<div id="committee_menu">
<?php echo anchor('committee/add_member','Add Committee Members');?>|
<?php echo anchor('committee/add_committee','Add Committees');?>|
<?php echo anchor('committee/drop_member','Drop Members'); ?>|
<?php echo anchor('committee/drop_committee','Drop Committee'); ?>
</div>

<table class="table table-condensed  table-bordered ">
   <th>Position</th>
   <th>Chair</th>
   <th>Members</th>
   <?php
       $type_list = $this->committee_model->get_type();
       foreach ($type_list->result() as $type) {
           echo '<tr><th colspan="3">' . $type->type_name . '</th></tr>';
           $committee_list = $this->committee_model->get_committee($type->type_name);
           foreach ($committee_list->result() as $comm) {
                echo '<tr><td>'.$comm->committee_name.'</td>';

                $member_list = $this->committee_model->get_member($comm->committee_name);
               
                echo '<td><ul>';
                foreach ($member_list->result() as $member) {
                    if ($member->is_chair) {
                        echo '<li>' . $member->member_name . '</li>';
                    }
                }
                echo '</ul></td>';
                
                echo '<td><ul>';
                foreach ($member_list->result() as $member)
                if (! $member->is_chair)  {
                    echo '<li>' . $member->member_name . '</li>';
                }    
                echo '</ul></td></tr>';
           }    
       }
   ?>
</table>
