<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_m extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	function get_all(){
		$this->db->select('menu.*,parent_menu.name as parent');
		$this->db->from('menu');
		$this->db->join('menu as parent_menu','parent_menu.id = menu.id_parent','left');
		return $this->db->get()->result();
	}
	function get_menu_bar($user_level){
        $this->db->select('menu.*,menu.id as id_menu');
        $this->db->from('useraccess');
        $this->db->join('menu'.' as menu','menu.id = '.'useraccess'.'.id_menu');
        $this->db->where('menu.id_parent',0);
        $this->db->where('useraccess'.'.act_read',1);
        $this->db->where('useraccess'.'.id_usergroup',$user_level);
        $this->db->order_by('menu.orders','ASC');
        return $this->db->get()->result();
    }
    function get_sub_menu($user_level){
        $this->db->select('menu.*');
        $this->db->from('useraccess');
        $this->db->join('menu'.' as menu','menu.id = '.'useraccess'.'.id_menu');
        $this->db->where('menu.id_parent >','0');
        $this->db->where('useraccess'.'.act_read',1);
        $this->db->where('useraccess'.'.id_usergroup',$user_level);
        $this->db->order_by('menu.orders','ASC');
        return $this->db->get()->result();
    }
}