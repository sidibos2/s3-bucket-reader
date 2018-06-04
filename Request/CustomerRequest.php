<?php
/**
 * Created by PhpStorm.
 * User: sidibos
 * Date: 03/06/2018
 * Time: 23:30
 */

namespace Request;


class CustomerRequest extends BaseRequest
{
    public function getAccountDetails($accountGUID)
    {
        $this->checkGUID($accountGUID);

        $response = $this->getCustomerData();
        $accounts = $response['accounts'];
        $accountData = [];

        if ($key  = $this->findAccountIndex($accountGUID, $accounts)) {
            $accountData = $accounts[$key];
            $accountData['name'] = $accountData['firstname'] . ' ' . $accountData['lastname'];
            unset($accountData['id']);
            unset($accountData['firstname']);
            unset($accountData['lastname']);
        }

        return $accountData;
    }

    public function getAccountsInDebt()
    {
        $response = $this->getCustomerData();
        $accounts = $response['accounts'];
        $resultData = [];

        foreach($accounts  as $account) {
            if ($account['balance'] < 0) {
                $resultData[] = $account['id'];
            }
        }

        return $resultData;
    }
}