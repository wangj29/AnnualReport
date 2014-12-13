<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Evaluation extends MY_Member_Controller {

    function __construct()
    {
      parent::__construct();
      $this->load->model('committee_model');
    }
    function index()
    {
        $data['main_content']='evaluation_view';
        $data['title']='Course Evaluation';
        $this->load->view('layout/master', $data);   
    }
}
//end of evaluation.php