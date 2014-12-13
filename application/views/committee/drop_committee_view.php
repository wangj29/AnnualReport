<h3>Drop a Committee Position</h3>
<?php echo form_open('committee/drop_committee_submit');?>

<?php
    $type_list = $this->committee_model->get_type();
    $option = array();
    foreach ($type_list->result() as $type)
    {
        
        $committee_list=$this->committee_model->get_committee($type->committee_type);
        if ($committee_list->num_rows() > 0){
            $option[$type->committee_type] = array();
            foreach ($committee_list->result() as $committee)
            {
                $option[$type->committee_type][$committee->committee_name]=$committee->committee_name;
            }   
        }
         
    }
    echo form_dropdown("committee_name",$option);
 ?> 
<?php echo form_submit("submit","Submit");?>