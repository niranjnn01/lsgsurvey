<?php showMessage();?>


<?php /*?>

<h3><?php echo $page_heading;?></h3>
<div class="row">
	<div class="col-md-12">	
		<?php echo $oSitePageData->content1?>
	</div>
</div>
<hr class=""/>

<?php */?>
<div class="row clearfix">
	<form class="" role="form" id="resource_search_form">
	
	<div class="col-md-6">
		<div class="form-group">
			<label class="control-label" for="search_query">Search for a resource item</label>
			
				<input type="text" class="form-control" value="<?php echo $sSearchString;?>" name="search_query" id="search_query" placeholder="Type a keyword"/>
			
		</div>	
	</div>
	
	<div class="col-md-2">
		<div class="form-group">
			<label class="control-label" for="file_category">File Category</label>
			
				<?php echo $sCategoryTreeDropDown?>
			
		</div>	
	</div>
		
	<div class="col-md-2">
		<div class="form-group">
			<label class="control-label" for="f_resource_type">File Type</label>
			
				<?php echo form_dropdown(	'type',
											$aResourceTypes,
											$iResourceType,
											'class="resource_type_filter form-control" id="f_resource_type"');?>
			
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
            <label class="control-label">&nbsp;</label>
            <br/>
			<input type="button" class="btn btn-primary" value="Search" id="search"/>
		</div>
	</div>

	</form>
</div>
<div class="row">

</div>
<?php /* - Form horizontal?>
<div class="row">		
	<form class="form-horizontal" role="form" id="resource_search_form">
		<div class="form-group">
			<label class="col-sm-3 control-label" for="search_query">Type a keyword</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" value="<?php echo $sSearchString;?>" name="search_query" id="search_query"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="file_category">File Category</label>
			<div class="col-sm-5">
				<?php echo $sCategoryTreeDropDown?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="f_resource_type">File Type</label>
			<div class="col-sm-5">
				<?php echo form_dropdown(	'type',
											$aResourceTypes,
											$iResourceType,
											'class="resource_type_filter form-control" id="f_resource_type"');?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="search">&nbsp;</label>
			<div class="col-sm-5">
				<input type="button" class="btn btn-default" value="Search" id="search"/>
			</div>
		</div>
	</form>
	
</div>
<?php */?>


<?php //echo $sPagination;?>



<div class="row">

	<hr>
	
	<div class="col-md-9" style="border-right:1px dashed #CCC;">
		

    <?php if($aResources):?>
	
	<h5 class="text-right">
		<small><?php echo 'From a total of ', $iTotal, ' files';?></small>
	</h5>
	
    <ul class="list-unstyled">
        <?php foreach($aResources AS $oItem):?>
        <li class="m-b-20">
            <h4 style="margin:0px;">
                    <a href="<?php echo $c_base_url, 'resource/view/', $oItem->seo_name;?>">
                    <?php echo $oItem->title?></a>
                <?php /*?>    
                <a href="<?php echo 'resource/view/', $oItem->seo_name;?>">
				<?php if( $oItem->type == $aResourceType['youtube_video'] ):?>
					<a href="<?php echo getYouTubeVideoURL_browser($oItem->file_name);?>"><?php echo $oItem->title;?></a>
				<?php elseif( $oItem->type == $aResourceType['web_link'] ):?>
					<a href="<?php echo $oItem->url;?>"><?php echo $oItem->title;?></a>
				<?php else:?>
                    <a href="<?php echo $aResourceTypeUrl[$oItem->type], $oItem->file_name;?>">
                    <?php echo $oItem->title?></a>
				<?php endif;?>
                <?php */?>    
            </h4>
			<h5 style="margin:3px 0px 5px 0px;"><small>
				Category : <?php echo $oItem->category_title;?>,
				File Type : <?php echo $aResourceTypes[$oItem->resource_type];?>, 
				Size : <?php echo $oItem->file_size;?> MB</small>
			</h5>
            
            <div><?php echo $oItem->excerpt;?></div>
        </li>
        <?php endforeach;?>
	</ul>
    <?php echo $sPagination;?>
    
    <?php else:?>
        <div class="no_data">There are no files</div>
    <?php endif;?>
		
	</div>
	<div class="col-md-3">
		<p class="text-justify">
			<i><?php echo $oSitePageData->content1?></i>
		</p>
		<a class="pull-right" href="<?php echo $c_base_url, 'privacy-policy'?>">Privacy Policy</a>
	</div>
</div>