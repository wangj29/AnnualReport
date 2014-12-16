<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Publication extends MY_Member_Controller {

    function __construct()
    {
      parent::__construct();
      $this->load->model('publication_model');
     
    }
    function index()
    {
        if ($this->session->userdata('user_type')!= 'admin'){
            $data['main_content']='publication/index';
        }
        else{
            $data['main_content']='publication2/index';
        }   
        $data['title']='Publication';
        $this->load->view('layout/master', $data);   
    }
    function add_publication()
    {
        if ($this->session->userdata('type')!= 'admin')
            $data['main_content']='publication/add_pub_view';
        else
            $data['main_content']='publication2/add_pub_view';
        $data['title']='Publication';
        $this->load->view('layout/master', $data); 
    }
    function submit()
    {

        if ($this->session->userdata('type')==='admin')
        {
            $author=$this->input->post('author');
        }
        else
        {
            $author=$this->session->userdata('username');  
        }
        $title = $this->input->post("title");
        $year = $this->input->post('year');
        $type = $this->input->post('type');
        $costudent_u = $this->input->post('costudent_u');
        $costudent_g = $this->input->post('costudent_g');
        $cofaculty = $this->input->post('cofaculty');
        $content = $this->input->post('content');
        $content = mb_convert_encoding($content, "UTF-8");
        $comment= $this->input->post('comment');
        $this->publication_model->insert_publication($author,$type,$title,$year,$costudent_g,$costudent_u,$cofaculty,$content,$comment);
        redirect('publication','refresh');
    }
    
}
//end of publication.php