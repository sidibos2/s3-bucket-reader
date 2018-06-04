<?php
namespace Request;

Interface APIClientInterface {
    public function callAPI($url, $method);
}