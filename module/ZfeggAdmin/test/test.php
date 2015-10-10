<?php
use Zend\Http\ClientStatic;
use Zend\Json\Json;

include __DIR__ . '/../../../vendor/autoload.php';

//echo  Json::prettyPrint(file_get_contents('http://image.baidu.com/i?tn=baiduimagejson&width=&height=&word='.urlencode('金馆长').'&rn=10&pn=2'));
//exit;
use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Role\GenericRole as Role;
use Zend\Permissions\Acl\Resource\GenericResource as Resource;

$acl = new Acl();

$acl->addRole(new Role('guest'))
    ->addRole(new Role('admin'));

$parents = array('member', 'admin');

$acl->addRole('member2', ['member']);
$acl->addRole('member', ['guest']);

$acl->addRole(new Role('someUser'), $parents);

$acl->addResource(new Resource('someResource'));

$acl->deny('guest', 'someResource');
//$acl->allow('member', 'someResource');

echo $acl->isAllowed('someUser', 'someResource') ? 'allowed' : 'denied';


exit;
use Zend\Crypt\Password\Bcrypt;

$bcrypt = new Bcrypt();
$securePass = $bcrypt->create('testpass');
//$securePass = '111111';
$password = 'testpass';

echo "Password: $password\n";
echo "Secure Pass: $securePass\n";
if ($bcrypt->verify($password, $securePass)) {
    echo "The password is correct! \n";
} else {
    echo "The password is NOT correct.\n";
}

exit;
$response = ClientStatic::get('http://zfeggapi.local/admin_role', [],
    [
        'Accept' => 'application/hal+json',
    ]
);

echo $response->getBody();exit;
echo Json::prettyPrint($response->getBody());