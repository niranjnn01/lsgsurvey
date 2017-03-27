<h3><?php echo $page_heading;?></h3>
<?php showMessage();?>

<div class="row">
<div class="col-md-8">
<?php echo form_open_multipart('program/create', array('id' => 'programCreateForm'))?>


<div></div>
	
	<div class="col-md-12">
		<label for="title">Title</label>
        <input type="text" name="title" value="<?php echo set_value('title') ? set_value('title') : '';?>" class="col-md-12"/>
	</div>
	
	<div class="col-md-12">
		<label for="excerpt">Excerpt</label>
        <textarea id="excerpt" name="excerpt" class="col-md-12"><?php echo set_value('excerpt') ? set_value('excerpt') : '';?></textarea>
        <div class="help-block"><span id="charsLeft"></span> charaters left</div>
	</div>

	<div class="col-md-12">
		<label for="description">Description</label>
        <textarea name="description"  class="col-md-12 text-editor"><?php echo set_value('description') ? set_value('description') : '';?></textarea>
        <div class="program_desc_err_position"></div>
	</div>
    
	<div class="col-md-12">
		<label for="program_director">Program Director</label>
        <input type="text" name="program_director"  class="col-md-12" value="<?php echo set_value('program_director') ? set_value('program_director') : '';?>"/>
	</div>
    
	
	<div class="col-md-12">
		<label for="topic">Topic</label>
        <?php $iDefault = set_value('topic') ? set_value('topic') : 0;?>
        <?php echo form_dropdown('topic', $aTopics, $iDefault, ' class="col-md-12"');?>
	</div>
    
	<div class="col-md-12">
		<label for="priority">Priority</label>
        <?php $iDefault = set_value('priority') ? set_value('priority') : 5;?>
        <?php echo form_dropdown('priority', $aPriority, $iDefault, ' class="col-md-12"');?>
        <div class="help-block">1=highest priority</div>
	</div>

	<div class="col-md-12">
		<label for="display_image">Display Image</label>
		<div id="display_image_cnt" class="thumbnail text-center pull-left m-r-20" style="width:100px; min-height:100px;background-color:#FFF;">
			No Image Selected
		</div>
		<a href="#" class="btn btn-default btn btn-default-primary pull-left" id="select_display_image" style="margin-top:40px;">Select Display Image</a>
        <input type="hidden" name="display_image" id="display_image" class="col-md-8" value="<?php echo set_value('display_image') ? set_value('display_image') : '';?>"/>
		
	</div>
	
	<div class="col-md-12">
		<label>Resources</label>
		<div id="selected_resources_cnt" style="min-height:60px;background-color:#FFF;" class="thumbnail c"></div>
		<div class="row m-t-15">
			<a class="fancybox btn btn-default btn btn-default-primary" href="#" id="include_resource">Include Resources</a>
		</div>
		<input type="hidden" name="selected_resources" id="selected_resources" value=""/>
	</div>


    
	
	<div class="col-md-12">
			<input type="submit" name="create" value="Create Program" class="btn btn-default btn btn-default-primary"/>
			<?php echo backButton('', 'Back');?>
	</div>
	
	

<?php echo form_close(); ?>
</div>


<?php echo $sResourceTable;?>


</div>