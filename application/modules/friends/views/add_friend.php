<?php echo form_open_multipart($this->uri->uri_string()); ?>
<div>
	<label for='first_name'>First Name: </label>
	<input type="text" name="first_name">
</div>
<div>
	<label for='age'>Age: </label>
	<input type="number" name="age">
</div>
<div class="form-group">
	<label for='gender'>Gender: </label>
	Male <input type="radio" name="gender" value="male"> Female <input type="radio" name="gender" value="female">
</div>
<div>
	<label for='hobby'>Hobby: </label>
	<input type="text" name="hobby">
</div>
<div class="form-group">
	<label>Image</label>
	<input type="file" id="userfile" name="userfile">
</div>
<div>
		<input type="submit" value="welcome friend" class="button1">
</div>
	<?php echo form_close(); ?>
</div>

