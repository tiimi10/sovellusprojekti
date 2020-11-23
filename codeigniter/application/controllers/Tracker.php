<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tracker extends CI_Controller {

	/**
	 *Home page which comes after succesful login
	 */
	public function index()
	{
                $devicedata = $this->getDevices();
                $userdata = $this->getUsers();
                $locationdata = $this->getLocationHistory();
                $mapdata = $this->map();
		$this->load->view('tracker');
                $this->load->view('tracker_users', $userdata);
                $this->load->view('tracker_devices', $devicedata);
                $this->load->view('tracker_locations', $locationdata);
                $this->load->view('tracker_map', $mapdata);
	}
        
        public function getUsers()
        {
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
        
        public function map()
        {
                $this->load->library('googlemaps');

                $config['zoom'] = 'auto';
                $this->googlemaps->initialize($config);
                
                $coordinates = $this->getLocation();
                $this->googlemaps->add_polyline($coordinates);
                $data['map'] = $this->googlemaps->create_map();
                return $data;
        }
        
        public function mapMarkers()
        {
                $this->load->library('googlemaps');

                //$config['center'] = '37.4419, -122.1419';
                $config['zoom'] = 'auto';
                $this->googlemaps->initialize($config);
                
                $mapdata = $this->getLocAndTime();
                foreach($mapdata['points'] as $point)
                {                
                    $marker = array();
                    //$marker['position'] = '37.429, -122.1519';
                    $marker['position'] = $point['location'];
                    $marker['infowindow_content'] = $point['logDateTime'];
                    $this->googlemaps->add_marker($marker);
                }
                $data['map'] = $this->googlemaps->create_map();

                $devicedata = $this->getDevices();
                $userdata = $this->getUsers();
                $locationdata = $this->getLocationHistory();
		$this->load->view('tracker');
                $this->load->view('tracker_users', $userdata);
                $this->load->view('tracker_devices', $devicedata);
                $this->load->view('tracker_locations', $locationdata);
                $this->load->view('tracker_map', $data);
        }
        
}
