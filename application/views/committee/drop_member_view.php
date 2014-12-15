<form class="form-inline" role="form" method="post" action="drop_member_submit">
    <div class="form-group">
        <label class="sr-only" for="committee_name" >Committee</label>
        <select class="form-control" name="committee_name" required>
            <option value="">Select A Committee</option>
            <?php
                $committee_list = $this->committee_model->get_committee();
                foreach ($committee_list->result() as $row){ ?>
                    <option value="<?=$row->committee_name?>"><?=$row->committee_name?></option>
                <?
                }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label class="sr-only" for="committee_member" >Member</label>
        <select class="form-control" name="committee_member" required disabled>
            <option value="">Select a Member</option>
        </select>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
<!--end of form -->

<script type="text/javascript">
$(function(){
    var url = 'show_member_query';
    $('select[name="committee_name"]').change(function(){
        var postData = $(this).serialize();
        $.ajax(url, {
            type: "POST",
            data: postData,
            dataType: 'json',
            success: function(result){
                if (result.length > 0) {
                    var options = "";
                    for(var i = 0; i < result.length; i++) {
                        options += '<option value="' + result[i].member_id + '">' + result[i].member_name + '</option>';
                    }
                    $('select[name="committee_member"]').attr('disabled',false).html(options);
                } else {
                    $('select[name="committee_member"]').attr('disabled',true).html("<option value>Select a Member</option>")
                }
            }
            });
        // End of ajax call

    });
 });
</script>