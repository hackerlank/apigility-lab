<?php

namespace Zfegg\Admin\MvcAuth\Factory;

use Zend\Http\Request;
use Zend\Permissions\Acl\Acl;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AclAuthorizationFactory extends \ZF\MvcAuth\Factory\AclAuthorizationFactory
{
    /** @var  Acl */
    protected $acl;


    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {

        $this->acl = new Acl();

        if (!$serviceLocator->has('config')) {
            return $this->acl;
        }

        $this->initRoles($serviceLocator);
        $this->initResources($serviceLocator);

        /** @var \ZfeggAdmin\V1\Rest\RoleResources\RoleResourcesResource $roleResources */
        $roleResources = $serviceLocator->get('Zfegg\Admin\MvcAuth\RoleResourcesResource');
        $resources = $roleResources->fetchAllFull();

        foreach ($resources as $resource) {
            $this->acl->allow($resource['role_id'], $resource['resource'], explode(',', $resource['privileges']));
        }

        return $this->acl;
    }


    private function initResources(ServiceLocatorInterface $serviceLocator)
    {
        $config = $this->createAclFromConfig($serviceLocator->get('config'));
        foreach ($config as $resource) {
            $this->acl->addResource($resource['resource']);
        }
    }

    private function initRoles(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \Zend\Db\TableGateway\TableGateway $roleTable */
        $roleTable = $serviceLocator->get('ZfeggAdmin\V1\Rest\AdminRole\AdminRoleResource\Table');

        $roles = $roleTable->select()->toArray();

        $dataMapCallable = function ($row, $data) {
            return $data + $row;
        };
        $roles = $this->toTreeData($roles, $dataMapCallable)[0]['children'];

        $this->createRoles($roles);
    }

    private function createRoles($roles, $parent = null)
    {
        foreach ($roles as $role) {
            $this->acl->addRole($role['role_id'], $parent);
            if (isset($role['children'])) {
                $this->createRoles($role['children'], $role['role_id']);
            }
        }
    }

    public static function toTreeData($rows, callable $dataMapCallable, $key = 'role_id', $childKey = 'children')
    {
        $rootId = 0;
        $data   = array($rootId => array($childKey => array()));
        foreach ($rows as $row) {
            if (!isset($data[$row[$key]])) {
                $data[$row[$key]] = [];
            }
            $data[$row[$key]] = $dataMapCallable($row, $data[$row[$key]]);
            $data[$row['parent']][$childKey][] = &$data[$row[$key]];
        }
        return $data;
    }

    /**
     * Generate the ACL instance based on the zf-mvc-auth "authorization" configuration
     *
     * Consumes the AclFactory in order to create the AclAuthorization instance.
     *
     * @param array $config
     * @return \ZF\MvcAuth\Authorization\AclAuthorization
     */
    protected function createAclFromConfig(array $config)
    {
        $aclConfig     = [];
        $denyByDefault = false;

        if (isset($config['zf-mvc-auth'])
            && isset($config['zf-mvc-auth']['authorization'])
        ) {
            $config = $config['zf-mvc-auth']['authorization'];

            if (array_key_exists('deny_by_default', $config)) {
                $denyByDefault = $aclConfig['deny_by_default'] = (bool) $config['deny_by_default'];
                unset($config['deny_by_default']);
            }

            foreach ($config as $controllerService => $privileges) {
                $this->createAclConfigFromPrivileges($controllerService, $privileges, $aclConfig, $denyByDefault);
            }
        }

        return $aclConfig;
    }
}