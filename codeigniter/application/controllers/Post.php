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
            
                $received = json_decode(file_get_contents("php://input"),true);
                $uplinkmessage = $received['DevEUI_uplink'];
                $data['time'] = $uplinkmessage['Time'];
                $data['DevEUI'] = $uplinkmessage['DevEUI'];
                $location_hex = $uplinkmessage['payload_hex']; 
                print_r($location_hex);
                $decoderOutput = array();
                exec('python /var/www/html/codeigniter/application/third_party/hex_decoder.py '.($location_hex) , $decoderOutput);
                print_r($decoderOutput);
                $data['location'] = $decoderOutput[0];
                print_r($data['location']);
                $this->load->model('usedb');
		$this->usedb->addData($data);              
	}
        
        public function test()
        {
            $output = array();
            exec('python /var/www/html/codeigniter/application/third_party/hex_decoder.py 36362e373936323838322c2032362e39313335323432', $output);
            $data['code'] = $output[0];
            print_r($data['code']);
        }
        
        
}
