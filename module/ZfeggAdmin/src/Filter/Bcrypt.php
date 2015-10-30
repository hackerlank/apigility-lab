<?php
namespace ZfeggAdmin\Filter;

use Zend\Filter\AbstractFilter;
use Zend\Filter\Exception;
use ZF\OAuth2\Adapter\BcryptTrait;

class Bcrypt extends AbstractFilter
{
    use BcryptTrait;

    /**
     * Returns the result of filtering $value
     *
     * @param  mixed $value
     * @throws Exception\RuntimeException If filtering $value is impossible
     * @return mixed
     */
    public function filter($value)
    {

        if ($value[0] == '$' && strlen($value) > 32) {
            return $value;
        }

        $this->createBcryptHash($value);

        return $value;
    }
}