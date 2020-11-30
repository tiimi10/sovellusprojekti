<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();


class Tracker extends CI_Controller {  
        
	public function index() 
	{               
                $devicedata = $this->getDevices();
                $userdata = $this->getUsers();
                $locationdata = $this->getLocationHistory();
                $mapdata = $this->mapLine();
		$this->load->view('tracker_page/index');
                $this->load->view('tracker_page/users', $userdata);
                $this->load->view('tracker_page/devices', $devicedata);
                if (count ($locationdata['locations'])){
                    $this->load->view('tracker_page/locations', $locationdata);
                }
                if ($mapdata){
                    $this->load->view('tracker_page/map', $mapdata);
                }
                
	}
        
        public function selectDevice(){
            $_SESSION["idDevice"] = htmlspecialchars($_GET["idDev"]); 
            $this->index();
        }
        
        public function getUsers()
        {
                //$user = $this->idUser;
                $this->load->model('usedb');
                $userdata['users'] = $this->usedb->getUsers();
                //$this->load->view('tracker', $userdata);
                return $userdata;
        }
        
        public function getDevices()
        {
                $this->load->model('usedb');
                $devicedata['devices'] = $this->usedb->getDevices();
                //$this->load->view('tracker', $devicedata);
                return $devicedata;
        }
        
        public function getLocationHistory()
        {
                $this->load->model('usedb');
                $locationdata['locations'] = $this->usedb->getLocationHistory();
                //$this->load->view('tracker', $devicedata);
                return $locationdata;
        }
        
        public function getLocation()
        {
                $this->load->model('usedb');
                $data['points'] = $this->usedb->getLocation();               
                return $data;
        }
        
        public function getLocAndTime()
        {
                $this->load->model('usedb');
                $data['points'] = $this->usedb->getLocAndTime();               
                return $data;
        }
        
        public function addData() 
        {
                $this->load->model('usedb');
                $this->usedb->addData();
        }
        
        public function mapLine()
        {
                $this->load->library('googlemaps');
                $config['zoom'] = 'auto';
                $this->googlemaps->initialize($config);              
                $coordinates = $this->getLocation();
                if (count($coordinates['points'])){ 
                    $this->googlemaps->add_polyline($coordinates);
                    $data['map'] = $this->googlemaps->create_map();
                    $data['message'] = 'Show markers on map';
                    $data['link'] = '/index.php/tracker/mapMarkers/';
                    return $data;
                }
                else{
                    return false;
                }
        }
        
        public function mapMarkers()
        {
                $this->load->library('googlemaps');
                $config['zoom'] = 'auto';
                $this->googlemaps->initialize($config);              
                $mapdata = $this->getLocAndTime();
                foreach($mapdata['points'] as $point)
                {                
                    $marker = array();
                    $marker['position'] = $point['location'];
                    $marker['infowindow_content'] = $point['logDateTime'];
                    $this->googlemaps->add_marker($marker);
                }
                $data['map'] = $this->googlemaps->create_map();
                $data['message'] = 'Show line on map';
                $data['link'] = '/index.php/tracker/';
                $devicedata = $this->getDevices();
                $userdata = $this->getUsers();
                $locationdata = $this->getLocationHistory();
		$this->load->view('tracker_page/index');
                $this->load->view('tracker_page/users', $userdata);
                $this->load->view('tracker_page/devices', $devicedata);
                if (count ($locationdata['locations'])){
                    $this->load->view('tracker_page/locations', $locationdata);
                }
                if (count($mapdata['points'])){              
                    $this->load->view('tracker_page/map', $data);
                }
        }
        
}
