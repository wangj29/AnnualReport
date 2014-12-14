<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Committee extends Admin_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('committee_model');
    }
    
    function index()
    {
        $data['main_content']='committee/index';
        $data['title']='Committee';
        $this->load->view('layout/master', $data);

    }
    function add_committee()
    {
        $data['main_content']='committee/add_committee_view';
        $data['title']='Add Committee';
        $this->load->view('layout/master', $data);
    }
    //to-do: eliminate duplicate
    function add_committee_submit()
    {        
        $name=$this->input->post('committee_name');
        if ($name){
            $type=$this->input->post('committee_type');            
            $this->committee_model->add_committee($type,$name);
            redirect('committee'); 
        }else{
            echo "Please input Committee Title";
        }  
    }
    function add_member()
    {
        $data['main_content']='committee/add_member_view';
        $data['title']='Add Member';
        $this->load->view('layout/master', $data);
    }
    function add_member_submit()
    {    
        $data = array();
        $data['member_name'] = $this->input->post('faculty');
        $data['is_chair'] = $this->input->post('is_chair');
        $data['committee_name'] = $this->input->post('committee_name');
        $this->committee_model->add_member($data);
        redirect('committee'); 
    }
    function drop_committee()
    {
        $data['main_content']='committee/drop_committee_view';
        $data['title']='Drop Committee';
        $this->load->view('layout/master', $data);
    }
    function drop_committee_submit()
    {
        
        $committee_name=$this->input->post('committee_name');
        $this->committee_model->drop_committee($committee_name);
        redirect('committee'); 
    }
    function drop_member()
    {
        $data['main_content']='committee/drop_member_view';
        $data['title']='Drop Member';
        $this->load->view('layout/master', $data);
    }
    function drop_member_submit()
    {
        $data['committee_name']=$this->input->post('committee_name');
        $data['member_name']=$this->input->post('member_name');        
        $this->committee_model->drop_member($data);
        redirect('committee');
    }
    
    // cascasing committee --> member dropdown box
    function show_member_query()
    {
        $result = $this->committee_model->get_member($this->input->post('committee_name'))->result_array();
        $this->output->set_content_type('application_json');
        if ($result) {
            $this->output->set_output(json_encode($result));
        }
    }
   
    
    
}
//end of committee.php