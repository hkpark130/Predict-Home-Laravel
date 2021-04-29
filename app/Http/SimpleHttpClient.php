<?php

namespace App\Http;

use App\Exceptions\CommandRepeatedException;
use App\TrafficManage;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
//use GuzzleHttp\Handler\CurlHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\RotatingFileHandler;
use GuzzleHttp\Middleware;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Exception\ClientException;
use Symfony\Component\HttpKernel\Exception\HttpException;

use GuzzleHttp\Psr7;

class SimpleHttpClient extends Client
{
    protected $_baseurl;

    public function __construct()
    {

        $this->_baseurl = $_ENV['API_URL'];
        parent::__construct();

    }

    public function apiRequest(String $method, String $urlPath, Array $params)
    {
        $stack = HandlerStack::create();
        $client = new Client(['base_uri' => $this->_baseurl, 'handler' => $stack]);

        try {
            $response = $client->request($method, $urlPath, ['verify' => false, 'headers' => [
                "data" => json_encode($params)]
            ]);

            $this->statusCode = (string)$response->getStatusCode();
            $this->responseBody = (string)$response->getBody();

            if( (string)$response->getBody() === "null"){
                throw new HttpException(400, '시스템 에러') ;
            }
        }catch (ClientException $e){
            if($e->getCode() == 404){
                throw new HttpException($e->getCode(), $e->getMessage()) ;
            }
			// $response = (string)$e->getResponse()->getBody(true);
			throw new HttpException($e->getCode(), '시스템 에러');
        }

        return $this->responseBody ;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getResponseBody()
    {
        return $this->responseBody;
    }

    public function getDecodeResponseBody()
    {
        return json_decode($this->responseBody);
    }

}