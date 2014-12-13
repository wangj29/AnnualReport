<h3>Upload Excel File </h3>
<div class='form'>
<?php   echo form_open_multipart('evaluation/do_upload');?>
   <p><label for='namecol'>Name Column</label>
   <?php
         $data = array(
            'name'        => 'namecol',
            'maxlength'   => '3',
            'size'        => '3',
          );
        echo form_input($data);
   ?>
   </p>
   <p><label for='valuecol'>Value Column</label>
   <?php
         $data = array(
            'name'        => 'valuecol',
            'maxlength'   => '3',
            'size'        => '3',
          );
        echo form_input($data);
   ?>
   </p>
   <p><?php echo form_upload('file'); ?> <?php echo form_submit('submit','Upload'); ?></p>
</form>
</div>

