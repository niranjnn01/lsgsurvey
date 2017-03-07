<?php showMessage();?>

<?php /*?>
<table class="table borderless">
	<tr>
		<td class="col-xs-3">
            Constitutional Entity Type : <?php echo form_dropdown('constitutional_entity_type', $aConstitutionalEntityTypesDropDown, $iConstitutionalEntityType, 'class="form-control"  id="f_constitutional_entity_type"');?>
		</td>
		<td class="col-xs-3">
            Constitutional Level : <?php echo form_dropdown('constitutional_level', $aConstitutionalLevelsDropDown, $iConstitutionalLevel, 'class="form-control"  id="f_constitutional_level"');?>
		</td>
		<td class="col-xs-3">
            &nbsp;
            <a href="#" id="search" class="btn btn-primary">Search</a>
		</td>
    </tr>
</table>
<?php */?>


<div class="row">
	<div class="col-md-12">
		
		
	</div>
</div>


<div class="row">
	<div class="col-md-3">
		Total of <?php echo $iTotal;?> Tasks
	</div>
	<div class="col-md-9 pull-right">
		
	</div>
</div>



<?php if($aMeetings):?>
<table class="table table-condensed">

    <thead>
		<tr>
			<th>SI</th>
			<th>Details</th>
			<th>Constitutional Level</th>
			<th>Name</th>
			<th>type</th>
			<th>District</th>
			<th>Actions</th>
		</tr>
    </thead>
	
    <tbody>
	<?php foreach($aMeetings AS $iKey => $oItem):?>
    <tr>

	    <td>
			<?php echo $iKey + $iOffset + 1;?>
		</td>
		<td>
			<div>
					<a href="<?php echo $c_base_url, 'meeting/view/', $oItem->id;?>"><?php echo $oItem->title;?></a>
			</div>
			
		</td>
		
		<td>
			<?php //echo $aConstitutionalLevels_IdTitlePairs[$oItem->constitutional_entity_level];?>
		</td>
		
		<td>
			<?php echo $oItem->constitutional_entity_title;?>
			
		</td>
		<td>
			<?php echo $oItem->constitutional_entity_type_title;?>
			
		</td>
		<td>
			<?php echo $oItem->constitutional_entity_district_title;?>
			
		</td>
		
			
		<td>
			<div>
				<?php /*?>
				<a href="<?php echo c('base_url');?>task/edit/<?php echo $oItem->id;?>">Edit</a>
				<?php */?>
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
<div class="col-md-10 pull-center">There are no tasks</div>
<?php endif;?>

