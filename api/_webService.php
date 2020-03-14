<?php
class Api {

    public $token;
    private $url = "http://webservice-rest-velo-back.herokuapp.com/";

    public function __construct()
    {
        
    }

    /**
     * Permet de vérif si l'utilisateur existe
     * @return true si l'utilisateur existe / false cas contraire
     */
    public function connexion(string $email, string $mdp) : bool {  

        $result = false;

        $data = array('mail' => $email, 'password' => $mdp);
        $content = json_encode($data);

        $curl = curl_init($this->url."login");
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
        $json_response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if($status === 401)
        {
            //echo($json_response);
            //die();
        } else if ( $status != 200 ) {
            die("Error: call to URL ".$this->url." failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
        }

        curl_close($curl);
        $response = json_decode($json_response,true);

        if($response !== NULL && json_last_error() === JSON_ERROR_NONE)
        {
            $this->token=$response['token'];
            $result = true;
        }

        return $result;
    }

    /**
     * Permet de retourner la liste des porduits
     * @return un array 'products' => 'categorie', 'description', 'id', 'name', 'price'
     */
    public function getAllProduit() : ?array {

        $curl = curl_init($this->url."product");
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $json_response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ( $status != 200 ) {
            die("Error: call to URL ".$this->url." failed with status $status, response $json_response, curl_error " 
            . curl_error($curl) . ", curl_errno " . curl_errno($curl));
        } else {
            curl_close($curl);
            $response = json_decode($json_response, true);
            return $response;
        }
    }

    /**
     * Permet de récupérer les informations d'un produit pour un id de produit donné
     * @return un array 'product' => 'categorie', 'description', 'id', 'name', 'price
     */
    public function getProductById(int $id) : ?array {

        $curl = curl_init($this->url."product/".$id);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $json_response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if($status != 200) {
            die("Error: call to URL ".$this->url." failed with status $status, response $json_response, curl_error " 
            . curl_error($curl) . ", curl_errno " . curl_errno($curl));
        } else {
            curl_close($curl);
            $response = json_decode($json_response, true);
            return $response;
        }
    }

    /**
     * Retourne l'image du produit donnée (id)
     * @return base64 de l'image 
     */
    public function getImageOfProduct(int $id) {

        $curl = curl_init($this->url."product/img/".$id);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $json_response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if($status != 200) {
            die("Error: call to URL ".$this->url." failed with status $status, response $json_response, curl_error " 
            . curl_error($curl) . ", curl_errno " . curl_errno($curl));
        } else {
            curl_close($curl);
            $response = $json_response;
            return $response;
        }
    }
    
    /**
     * Crée un panier
     * @return true si bien crée sinon false
     */
    public function createUserCart($cart) : bool {

        $result = false;

        $content = json_encode($cart);

        $curl = curl_init($this->url."cart");
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json","x-access-token:".$this->token));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
        $json_response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ( $status != 200 ) {
            die("Error: call to URL ".$this->url." failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
        }
        curl_close($curl);
        $response = json_decode($json_response,true);
        if($response['message'] = 'cart created') {
            $result = true;
        }
        return $result;
    }

    /**
     * Retourne le panier du user 
     * @return un array 'orders' => 'id', 'product_id', 'quantity', 'user_id'
     */
    public function getCurrentUserCart() : array {

        $curl = curl_init($this->url."cart/user");
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json","x-access-token:".$this->token));
        $json_response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ( $status != 200 ) {
            die("Error: call to URL ".$this->url." failed with status $status, response $json_response, curl_error " 
            . curl_error($curl) . ", curl_errno " . curl_errno($curl));
        } else {
            curl_close($curl);
            $response = json_decode($json_response, true);
            return $response;
        }
    }

    /**
     * Retourne toutes les categories
     * @return array 'categories' => 'n' => 'id', 'name'
     */
    public function getAllCategories() : array {

        $curl = curl_init($this->url."category");
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json","x-access-token:".$this->token));
        $json_response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ( $status != 200 ) {
            die("Error: call to URL ".$this->url." failed with status $status, response $json_response, curl_error " 
            . curl_error($curl) . ", curl_errno " . curl_errno($curl));
        } else {
            curl_close($curl);
            $response = json_decode($json_response, true);
            return $response;
        }
    }


}
