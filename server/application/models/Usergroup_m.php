<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usergroup_m extends CI_Model {
	
	public function __construct() {
		parent::__construct();
    }
    
    public function getUserOrderBy($orderBy = null, $direction = null, $limit = null, $offset = 0){
		$query = $this->db->from('usergroup U')
		->select('U.*')
	    ->limit($limit)
		->order_by($orderBy, $direction)
	    ->offset($offset)	
		->get();
		return $query->result_array();
	}	

	public function rows(){
		$query = $this->db->from('usergroup')
		->get();
		return $query->num_rows();
	}	

	public function getUserOrderByWhere($orderBy = null, $direction = null, $limit = null, $offset = 0, $where){
		$query = $this->db->from('usergroup')
		->order_by($orderBy, $direction)
	    ->like('id', $where)
		->or_like('username', $where)
		->or_like('name', $where)
		->or_like('email', $where)
		->or_like('email', $where)
	    ->limit($limit)
	    ->offset($offset)
		->get();
		return $query->result_array();
    }	
    
}
