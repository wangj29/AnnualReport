<h3>Awards</h3>
<?php
echo '<div class="add-button">';
    if ($this->session->userdata('user_type')== 'admin'){
        echo anchor('award/add_award_admin','Add Award');
    }else{
        echo anchor('award/add_award','Add Award');
    }
echo '</div>';
if ($this->session->userdata('user_type')== 'admin'){
    echo '<div class="add-button">';
        echo anchor('award/delete_award','Delete Award');
    echo '</div>';
}
?>

<?php

$query = $this->db->get('award');
//Adding display data
//foreach ($query->result() as $row){
  //  $row->name
//}
//echo $this->table->generate($query);
?>

<table>
   <th>Name</th>
   <th>Type</th>
   <th>Title</th>
   <th>Year</th>
   <?php
      foreach($query->result() as $row){
        echo '<tr>';
        echo '<td>';
        echo $member=$this->award_model->get_fullname($row->name);
        echo '</td>';
        echo '<td>';
        echo $row->type;
        echo '</td>'; 
        echo '<td>';
        echo $row->title;
        echo '</td>';
        echo '<td>';
        echo $row->year;
        echo '</td>';
        echo '</tr>';
      }
      
   ?>
</table>