<?php
namespace ZfeggAdmin;

use Zend\Mvc\MvcEvent;
use ZF\Apigility\Provider\ApigilityProviderInterface;

class Module implements ApigilityProviderInterface
{
    public function onBootstrap(MvcEvent $e)
    {
        $app      = $e->getApplication();
        $events   = $app->getEventManager();
        $services = $app->getServiceManager();

//        $events->attach(
//            'authentication',
//            function ($e) use ($services) {
//                /** @var \ZF\MvcAuth\Authentication\DefaultAuthenticationListener $listener */
//                $listener = $services->get('ZF\MvcAuth\Authentication\DefaultAuthenticationListener');
//                $adapter = $services->get('MyCustomAuthenticationAdapter');
//                $listener->attach($adapter);
//            },
//            1000
//        );
    }
    
    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
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
