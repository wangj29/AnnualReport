<?php
Class Membership_Model extends CI_Model
{
    function get($user_id){
        $this -> db -> where('user_id',$user_id);
        $query = $this-> db -> get('user');
        if($query -> num_rows() == 1) {
            return $query;
        }
        return false;
    }
    function get_fullname($user_id){
        $this -> db -> where('user_id', $user_id);
        return $this -> db -> get('user');
    }

    function set_user($user_id, $user_name, $user_type){
        $data =array(
            'user_id' => $user_id,
            'user_name'=>$user_name,
            'user_type' =>$user_type
        );
        $this->insert('user', $data);
    }
}
