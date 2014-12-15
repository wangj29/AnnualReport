<form class="form-inline" role="form" method="post" action="add_member_submit">
	<div class="form-group">
		<label for="committee">Committee </label>
		<select name="committee_name" class="form-control" >
			<?php
				$query = $this->committee_model->get_committee();
				foreach( $query->result() as $committee)  {?>
					<option value="<?=$committee->committee_name?>"> <?=$committee->committee_name?></option>
				<?php }
			?>
		</select>
	</div>

	<div class="form-group">
		<label for="faculty"> Faculty </label>
		<select name="faculty" class="form-control" >
			<?php
				$query = $this->membership_model->get_user();
				foreach($query->result() as $user)  {?>
					<option value="<?=$user->user_id?>"> <?=$user->user_fullname?></option>
				<?php
				}
			?>
		</select>
	</div>
	<div class="checkbox">
		<label for="member">Member</label>
		<?= form_radio('is_chair', '0',TRUE);?>
	</div>
	<div class="checkbox">
		<label for="chair">Chair</label>
		<?=form_radio('is_chair', '1',FALSE);?>
	</div>
<button type="submit" class="btn btn-default">Add</button>
</form>