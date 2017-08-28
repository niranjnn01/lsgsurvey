<?php showMessage();?>


<div class="row">
	<div class="col-md-3">
		Total of <?php echo $iTotal;?> Surveys in progress
	</div>
	<div class="col-md-9 pull-right">

	</div>
</div>

<?php if($aData):?>
<table class="table table-condensed">

    <thead>
		<tr>
			<th>SI</th>
			<th>Details</th>
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
				<div>
					<b>Temporary ID :</b> <?php echo $oItem->temporary_survey_id;?>
				</div>
				<div>
					<b>Created On :</b> <?php echo date('j M, Y', strtotime($oItem->created_on));?>
				</div>

			</td>

			<td>
				<?php echo $oItem->full_name;?>
			</td>

		<td>

<?php /*?>
			<div>
				<a href="<?php echo c('base_url');?>survey_edit/<?php echo $oItem->id;?>">Resume</a>
			</div>
<?php */?>

		</td>

    </tr>
	<?php endforeach;?>
    </tbody>
</table>
<div class="row">
	<?php echo $sPagination;?>
</div>

<?php else:?>
<div class="col-md-10 pull-center">There are no Surveys in progress</div>
<?php endif;?>
