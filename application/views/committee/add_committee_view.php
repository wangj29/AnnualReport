<form class="form-inline" role="form" method="post" action="add_committee_submit">
    <div class="form-group">
        <label for="committee_name">Committee Name:</label>
        <input type="text" class="form-control" name="committee_name" required="true">
    </div>

    <div class="form-group">
        <label for="committee_type">Category:</label>
        <select class="form-control" name="committee_type">
            <?php
                $query = $this->committee_model->get_type();
                foreach($query->result() as $row) { ?>
                    <option value="<?=$row->type_name?>"> <?=$row->type_name?> </option>
                <?php
                }
            ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
