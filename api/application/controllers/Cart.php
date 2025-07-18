<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {
	public function __construct() {
		parent::__construct();
		header("Content-type:application/json");
		$this->load->model('M_cart');
	}
	public function index()
	{
		// $user_id = $this->input->post('user_id');
		$user_id = 33;
		$cart = $this->M_cart->getCart($user_id);
		echo json_encode($cart);
	}
}
