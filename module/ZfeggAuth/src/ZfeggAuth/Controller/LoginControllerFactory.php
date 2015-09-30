<?php
namespace ZfeggAuth\Controller;

class LoginControllerFactory
{
    public function __invoke($controllers)
    {
        return new LoginController();
    }
}
