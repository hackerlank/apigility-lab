<?php
namespace ZfeggAdmin\V1\Rest\AdminRole;

use ArrayObject;

class AdminRoleEntity extends ArrayObject
{
    public function exchangeArray($input)
    {
        $input['role_id'] = intval($input['role_id']);
        $input['parent_id'] = intval($input['parent_id']);

        return parent::exchangeArray($input);
    }
}
