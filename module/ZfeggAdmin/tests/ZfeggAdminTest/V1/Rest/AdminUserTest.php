<?php


namespace ZfeggAdminTest\V1\Rest;


use Zend\Http\ClientStatic;
use Zend\Json\Json;

class AdminUserTest extends \PHPUnit_Framework_TestCase {

    public function testGet()
    {

        $response = ClientStatic::get('http://zfeggapi.local/admin_role', [],
            [
                'Accept' => 'application/hal+json',
            ]
        );

        echo Json::prettyPrint($response->getBody());

        $this->assertEquals(1, 1);
    }
}
