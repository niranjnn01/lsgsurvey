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
			<th>Mobile number</th>
			<th>From</th>
			<th>To</th>
		</tr>
    </thead>
	
    <tbody>
	<?php foreach($aData AS $iKey => $oItem):?>
    <tr>

	    <td>
			<?php echo $iKey + $iOffset + 1;?>
		</td>
		<td>
			<div>
				<?php echo $oItem->mobile_number;?>
			</div>
			
		</td>
		
		<td>
			<?php echo date('', strtotime());?>
		</td>
		
		<td>
			<?php echo date('', strtotime());?>
		</td>
		
		
    </tr>
	<?php endforeach;?>
    </tbody>
</table>
<div class="row">
	<?php echo $sPagination;?>
</div>

<?php else:?>
<div class="col-md-10 pull-center">There are no items</div>
<?php endif;?>

