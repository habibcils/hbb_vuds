<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz_M extends CI_Model {

	public function getQuizReady($id = null){
		if ($id == null) {
			return $this->db->get('quiz')->result_array();
		}else{
			return $this->db->get_where('quiz', ['id'=> $id])->result_array();
		}
	}

	public function postQuiz($id){
		return $this->db->get('quiz')->result_array();
	}	

	public function putQuiz($id){
		return $this->db->get('quiz')->result_array();
	}	

	public function deleteQuiz($id){
		$this->db->delete('quiz', ['id' => $id]);
		return $this->db->affected_rows();
	}

	

}

/* End of file Quiz_M.php */
/* Location: ./application/models/Quiz_M.php */