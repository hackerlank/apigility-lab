<?php
use Zend\Http\ClientStatic;
use Zend\Json\Json;

include __DIR__ . '/../../../vendor/autoload.php';

$a = <<<EOT
[{
    "text": "\u7cfb\u7edf",
    "index": 0,
    "expanded": true,
    "items": [{
      "text": "\u7528\u6237\u7ba1\u7406",
      "index": 0,
      "url": "..\/data\/admin\/user.html"
    }, {
      "text": "\u89d2\u8272\u7ba1\u7406",
      "index": 1,
      "url": "\/admin\/role"
    }, {
      "text": "\u6743\u9650\u7ba1\u7406",
      "index": 2,
      "url": "\/admin\/permission"
    }, {"text": "\u4e2a\u4eba\u4fe1\u606f", "index": 4, "url": ".\/ui\/admin\/index\/self"}]
  }, {
    "text": "\u6a21\u578b\u7ba1\u7406",
    "expanded": true,
    "items": [{
      "text": "\u6570\u636e\u6e90\u6dfb\u52a0",
      "index": 0,
      "url": "\/model-manager\/data-source-config\/add"
    }, {
      "text": "\u6570\u636e\u6e90\u7ba1\u7406",
      "index": 0,
      "url": "\/model-manager\/data-source-config\/index"
    }, {
      "text": "\u6a21\u578bUI\u914d\u7f6e",
      "index": 1,
      "url": "\/ui\/model-manager\/ui-config\/index"
    }, {
      "text": "\u6a21\u578bUI\u5217\u8868",
      "index": 1,
      "url": "\/ui\/model-manager\/ui-config\/list"
    }, {
      "text": "\u83dc\u5355\u914d\u7f6e",
      "url": "\/model-manager\/source\/view\/id\/4"
    }, {"text": "\u6570\u636e\u6e90\u6743\u9650", "url": ".\/model-manager\/source\/view\/id\/2"}]
  }, {
    "text": "\u6b66\u6781\u5929\u4e0b",
    "expanded": true,
    "items": [{
      "text": "\u89d2\u8272\u67e5\u8be2",
      "index": 0,
      "url": "\/gm\/character"
    }, {
      "text": "\u5145\u503c\u67e5\u8be2",
      "index": 0,
      "url": "\/gm\/character\/charge-record"
    }, {
      "text": "\u7528\u6237\u589e\u51cf\u67e5\u8be2",
      "index": 1,
      "url": "\/gm\/character\/reduce-and-increment"
    }, {
      "text": "\u9053\u5177\u64cd\u4f5c\u8bb0\u5f55\u67e5\u8be2",
      "index": 1,
      "url": "\/gm\/character\/item-operation-record"
    }, {
      "text": "\u540e\u53f0\u5145\u503c",
      "url": "\/gm"
    }, {
      "text": "\u793c\u5305\u7801\u5236\u4f5c\u5de5\u5177",
      "url": "\/gm"
    }, {"text": "\u4fe1\u606f\u53d1\u5e03\u5de5\u5177", "url": ".\/gm"}]
}]
EOT;

var_export(json_decode($a, 1));


exit;
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