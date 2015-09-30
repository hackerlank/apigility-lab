<?php

namespace ZfeggAuth\Factory;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZfeggAuth\Authentication\DbAuthenticationAdapter;

class AuthenticationAdapterFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config')['zfegg-auth']['authentication'];

        return new DbAuthenticationAdapter(
            $serviceLocator->get($config['adapter']),
            $config['table'],
            $config['identity_column'],
            $config['credential_column']
        );
    }
}