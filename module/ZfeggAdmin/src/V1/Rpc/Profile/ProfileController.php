<?php
namespace ZfeggAdmin\V1\Rpc\Profile;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

class ProfileController extends AbstractActionController
{
    public function indexAction()
    {
        if ($this->identity()) {
            return new JsonModel($this->identity());
        } else {
            return new JsonModel([
                'email' => '',
                'real_name' => '',
                'account' => '',
            ]);
        }
    }

    public function menusAction()
    {
        $configs = $this->getServiceLocator()->get('config');
        $menus   = isset($configs['zfegg-admin']['menus']) ? $configs['zfegg-admin']['menus'] : [];
        return new JsonModel($menus);
    }
}
