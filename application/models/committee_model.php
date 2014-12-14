<?php
Class Committee_Model extends CI_Model{
   
    function get_type()
    {
        $this->db->select('committee_type');
        $query=$this->db->get('committee_type_list');
        return $query;
    }
    function get_committee($type = null)
    {
		if ($type == null) {
			return $this->db->get('committee_list');
		}
		$this -> db -> where('committee_type', $type);
        $this->db->order_by('committee_name');        
        $query=$this->db->get('committee_list');
        return $query;
    }

    /**
     * @uage  Get member from a committee
     *    $this->committee_model->get_member($committee_name);
     * @param $committee_name
     * @return mixed
     */
	function get_member($committee_name)
    {
        $this -> db -> where('committee_name', $committee_name);
        $query = $this->db->get('committee_member');
        return $query;
    }
	/*Get a list of faculities*/
    function get_faculty()
    {
        $this->db->order_by("user_name", "asc");
        $query=$this->db->get('users');
        return $query;
    }
  
    function get_fullname($uniqueid)
    {
        $this->db->where('user_id',$uniqueid);
        $query=$this->db->get('users');
        $row = $query->row();
        return $row->user_name;        
    }
    function add_committee($type,$name)
    {
        $data=array();
        $data['committee_type']=$type;
        $data['committee_name']=$name;
        $this->db->insert('committee_list',$data);
    }
    function add_member($data)
    {
        $this->db->insert('committee_member',$data);
    }
    /*Drop Committee from committee_list and corresponding
     member from committee_member */
    function drop_committee($committee_name)
    {   $this->db->where('committee_name',$committee_name);
        $this->db->delete('committee_list');
        $this->db->where('committee_name',$committee_name);
        $this->db->delete('committee_member');
    }
    function drop_member($data)
    {       
        $this->db->where('committee_name',$data['committee_name']);
        $this->db->where('member_name',$data['member_name']);
        $this->db->delete('committee_member');
    }
}