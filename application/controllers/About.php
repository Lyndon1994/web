<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {
	
	public function index()
	{
		$this->load->view('about');
	}
	public function team()
	{
		$this->load->view('team');
	}
	public function test(){
		$this->load->view('test');
	}
}
