<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//$db = db_connect();

class Usedb extends CI_Model {
       
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function getUsers()
    {
        $query = $this->db->query('SELECT userID, name, lastname, email, phonenumber FROM userTable');
        $results = $query->result();
        return $results;        
    }
    
    function getDevices()
    {
        $query = $this->db->query('SELECT deviceID, ownerID, nickname, registerName FROM trackerTable');
        $results = $query->result();
        return $results;        
    }
    
    function getLocationHistory()
    {
        $query = $this->db->query('SELECT logID, logDateTime, trackID, location FROM locationHistory');
        $results = $query->result();
        return $results;        
    }
    
    function getLocation()
    {
        $query = $this->db->query('SELECT location FROM locationHistory WHERE trackID = 3');
        $results = $query->result_array();
        $array = array();

        foreach ( $results as $key => $location )
        {
            $temp = array_values($location);
            $array[] = $temp[0];
        }
        return $array;
    }
    
    function getLocAndTime()
    {
        $query = $this->db->query('SELECT logDateTime, location FROM locationHistory WHERE trackID = 3');
        $results = $query->result_array();
        return $results;
    }
    
    function addData()
    {
        $this->load->database();
        $this->db->query("INSERT INTO locationHistory VALUES (DEFAULT,DEFAULT,3,'65.7962882, 25.9135242')");
    }
    
    
}
