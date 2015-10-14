<?php
namespace ZfeggAdmin\V1\Rpc\Profile;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

class ProfileController extends AbstractActionController
{
    public function indexAction()
    {
        return new JsonModel([
            'email' => 'xxx@xxx.com',
            'real_name' => 'xxxx',
            'account' => 'XXXX',
        ]);
        return new JsonModel($this->identity());
    }

    public function menusAction()
    {
        $configs = $this->getServiceLocator()->get('config');
        $menus   = isset($configs['zfegg-admin']['menus']) ? $configs['zfegg-admin']['menus'] : [];
        return new JsonModel($menus);
    }
}
