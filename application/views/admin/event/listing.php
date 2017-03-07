<div class="row">
	<div class="col-md-11">

<?php showMessage();?>
<h3><?php echo @$page_heading;?></h3>


						
<div class="row">
	<div class="col-md-3">
		Total of <?php echo $iTotal;?> events
	</div>
	<div class="col-md-9">
		Event Status : <?php echo form_dropdown('status', $aEventStatus, $iStatus, 'class="event_filter"  id="f_status"');?>
	</div>
		
</div>

<?php if($aData):?>
<table class="table table-condensed">

    <thead>
		<tr>
			<th>SI</th>
			<th>Details</th>
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
			Timing : 
				From <?php echo date('j M Y (g A)', strtotime($oItem->starting_on));?>, 
				To <?php echo date('j M Y (g A)', strtotime($oItem->ending_on));?>
			<div>Event Type : <?php echo $aEventTypesFlipped[$oItem->type];?></div>
			<div>Admission Type : <?php echo $aEventAdmissionTypesTitle[$oItem->admission_type];?></div>
			<?php if($oItem->admission_comment):?>
				<div>[ <i><?php echo substr($oItem->admission_comment, 0, 175);?></i> ]</div>
			<?php endif;?>
			<div><?php echo $oItem->excerpt;?></div>
		</td>
		<td>
			<?php echo $aEventStatus[$oItem->status];?>
		</td>
		<td>
			<div><a href="<?php echo c('base_url');?>event/edit/<?php echo $oItem->id;?>">Edit</a></div>
			<div><a href="javascript:void(0);" class="perm_delete" id="<?php echo $oItem->id;?>">Delete</a></div>
		</td>
		
    </tr>
	<?php endforeach;?>
    </tbody>
</table>
<div class="row">
	<?php echo $sPagination;?>
</div>

<?php else:?>
<div class="">There are no events</div>
<?php endif;?>

    </div>
</div>



