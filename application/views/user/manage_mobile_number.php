
<div class="row">
	<div class="col-md-6 col-md-offset-3">

		<?php showMessage();?>
		
		
		
		<div class="form-group">
			<label>
				Mobile Number
			</label>
			
			<?php echo $oUser->mobile_number;?>
			
		</div>
		
		<div class="form-group">
			<label>
				Status
			</label>
			
			<?php $sColour = '';?>
			<?php if( $oUser->mobile_verification_status == $aUserMobileVerificationStatus['sms_verified'] ):?>
				<?php $sColour = 'green';?>
			<?php elseif( $oUser->mobile_verification_status == $aUserMobileVerificationStatus['sms_sent'] ):?>
				<?php $sColour = 'orange';?>
			<?php elseif( $oUser->mobile_verification_status == $aUserMobileVerificationStatus['no_sms_verification_done'] ):?>
				<?php $sColour = 'red';?>
			<?php endif;?>
				
			<span style="color:<?php echo $sColour;?>">
				<?php echo $aUserMobileVerificationStatusTitle[$oUser->mobile_verification_status];?>
			</span>
			
			
			<?php if(
						$oUser->mobile_verification_status != $aUserMobileVerificationStatus['sms_verified']
						&&
						$oUser->mobile_verification_status != $aUserMobileVerificationStatus['sms_sent']
					):?>
				<?php echo form_open('user/manage_mobile_number',
									   array('id' => 'MobNumVerificationRequestForm', "class" => "form-inline"))?>
					<div class="form-group">
						<input type="hidden" name="verification_request" value="1"/>
						<input type="submit" name="verify_mobile_number" class="btn btn-default pull-right" id="btn-default" value="Verify mobile number"/>
					</div>
				<?php echo form_close(); ?>
			<?php endif;?>
			
		</div>
		
		
		

	</div>
</div>
