<h3>Committee</h3>
<div id="committee_menu">
<?php echo anchor('committee/add_member','Add New Committee Members','class=menu-link');?>|
<?php echo anchor('committee/add_committee','Create New Committees','class=menu-link');?>|
<?php echo anchor('committee/drop_member','Drop Members','class=menu-link'); ?>|
<?php echo anchor('committee/drop_committee','Drop Committee','class=menu-link'); ?>
</div>
<table class="table table-condensed  table-bordered table-striped">
   <th>Position</th>
   <th>Chair</th>
   <th>Members</th>
   <?php
       $type_list=$this->committee_model->get_type();
       foreach ($type_list->result() as $row_t)
       {
           echo '<tr><td colspan="3"><div id="typecell">'.$row_t->committee_type.'<div></td></tr>';
           $committee_list=$this->committee_model->get_committee($row_t->committee_type);
           foreach ($committee_list->result() as $row_c)
           {
                echo '<tr><td>'.$row_c->committee_name.'</td>';
                $member_list = $this->committee_model->get_member($row_c->committee_name);
                echo '<td><ul>';
                foreach ($member_list->result() as $row_m)
                if ($row_m->is_chair)
                {
                    echo '<li>';
                    $member=$this->committee_model->get_fullname($row_m->member_name);
                    echo $member;
                    echo '</li>';
                }    
                echo '</ul></td>';
                
                echo '<td><ul>';
                foreach ($member_list->result() as $row_m)
                if (! $row_m->is_chair)
                {
                    echo '<li>';
                    $member=$this->committee_model->get_fullname($row_m->member_name);
                    echo $member;
                    echo '</li>';
                }    
                echo '</ul></td></tr>';
               
           }    
       }
      
   ?>
</table>
