<h3><?php echo $page_heading;?></h3>
<?php showMessage();?>

<div class="row">
<div class="col-md-8">
<?php echo form_open_multipart('program/edit/'.$oProgram->uid, array('id' => 'programCreateForm'))?>


<div></div>
	
	<div class="col-md-12">
		<label for="title">Title</label>
        <input type="text" name="title" value="<?php echo set_value('title') ? set_value('title') : $oProgram->title;?>" class="col-md-12"/>



	</div>
	
	<div class="col-md-12">
		<label for="excerpt">Excerpt</label>
        <textarea id="excerpt" name="excerpt" class="col-md-12"><?php echo set_value('excerpt') ? set_value('excerpt') : $oProgram->excerpt;?></textarea>
        <div class="help-block"><span id="charsLeft"></span> charaters left</div>
	</div>

	<div class="col-md-12">
		<label for="description">Description</label>
        <textarea name="description"  class="col-md-12 tinymce"><?php echo set_value('description') ? set_value('description') : $oProgram->description;?></textarea>
        <div class="program_desc_err_position"></div>
	</div>
    
	<div class="col-md-12">
		<label for="program_director">Program Director's name</label>
        <input type="text" name="program_director"  class="col-md-12" value="<?php echo set_value('program_director') ? set_value('program_director') : $oProgram->program_director;?>"/>
	</div>
	

	<div class="col-md-12">
		<label for="program_director_url">Program Director's profile URL</label>
        <input type="text" name="program_director_url"  class="col-md-12" value="<?php echo set_value('program_director_url') ? set_value('program_director_url') : $oProgram->program_director_url;?>"/>
	</div>
    
	<?php /*?>
	<div class="col-md-12">
		<label for="topic">Topic</label>
        <?php $iDefault = set_value('topic') ? set_value('topic') : $oProgram->topic_uid;?>
        <?php echo form_dropdown('topic', $aTopics, $iDefault, ' class="col-md-12"');?>
	</div>
	<?php */?>
	<div class="col-md-12">
		<label for="priority">Priority</label>
        <?php $iDefault = set_value('priority') ? set_value('priority') : $oProgram->priority;?>
        <?php echo form_dropdown('priority', $aPriority, $iDefault, ' class="col-md-12"');?>
        <div class="help-block">1=highest priority</div>
	</div>
    
	<div class="col-md-12">
		<label for="status">Status</label>
        <?php echo form_dropdown('status', $aProgramStatusFlipped, $oProgram->status, ' class="col-md-12"');?>
	</div>
	
	
    <?php /*?>
	<div class="col-md-12">
		<label for="project_type">Resource ID</label>
        <div class="resources">
            <?php if($oProgram->aResources):?>
                <?php foreach($oProgram->aResources AS $oResource):?>
                    <input type="text" name="resource_id[]" class="col-md-12" value="<?php echo $oResource->resource_id?>"/>
                <?php endforeach;?>
            <?php else:?>
                <input type="text" name="resource_id[]" class="col-md-12"/>
            <?php endif;?>
        </div>
        <input type="button" id="add_resource" value="Add More" class="btn btn-default btn btn-default-primary"/>
        <div class="help-block">ID of a resource from thanal.</div>
	</div>
    <?php */?>

	<?php /*?>
	<div class="col-md-12">
		<label for="display_image">Display Image</label>
        <input type="text" name="display_image"  class="col-md-12" value="<?php echo set_value('display_image') ? set_value('display_image') : $oProgram->display_image;?>"/>
        <div class="help-block">enter the uid of a resource of type "image"</div>
	</div>
	<?php */?>
	
	<div class="col-md-12">
		<label for="display_image">Display Image</label>
		<div id="display_image_cnt" class="thumbnail text-center pull-left m-r-20" style="width:100px; min-height:100px;background-color:#FFF;">
			<?php if( $oProgram->display_image ): ?>
				<img src="<?php echo $this->thanal_resource->getResourceThumbnailUrl($oProgram->display_image, 'display_image');?>"/>
			<?php else: ?>
				No Image Selected
			<?php endif; ?>
			
		</div>
		<a href="#" class="btn btn-default btn btn-default-primary pull-left" id="select_display_image" style="margin-top:40px;">Select Display Image</a>
        <input type="hidden" name="display_image" id="display_image" class="col-md-8" value="<?php echo set_value('display_image') ? set_value('display_image') : $oProgram->display_image;?>"/>
		
	</div>
	
	<div class="col-md-12">
		<label>Resources</label>
		<div id="selected_resources_cnt" style="min-height:60px;background-color:#FFF;" class="thumbnail c">
			
            <?php if($oProgram->aResources):?>
                <?php foreach($oProgram->aResources AS $oResource):?>
				
				
					<div class="alert alert-success" style="float:left;margin-right: 10px;">
						
						<button class="close" id="<?php echo $oResource->resource_id;?>" data-dismiss="alert" type="button">x</button>
					
						<?php if( $oResource->type == $aResourceType['youtube_video'] ):?>
							<a target="_blank" href="<?php echo $this->thanal_resource->getYouTubeVideoURL_browser($oResource->file_name);?>"><?php echo $oResource->title;?></a>
						<?php elseif( $oResource->type == $aResourceType['web_link'] ):?>
							<a target="_blank" href="<?php echo $oResource->url;?>"><?php echo $oResource->title;?></a>
						<?php else:?>
							<a target="_blank" href="<?php echo $aResourceTypeUrl[$oResource->type], $oResource->file_name;?>">
							<?php echo $oResource->title?></a>
						<?php endif;?>
					
					</div>
                <?php endforeach;?>
            <?php else:?>
                
            <?php endif;?>
			
		</div>
		<div class="row m-t-15">
			<a class="fancybox btn btn-default btn btn-default-primary" href="#" id="include_resource">Include Resources</a>
		</div>
		<input type="hidden" name="selected_resources" id="selected_resources" value="<?php echo $selected_resources_stringified;?>"/>
	</div>

	
	<div class="col-md-12">&nbsp;</div>
	
	<div class="col-md-12">
			<input type="submit" name="create" value="Update Program" class="btn btn-default btn btn-default-primary"/>
			<?php echo backButton('', 'Back');?>
	</div>
	

<?php echo form_close(); ?>

<?php echo $sResourceTable;?>
</div>
</div>