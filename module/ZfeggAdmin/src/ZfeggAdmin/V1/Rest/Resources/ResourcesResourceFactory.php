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
        $authConfigs = $services->get('config')['zf-mvc-auth']['authorization'];
        $restConfigs = $services->get('config')['zf-rest'];
        $rpcConfigs  = $services->get('config')['zf-rpc'];
        $docConfigs  = $services->get('config')['zfegg-admin']['resources-documentation'];
        $resources   = [];

        unset($authConfigs['deny_by_default']);

//        var_dump($authConfigs, $restConfigs, $rpcConfigs);exit;
        foreach ($authConfigs as $ctrl => $authConfig) {
            if (isset($authConfig['actions'])) {
                $methods = [];
                foreach ($authConfig['actions'] as $action => $authMethods) {
                    foreach ($authMethods as $method => $val) {
                        if ($val) {
                            $methods[] = $method;
                        }
                    }
                }

                $resources[$ctrl] = [
                    'type'    => 'rpc',
                    'actions' => array_keys($authConfig['actions']),
                    'methods' => $methods
                ];

            } else {
                $methods = [];
                foreach (['collection', 'entity'] as $action) {
                    foreach ($authConfig[$action] as $method => $val) {
                        if ($val) {
                            $methods[] = $method;
                        }
                    }
                }

                if (empty($methods)) {
                    continue;
                }

                $resources[$ctrl] = [
                    'type'    => 'rest',
                    'actions' => ['collection', 'entity'],
                    'methods' => $methods
                ];
            }

            $resources[$ctrl]['resource'] = $ctrl;

            if (isset($docConfigs[$ctrl])) {
                $resources[$ctrl]['description'] = $docConfigs[$ctrl]['description'];
            } else if (isset($restConfigs[$ctrl]['service_name'])) {
                $resources[$ctrl]['description'] = $restConfigs[$ctrl]['service_name'];
            } else if (isset($rpcConfigs[$ctrl]['service_name'])) {
                $resources[$ctrl]['description'] = $rpcConfigs[$ctrl]['service_name'];
            } else {
                $resources[$ctrl]['description'] = '';
            }
        }

        return $resources;
    }
}
