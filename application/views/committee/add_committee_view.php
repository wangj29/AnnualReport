<div id='add-committee'>
<?php
    echo form_open('committee/add_committee_submit');
    echo "Add a new committee ";
    echo form_input('committee_name');
    
    echo "Category ";
    $option=array();
    $query=$this->committee_model->get_type();
    foreach( $query->result() as $type)
    {
        $option[$type->committee_type]=$type->committee_type;
    }
    
    echo form_dropdown('committee_type',$option);
    echo form_submit('submit','Add');
?>
</div>