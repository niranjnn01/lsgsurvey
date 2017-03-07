<?php showMessage();?>
<h3><?php echo @$page_heading;?></h3>












<div class="row">
	<div class="col-md-3">
		Total of <?php echo $iTotal;?> categories
		
	</div>
	<div class="col-md-9">
		Showing Categories under : <?php echo $sCategoryTreeDropDown;?>
	</div>
</div>
<?php if($aData):?>
<table class="table table-condensed">

    <thead>
		<tr>
			<th>SI</th>
			<th>Details</th>
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
			<div><h4><?php echo $oItem->title;?></h4></div>
			<div><?php echo $oItem->description;?></div>
		</td>
		<td>
			<div>
				<a href="<?php echo c('base_url');?>resource/edit_category/<?php echo $oItem->id;?>">Edit</a>
			</div>
			<div>
				<a href="javascript:void(0);" class="perm_delete" id="<?php echo $oItem->id;?>">Delete</a>
			</div>
		</td>
		
    </tr>
	<?php endforeach;?>
    </tbody>
</table>
<div class="row">
	<?php echo $sPagination;?>
</div>

<?php else:?>
<div class="col-md-10 pull-center">There are no categories</div>
<?php endif;?>


















