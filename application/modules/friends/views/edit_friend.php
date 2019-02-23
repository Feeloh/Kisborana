<?php echo form_open_multipart('friends/edit_friend/'.$friend_id, array('onsubmit' => "return confirm('Do you want to update this record')")); ?>
<div>
	<input type="hidden" name="first_name" value="<?php echo $friend_id; ?>" >
</div>
<div>
	<label for='first_name'>First Name: </label>
	<input type="text" name="first_name" value="<?php echo $friend_name; ?>" >
</div>
<div>
	<label for='age'>Age: </label>
	<input type="number" name="age" value="<?php echo $friend_age; ?>">
</div>
<div class="form-group">
	<label for='gender'>Gender: </label>
	Male <input type="radio" name="gender" value="male"> Female <input type="radio" name="gender" value="female">
</div>
<div>
	<label for='hobby'>Hobby: </label>
	<input type="text" name="hobby" value="<?php echo $friend_hobby; ?>">
</div>
<div class="form-group">
	<label>Image</label>
	<input type="file" id="userfile" name="userfile" value="<?php echo $friend_picture; ?>">
</div>
<div>
		<input type="submit" value="Edit friend" class="button1">
</div>
	<?php echo form_close(); ?>
</div>

