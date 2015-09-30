<?php
namespace ZfeggAdmin\V1\Rpc\Profile;

class ProfileControllerFactory
{
    public function __invoke($controllers)
    {
        return new ProfileController();
    }
}
