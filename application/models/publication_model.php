<?php
Class Publication_Model extends CI_Model
{
    function insert_publication($author,$type,$title,$year,$costudent_g,$costudent_u,$cofaculty,$content,$comment)
    {
       
        $data = array(
                'title'=>$title,
                'year' => $year ,
                'type' => $type,
                'author' => $author,
                'costudent_u' => $costudent_u,
                'costudent_g' => $costudent_g,
                'cofaculty' => $cofaculty,
                'content' => $content,
                'comment' => $comment
             );
        $this->db->insert('publication', $data);
    }
    function get_publication($author = NULL)
    {
        if ($author!=NUll) $this->db->where('author',$author);        
        $this->db->order_by('year desc, type asc');
        $query = $this->db->get('publication');
        return $query;
    }
    function get_author()
    {
        $this->db->order_by('faculty_name');
        $query = $this->db->get('faculty');
        return $query;
    }
    function get_publication_type()
    {
        $query=$this->db->get('publication_type_list');
        return $query;
    }
}
//end of publication_model.php
//location: application/model/publication_model.php