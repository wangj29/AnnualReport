<h3>Annual Report Contents</h3>
<div>
    <?php echo form_open('DepartmentExcel'); ?>
    <p><?php
        $attr='class="myButton"';
    echo anchor('IndividualExcel','Individual Report',$attr);?></p>
    
    <p>
    <label for='year'> Year </label>
    <?php
        $option=array();
        $option[1]='current';
        $option[2]='last 3 years';
        $option[4]='last 5 years';
        $option[date('Y')]='all';

        echo form_dropdown('year',$option);
    ?>
    </p>
    <p>
        <?php
    
    echo form_submit('submit','Department Report',$attr);
    ?>
    </p>
</div>
</form>