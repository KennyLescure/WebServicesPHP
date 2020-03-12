<?php
class Api {

    public $token;
    private $url = "http://webservice-rest-velo-back.herokuapp.com/";

    public function __construct()
    {
        
    }

    public function connexion(string $email, string $mdp) {  

        $data = array('mail' => $email, 'password' => $mdp);
        $content = json_encode($data);

        $curl = curl_init($this->url."login");
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER,
                array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

        $json_response = curl_exec($curl);

        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if($status === 401)
        {
            echo($json_response);
            die();
        }
        else if ( $status != 200 ) {
            die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
        }

        curl_close($curl);

        $response = json_decode($json_response,true);

        if($response !== NULL && json_last_error() === JSON_ERROR_NONE)
        {
            var_dump($response['token']);
            $this->token=$response['token'];
        }

    }

    public function getAllProduit() : ?array {

        $curl = curl_init($this->url."product");
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $json_response = curl_exec($curl);

        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ( $status != 200 ) {
            die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
        }


        curl_close($curl);

        $response = json_decode($json_response, true);
        var_dump($response);
        return $response;
    }

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
