<?php
namespace ZfeggAuth\Controller;

use Zend\Form\Element\Captcha;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

/**
 * Class LoginController
 *
 * @method \Zend\Http\PhpEnvironment\Request getRequest()
 */
class LoginController extends AbstractActionController
{
    public function loginAction()
    {
        $sl = $this->getServiceLocator();
        /** @var \Zend\Form\Form $form */
        $form = $sl->get('FormElementManager')->get('ZfeggAuth\Login');

        if ($this->getRequest()->isPost()) {
            $form->setData($_POST);
            if (!$form->isValid()) {
                return new ApiProblemResponse(
                    new ApiProblem(422, 'Failed Validation', null, null, [
                        'validation_messages' => $form->getMessages(),
                    ])
                );
            }


            /**
             * @var \Zend\Authentication\AuthenticationService $auth
             * @var \ZfeggAuth\Authentication\DbAuthenticationAdapter $authAdapter
             */
            $auth          = $sl->get('Zend\Authentication\AuthenticationService');
            $authAdapter   = $sl->get('ZfeggAuth\AuthenticationAdapter');
            $authAdapter->setIdentity($form->get('username')->getValue());
            $authAdapter->setCredential($form->get('password')->getValue());

            $auth->setAdapter($authAdapter);
            $result = $auth->authenticate();
            if ($result->isValid()) {
                session_regenerate_id(true);
                return new JsonModel(['success' => true, 'message' => 'Login success!']);
            } else {

                return new ApiProblemResponse(
                    new ApiProblem(
                        401, current($result->getMessages()), null, null, [
                            'messages' => $result->getMessages(),
                        ]
                    )
                );
            }
        }

        /** @var \Zend\Http\Header\Accept $accept */
        $accept = $this->getRequest()->getHeader('accept');

        if ($accept->hasMediaType('text/html')) {
            return new ViewModel(['form' => $form]);
        } else if ($accept->hasMediaType('application/json')) {
            return new JsonModel([]);
        } else {
            return new ViewModel(['form' => $form]);
        }
    }
}