<?php
namespace ZfeggAdmin\V1\Rpc\App;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AppController extends AbstractActionController
{
    public function appAction()
    {
        $modules = $this->getServiceLocator()->get('config')['zfegg-admin']['ui_modules'];

        $viewModel = new ViewModel(['modules' => $modules]);
        $viewModel->setTemplate('zfegg-admin-ui');
        $viewModel->setTerminal(true);

        return $viewModel;
    }
}
