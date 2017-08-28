<?php showMessage();?>


<div class="row">
	<div class="col-md-3">
		Total of <?php echo $iTotal;?> Surveys
	</div>
	<div class="col-md-9 pull-right">

	</div>
</div>

<?php if($aData):?>
<table class="table table-condensed">

    <thead>
		<tr>
			<th>SI</th>
			<th>Created On</th>
			<th>Enumerator</th>
			<th>Actions</th>
		</tr>
    </thead>

    <tbody>
	<?php foreach($aData AS $iKey => $oItem):?>
    <tr>

	    <td>
				<?php echo $iKey + $iOffset + 1;?>
			</td>
			<td>
				<?php echo date('j M, Y', strtotime($oItem->created_on));?>
			</td>

			<td>
				<?php echo $oItem->full_name;?>
			</td>

		<td>

<?php /*?>
			<div>
				<a href="<?php echo c('base_url');?>survey_edit/<?php echo $oItem->id;?>">Edit</a>
			</div>
<?php */?>
      <div>
        <a href="<?php echo c('base_url');?>survey_result/view/<?php echo $oItem->id;?>">View Details</a>
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
<div class="col-md-10 pull-center">There are no Surveys</div>
<?php endif;?>
