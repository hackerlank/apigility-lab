<?php

namespace Zfegg\Admin\MvcAuth\Authentication;


use Zend\Authentication\Adapter\DbTable\AbstractAdapter;
use Zend\Authentication\Result as AuthenticationResult;
use Zend\Db\Sql;
use Zend\Http\Response;
use ZF\OAuth2\Adapter\BcryptTrait;

class DbAuthenticationAdapter extends AbstractAdapter
{
    use BcryptTrait;
    const COLUMN_USER_ENABLED = 'user_enabled';

    /**
     * _authenticateValidateResult() - This method attempts to validate that
     * the record in the resultset is indeed a record that matched the
     * identity provided to this adapter.
     *
     * @param  array $resultIdentity
     * @return AuthenticationResult
     */
    protected function authenticateValidateResult($resultIdentity)
    {
        if (!$resultIdentity[self::COLUMN_USER_ENABLED]) {
            $this->authenticateResultInfo['code']       = AuthenticationResult::FAILURE;
            $this->authenticateResultInfo['messages'][] = 'Identity is disabled.';
            return $this->authenticateCreateAuthResult();
        }

        if (!$this->getBcrypt()->verify($this->getCredential(), $resultIdentity['password'])) {
            $this->authenticateResultInfo['code']       = AuthenticationResult::FAILURE_CREDENTIAL_INVALID;
            $this->authenticateResultInfo['messages'][] = 'Supplied credential is invalid.';
            return $this->authenticateCreateAuthResult();
        }

        unset($resultIdentity[self::COLUMN_USER_ENABLED]);

        $this->setIdentity($resultIdentity);
        $this->resultRow = $resultIdentity;

        $this->authenticateResultInfo['code']       = AuthenticationResult::SUCCESS;
        $this->authenticateResultInfo['identity']   = $resultIdentity;
        $this->authenticateResultInfo['messages'][] = 'Authentication successful.';
        return $this->authenticateCreateAuthResult();
    }

    /**
     * _authenticateCreateSelect() - This method creates a Zend\Db\Sql\Select object that
     * is completely configured to be queried against the database.
     *
     * @return Sql\Select
     */
    protected function authenticateCreateSelect()
    {
        // get select
        $dbSelect = clone $this->getDbSelect();
        $dbSelect->columns(['*', self::COLUMN_USER_ENABLED => new Sql\Expression('status=0')]);
        $dbSelect->from('oauth_users')
            ->where([
                'username' => $this->getIdentity(),
            ]);

        return $dbSelect;
    }
}