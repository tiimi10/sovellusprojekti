<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();
$_SESSION["idUser"] = 1;
$_SESSION["idDevice"] = 0;

class Main extends CI_Controller {

	/**
	 * Index Page.	 
	 */
	public function index()
	{
		$this->load->view('index');
	}
        
}
