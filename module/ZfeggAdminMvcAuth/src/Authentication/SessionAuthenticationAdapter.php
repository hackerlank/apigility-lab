<?php

namespace Zfegg\Admin\MvcAuth\Authentication;


use Zend\Http\Request;
use Zend\Http\Response;
use ZF\MvcAuth\Authentication\AbstractAdapter;
use ZF\MvcAuth\Identity\IdentityInterface;
use ZF\MvcAuth\Identity;
use ZF\MvcAuth\MvcAuthEvent;

class SessionAuthenticationAdapter extends AbstractAdapter
{
    protected $providesTypes = ['Session'];

    /**
     * @return array Array of types this adapter can handle.
     */
    public function provides()
    {
        return $this->providesTypes;
    }

    /**
     * Attempt to match a requested authentication type
     * against what the adapter provides.
     *
     * @param string $type
     * @return bool
     */
    public function matches($type)
    {
        var_dump($type);exit;
        return in_array($type, $this->providesTypes, true);
    }

    /**
     * Perform pre-flight authentication operations.
     *
     * Use case would be for providing authentication challenge headers.
     *
     * @param Request $request
     * @param Response $response
     * @return void|Response
     */
    public function preAuth(Request $request, Response $response)
    {

    }

    /**
     * Attempt to authenticate the current request.
     *
     * @param Request $request
     * @param Response $response
     * @param MvcAuthEvent $mvcAuthEvent
     * @return false|IdentityInterface False on failure, IdentityInterface
     *     otherwise
     */
    public function authenticate(Request $request, Response $response, MvcAuthEvent $mvcAuthEvent)
    {
        if (! $request->getHeader('Authorization', false)) {
            // No credentials were present at all, so we just return a guest identity.
            return new Identity\GuestIdentity();
        }



        return false;


        $result = $this->authenticationService->authenticate($this->httpAuth);
        $mvcAuthEvent->setAuthenticationResult($result);

        if (! $result->isValid()) {
            return false;
        }

        $resultIdentity = $result->getIdentity();

        // Pass fully discovered identity to AuthenticatedIdentity instance
        $identity = new Identity\AuthenticatedIdentity($resultIdentity);

        // But determine the name separately
        $name = $resultIdentity;
        if (is_array($resultIdentity)) {
            $name = isset($resultIdentity['username'])
                ? $resultIdentity['username']
                : (string) array_shift($resultIdentity);
        }
        $identity->setName($name);

        return $identity;
    }
}