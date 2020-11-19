<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {

	/**
	 *Home page which comes after succesful login
	 */
        public function index()
	{
		$this->load->view('tracker');
	}
    
	public function uplink()
	{
                $this->load->model('Uplink');
                $devEUI = $this->input->post('DevEUI');
                //$this->load->view('tracker',$devEUI);
		$this->Uplink->addData($devEUI);                                     
	}
        
        
}
