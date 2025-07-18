<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct() {
		parent::__construct();
		header("Content-type:application/json");
		$this->load->model('M_user');
	}
	public function index()
	{
		$username=$this->input->post('username');
		$password=md5($this->input->post('password'));
		$check = $this->M_user->check_user($username,$password);
		if ($check <> 0) {
			echo $check;
		}else{
			echo 0;
		}
	}
}
