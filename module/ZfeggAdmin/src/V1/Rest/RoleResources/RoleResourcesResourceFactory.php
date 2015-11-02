<?php
namespace ZfeggAdmin\V1\Rest\RoleResources;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class RoleResourcesResourceFactory
{
    public function __invoke($services)
    {
        $tableName          = $services->get('config')['zfegg-admin']['tables']['role_resources'];
        $resultSetPrototype = new ResultSet(ResultSet::TYPE_ARRAYOBJECT, new RoleResourcesEntity());
        $table              = new TableGateway(
            $tableName,
            $services->get('ZfeggAdmin'),
            null,
            $resultSetPrototype
        );

        return new RoleResourcesResource($table);
    }
}
