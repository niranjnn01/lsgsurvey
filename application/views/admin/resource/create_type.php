<h3><?php echo $page_heading;?></h3>
<?php showMessage();?>
<?php required_title();?>

<?php echo form_open_multipart('resource/create_type', array('id' => 'resourceCreateTypeForm'))?>

<div class="fc create_resource_type_form">

	<div class="fro" align="center">
		<label for="username">Title<span class="req">*</span></label>
		<div>&nbsp;:&nbsp;</div>
		<div class="fr ">
			<div class="l">
				<input type="text" name="title" autocomplete="off" value="<?php echo set_value('title') ? set_value('title') : '';?>"/>
			</div>
		</div>
	</div>

	<div class="fro" align="center">
		<label for="description">Description</label>
		<div>&nbsp;:&nbsp;</div>
		<div class="fr ">
			<div class="l">
				<textarea name="description"><?php echo set_value('description') ? set_value('description') : '';?></textarea>
			</div>
		</div>
	</div>
	
	
	<div class="fro" align="center">
		<label>&nbsp;</label>
		<div>&nbsp;&nbsp;&nbsp;</div>
		<div class="fr ">
			<input type="submit" name="create" value="Create Type"/>
			<?php echo backButton('', 'Back');?>
		</div>
	</div>
	
</div>
<?php echo form_close(); ?>
