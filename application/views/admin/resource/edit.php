

<div class="row">
<div class="col-md-12">

	
	<div class="form-group">
		<label for="title">Title</label>
		<input type="text" class="form-control" name="title" value="<?php echo set_value('title') ? set_value('title') : $oResource->title;?>"/>
		<div class="help-block">Give meaningful names. will be used to create the filename.</div>
	</div>
    
	<div class="form-group">
		<label for="excerpt">Excerpt</label>
		<textarea id="excerpt" class="form-control" name="excerpt"><?php echo set_value('excerpt') ? set_value('excerpt') : $oResource->excerpt;?></textarea>
		<div class="help-block"><span id="charsLeft"></span> charaters left</div>
	</div>
    
	<div class="form-group">
		<label for="description">Description</label>
		<textarea name="description" class="col-md-12 text-editor"><?php echo set_value('description') ? set_value('description') : $oResource->description;?></textarea>
		<span class="resource_desc_err_position"></span>
	</div>

	<div class="form-group">
		<label for="status">Status</label>
		<?php echo form_dropdown('status', $aResourceStatusFlipped, $oResource->status, ' class="form-control"');?>
	</div>
		
	<div class="form-group">
		<label for="category">Category</label>
		<?php echo $sCategoryTreeDropDown;?>
	</div>
	
	<div class="form-group">
		<label for="resource_type">Resource Type</label>
		<?php $iDefault = set_value('resource_type') ? set_value('resource_type') : $oResource->resource_type?>
		<?php echo form_dropdown('resource_type', $aResourceTypes, $iDefault, ' class="form-control"');?>
	</div>
	
	<div class="form-group">
		<label for="priority">Priority</label>

        <?php $iDefault = set_value('priority') ? set_value('priority') : $oResource->priority;?>
        <?php echo form_dropdown('priority', $aPriority, $iDefault, ' class="form-control"');?>
        <div class="help-block">1=highest priority</div>
	</div>
	
	<?php if( $oResource->type == $aResourceType['image'] ): ?>
	<div class="form-group">
		<label>
			<input type="checkbox" name="add_to_image_gallery" id="add_to_image_gallery"
				   <?php echo $oResource->added_to_image_gallery ? 'checked="checked"' : '';?>
				   value="1"/>
			Add this image to image gallery
		</label>
	</div>
	
	<div class="row <?php echo $oResource->added_to_image_gallery ? '' : 'dn';?>" id="image_gallery_category_cnt">
		<label for="image_gallery_category">select a category</label>
		<?php $iDefault = set_value('image_gallery_category') ?
							set_value('image_gallery_category') :
								(
									$oResource->added_to_image_gallery ?
									$oResource->image_gallery_category_id : 0
								);
		?>
		<?php echo form_dropdown('image_gallery_category', $aImageGalleryCategoryTitle, $iDefault, ' class="form-control"');?>
	</div>

	<div class="row <?php echo $oResource->added_to_image_gallery ? '' : 'dn';?>"
                                id="image_gallery_share_cnt">
        <div>Add this image to the gallery of the following websites.</div>
		
            <?php
            foreach( $aClientWebsites AS $sKey => $aWebsites ):
            $sChecked = '';
            if( in_array($sKey, $aGalleryWebsites) ) {
                $sChecked = 'checked="checked"';
            }
            ?>
        <label>    
                <input type="checkbox" name="image_gallery_item_on_websites[]" id=""
                       <?php echo $sChecked;?>
                       value="<?php echo $sKey;?>"/>
                <?php echo $aWebsites['domain'];?>
        </label>
            <?php endforeach;?>
		
	</div>


	<?php endif;?>
	
	<?php if( $oResource->type == $aResourceType['youtube_video'] ): ?>
	<div class="form-group">
		<label>
			<input type="checkbox" name="add_to_video_gallery" id="add_to_video_gallery"
				   <?php echo $oResource->added_to_video_gallery ? 'checked="checked"' : '';?>
				   value="1"/>
			Add this video to video gallery
		</label>
	</div>
	
	<div class="row <?php echo $oResource->added_to_video_gallery ? '' : 'dn';?>" id="video_gallery_category_cnt">
		<label for="video_gallery_category">select a category</label>
		<?php $iDefault = set_value('video_gallery_category') ?
							set_value('video_gallery_category') :
								(
									$oResource->added_to_video_gallery ?
									$oResource->video_gallery_category_id : 0
								);
		?>
		<?php echo form_dropdown('video_gallery_category', $aVideoGalleryCategoryTitle, $iDefault, ' class="form-control"');?>
	</div>
    

	<div class="row <?php echo $oResource->added_to_video_gallery ? '' : 'dn';?>"
                                id="image_gallery_share_cnt">
        <div>Add this video to the gallery of the following websites.</div>
		
            <?php
            foreach( $aClientWebsites AS $sKey => $aWebsites ):
            $sChecked = '';
            if( in_array($sKey, $aVideoGalleryWebsites) ) {
                $sChecked = 'checked="checked"';
            }
            ?>
        <label>    
                <input type="checkbox" name="youtube_video_gallery_item_on_websites[]" id=""
                       <?php echo $sChecked;?>
                       value="<?php echo $sKey;?>"/>
                <?php echo $aWebsites['domain'];?>
        </label>
            <?php endforeach;?>
		
	</div>
    
	<?php endif;?>

	<div class="form-group">&nbsp;</div>
	<div class="form-group">
			<input type="submit" name="update" value="Update Resource" class="btn btn-default btn btn-default-primary"/>
			<?php echo backButton('', 'Back');?>
	</div>
	
</div>
</div>
