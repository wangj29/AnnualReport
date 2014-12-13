<?php
Class Mentoring_Model extends CI_Model{
    function get($type)
    {      
        $this->db->select('course_no');
        $this->db->where('is_project',$type);
        $query = $this->db->get('course');
        return $query;
    }
    
    function insert_undergraduate(){
        $student=$this->input->post('student');
        //$name = $this->award_model->get_ID($this->input->post('name'));
        $project = $this->input->post('project');
        $courseNumber = $this->input->post('course No.');
        $year = $this->input->post('year');
        $term = $this->input->post('term');
        $data = array(
            //'name' => $this->IdToName($username),
            //'name' => $username,
            'student' => $student,
            'Project'=> $project,
            'Year' => $year,
            'CourseNumber' => $courseNumber,
            'Term'=> $term
                );
        $this->db->insert('Undergrad-research',$data);  
    }
    
    function insert_thesis(){
        $student=$this->input->post('student');
        //$name = $this->award_model->get_ID($this->input->post('name'));
        $year = $this->input->post('year');
        $term = $this->input->post('term');
        $advisor = $this->input->post('advisor');
        //$commitee = $this->input->post('commitee members');
        //$committee = 'dfasdfsafadfsdfas';
        
        $data = array(
            //'name' => $this->IdToName($username),
            //'name' => $username,
            'student' => $student,
            'year' => $year,
            'term'=> $term,
            'advisor'=> $advisor,
            'committee' => 'Testing'
                );
        $this->db->insert('Master-thesis',$data);  
    }
}
//end of mentoring_model.php