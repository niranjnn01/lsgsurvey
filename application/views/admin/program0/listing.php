<?php showMessage();?>
<h3><?php echo @$page_heading;?></h3>





<div class="row">
	<div class="col-md-3">
		Total of <?php echo $iTotal;?> programs
	</div>
	<div class="col-md-9">
        Program Status : <?php echo form_dropdown('status', $aProgramStatusTitle, $iStatus, 'class="status_filter"  id="f_status"');?>
	</div>
</div>
<?php if($aData):?>
<table class="table table-condensed">

    <thead>
		<tr>
			<th>SI</th>
			<th>Details</th>
			<th>Topic</th>
			<th>Priority</th>
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
            
			<div><h5><a href="<?php echo $c_base_url, 'program/view/', $oItem->seo_name;?>"><?php echo $oItem->title;?></a></h5></div>
			<div>Last Updated On: <?php echo date('d M Y', strtotime($oItem->updated_on));?></div>
			<div>Program Director : <?php echo $oItem->program_director_name;?></div>
			<div><a href="<?php echo $c_base_url, 'campaign/listing/0/', $oItem->uid;?>"><?php echo $oItem->num_campaigns;?> campaings</a> under this progam</div>
            
		</td>
		<td>
			<?php echo $oItem->topic_title;?>
		</td>
		<td>
			<?php echo $oItem->priority;?>
		</td>
		<td>
			<?php echo $aProgramStatusTitle[$oItem->status];?>
		</td>
		<td>
			<div><a href="<?php echo c('base_url');?>program/edit/<?php echo $oItem->uid;?>">Edit</a></div>
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
<div class="col-md-10 pull-center">There are no programs</div>
<?php endif;?>