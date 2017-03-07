
<?php showMessage();?>

<?php echo form_open('meeting/create_ward_meeting', 'id = "createWardMeeting"')?>

	<div class="col-md-6">
		
		<div class="form-group">
		
			<div>
				<b>Choose your ward</b>
			</div>
			<?php foreach($aUserWards_key_values AS $iKey=>$sValue):?>
				<label class="radio-inline">
					<input type="radio" name="ward" value="<?php echo $iKey;?>"/><?php echo $sValue;?>
				</label>
			<?php endforeach;?>
			
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-6">
					<label for="title">Title</label>
					<input type="text" class="form-control" name="title"
						   value="<?php echo set_value('title')? set_value('title') : '';?>"/>
				</div>	
				<div class="col-md-6">
					<label for="meeting_date">Meeting Date</label>
					<input type="text" class="form-control datepicker" name="meeting_date"
						   value="<?php echo set_value('meeting_date')? set_value('meeting_date') : '';?>"/>
				</div>	
			</div>		
		</div>
		
		
		<div class="form-group">
			<label for="description">Description</label>
			<textarea name="description" class="form-control text-editor" cols="7"><?php echo set_value('description')? set_value('description') : '';?></textarea>
		</div>
		
		<div class="form-group">&nbsp;</div>
		<div class="form-group">
				<input type="submit" name="create" value="Create" class="btn btn-primary"/>
				<?php echo backButton('', 'Back');?>
		</div>		
	</div>
	
	<div class="col-md-6">

		<fieldset>
			<legend>
				Resources
				
				<a class="fancybox btn btn-primary pull-right" href="#" id="include_resource">
					<i class="fa fa-plus"></i> Add Files
				</a>
			</legend>
		
			<div class="form-group">
				
				<div id="selected_resources_cnt" style="min-height:60px;background-color:#FFF;" class="thumbnail c">
					
				</div>
				
				<input type="hidden" name="selected_resources" id="selected_resources" value=""/>
			</div>
		</fieldset>
		
	</div>
<?php echo form_close(); ?>

