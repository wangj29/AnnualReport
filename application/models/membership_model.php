<?php
Class Membership_Model extends CI_Model
{
    function get_user($user_name = null){
        if ($user_name == null) {
            return $this->db->get('user');
        }
        $query = $this-> db
            -> where('user_name', $user_name)
            -> get('user');
        if($query -> num_rows() == 1) {
            return $query;
        }
        return false;
    }

    function set_user($user_id, $user_name, $user_type){
        $data =array(
            'user_id' => $user_id,
            'user_name'=>$user_name,
            'user_type' =>$user_type
        );
        $this->insert('users', $data);
    }
}
