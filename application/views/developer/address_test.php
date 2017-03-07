<div class="row">
	<div class="col-md-8">
	<h1><?php echo $page_heading;?></h1>
	<?php showMessage();?>


<?php echo form_open_multipart('developer/address_test', array('id' => 'contactInfoForm', 'class' => 'form'))?>


	
	<div class="form-group">
		<label for="title">Title</label>
		<input type="text" id="title" name="title"
			   class="form-control"
			   value="<?php echo set_value('title') ? set_value('title') : ''?>"/>
	</div>
	
	
	<?php //echo $sAddressCreateForm;?>
	
	<?php echo $sAddressUpdateForm;?>
	
	<div class="form-group">
		<label>&nbsp;</label>
		<input type="submit" name="save" value="Save" class="btn btn-default"/>
		<?php echo backButton('', 'Back');?>
	</div>
	

<?php echo form_close(); ?>

	</div>

</div>