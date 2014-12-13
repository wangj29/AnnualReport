<?php
Class Course_Model extends CI_Model{
   
    function view_course()
    {
        $query=$this->db->get('course');
        return $query;
    }
}