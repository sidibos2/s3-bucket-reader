<?php

require_once __DIR__ . '/../boot.php';

$accountGUID = '777e58b3-63bd-4fb7-af9a-bbf7069f1782';
$customerGUID = 'a4a06bb0-3fbe-40bd-9db2-f68354ba742f';

try {
    $apiClient = new \Request\RestAPIClient();
    $accountRequest = new \Request\AccountRequest(
        $apiClient,
        $customerGUID,
        'GET',
        $accountGUID
    );

    // 1.1 As an account holder, I want to check my balance, so that I know how much money I have.
    $balance = $accountRequest->getBalance();
    echo $balance.PHP_EOL.PHP_EOL;

    echo PHP_EOL;

    // 1.2 As an account holder, I want to check the details being held about me,
    // so that I can make sure the correct details are being stored.
    $details = $accountRequest->getDetails();
    echo $details.PHP_EOL.PHP_EOL;
} catch (Exception $ex) {
    echo 'Error - ' . $ex->getMessage();
}