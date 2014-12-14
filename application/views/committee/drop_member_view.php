<h3>Drop a Committee Member</h3>
<?php echo form_open('committee/drop_member_submit');?>

<?php
    //first dropdown menu
    $committee_list = $this->committee_model->get_committee();
    $option = array();
    $option[""]="Select a committee";

    foreach ($committee_list->result() as $row){ 
        $option[$row->committee_name] = $row->committee_name;
    }
    $id = 'id="committee-name"';
    echo form_dropdown('committee_name',$option,'""',$id);
    
    //second dropdown menu
    $option = array();
    $option[""] = "Select a member";
    $id = 'id="member-name" disabled=true';
    echo form_dropdown('member_name', $option,'""',$id);
?>
<!--<select id="committee-member" name="committee_member" disabled=true></select>-->

<?php echo form_submit('submit', 'Submit'); ?>
</form>
<!--end of form -->

<script type="text/javascript">
$(function(){
    var url = '<?php echo site_url('committee/show_member_query'); ?>';
    $("#committee-name").change(function(){
        var postData = $(this).serialize();
        $.ajax(url, {
            type: "POST",
            data: postData,
            dataType: 'json',
            success: function(result){
                var options = $.map(result, function(member, index){
                    return $('<option value="' + member.user_id+ '">' + member.user_name + '</option>');
                });
                $('select#member-name').attr('disabled',false).html(options);
            }
            });
        // End of ajax call

    });
 });
</script>