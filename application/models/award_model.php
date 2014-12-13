<?php
Class Award_Model extends CI_Model{

    function insert_admin()
    {
        $name=$this->input->post('name');
        //$name = $this->award_model->get_ID($this->input->post('name'));
        $type = $this->input->post('type');
        $title = $this->input->post('title');
        $year = $this->input->post('year');
        $comment = $this->input->post('comment');
        $data = array(
            //'name' => $this->IdToName($username),
            //'name' => $username,
            'name' => $name,
            'title'=> $title,
            'year' => $year,
            'type' => $type,
            'comment'=> $comment
                );
        $this->db->insert('award',$data);  
    }
    
    function insert($username)
    {
        $type = $this->input->post('type');
        $title = $this->input->post('title');
        $year = $this->input->post('year');
        $comment = $this->input->post('comment');
        $data = array(
            'name' => $username,
            'name' => $name,
            'title'=> $title,
            'year' => $year,
            'type' => $type,
            'comment'=> $comment
                );
        $this->db->insert('award',$data);  
    }
    
    //Change userId to username
    function get_fullname($uniqueid)
    {
        $this->db->where('user_id',$uniqueid);
        $query=$this->db->get('user');
        $row=$query->row();
        return $row->user_name;        
    }
    //Get userId from full name
    function get_ID($name)
    {
        $this->db->where('user_name',$name);
        $query=$this->db->get('user');
        $row=$query->row();
        return $row->user_id;        
    }
    function view_faculty()
    {
        $this->db->order_by("user_name", "asc");
        $query=$this->db->get('user');
        return $query;
    }
    function delete($userid, $type, $title, $year){
        $this->db->where('name', $userid);
        $this->db->where('type', $type);
        $this->db->where('title', $title);
        $this->db->where('year', $year);
        $this->db->delete('award'); 
    }
}