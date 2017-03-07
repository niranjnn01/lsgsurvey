<h3><?php echo $page_heading;?></h3>
<?php showMessage();?>

<div class="row">
<div class="col-md-8">

<?php echo form_open_multipart('resource/edit_category/' . $oResourceCategory->id, array('id' => 'resourceCreateCategoryForm'))?>

<div></div>
	
	<div class="col-md-12">
		<label for="title">Title</label>
		<input type="text" class="col-md-12" name="title" autocomplete="off" value="<?php echo set_value('title') ? set_value('title') : $oResourceCategory->title;?>"/>
	</div>
	
	<div class="col-md-12">
		<label for="description">Description</label>
		<textarea name="description" class="col-md-12"><?php echo set_value('description') ? set_value('description') : $oResourceCategory->description;?></textarea>
	</div>

	
	<div class="col-md-12">
		<label for="parent">Parent</label>
		<?php echo $sCategoryTreeDropDown;?>
	</div>
	
	
	
	<div class="col-md-12 m-t-15">
			<input type="submit" name="create" value="Update Category" class="btn btn-default btn btn-default-primary"/>
			<?php echo backButton('', 'Back');?>
	</div>
	

<?php echo form_close(); ?>
</div>
</div>





