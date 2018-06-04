<?php

namespace Request;

class AccountRequest extends BaseRequest
{
    public $accountGUID;

    public function __construct(APIClientInterface $apiClient, $customerGUID, $method, $accountGUID)
    {
        $this->accountGUID = $accountGUID;
        parent::__construct($apiClient, $customerGUID, $method);
    }

    public function getDetails()
    {
        $accountData = $this->getAccountData($this->accountGUID);

        if ($accountData) {
            return $accountData['firstname'] . ',' . $accountData['lastname'] . ','
                        . $accountData['email'] . ',' . $accountData['telephone'];
        }

        return 'User account doesn\'t exist';
    }

    public function getBalance() {
        $accountData = $this->getAccountData($this->accountGUID);
        if ($accountData) {
            return $accountData['balance'];
        }

        return 'User account doesn\'t exist';
    }
}