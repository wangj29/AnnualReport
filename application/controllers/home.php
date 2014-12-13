<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Member_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('membership_model');
    }

    function index()
    {
        $data['user_name'] = $this->session->userdata['user_name'];
        $data['user_type']= $this->session->userdata['user_type'];
        $data['main_content']='home_view';
        $data['title']='Home';
        $this->load->view('layout/master', $data);
    }
    function logout()
    {
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        redirect('login', 'refresh');
    }

}
//end of home.php