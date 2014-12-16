<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Test extends MY_Member_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('membership_model');
        $this->load->model('committee_model');

       $result = $this->committee_model->get_member('Test Committee');
        echo "<pre>";
        print_r($result);
    }
    function index(){        
        $this->output->enable_profiler(true);
    }
    
}
