<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cas_Auth extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('membership_model');
    }

    function index()
    {        
        $this->load->library('cas');

        $this->cas->force_auth();
        $user_id = $this->cas->user()->userlogin;
        $query = $this->membership_model->get($user_id);
        if ($query) {
            $user_type = $query->row()->user_type;
            $user_name = $query->row()->user_name;
            $data = array(
                'user_id' => $user_id,
                'user_name' => $user_name,
                'user_type'=> $user_type,
                'logged_in' => true
            );
            $this->session->set_userdata($data);
            redirect('home');
       } else {
            show_error("$user_id is not a member of this department,please contact admin");
        }
    }
}