<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\Jwt\Jwt;
require APPPATH . 'libraries/JWT.php';

class ImplementJWT {

	PRIVATE $key = 'habib99';

	public function GenerateToken($data){
		$jwt = JWT::encode($data, $this->key);
		return $jwt;
	}

	public function DecodeToken($token){
		$decode = JWT::decode($token, $this->key, array('HS256'));
		$decodeData = (array) $decode;
		return $decodeData;
	}

}
