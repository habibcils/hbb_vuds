<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_m extends CI_Model {

	public function getUsersReady($id = null){
		if ($id == null) {
			return $this->db->get('users')->result_array();
		}else{
			return $this->db->get_where('users', ['id'=> $id])->result_array();
		}
	}

	public function getAuth($user, $pass){
		return $this->db->get_where('users', ['username'=> $user, 'password'=> $pass] )->result_array();
	}

	public function putUserToken($id, $data){
		$this->db->where('id', $id);
		$this->db->update('users',$data );
		return $this->db->affected_rows();
	}

	public function deleteUsers($id){
		$this->db->delete('users', ['id' => $id]);
		return $this->db->affected_rows();
	}

	public function putUser($data, $id){
		$this->db->update('users', $data, ['id'=>$id]);
		return $this->db->affected_rows();
	}

	public function getUser($id){
		$query = $this->db->from('users U')
		->select('U.*, UG.id AS UG_id, UG.usergroup_name')
		->join('usergroup UG', 'UG.id=U.id_usergroup', 'left')		
	    ->where('U.id', $id)
		->get();
		return $query->result();
	}

	public function addUser($data){
		$this->db->insert('users', $data);
		return $this->db->affected_rows();
	}

	public function deleteUser($id){
		$this->db->delete('users', ['id' => $id]);
		return $this->db->affected_rows();
	}

	// DATATABLE TO BOTTOM
	public function getUserOrderBy($orderBy = null, $direction = null, $limit = null, $offset = 0){
		$query = $this->db->from('users U')
		->select('U.*, UG.usergroup_name')
		->join('usergroup UG', 'UG.id=U.id_usergroup', 'left')
	    ->limit($limit)
		->order_by($orderBy, $direction)
	    ->offset($offset)	
		->get();
		return $query->result_array();
	}	

	public function rows(){
		$query = $this->db->from('users')
		->get();
		return $query->num_rows();
	}	

	public function getUserOrderByWhere($orderBy = null, $direction = null, $limit = null, $offset = 0, $where){
		$query = $this->db->from('users')
		->order_by($orderBy, $direction)
	    // ->where('id =', $where)
	    ->like('id', $where)
		->or_like('username', $where)
		->or_like('name', $where)
		->or_like('email', $where)
		->or_like('email', $where)
		// ->or_like('point', $where)
	    ->limit($limit)
	    ->offset($offset)
		->get();
		return $query->result_array();
	}	
}