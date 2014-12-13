<h3>Add Awards</h3>

<?php
    echo validation_errors();
    echo form_open('award/submit');
?>

<div class='form'>
    
    <p>
    <label for='year'> Year(4 digits)</label>
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
    <label for='type'> Type </label>
    <?php
        $option = array(
          'research'        => 'Research',
          'teaching'   => 'Teaching',
          'service'    => 'Service'
        );
        $attr='size="2"';
        echo form_dropdown('type',$option,$attr);
    ?>
    </p>
    
    <p>
    <label for='title'> Title </label>
     <?php
           $data = array(
                'name'        => 'title',
                'maxlength'   => '50',
                'size'        => '50',
              );
            echo form_input($data);
        ?>
    </p>
     <p>
    <label for='comment'> Comment </label>
     <?php
           $data = array(
                'name'        => 'comment',
                'rows'   => '5',
                'cols'        => '50',
              );
            echo form_textarea($data);
        ?>
    </p>
    <p> <?php echo form_submit('submit','Submit'); ?> </p>
</div>