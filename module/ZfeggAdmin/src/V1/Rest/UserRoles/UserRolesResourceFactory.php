<?php
namespace ZfeggAdmin\V1\Rest\UserRoles;

use Zend\Db\TableGateway\TableGateway;

class UserRolesResourceFactory
{
    public function __invoke($services)
    {
        $tableName = $services->get('config')['zfegg-admin']['tables']['user_roles'];
        $table = new TableGateway($tableName, $services->get('ZfeggAdmin'));
        return new UserRolesResource($table);
    }
}
