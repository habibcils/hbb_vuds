<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
// require APPPATH . 'libraries/JWT.php';
require APPPATH . 'libraries/ImplementJWT.php';


class Usergroup extends CI_Controller {

    use REST_Controller { REST_Controller::__construct as private __resTraitConstruct; }

    function __construct($config = 'reset'){
        parent::__construct();
		$this->__resTraitConstruct();
		
        $this->load->model('Basic_m', 'basic');
        $this->load->model('Usergroup_m', 'usergroup');
		$this->objOfJwt = new ImplementJWT();

		header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "OPTIONS") {
            die();
		}
		
	}

	// CRUD USER LIST GET
	function index_get(){
		$id = $this->get('id');
		if($id){
			$data = $this->basic->select_where('usergroup', 'id', $id);
		}else{
			$data = $this->basic->select_all('usergroup');
		}

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
			'usergroup_name' => $this->post('usergroup_name'),
		];
		if ($this->basic->insert('usergroup', $data) > 0) {
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

	// CRUD EDIT
	public function index_put(){
		$id = $this->put('id');
		$data = [
			'usergroup_name' => $this->put('usergroup_name'),
		];

		if( $this->basic->update('usergroup', $data, 'id', $id) > 0 ) {
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

	// DELETE
	public function delete_post(){
		$id = $this->post('id');

		if ($id === null) {
			$this->response([
				'status' => false,
				'message' => 'need an id'
			], 400);
		}else{
			if ($this->basic->delete('usergroup', 'id', $id) > 0) {
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
        $columns = ['id','usergroup_name'];
		$length = $this->get('length');
		$column = $this->get('column');
		$dir = $this->get('dir');
		$searchValue = $this->get('search');
		$offset	= $this->get('offset');

		if ($searchValue) {
			$data = $this->usergroup->getUserOrderByWhere($columns[$column], $dir, $length, $offset, $searchValue);
		}else{
			$data = $this->usergroup->getUserOrderBy($columns[$column], $dir, $length, $offset);
		}
			$total = $this->usergroup->rows();

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

}


/* End of file Quiz.php */
/* Location: ./application/controllers/api/Quiz.php */