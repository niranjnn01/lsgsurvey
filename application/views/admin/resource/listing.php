<?php showMessage();?>
<h3><?php echo @$page_heading;?></h3>


	
<div class="row">
	<div class="col-md-3">
		
		<label>Resource Status</label>
		<?php echo form_dropdown('status', $aResourceStatusTitle, $iStatus, 'class="status_filter" id="f_status"');?>
	</div>
	<div class="col-md-3">
		<label>Resource Type</label>
		<?php echo form_dropdown('type', $aResourceTypes, $iResourceType, 'class="type_filter" id="f_type"');?>
	</div>
	<div class="col-md-3">
		<label>Resource Category</label>
		<?php echo $sCategoryTreeDropDown;?>
	</div>
		
		<?php /*
		Resource Category : <span class="tiny"><?php echo form_dropdown('type', $aResourceCategories, $iCategory, 'class="category_filter" id="f_category"');?></span>
		*/ ?>
</div>

<div class="row">
	<div class="col-md-3">
		<h4>Total of <?php echo $iTotal;?> resources</h4>
	</div>
</div>
<?php if($aData):?>
<table class="table table-condensed">

    <thead>
		<tr>
			<th>SI</th>
			<th>Details</th>
			<th>Priority</th>
			<th>Extension</th>
			<th>Resource Type</th>
			<th>Category</th>
			<th>Status</th>
			<th>Actions</th>
		</tr>
    </thead>
	
    <tbody>
	<?php foreach($aData AS $iKey=>$oItem):?>
    <tr>
		
	    <td>
			<?php echo $iKey + $iOffset + 1;?>
		</td>
		<td>
			
			<h4><?php echo $oItem->title;?></h4>
			<div>
				<?php echo $aResourceTypes[$oItem->resource_type];?> | 
				Size : (<?php echo $oItem->file_size;?> MB) | UID : <?php echo $oItem->uid;?>
			</div>
			<div><?php echo $oItem->description;?></div>
			<div>
				view page : <a href="<?php echo $c_base_url, 'resource/view/', $oItem->seo_name;?>"><?php echo $oItem->title;?></a>
			</div>
			<div>Link to file :
				<?php if( $oItem->type == $aResourceType['youtube_video'] ):?>
					<a href="<?php echo getYouTubeVideoURL_browser($oItem->file_name);?>"><?php echo $oItem->title;?></a>
				<?php elseif( $oItem->type == $aResourceType['web_link'] ):?>
					<a href="<?php echo $oItem->url;?>">
						<?php echo $oItem->title;?></a>
				<?php else:?>
					<a href="<?php echo $aResourceTypeUrl[$oItem->type], $oItem->file_name;?>">
						<?php echo $oItem->file_name;?></a>
				<?php endif;?>
				
			</div>
		</td>
		<td>
			<?php echo $oItem->priority;?>
		</td>
		<td>
			<?php echo $oItem->extension;?>
		</td>
		<td>
			<?php echo $aResourceTypeTitle[$oItem->type];?>
		</td>
		<td>
			<?php echo $oItem->category_title;?>
		</td>
		<td>
			<?php echo $aResourceStatusTitle[$oItem->status];?>
		</td>
		<td>
			<div><a href="<?php echo c('base_url');?>resource/edit/<?php echo $oItem->uid;?>">Edit</a></div>
			<div><a href="javascript:void(0);" class="perm_delete" id="<?php echo $oItem->uid;?>">Delete</a></div>
		</td>
		
    </tr>
	<?php endforeach;?>
    </tbody>
</table>
<div class="row">
	<?php echo $sPagination;?>
</div>

<?php else:?>
<div class="">There are no resources</div>
<?php endif;?>