<div class="col-md-8">
	
<h3>Create New Resource</h3>
<?php showMessage();?>

<?php echo form_open_multipart('resource/create', array('id' => 'resourceCreateForm', 'class' => 'upload_resource_form'))?>




	
	<div class="form-group">
		<label for="title">Title</label>
		<input type="text" name="title" value="<?php echo set_value('title') ? set_value('title') : '';?>" class="form-control"/>
		<div class="help-block">Give meaningful names. will be used to create the filename.</div>
	</div>
    
	<div class="form-group">
		<label for="excerpt">Excerpt</label>
		<textarea id="excerpt" name="excerpt" class="form-control"><?php echo set_value('excerpt') ? set_value('excerpt') : '';?></textarea>
		<div class="help-block"><span id="charsLeft"></span> charaters left</div>
	</div>
    
	<div class="form-group">
		<label for="description">Description</label>
		<textarea name="description"  class="form-control text-editor"><?php echo set_value('description') ? set_value('description') : '';?></textarea>
		<span class="resource_desc_err_position"></span>
	</div>

	<?php /*?>
	
		<div class="form-group">
			<label for="description">Category</label>
			<?php echo $sCategoryTreeDropDown;?>
		</div>
	<?php */?>

	<div class="form-group">
		<label for="resource_type">Resource Type</label>
		<?php $iDefault = set_value('resource_type') ? set_value('resource_type') : 0?>
		<?php echo form_dropdown('resource_type', $aResourceTypes, $iDefault, 'class="form-control"');?>
	</div>
	
	<div class="form-group">
		<label for="priority">Priority</label>
        <?php $iDefault = set_value('priority') ? set_value('priority') : 5;?>
        <?php echo form_dropdown('priority', $aPriority, $iDefault, ' class="form-control"');?>
        <div class="help-block">1=highest priority</div>
	</div>
	
	<div class="form-group">
		<label for="description"><b>Resource File</b></label>

		
			<div id="file_upload_section">
				<?php /*?>
				<div>
					<a onclick="javascript:return false;"
						href="<?php echo c('base_url'), 'resource/get_upload_form/', $iAccountNo;?>"
						id="resource_add_popup"
						class="btn btn-default btn btn-default-primary"
						data-fancybox-type="iframe"
						>Choose a file</a>
					&nbsp;Or, if the resource is a youtube link, enter it below
				</div>
				<?php */?>
				
				<div class="fr"><a href="#" id="file_upload">Upload Files</a></div>
				<div id="upload_errors"></div>
				<div>
					<p>Or, to create a URL resource item, enter enter the URL in the text box below</p>
					<p>If the URL is a youtube link, it will be automatically identified as a "Video" resource item</p>
				</div>
				<div>
					<input type="text"
							name="youtube_video_url"
							class="form-control"
							value="<?php set_value('youtube_video_url') ? set_value('youtube_video_url') : ''?>"/>
				</div>
			</div>
			
			<div id="upload_success" class="dn">
				<a href="#" class="m-l-20 pull-left cancel_resource_upload_2">cancel</a>
			</div>
	</div>
	
	<div class="form-group">&nbsp;</div>
	<div class="form-group">
			<input type="submit" name="create" value="Create Resource" class="btn btn-default btn btn-default-primary"/>
			<?php echo backButton('', 'Back', array('class' => 'cancel_resource_upload_form'));?>
	</div>
	

<?php echo form_close(); ?>
</div>
