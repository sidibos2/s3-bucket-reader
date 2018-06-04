<?php
/**
 * Created by PhpStorm.
 * User: sidibos
 * Date: 03/06/2018
 * Time: 23:09
 */

namespace Request;


class RestAPIClient implements APIClientInterface
{
    private $client;

    public function __construct() {
        $this->client = new \GuzzleHttp\Client();
    }

    public function callAPI($url, $method) {
        $this->checkUrl($url);
        $this->checkMethod($method);
        $res = $this->client->request($method, $url);

        if ($res->getStatusCode() !== 200) {
            throw new \Exception("Error - {$res->getReasonPhrase()}", $res->getStatusCode());
        }

        return $res->getBody();
    }

    public function checkUrl($url) {
        if (empty($url)) {
            throw new \Exception('Url cannot be empty');
        }
    }

    public function checkMethod($method) {
        if (empty($method)) {
            throw new \Exception('Method cannot be empty');
        }
    }
}