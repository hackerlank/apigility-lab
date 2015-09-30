<?php
namespace ZfeggAdmin\V1\Rest\Resources;

use Zend\ServiceManager\ServiceManager;

class ResourcesResourceFactory
{
    public function __invoke(ServiceManager $services)
    {
        $listener = new ResourcesResource($services->get('config')['zf-rest']);
        $listener->setResources($services->get('config')['zf-rest']);

        return $listener;
    }
}
