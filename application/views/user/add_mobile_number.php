
<div class="row">
	<div class="col-md-6 col-md-offset-3">

		<?php showMessage();?>
		
		<?php echo form_open_multipart('user/add_mobile_number', array('id' => 'loginForm'))?>
		
		<div class="form-group">
			<label>Mobile Number</label>
			<input type="text" name="mobile_number" id="mobile_number" size="30" class="form-control"
				   value="<?php echo set_value('mobile_number') ? set_value('mobile_number') : '';?>"/>
			<div class="help-text">
				Enter your 10 digit mobile number.
			</div>
		</div>
		
		<div class="form-group">
			
			<input type="submit" name="continue" class="btn btn-default pull-right" id="btn-default" value="Continue"/>
			
		</div>
		<?php echo form_close(); ?>

	</div>
</div>
