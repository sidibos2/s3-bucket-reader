<?php
namespace Request;

class BaseRequest
{
  const S3_BUCKET_URL = 'https://mvf-devtest-s3api.s3-eu-west-1.amazonaws.com/';

  protected $url;
  protected $apiClient;
  protected $method;

  public function __construct(APIClientInterface $apiClient, $customerGUID, $method)
  {
      $this->checkGUID($customerGUID);

      $this->url = self::S3_BUCKET_URL . "{$customerGUID}.json";
      $this->apiClient = $apiClient;
      $this->method = $method;
  }

  public function checkGUID($guid)
  {
      if (empty($guid)) {
          throw new \Exception('GUID cannot be empty');
      }
  }

  public function getCustomerData()
  {
      $res = $this->apiClient->callAPI($this->url, $this->method);

      return json_decode($res, true);
  }

  public function findAccountIndex($accountGUID, $data)
  {
      return array_search($accountGUID, array_column($data, 'id'));
  }

  public function getAccountData($accountGUID)
  {
      $this->checkGUID($accountGUID);

      $response = $this->getCustomerData();
      $accounts = $response['accounts'];
      $accountData = [];

      if ($key  = $this->findAccountIndex($accountGUID, $accounts)) {
          $accountData = $accounts[$key];
      }

      return $accountData;
  }
}