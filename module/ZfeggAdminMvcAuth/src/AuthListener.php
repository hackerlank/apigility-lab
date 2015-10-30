<?php

namespace Zfegg\Admin\MvcAuth;


use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\Http\PhpEnvironment\Response;
use Zend\Mvc\MvcEvent;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use ZF\MvcAuth\Identity;

class AuthListener extends AbstractListenerAggregate implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    protected $identity;

    /**
     * Attach one or more listeners
     *
     * Implementors may add an optional $priority argument; the EventManager
     * implementation will pass this to the aggregate.
     *
     * @param EventManagerInterface $events
     *
     * @return void
     */
    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach(MvcEvent::EVENT_ROUTE, [$this, 'authentication'], -1000);
    }

    public function authentication(MvcEvent $e)
    {
        $response = $e->getResponse();

        if (!$response instanceof Response) {
            return $response;
        }

        $sl = $this->getServiceLocator();

        /**
         * @var \Zend\Authentication\AuthenticationService $auth
         * @var \Zf\MvcAuth\Authorization\DefaultResourceResolverListener $resourceBuild
         * @var \Zend\Permissions\Acl\Acl $acl
         * @var \Zend\Http\PhpEnvironment\Request $request
         */
        $request       = $e->getRequest();
        $resourceBuild = $sl->get('ZF\MvcAuth\Authorization\DefaultResourceResolverListener');
        $resource      = $resourceBuild->buildResourceString($e->getRouteMatch(), $request);
        $acl           = $sl->get('Zfegg\Admin\MvcAuth\Acl');
        $auth          = $sl->get('authentication');
        $configs       = $sl->get('config');

        if (!$acl->hasResource($resource)) {
            return;
        }

        if (!$auth->hasIdentity()) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }

        $identity = $auth->getIdentity();

        $userIdKey = isset($configs['zfegg-auth']['user_id']) ? $configs['zfegg-auth']['user_id'] : 'user_id';

        /** @var \ZfeggAdmin\V1\Rest\UserRoles\UserRolesResource $userRoles */
        $userRoles = $sl->get('Zfegg\Admin\MvcAuth\UserRolesResource');
        $roles     = $userRoles->setUserId($identity[$userIdKey])->fetchAll();
        $reason    = sprintf('Resource "%s", user "%s" is not allowed.', $resource, $identity[$userIdKey]);

        foreach ($roles as $role) {
            if ($acl->isAllowed($role['role_id'], $resource, $request->getMethod())) {
                return;
            }
        }

        return new ApiProblemResponse(new ApiProblem(403, $reason));
    }
}