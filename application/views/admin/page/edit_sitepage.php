
<?php showMessage();?>

<?php echo form_open_multipart('page/edit/'.$sitepage_details->id, array('id' =>'create_sitepage'))?>

<div class="row">
<div class="col-md-8">

	<div class="row">
		<label for="title">Site page name : <?php echo $sitepage_details->name;?></label>
		
	</div>
    
	<div class="row">
		<label for="title">Title</label>
		<input type="text" class="col-md-12" name="title" value='<?php echo htmlentities( set_value('title')?set_value('title'):$sitepage_details->title );?>' >
	</div>
    
	<div class="row">
		<label for="show">Show</label>
		<?php echo form_dropdown('show', array(1=>1, 2=>2, 3=>3), $sitepage_details->show ? $sitepage_details->show : set_value('show'), 'class="col-md-12"');?>
		<div class="help-block">(How many columns to be shown in the front end)</div>
	</div>

	<div class="row">
		<label for="page_content1">Content 1</label>
		<textarea name="page_content1" class="col-md-12 text-editor" rows="10"><?php echo $sitepage_details->content1;?></textarea>
	</div>
	
	<div class="row">
		<label for="page_content2">Content 2</label>
		<textarea name="page_content2" class="col-md-12 text-editor" rows="10"><?php echo $sitepage_details->content2;?></textarea>
	</div>
	
	<div class="row">
		<label for="page_content3">Content 3</label>
		<textarea name="page_content3" class="col-md-12 text-editor" rows="10"><?php echo $sitepage_details->content3;?></textarea>
	</div>
	
	<div class="row">&nbsp;</div>
	
	<div class="row">
			<input type="submit" name="create" value="Update" class="btn btn-default btn btn-default-primary"/>
			<?php echo backButton('', 'Back');?>
	</div>
	
</div>
</div>
<?php echo form_close(); ?>