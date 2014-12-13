<h3>Delete Awards</h3>
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
        echo '<td>';
        echo form_submit('delete','Delete');;
        echo '</td>';
        echo '</tr>';
      }
      
   ?>
</table>