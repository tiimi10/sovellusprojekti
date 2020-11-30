<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start();

//$db = db_connect();

class Usedb extends CI_Model {
       
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function getUsers()
    {
        $query = $this->db->query("SELECT userID, name, lastname, email, phonenumber FROM userTable WHERE userID = ".$this->db->escape_str($_SESSION["idUser"]));
        $results = $query->result();
        return $results;        
    }
    
    function getDevices()
    {
        $query = $this->db->query("SELECT deviceID, ownerID, nickname, registerName FROM trackerTable WHERE ownerID = ".$this->db->escape_str($_SESSION["idUser"]));
        $results = $query->result();
        return $results;        
    }
    
    function getLocationHistory()
    {
        $query = $this->db->query('SELECT logID, logDateTime, location FROM locationHistory WHERE trackID = '.$this->db->escape_str($_SESSION["idDevice"]));
        $results = $query->result();
        return $results;        
    }
    
    function getLocation()
    {
        $query = $this->db->query('SELECT location FROM locationHistory WHERE trackID = '.$this->db->escape_str($_SESSION["idDevice"]));
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
        $query = $this->db->query('SELECT logDateTime, location FROM locationHistory WHERE trackID = '.$this->db->escape_str($_SESSION["idDevice"]));
        $results = $query->result_array();
        return $results;
    }
    
    function addData($data)
    {
        $this->load->database();
        $query =$this->db->query("SELECT deviceID FROM trackerTable WHERE registerName = ".$this->db->escape($data['DevEUI']))->result_array();
        $devID = $query[0];
        print_r($devID['deviceID']);
        $this->db->query("INSERT INTO locationHistory VALUES (DEFAULT,".$this->db->escape($data['time']).", ".$this->db->escape($devID['deviceID'])." ," .$this->db->escape($data['location']).")");
    }
    
    
}
