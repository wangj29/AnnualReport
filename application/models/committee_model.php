<?php
Class Committee_Model extends CI_Model{

    /*-------------------------------------------------------------------------------------*/
    /**
     * @usage
     * $this->committee_model->get_type()
     */

    function get_type()
    {
        return $this->db->get('committee_type');
    }
    /*-------------------------------------Committee------------------------------------------------*/
    /*-------------------------------------------------------------------------------------*/
    /**
     * @usage
     * Single : $this->committee_model->get_committee($type)
     * All : $this->committee_model->get_committee()
     */
    function get_committee($type = null)
    {
		if ($type == null) {
            return $this->db
                ->order_by('committee_name')
                ->get('committee_list');
        }
        return $this->db
            ->where('committee_type', $type)
            ->order_by('committee_name')
            ->get('committee_list');
    }

    /*-------------------------------------------------------------------------------------*/
    /**
     * @usage
     *  $this->committee_model->add_committee($type, $name);
     */
    function add_committee($data)
    {
        $this->db->insert('committee_list', $data);
        return $this->db->insert_id();
    }

    /*-------------------------------------------------------------------------------------*/
    /**
     * @usage
     * Single : $this->committee_model->drop_committee($committee_name)
     */
    function drop_committee($data)
    {
        $this->db
            ->where('committee_name', $data['committee_name'])
            ->delete('committee_list');
        $this->db
            ->where('committee_name', $data['committee_name'])
            ->delete('committee_member');
        return $this->db->affected_rows();
    }

    /*-------------------------------------Member------------------------------------------------*/
    /*-------------------------------------------------------------------------------------*/
    /**
     * @uage
     * $this->committee_model->get_member($committee_name);
     * @param $committee_name
     * @return mixed
     */
	function get_member($committee_name)
    {
        if ($committee_name == null) {
            return false;
        }
        $query = $this->db
            ->select('member_id, is_chair, user.user_fullname AS member_name')
            ->from('committee_member')
            ->join('user', 'committee_member.member_id = user.user_id')
            ->where('committee_member.committee_name', $committee_name)
            ->get();
        return $query;
    }



    /*-------------------------------------------------------------------------------------*/

    function add_member($data)
    {
        $this->db->insert('committee_member',$data);
    }


    /*-------------------------------------------------------------------------------------*/

    function drop_member($data)
    {
        if ($data['committee_name'] == null || $data['member_id'] == null) {
            return false;
        }
        $this->db
            ->where('committee_name',$data['committee_name'])
            ->where('member_id',$data['member_id'])
            ->delete('committee_member');

        return $this->db->affected_rows();
    }
}