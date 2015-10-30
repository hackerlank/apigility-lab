<?php
namespace ZfeggAdmin\V1\Rest\RoleResources;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class RoleResourcesResourceFactory
{
    public function __invoke($services)
    {
        $resultSetPrototype = new ResultSet(ResultSet::TYPE_ARRAYOBJECT, new RoleResourcesEntity());
        $table              = new TableGateway(
            'admin_assign_role_resource',
            $services->get('ZfeggAdmin'),
            null,
            $resultSetPrototype
        );

        return new RoleResourcesResource($table);
    }
}
