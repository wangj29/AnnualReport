<h4> Courses Preferences</h4>
<div class="course">
<?php
    $year=date('Y');
    $month=date('n');
    $term='fall';
    if ($month >= 1 && $month <=5 ) $term ='spring';
    if ($month > 5 && $month <8 ) $term = 'summer';
    
    $options=array();
    if ($term == 'fall') $year=$year+1;
    if ($term == 'spring') $term = 'summer';
    if ($term == 'fall') $term = 'spring';
    if ($term == 'summer') $term = 'fall';
    
    echo '<p id="title1">';
    $title1= "For ".$year." ".$term;
    echo '</p>';
?>

<?php   echo form_open('course/submit'); ?>

<?php   echo form_fieldset($title1);?>
<p id="title2">Course #1</p>
<label for='course1'>Select Course</label>
<?php
    $course_list=$this->course_model->view_course();
    $options=array();
    $options[""]="None";
    foreach( $course_list->result() as $course)
        $options[$course->course_id]=$course->course_no;
    echo form_dropdown('course1', $options);
?>

<label for='day1'>Prefered days</label>
<?php
    $day_list=array('ALL','MW','TR','WF','MW','MWF','M','T','W','R','F');
    $options=array();
    foreach( $day_list as $day)
        $options[$day]=$day;
    echo form_dropdown('day1', $options);
?>

<label for='Time1'>Time Period</label>
<?php
    $time_list=array('ALL','8:00-10:00','10:00-12:00','12:00-14:00','14:00-16:00','16:00-18:00','18:00-rest');
    $options=array();
    foreach( $time_list as $time)
        $options[$time]=$time;
    echo form_dropdown('Time1', $options);
?>

<p id="title2">Course #2</p>
<label for='course2'>Select Course</label>
<?php
    $options=array();
    $options[""]="None";
    foreach( $course_list->result() as $course)
        $options[$course->course_id]=$course->course_no;
    echo form_dropdown('course2', $options);
?>

<label for='day2'>Prefered days</label>
<?php
    $options=array();
    foreach( $day_list as $day)
        $options[$day]=$day;
    echo form_dropdown('day2', $options);
?>

<label for='Time2'>Time Period</label>
<?php
    $time_list=array('ALL','8:00-10:00','10:00-12:00','12:00-14:00','14:00-16:00','16:00-18:00','18:00-rest');
    $options=array();
    foreach( $time_list as $time)
        $options[$time]=$time;
    echo form_dropdown('Time2', $options);
?>

<?php echo form_fieldset_close(); ?>

<?php   echo form_fieldset("Course for future");?>
<p id="title2">Course #1</p>
<label for='future1'>Select Course</label>
<?php
    $options=array();
    $options[""]="None";
    foreach( $course_list->result() as $course)
        $options[$course->course_id]=$course->course_no;
    echo form_dropdown('future1', $options);
?>

<p id="title2">Course #2</p>
<label for='future2'>Select Course</label>
<?php
    $options=array();
    $options[""]="None";
    foreach( $course_list->result() as $course)
        $options[$course->course_id]=$course->course_no;
    echo form_dropdown('future2', $options);
?>
<?php echo form_fieldset_close(); ?>
<?php echo form_submit('submit','Submit');?>

</div>
