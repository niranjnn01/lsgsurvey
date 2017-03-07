
<?php showMessage();?>

<h4>
	Meeting of <?php echo $oMeeting->constitutional_entity_title, ' ', $oMeeting->constitutional_entity_type_title;?>
	(<?php echo $oMeeting->constitutional_entity_district_title;?> District)
</h4>
<div class="row">
	
	<div class="col-md-9">
		<h6>
			Contributors :
			<?php foreach($aContributors AS $oContributor):?>
				<?php /*?>
				<a href="<?php echo $c_base_url, '/profile/view/', $oContributor->account_no?>"><?php echo $oContributor->username?></a>
				<?php */?>
				<a href="#"><?php echo $oContributor->username?></a>
			<?php endforeach;?>
		</h6>
		
		<div class="row">
			<div class="col-md-12">
				<?php echo $oMeeting->description;?>
			</div>
		</div>
	</div>
	
	<div class="col-md-3">
	
	<div class="row">
		<div class="col-md-12 text-right">
		<h5>
			<b>Meeting held on : <?php echo date('jS F,Y', strtotime($oMeeting->meeting_date));?></b>
		</h5>
		</div>
	</div>
		
	<div class="row">
		<div class="col-md-12">
			<h5><b>Agenda</b></h5>
			<?php echo $sResources_agenda;?>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<h5><b>Attendance Sheets</b></h5>
			<?php echo $sResources_attendance_sheets;?>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<h5><b>Other Files</b></h5>
			<?php echo $sResources_other_files;?>
		</div>
	</div>
	
</div>
	
	
<div class="row">
	<div class="col-md-5">
		
	</div>
	<div class="col-md-4">
		
	</div>
	<div class="col-md-3">
		
		
		
	</div>
</div>