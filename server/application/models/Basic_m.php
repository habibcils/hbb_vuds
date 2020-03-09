<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Basic_m extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}

	function getCount($table){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$this->db->from($table);

		return $this->db->get()->num_rows();
	}
	function select_all($table){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$this->db->from($table);
		$data = $this->db->get();

		return $data->result();
	}
	function select_all_array($table){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$this->db->from($table);
		$data = $this->db->get();

		return $data->result_array();
	}
    function select_all_row($table){
        $this->load->database('default',TRUE);
        $this->db->select('*');
        $this->db->from($table);
        $data = $this->db->get();

        return $data;
    }
	function select_where($table,$column,$where){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($column,$where);
		$data = $this->db->get()->result();

		return $data;
	}
	function select_kontrak_site_on($kontrak_site_id){
		$this->load->database('default',TRUE);
		$this->db->select('a.*');
		$this->db->from('px_kontrak_site_sensor a'); 
		$this->db->join('px_kontrak_site b', 'b.id = a.kontrak_site_id', 'left');
		$this->db->join('px_site c', 'c.id = b.site_id', 'left');
		$this->db->where(
			array(
				'a.kontrak_site_id'	=> $kontrak_site_id,
				'c.status_active'	=> 1,
			));
		$data = $this->db->get();
		return $data;
	}
	function select_kontrak_site_score_on($where){
		$this->load->database('default',TRUE);
		$this->db->select('a.*, c.status_active');
		$this->db->from('px_kontrak_site_score a'); 
		$this->db->join('px_kontrak_site b', 'b.id = a.kontrak_site_id', 'left');
		$this->db->join('px_site c', 'c.id = b.site_id', 'left');
		$this->db->where(
			array(
				'a.kontrak_site_id'	=> $where['kontrak_site_id'],
				'a.month'			=> $where['month'],
				'a.year'			=> $where['year'],
				'c.status_active'	=> 1,
			));
		$data = $this->db->get();
		return $data;
	}
	function select_where_limit($table,$column,$where, $limit = 1){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($column,$where);
		$this->db->limit($limit);
		$data = $this->db->get();

		return $data;
	}
    function select_where_double($table,$column,$where,$column2,$where2){
        $this->load->database('default',TRUE);
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($column,$where);
        $this->db->where($column2,$where2);
        $data = $this->db->get();

        return $data;
    }
	function select_where_order($table,$column,$where,$order_by,$order_type){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($column,$where);
        $this->db->order_by($order_by, $order_type);
		$data = $this->db->get();

		return $data;
	}
    function select_where_multiorder($table,$column,$where,$order){
        $this->load->database('default',TRUE);
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($column,$where);
        $this->db->order_by($order);
        $data = $this->db->get();
        return $data;
    }
    function select_where_in_order($table,$column,$where_in,$order_by,$order_type){
        $this->load->database('default',TRUE);
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where_in($column,$where_in);
        $this->db->order_by($order_by, $order_type);
        $data = $this->db->get();

        return $data;
    }
    function select_where_limit_order($table,$column,$where,$limit,$order_by,$order_type){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$this->db->where($column,$where);
        $this->db->order_by($order_by, $order_type);
		$data = $this->db->get($table,$limit);

		return $data;
	}
	function select_where_array($table,$where){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($where);
		$data = $this->db->get();

		return $data;
	}
	function select_where_array_limit($table,$where){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($where);
		$this->db->limit(1);
		$data = $this->db->get();

		return $data;
	}
	function select_where_array_limit_order($table,$where, $limit, $order_by, $order_type){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($where);
		$this->db->limit($limit);
		$this->db->order_by($order_by, $order_type);
		$data = $this->db->get();

		return $data;
	}
	function select_where_field($table,$field,$column,$where){
		$this->load->database('default',TRUE);
		$this->db->select($field);
		$this->db->from($table);
		$this->db->where($column,$where);
		$data = $this->db->get();

		return $data;
	}
    function select_where_in_array($table,$where,$column_where_in,$value_where_in){
        $this->load->database('default',TRUE);
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where);
        $this->db->where_in($column_where_in, $value_where_in);
        $data = $this->db->get();

        return $data;
    }
    function select_like($table,$column,$where){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$this->db->from($table);
		$this->db->like($column,$where);
		$data = $this->db->get();

		return $data;
	}
	function insert_all($table,$data) {
		$this->load->database('default',TRUE);
		if(!$this->db->insert($table,$data)){
            return FALSE;
        }
		$data["id"] = $this->db->insert_id();

		return (object)$data;
	}
	function insert_all_batch($table,$data) {
		$this->load->database('default',TRUE);
		if(!$this->db->insert_batch($table,$data)){
            return FALSE;
        }
		$data["id"] = $this->db->insert_id();

		return (object)$data;
		
	}
	function insert($table, $data){
		$this->db->insert($table, $data);
		return $this->db->affected_rows();
	}
	function update($table,$data_arr,$column,$where){
		$this->db->update($table, $data_arr, [$column=>$where]);
		return $this->db->affected_rows();				
	}
	function delete($table,$column, $where){
		$this->db->delete($table, [$column => $where]);
		return $this->db->affected_rows();
	}	
    function update_where_array($table,$data,$where){
        $this->load->database('default',TRUE);
        $this->db->where($where);

        return $this->db->update($table,$data);
    }
	function update_one($table,$column,$where,$target,$action){
		$this->db->set($target, $target.$action, FALSE);
		$this->db->where($column, $where);

		return $this->db->update($table);
	}
	function update_all_batch($table, $data, $field_param) {
		return $this->db->update_batch($table, $data, $field_param);
	}
	// function delete($table,$column,$where){
	// 	$this->load->database('default',TRUE);
	// 	$this->db->where($column,$where);

	// 	return $this->db->delete($table);
	// }
	function delete_where_array($table,$where){
		$this->load->database('default',TRUE);
		$this->db->where($where);

		return $this->db->delete($table);
	}
    function select_all_limit($table, $limit){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$data = $this->db->get($table, $limit);

		return $data;
	}
     function select_all_limit_order($table, $limit, $order_by, $order){
		$this->load->database('default',TRUE);
		$this->db->select('*');
        $this->db->order_by($order_by, $order);
		$data = $this->db->get($table, $limit);

		return $data;
	}
	function count($table){
		$this->load->database('default',TRUE);
		$this->db->select('id');
		$this->db->from($table);

		return $this->db->count_all_results();
	} 
    function select_all_order($table, $order_by, $order){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$this->db->from($table);
        $this->db->order_by($order_by, $order);
		$data = $this->db->get();

		return $data->result();
	}    
}