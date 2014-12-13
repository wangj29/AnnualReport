<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Member_Controller extends CI_Controller {

    function __construct()
    {        
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

}
class Admin_Controller extends My_Member_Controller {

    function __construct()
    {
        parent::__construct();
        if( $this->session->userdata('user_type') != 'admin') {
            redirect('home');
        }
    }

}
//end of My_controller.php