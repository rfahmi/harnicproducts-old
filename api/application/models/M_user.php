<?php
class M_user extends CI_Model {
	function check_user($username,$password) {
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$result = $this->db->get();
		$rows = $result->num_rows();
		if ($rows == 1) {
			foreach ($result->result() as $r) {
				return $r->id;
			}
		}else{
			echo 0;
		}
	}
}
?>