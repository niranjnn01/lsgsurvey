
<div class="row">
	<div class="col-md-6 col-md-offset-3">

		<?php showMessage();?>
		
		<?php echo form_open_multipart('user/verify_mobile_number?account_no=' . $iAccountNo,
									   array('id' => 'loginForm'))?>
		
		<div class="form-group">
			<label>
				Enter the verification code sent to your mobile.
				<br/>
				(The code will be active only for <?php echo ($this->config->item('mobile_num_verification_token_time_to_live') / 60);?> minutes.)
				
			</label>
			<input type="text" name="verification_code" id="verification_code" size="30" class="form-control"
				   value="<?php echo set_value('verification_code') ? set_value('verification_code') : '';?>"/>
			<div class="help-text">
				
			</div>
		</div>
		
		<div class="form-group">
			
			<input type="submit" name="continue" class="btn btn-default pull-right" id="btn-default" value="Continue"/>
			
		</div>
		<?php echo form_close(); ?>

	</div>
</div>
