<?php
namespace ZfeggAdmin\V1\Rest\Resources;

use Zend\ServiceManager\ServiceManager;

class ResourcesResourceFactory
{
    public function __invoke(ServiceManager $services)
    {
        $listener = new ResourcesResource();
        $listener->setResources($this->getConfigs($services));

        return $listener;
    }

    protected function getConfigs(ServiceManager $services)
    {
        $configs = $services->get('config')['zf-rest'];

        $docConfigs = $services->get('config')['zfegg-admin']['resources-documentation'];

        foreach ($configs as $ctrl => $config) {
            //忽略apigility
            if (strpos($ctrl, 'ZF\Apigility') === 0) {
                unset($configs[$ctrl]);
                continue;
            }

            if (isset($docConfigs[$ctrl])) {
                $configs[$ctrl] = array_merge($configs[$ctrl], $docConfigs[$ctrl]);
            } else if (isset($config['service_name'])) {
                $configs[$ctrl]['description'] = $config['service_name'];
            } else {
                print_r($configs);exit;
            }
        }

        return $configs;
    }
}
