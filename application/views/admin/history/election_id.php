<?php showMessage();?>



<div class="row">
	<div class="col-md-12">
		
		
	</div>
</div>


<div class="row">
	<div class="col-md-3">
		Total of <?php echo $iTotal;?> Entries
	</div>
	<div class="col-md-9 pull-right">
		
	</div>
</div>



<?php if($aData):?>
<table class="table table-condensed">

    <thead>
		<tr>
			<th>SI</th>
			<th>Election Id</th>
			<th>From</th>
			<th>To</th>
		</tr>
    </thead>
	
    <tbody>
	<?php for($i=0; $i < count($aData); ++$i):?>
	<?php
		$iKey = $i;
		$oItem = $aData[$i];
	?>
	<?php //foreach($aData AS $iKey => $oItem):?>
    <tr>

	    <td>
			<?php echo $iKey + $iOffset + 1;?>
		</td>
		<td>
			<div>
				<?php echo $oItem->election_id;?>
			</div>
			
		</td>
		
		<td>
			<?php echo date('M j, Y h:i a', strtotime($oItem->created_on));?>
		</td>
		
		<td>
			<?php if($i != 0):?>
				<?php $oPreviousItem = $aData[($i-1)]?>
				<?php echo date('M j, Y h:i a', strtotime($oPreviousItem->created_on));?>
			<?php else:?>
			Now
			<?php endif;?>
			
		</td>
		
		
    </tr>
	<?php endfor;?>
    </tbody>
</table>
<div class="row">
	<?php echo $sPagination;?>
</div>

<?php else:?>
<div class="col-md-10 pull-center">There are no items</div>
<?php endif;?>

