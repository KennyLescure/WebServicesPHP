<?php
class Api {

    public $token;
    private static $url = "https://webservice-rest-velo-back.herokuapp.com/";

    public function __construct()
    {
        
    }

    private function 

    /*
    private function callApi(string $endPoint) : ?array
    {
        $curl = curl_init();
        $opts = [
            CURLOPT_URL => "https://webservice-rest-velo-back.herokuapp.com/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 1
        ];
        curl_setopt_array($curl,$opts);
        $response = curl_exec($curl);
        if($response === false || curl_getinfo($curl,CURLINFO_HTTP_CODE) !== 200) {
            var_dump(curl_error($curl));
            return null;
        } else {
            $response = json_decode($response, true);
            return $response;
        }
    }*/
}
