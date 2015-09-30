<?php
namespace ZfeggAdmin\V1\Rest\RoleResources;

use Zend\Db\TableGateway\TableGateway;

class RoleResourcesResourceFactory
{
    public function __invoke($services)
    {
        $table = new TableGateway('admin_assign_role_resource', $services->get('ZfeggAdmin'));
        return new RoleResourcesResource($table);
    }
}
