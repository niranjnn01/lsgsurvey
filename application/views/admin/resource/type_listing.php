<?php showMessage();?>
<h3><?php echo @$page_heading;?></h3>


<div class="grid_container l users">
	<div class="cell l">
		Total of <?php echo $iTotal;?> categories
	</div>
</div>

<?php if($aData):?>

<div class="grid_container l events">


<div class="grid_header_cont l">
	<?php 
	$width1 = '25px';
	$width2 = '685px';
	$width4 = '105px';
	?>
	<div class="cell l" style="width:<?php echo $width1;?>">Si</div>
	<div class="cell l" style="width:<?php echo $width2;?>">Details</div>
	<div class="cell l" style="width:<?php echo $width4;?>">Actions</div>
</div>


<div class="grid_content_cont l">
	<?php foreach($aData AS $iKey=>$oItem):?>
	<div class="grid_row l <?php echo 'row'.$iKey;?>">
		<div class="cell l" style="width:<?php echo $width1;?>"><?php echo $iKey + $iOffset + 1;?></div>
		<div class="cell l event_details" style="width:<?php echo $width2;?>">
		
			<div><h4><?php echo $oItem->title;?></h4></div>
			<div><?php echo $oItem->description;?></div>

		</div>
		<div class="cell r" style="width:<?php echo $width4;?>">
			<div class="action" title="Edit">
				<a href="<?php echo c('base_url');?>resource/edit_type/<?php echo $oItem->id;?>">Edit</a>
			</div>
			<div class="action delete" title="Delete">
				<a href="javascript:void(0);" class="perm_delete" id="<?php echo $oItem->id;?>">Delete</a>
			</div>
		</div>
	</div>
	<?php //p('test ');exit;?>
	<?php endforeach;?>
	<?php //p('test 2');exit;?>
	<?php echo $sPagination;?>
	
</div>

<?php else:?>
<div class="fw tac m-t-10 l">There are no resources</div>
<?php endif;?>	