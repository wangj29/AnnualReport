<?php    include('menu.php');  ?>
<div class="form">
<?php

echo form_open('mentoring/submit');
echo form_hidden('type','graduate');
?>

    <p>
    <label for='student'>Student</label>
    <?php
        $data = array(
          'name'        => 'student',
          'maxlength'   => '20',
          'size'        => '20',
        );
        echo form_input($data);
    ?>
    </p>
    <p>
    <label for='project'>Project</label>
    <?php
        $data = array(
          'name'        => 'project',
          'maxlength'   => '50',
          'size'        => '50',
        );
        echo form_input($data)
    ?>
    </p>
    <p>
    <label for='course'>Course No.</label>
    <?php        
        $query = $this->mentoring_model->get(2);
        if ($query->num_rows()>0)
        {            
            $option=array();
            foreach( $query->result() as $course)
                $options[$course->course_no]=$course->course_no;
            echo form_dropdown('course',$options,'default','id="project_course"');
        }
        echo form_checkbox('other_button',1,FALSE,'id="other_button"');
    
    echo "other";
    $data = array(
        'id'        =>  'other_course',
        'name'        => 'other_course',
        'maxlength'   => '7',
        'size'        => '7',
        'disabled'   => TRUE   
      );
    echo form_input($data);
    
    ?>
    </p>
    <label for='year'>Year</label>
    <?php        
        $data = array(
            'name'        => 'year',
            'maxlength'   => '4',
            'size'        => '4',
          );
        echo form_input($data);
    ?>
    </p>
    <p>
    <label for='term'>Term</label>
    <?php
        
        $options=array(
            'spring' => 'Spring',
            'summer' =>'Summer',
            'fall' =>'Fall',
            'winter'=> 'Winter'
        );
        echo form_dropdown('term',$options);
    ?>
    </p>
        <p>
        <?php
            echo form_submit('submit','Submit');
        ?>
    </p>
    </form>
</div>