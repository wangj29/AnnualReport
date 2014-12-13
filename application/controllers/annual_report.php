<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Annual_report extends CI_Controller {
    function __construct()
    {
      parent::__construct();
    }
    function index()
    {
        $data['main_content']='annual_report/index';
        $data['title']='Annual Report';
        $this->load->view('layout/master', $data);
    }
  
}