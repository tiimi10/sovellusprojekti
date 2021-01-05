<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();
//$_SESSION["idUser"] = 2;
$_SESSION["idDevice"] = 0;
$_SESSION['message'] = NULL;

class Main extends CI_Controller {

	/**
	 * Index Page.	 
	 */
	public function index()
	{   
                $this->load->view('main');
	}
        
        public function login()
        {
                $data['idUser'] = filter_input(INPUT_POST, 'user_name');
                $data['passwd'] = filter_input(INPUT_POST, 'password');
                $this->load->model('usedb');
                $result = $this->usedb->getUser($data);                
                if($result == false) 
                {   
                    $_SESSION['message'] = "Invalid Username or Password!";
                    header("Location: /index.php/main#login");       
                } else {
                    $_SESSION["idUser"] = $result['userID'];
                    $_SESSION["name"] = $result['name'];
                    header("Location: /index.php/tracker");                   
                }
                
        }
        
        public function logout()
        {
                $_SESSION['idUser']=NULL;
                $_SESSION['name']=NULL;
                $_SESSION['idDevice']=0;
                $_SESSION['message'] = NULL;
                header("Location: /index.php/main");
        }
}
