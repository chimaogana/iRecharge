<?php
namespace App\Service\Api;

interface ApiService {
    public function getData($endpoint);
    public function postData($endpoint, array $data);
}