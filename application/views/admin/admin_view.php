<h3>Add User</h3>
<div id='add-member'>
	<form class="form-inline" role="form" action="<?=site_url('admin/insert');?>"/>
		<div class="form-group">
			<label for="user_id">UniqueID</lable>			
			<?=form_input('user_id');?>
		</div>
		<div class="form-group">
			<label for="user_name">USERNAME</lable>			
			<?=form_input('user_name');?>
		</div>
		<button type="submit" class="btn btn-default">Add</button>
	</form>
</div>