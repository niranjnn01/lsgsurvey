
<?php showMessage();?>

<?php echo form_open('meeting/create_ward_meeting', 'id = "createWardMeeting"')?>

	<div class="col-md-6">
		
		<div class="form-group">
		
			<title>Choose a ward</title>
			<?php echo form_dropdown('ward_id', $aUserWards, 0, 'class="form-control"  id="ward_id"');?>
			
		</div>
		
		<div class="form-group">&nbsp;</div>
		<div class="form-group">
				<input type="submit" name="create" value="Create" id="create_meeting" class="btn btn-primary"/>
				<?php echo backButton('', 'Back');?>
		</div>		
	</div>
<?php echo form_close(); ?>

