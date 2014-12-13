<?php
$query=$this->committee_model->get_committee($committee);
foreach($query->result() as $member){
    echo '<option value="'.$member->member_name.'" >'.$member->member_name.'</option>';
}
?>