


<div class="row">
<div class="col-md-4 col-md-offset-4">

	<h1>Register with us</h1>

	<?php showMessage();?>

	<p>
		Welcome to jeevana!<br/>
		Fill and submit this form to register with us. And we will take it from there.
	</p>

<?php required_title();?>

<?php echo form_open_multipart('user/register', array('id' => 'registrationForm'))?>


<div class="form-group">
	<label for="first_name">First Name</label>
	<input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo set_value('first_name') ? set_value('first_name') : '';?>"/>
</div>

<div class="form-group">
	<label for="last_name">last Name</label>
	<input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo set_value('last_name') ? set_value('last_name') : '';?>"/>
</div>

<div class="form-group">
	<label for="">Mobile Number</label>
	<div class="input-group col-md-12">

		<div class="col-md-2" style="padding:0px 0px;">
			<?php $aMobileData = array( 1 => '+91', 2 => '+86');?>
			<?php echo form_dropdown('mobile_code', $aMobileData, 1, 'id="mobile_code" class="form-control" style="padding:2px;"');?>
		</div>
		<div class="col-md-10" style="padding:0px 2px;">
			<input type="text" name="address_mobile1_" id="address_mobile1_" class="form-control" value="<?php echo set_value('address_mobile1_') ? set_value('address_mobile1_') : '';?>"/>
		</div>

	</div>
</div>

<div class="form-group">

		<label for="">Landline Number</label>
		<div class="input-group col-md-12">

			<div class="col-md-3" style="padding:0px 0px;">
				<input type="text" name="address_landline1_code_" id="address_landline1_code_" class="form-control" value="<?php echo set_value('address_landline1_code_') ? set_value('address_landline1_code_') : '';?>"/>
				<span class="small">Code</span>
			</div>
			<div class="col-md-1" style="padding:0px 2px;text-align:center;">-</div>
			<div class="col-md-8" style="padding:0px 2px;">
				<input type="text" name="address_landline1_" id="address_landline1_" class="form-control" value="<?php echo set_value('address_landline1_') ? set_value('address_landline1_') : '';?>"/>
				<span class="small">Number</span>
			</div>

		</div>



</div>

<div class="form-group">
	<label for="first_name">Gender</label>
	<?php $iDefault = set_value('gender') ? set_value('gender') : 1;?>
	<?php echo form_dropdown('gender', $aGenders, $iDefault, 'id="gender" class="form-control"');?>

</div>




<div class="form-group" style="text-align:center;">
		<input type="submit" name="submit" value="Submit" class="btn btn-primary"/>
		<?php echo backButton('', 'Back');?>
</div>

<?php echo form_close(); ?>
</div>
</div>
