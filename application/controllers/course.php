<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); 
class Course extends CI_Controller {

    function __construct()
    {
      parent::__construct();
    }
    
    function index()
    {
       if($this->session->userdata('logged_in'))
       {
         $session_data = $this->session->userdata('logged_in');
         $data['username'] = $session_data['username'];
         $data['user_type'] = $session_data['user_type'];
         $this->load->model('course_model');
         $data['main_content']='course_view';
         $data['title']='Course';
         $this->load->view('layout/master', $data);
       }
       else
       {
         //If no session, redirect to login page
         redirect('login', 'refresh');
       }
    }
    
    function add_member()
    {
        
        
    }


}
//end of committee.php