<?php
namespace ZfeggAdmin\V1\Rest\UserRoles;

use Zend\Db\TableGateway\TableGateway;

class UserRolesResourceFactory
{
    public function __invoke($services)
    {
        $table = new TableGateway('admin_assign_user_role', $services->get('ZfeggAdmin'));
        return new UserRolesResource($table);
    }
}
