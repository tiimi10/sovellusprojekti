<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page.	 
	 */
	public function index()
	{
		$this->load->view('index');
	}
        
        public function login()
	{
		echo"login function";
	}
}
