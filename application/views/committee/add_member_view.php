<div id='add-member'>
<h3>Add a new committee member</h3>
	<form class="form-inline" role="form" method="post" action="<?=site_url('committee/add_member_submit');?>"/>
		<div class="form-group">
			<label for="committee">Committee </lable>
			<?php
				$option=array();
				$query=$this->committee_model->get_committee();
				foreach( $query->result() as $committee) {
					$option[$committee->committee_name]=$committee->committee_name;
				}
				echo form_dropdown('committee_name',$option, 'class="form-control"');
			?>
		</div>
		<div class="form-group">
			<label for="faculty">Faculty</label>
			<?php
				$option=array();
				$query = $this->committee_model->get_faculty();
				foreach( $query->result() as $faculty){
					$option[$faculty->user_id]=$faculty->user_name;
				}
				echo form_dropdown('faculty',$option,'class="form-control"');
			?>
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
</div>