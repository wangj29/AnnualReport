<?php
    echo form_open('admin/submit');
    $item_list=array('committee','course','evaluation','publication',
                'mentoring','awards','annual_report');
    echo '<div id="nav-list">';
    foreach($item_list as $item){
        echo '<p>';
        echo form_checkbox('item[]',$item);
        echo $item;
        echo '</p>';
    }
    echo form_submit('submit','Submit');
    echo '</div>'
?>
</form>