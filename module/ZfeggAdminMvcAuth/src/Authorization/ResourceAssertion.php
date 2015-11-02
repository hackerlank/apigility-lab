<?php

namespace Zfegg\Admin\MvcAuth\Authorization;


use Zend\Db\Sql\Sql;
use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Assertion\AssertionInterface;
use Zend\Permissions\Acl\Resource\ResourceInterface;
use Zend\Permissions\Acl\Role\RoleInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class ResourceAssertion implements ServiceLocatorAwareInterface, AssertionInterface
{
    use ServiceLocatorAwareTrait;

    /**
     * Returns true if and only if the assertion conditions are met
     *
     * This method is passed the ACL, Role, Resource, and privilege to which the authorization query applies. If the
     * $role, $resource, or $privilege parameters are null, it means that the query applies to all Roles, Resources, or
     * privileges, respectively.
     *
     * @param  Acl $acl
     * @param  RoleInterface $role
     * @param  ResourceInterface $resource
     * @param  string $privilege
     * @return bool
     */
    public function assert(Acl $acl, RoleInterface $role = null, ResourceInterface $resource = null, $privilege = null)
    {
        /** @var \Zend\Db\Adapter\Adapter $dbAdapter */
        $dbAdapter = $this->getServiceLocator()->get('ZfeggAdmin');
        $configs   = $this->getServiceLocator()->get('config');
        $tables    = $configs['zfegg-admin']['tables'];

        if ($this->inWhitelist($role->getRoleId(), $resource->getResourceId(), $privilege, $configs)) {
            return false;
        }

        $sql    = new Sql($dbAdapter);
        $select = $sql->select();
        $select->from($tables['user_roles']);
        $select->columns([]);
        $select->join(
            $tables['role_resources'],
            sprintf('%s.role_id=%s.role_id', $tables['user_roles'], $tables['role_resources'])
        );
        $select->where(['user_id' => $role->getRoleId()]);
        $select->where(['resource' => $resource->getResourceId()]);
        $prepare = $sql->prepareStatementForSqlObject($select);

        $methods = explode(',', $prepare->execute()->current()['methods']);

        return !in_array($privilege, $methods);
    }

    public function inWhitelist($role, $resource, $privilege, array $configs)
    {
        $resource       = str_replace('\\', '-', $resource);
        $roleWhitelists = $configs['zfegg-admin-mvc-auth']['role_whitelists'];

        foreach ($roleWhitelists as $rolePattern => $resourceWhitelists) {
            if (fnmatch($rolePattern, $role)) {
                foreach ($resourceWhitelists as $resourcePattern => $privileges) {
                    $resourcePattern = str_replace('\\', '-', $resourcePattern);
                    if (fnmatch($resourcePattern, $resource)) {
                        return empty($privileges) || in_array($privilege, $privileges);
                    }
                }
            }
        }

        return false;
    }
}