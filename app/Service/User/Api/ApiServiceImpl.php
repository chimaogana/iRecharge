<?php
namespace App\Service\Api;

use Illuminate\Support\Facades\Http;

Class ApiServiceImpl implements ApiService{

    protected $client;
    protected $baseUrl;

    public function __construct() {
        $this->client = new Http();
        $this->baseUrl = 'https://irecharge.com.ng/pwr_api_sandbox/v2/'; // Replace with your API's base URL
    }

    
}















?>