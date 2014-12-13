<?php
Class Admin_Model extends CI_Model{
    function remember($list)
    {
        $data = array();
        foreach($list as $item){
            
            $data['value']=$item;
            $this->db->insert('nav_tab1',$data);
        }
        
    }
}