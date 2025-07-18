<?php
class M_cart extends CI_Model {
	function getCart($user_id) {
		$this->db->select('carts.*,items.itemname');
		$this->db->from('carts');
		$this->db->join('items','carts.item=items.id','left');
		$this->db->where('user', $user_id);
		$result = $this->db->get();
		return $result->result_array();
	}
}
?>