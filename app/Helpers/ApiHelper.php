<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 11/10/2018
 * Time: 15:28
 */

namespace App\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;


class ApiHelper
{
    private $apiEndpoint;
    private $apiVersion;
    private $guzzle;

    public function __construct(Client $guzzle)
    {
        $this->apiEndpoint = config('api.api_endpoint');
        $this->apiVersion = config('api.api_version');
        $this->guzzle = $guzzle;

    }

    public function _getHeader() {
        $token = session('token');
        return [
            "Content-Type"=> "application/json",
            "Authorization"=>"Bearer {$token}"
        ];
    }

    public function _makeUrl ($path, $params = "") {
        $url = $this->apiEndpoint;

        if(!empty($this->apiVersion)) {
            $url .= "/{$this->apiVersion}";
        }

        $url .= "/{$path}";

        if(!empty($params)) {
            $queryString = http_build_query($params);

            $url .= "?{$queryString}";
        }

        return $url;
    }

    public function getJson($path, $params= "") {
        $url = $this->_makeUrl($path,$params);
        $headers = $this->_getHeader();

        try {
            $result = $this->guzzle->get($url, [
                'headers'=>$headers
            ]);
        } catch (\Exception $e) {
            return ['errors'=>$e->getMessage()];
        }

        $res = json_decode($result->getBody()->getContents(), true);

        if(isset($res['error'])) {
            return ['errors'=>$res['error']];
        }

        return $res;
    }

    public function postJson($path, $data, $params = "") {
        $url = $this->_makeUrl($path, $params);
        $headers = $this->_getHeader();

        try {
            $result = $this->guzzle->post($url, [
                'json'=>$data,
                'headers'=>$headers
            ]);
        } catch (\Exception $e) {
            return ['errors'=>$e->getMessage()];
        }

        $code = $result->getStatusCode();

        return $code;
    }

    public function patchJson($path, $data, $params = "") {
        $url = $this->_makeUrl($path, $params);
        $headers = $this->_getHeader();

        try {

            $result = $this->guzzle->patch($url, [
                'json'=>$data,
                'headers'=>$headers
            ]);

        } catch ( ClientException $e) {

            $errors = (string)($e->getResponse()->getBody());

            return ['errors'=>$errors];
        }

        $code = $result->getStatusCode();

        return $code;
    }

    public function deleteJson($path, $params = "") {
        $url = $this->_makeUrl($path, $params);
        $headers = $this->_getHeader();

        try {
            $result = $this->guzzle->delete($url, [
                'headers'=>$headers
            ]);
        } catch (\Exception $e) {
            return ['errors'=>$e->getMessage()];
        }

        $code = $result->getStatusCode();

        return $code;

    }

    public function getTokenJson($path, $data, $params = "") {

        $url = $this->_makeUrl($path, $params);

        try {
            $result = $this->guzzle->post($url, [
                'json'=>$data,
                'headers'=>[
                    "Content-Type"=>"application/json"
                ]
            ]);
        } catch (\Exception $e) {
            return ['errors'=>$e->getMessage()];
        }

        $res = json_decode($result->getBody()->getContents(), true);

        session()->put(['token'=>$res['token']]);

        return $res;
    }

}
