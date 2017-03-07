
<div class="row">
	<div class="col-md-6 col-md-offset-3">

		<?php showMessage();?>
		
		<?php echo form_open_multipart('ward/choose', array('id' => 'loginForm'))?>
		
		<div class="form-group">
			<label for="district">District</label>
			<?php echo form_dropdown('district', $aDistricts, 0, 'class="form-control" id="district"');?>
			
		</div>
		<div class="form-group">
			<label for="wards">Ward</label>
			<?php $aWards = array(0 => 'choose a district');?>
			<?php //$aWards = array();?>
			<?php echo form_dropdown('ward', $aWards, 0, 'class="form-control" id="ward_id"');?>
		</div>
		
		
		
		<div class="form-group">
			
			<input type="submit" name="submit" class="btn btn-default pull-right" id="btn-default" value="Submit"/>
			
		</div>
		<?php echo form_close(); ?>

	</div>
</div>
