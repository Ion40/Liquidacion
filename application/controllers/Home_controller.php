<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_controller extends CI_Controller {

	public function index()
	{
		$this->load->view('header/header');
		$this->load->view('home');
		$this->load->view('footer/footer');
	}

}
