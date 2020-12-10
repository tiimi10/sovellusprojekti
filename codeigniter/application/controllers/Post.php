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
                $decoderOutput = array();
                exec('python /home/team10/public_html/codeigniter/application/third_party/hex_decoder.py '.($location_hex) , $decoderOutput);
                if(strlen($decoderOutput[0]) != 20)
                {
                    print_r('failed');
                }else{
                    $data['location'] = $decoderOutput[0];
                    $this->load->model('usedb');
                    $this->usedb->addData($data);  
                }
	}
        
        public function downlink()
        {

            $data['deveui'] = htmlspecialchars($_GET["deveui"]);
            $data['status'] = htmlspecialchars($_GET["status"]);
            if($data['status'] == true){
                $data['payload'] = 'ff1010';               
            }else{
                $data['payload'] = 'ff0101';
            }
            $url = 'https://api-eu.thingpark.com/thingpark/lrc/rest/downlink?DevEUI='.$data['deveui'].'&FPort=1&Payload='.$data['payload'].'&FlushDownlinkQueue=1';
            print_r($url);
            $url2 = 'https://api-eu.thingpark.com/thingpark/lrc/rest/downlink?DevEUI='.$data['deveui'].'&FPort=1&Payload='.$data['payload'];
            $ch = curl_init();
            
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            print_r($response);
            curl_setopt($ch, CURLOPT_URL, $url2);
            $response2 = curl_exec($ch);
            print_r($response2);
            curl_close($ch);
            header("Location: /index.php/tracker");
            
        }
                       
}
