<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Mentoring extends MY_Member_Controller {
    function __construct()
    {
      parent::__construct();
      $this->load->model('mentoring_model');
    }
    function index()
    {
        $data['main_content']='mentoring/index';
        $data['title']='Mentoring';
        $this->load->view('layout/master', $data);   
    }
    function thesis()
    {
        $data['main_content']='mentoring/thesis';
        $data['title']='Master Student Thesis Project';
        $this->load->view('layout/master', $data);   
    }
    function graduate()
    {
        $data['main_content']='mentoring/graduate';
        $data['title']='Graduate Student Research Project';
        $this->load->view('layout/master', $data);   
    }
    function undergraduate()
    {
        $data['main_content']='mentoring/undergraduate';
        $data['title']='Undergraduate Student Research Project';
        $this->load->view('layout/master', $data);   
    }
    function submit()
    {
        
        if ($this->input->post('other_button'))
        {
            if ($this->input->post('type') === 'undergraduate')
                $data = array('is_project' => 1 );
            else
                $data = array('is_project' => 2);
            $this->db->where('course_no',$this->input->post('other_course'));
            $this->db->update('course',$data);
        }/*
        $this->form_validation->set_rules('year', 'Year', 'trim|required|xss_clean');
	$this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
        if ($this->form_validation->run())
        {
	    $result=$this->mentoring_model->insert();
            if ($result)
            {
                $this->load->view('mentoring/index');
            }
        } */     
        
        
        redirect('mentoring');
    }
    function submit_undergraduate()
    {
        $this->form_validation->set_rules('year', 'Year', 'trim|required|xss_clean');
	//$this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
        if ($this->form_validation->run())
        {
	    $result=$this->mentoring_model->insert_undergraduate();
            if ($result)
            {
                $this->load->view('mentoring/index');
            }
        }      
    
        redirect('mentoring');  
    }
    function submit_thesis()
    {
        $this->form_validation->set_rules('year', 'Year', 'trim|required|xss_clean');
        if ($this->form_validation->run())
        {
	    $result=$this->mentoring_model->insert_thesis();
            if ($result)
            {
                $this->load->view('mentoring/index');
            }
        }      
    
        redirect('mentoring');  
    }
}