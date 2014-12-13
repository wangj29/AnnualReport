<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Admin extends CI_Controller 
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
    }

    function index()
    {
        if($this->session->userdata('logged_in') AND $this->session->userdata('type')=='admin') {
          
            $data['main_content']='admin_view';
            $data['title']='DSS Admin';
            $this->load->view('layout/master', $data);
        } else {
            //If no session, redirect to login page
            $data['title']='Login';
            $data['redirect']='admin';
            $this->load->view('login_page',$data);
        }
    }
    function submit() {
        $this->admin_model->remember($this->input->post('item'));
        redirect('home','refresh');
    }

}

?>