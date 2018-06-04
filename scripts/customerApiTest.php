<?php

require_once __DIR__ . '/../boot.php';

$customerGUID = 'a4a06bb0-3fbe-40bd-9db2-f68354ba742f';
$accountGUID = '50456415-4ea0-42b2-adae-063edce3225c';

try {
    $apiClient = new \Request\RestAPIClient();

    $customerRequest = new Request\CustomerRequest($apiClient, $customerGUID, 'GET');

    $customerData = $customerRequest->getCustomerData();
    // 1.4 As the customer, I want to get the name, email address, telephone and balance for an account,
    // so that I can contact them and talk about their account.
    $accountDetails = $customerRequest->getAccountDetails($accountGUID);
    echo 'Account Details' . PHP_EOL.PHP_EOL;
    echo '<pre>';
    print_r($accountDetails);

    echo PHP_EOL;

    // 1.3 As the customer, I want to get a list of accounts in debt,
    // so that I can assess them for overdraft interest.
    $accountsInDebt = $customerRequest->getAccountsInDebt();
    echo 'Accounts in Debt' . PHP_EOL.PHP_EOL;
    print_r($accountsInDebt);
} catch (Exception $ex) {
    echo 'Error - '. $ex->getMessage();
}



