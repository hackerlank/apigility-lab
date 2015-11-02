<?php
namespace Zfegg\Admin\MvcAuth;

use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $app      = $e->getApplication();
        $events   = $app->getEventManager();
        $services = $app->getServiceManager();

        $events->attach(new Authorization\ResourcePermissionListener());
//        $events->attach($services->get('Zfegg\Admin\MvcAuth\AuthListener'));

//        $events->attach(
//            'authentication',
//            function ($e) use ($services) {
//                $listener = $services->get('ZF\MvcAuth\Authentication\DefaultAuthenticationListener');
//                $listener->attach($services->get('Zfegg\Admin\MvcAuth\AuthenticationAdapter'));
//            },
//            1000
//        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'ZF\Apigility\Autoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }
}