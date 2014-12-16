<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Award extends MY_Member_Controller
{
    function __construct()
    {
      parent::__construct();
      $this->load->library('table');
      $this->load->model('award_model');
    }
    function index()
    {
        $data['main_content']='award/index';
        $data['title']='Awards';
        $this->load->view('layout/master', $data);   
    }
    function add_award()
    {
        $data['main_content']='award/add_award';
        $data['title']='Awards';
        $this->load->view('layout/master', $data);   
    }
    function add_award_admin()
    {
        $data['main_content']='award/add_award_admin';
        $data['title']='Awards';
        $this->load->view('layout/master', $data);   
    }
    /*
    function delete_award()
    {
        $data['main_content']='award/delete_award_admin';
        $data['title']='Awards';
        $this->load->view('layout/master', $data);   
    }*/
    function submit()
    {
	//$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('year', 'Year', 'trim|required|xss_clean');
	$this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
        if ($this->form_validation->run())
        {
            $username= $this->session->userdata('username');
            $result=$this->award_model->insert($username);
            if ($result)
            {
                $this->load->view('award/index');
            }
        }      
       
        $data['main_content']='award/index';
        $data['title']='Awards';
        $this->load->view('layout/master', $data);   
    }
    function submit_admin()
    {
        $this->form_validation->set_rules('year', 'Year', 'trim|required|xss_clean');
	$this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
        if ($this->form_validation->run())
        {
	    $result=$this->award_model->insert_admin();
            if ($result)
            {
                $this->load->view('award/index');
            }
        }      
       
        $data['main_content']='award/index';
        $data['title']='Awards';
        $this->load->view('layout/master', $data);   
    }
    
    function delete(){
	$this->form_validation->set_rules('year', 'Year', 'trim|required|xss_clean');
	$this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
        if ($this->form_validation->run())
        {
	    $result=$this->award_model->delete();
            if ($result)
            {
                $this->load->view('award/index');
            }
        }      
       
        $data['main_content']='award/index';
        $data['title']='Awards';
        $this->load->view('layout/master', $data); 
    }
}