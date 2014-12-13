<h3><?php echo $title; ?></h3>
 <div class="form">
<?php
    echo form_open('mentoring/submit');
?>
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
<!--
     data entry needed
-->
<p>
<label for='advisor'>Advisor</label>
<?php
    $data = array(
        'name' => 'advisor',
        'id' => 'advisor',
        'rows' => '2',
        'cols' => '50'
    );
    echo form_input($data)    
?>
</p>
<p>
<label for='committee'>Committee Members </label>
<?php
    $data = array(
        'name' => 'committee',
        'id' => 'committee',
        'rows' => '2',
        'cols' => '50'
    );
    echo form_textarea($data)
    
?>
</p>

<p>
    <?php
        echo form_submit('submit_thesis','Submit');
    ?>
</p>
</form>
</div>