<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
// require APPPATH . 'libraries/JWT.php';
require APPPATH . 'libraries/ImplementJWT.php';


class Users extends CI_Controller {

    use REST_Controller { REST_Controller::__construct as private __resTraitConstruct; }

    function __construct($config = 'reset'){
        parent::__construct();
		$this->__resTraitConstruct();
		
        $this->load->model('Users_m', 'users');
        $this->load->model('Basic_m', 'basic');
		$this->objOfJwt = new ImplementJWT();

		header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "OPTIONS") {
            die();
		}
		
	}
	
	// AUTH LOGIN
	// public function index_post(){

	// 	$username = $this->post('username');
	// 	$pass = $this->post('password');

	// 	$data = $this->users->getAuth($username, $pass);
	// 	// print_r($data[0]['id']);
	// 	// die();
	// 	if ($data) {
	// 		$tokenData['uniqueId'] = $data[0]['id'];
	// 		$tokenData['username'] = $data[0]['username'];
	// 		$tokenData['role'] = 'superadmin';
	// 		$tokenData['timeStamp'] = Date('Y-m-d h:i:s');
	// 		$jwtToken = $this->objOfJwt->GenerateToken($tokenData);
	// 		$addToken = $this->users->putUserToken($data[0]['id'], array('token'=>$jwtToken, 'updated_at' => Date('Y-m-d H:i:s')) );

	// 		$this->response([
	// 			'status' => true,
	// 			'message' => 'success',
	// 			'token' => $jwtToken,
	// 		], 200);
	// 	}else{
	// 		$this->response([
	// 			'status' => false,
	// 			'message' => 'no data',
	// 		], 404);
	// 	}
	// }

	// AUTH
	public function getPayload_get(){
		$receivedToken = $this->input->request_headers('Authorization');
		// $token = $this->get('token');
		
		// print_r($receivedToken['token']);
		$jwtData = $this->objOfJwt->DecodeToken($receivedToken['token']);
		// die();
		if ($jwtData) {

			$this->response([
				'status' => true,
				'message' => 'success',
				'payload' => $jwtData,
			], 200);
		}else{
			$this->response([
				'status' => false,
				'message' => 'no data'
			], 401);			
		}
	}

	// GET
	public function index_get(){
		$id = $this->get('id');
		$data = $this->users->getUser($id);

		if ($data) {
			$this->response([
				'status' => true,
				'message' => 'success',
				'data' => $data
			], 200);
		}else{
			$this->response([
				'status' => true,
				'message' => 'no data'
			], 404);
		}
	}	

	// ADD
	function index_post(){
		$data = [
			'username' => $this->post('username'),
			'name' => $this->post('name'),
			'email' => $this->post('email'),
			'password' => $this->post('password'),
			'point' => $this->post('point')
		];
		if ($this->users->addUser($data) > 0) {
			$this->response([
				'status' => true,
				'message' => 'added user done',
				'data' => $data
			], 200);
		}else{
			$this->response([
				'status' => false,
				'message' => 'failed add'
			], 404);
		}
	}

	// CRUD USER LIST EDIT
	public function index_put(){
		$id = $this->put('id');
		$data = [
			'username' => $this->put('username'),
			'name' => $this->put('name'),
			'email' => $this->put('email'),
			'password' => $this->put('password'),
			'id_usergroup' => $this->put('UG_id')
		];

		if( $this->users->putUser($data, $id) > 0 ) {
			$this->response([
				'status' => true,
				'message' => 'updated user done',
				'data' => $data
			], 204);
		}else{
			$this->response([
				'status' => false,
				'message' => 'failed updated'
			], 404);
		}
	}

	// CRUD USER LIST DELETE
	public function deleteUser_post(){
		$id = $this->post('id');
		$data = $this->post();

		if ($id === null) {
			$this->response([
				'status' => false,
				'message' => 'need an id'
			], 400);
		}else{
			if ($this->users->deleteUsers($id) > 0) {
				$this->response([
					'status' => true,
					'id'	=> $id,
					'message' => 'delete success'
				], 204);				
			}else{
				$this->response([
					'status' => false,
					'message' => 'id not found'
				], 400);
			}
		}
	}			


	// DATATABLE
	public function datatable_get(){
        $columns = ['id','username', 'name', 'email', 'point'];
		$length = $this->get('length');
		$column = $this->get('column');
		$dir = $this->get('dir');
		$searchValue = $this->get('search');
		$offset	= $this->get('offset');

		if ($searchValue) {
			$data = $this->users->getUserOrderByWhere($columns[$column], $dir, $length, $offset, $searchValue);
		}else{
			$data = $this->users->getUserOrderBy($columns[$column], $dir, $length, $offset);
		}
			$total = $this->users->rows();

		if ($data) {
			$this->response([
				'status' => true,
				'message' => 'success',
				'data' => $data,
				'draw' => $this->get('draw'),
				'total' => $total,
				'count_data' => count($data),
				'next_page_url' => 'asdsa',
				'prev_page_url' => 'asdsa'
			], 200);
		}else{
			$this->response([
				'status' => true,
				'message' => 'no data',
				'draw' => $this->get('draw')			
			], 404);
		}
	}

	// FOR LOGIN
	public function auth_post(){
		$username = $this->post('username');
		$password = $this->post('password');

		$data = $this->users->getAuth($username, $password);
		if ($data) {
			$this->response([
				'status' => true,
				'message' => 'success',
				'token' => '1745',
				'data' => $data
			], 200);
		}else{
			$this->response([
				'status' => true,
				'token' => null,				
				'message' => 'no data'
			], 404);
		}
	}

}


/* End of file Quiz.php */
/* Location: ./application/controllers/api/Quiz.php */