<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
// require APPPATH . 'libraries/JWT.php';
require APPPATH . 'libraries/ImplementJWT.php';


class Menu extends CI_Controller {

    use REST_Controller { REST_Controller::__construct as private __resTraitConstruct; }

    function __construct($config = 'reset'){
        parent::__construct();
		$this->__resTraitConstruct();
		
        $this->load->model('Menu_m', 'Menu');
		$this->objOfJwt = new ImplementJWT();

		header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "OPTIONS") {
            die();
		}
	}

    function index_get(){
		$id_usergroup = $this->get('id_usergroup');
        $menu = $this->Menu->get_menu_bar($id_usergroup );
        $submenu = $this->Menu->get_sub_menu($id_usergroup );
		$data = array();
        foreach ($menu as $key => $m) {
            $data[$key] = $m;
			$m->submenu = array();
			for ($i=0; $i < count($submenu) ; $i++) { 
				if($submenu[$i]->id_parent == $m->id ){
					array_push($m->submenu, $submenu[$i]);					
				}
			}
		}

		if ($data) {
			$dump = $this->response([
				'status' => true,
				'message' => 'success',
				'data' => $data
			], 200);
		}else{
			$this->response([
				'status' => false,
				'message' => 'not found',
				'data' => $data
			], 202);
		}
	}
}