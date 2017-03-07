<h3><?php echo $page_heading;?></h3>
<?php showMessage();?>

<?php echo form_open_multipart('event/create', array('id' => 'eventCreateForm'))?>

<div class="row">
<div class="col-md-8">


	<div class="form-group">
		<label for="title">Title</label>
		<input type="text" name="title" class="form-control"
			   value="<?php echo set_value('title') ? set_value('title') : '';?>"/>
	</div>

	<div class="form-group">
		<label for="event_type">Event Type</label>
		<?php $iDefault = set_value('event_type') ? set_value('event_type') : 0;?>
		<?php echo form_dropdown('event_type', $aEventTypes, $iDefault, ' class="form-control"');?>
	</div>

	<div class="form-group">
		<label for="admission_type">Admission Type</label>
			<?php $iDefault = set_value('admission_type') ? set_value('admission_type') : 0;?>
			<?php echo form_dropdown('admission_type', $aEventAdmissionTypesTitle, $iDefault, ' class="form-control"');?>
	</div>

	<div class="form-group">
		<label for="admission_comment">Admission Comment</label>
		<textarea name="admission_comment" class="form-control"><?php echo set_value('admission_comment') ? set_value('admission_comment') : '';?></textarea>
	</div>

	<div class="form-group">
		<label for="excerpt">Excerpt</label>
		<textarea id="excerpt" name="excerpt" class="form-control"><?php echo set_value('excerpt') ? set_value('excerpt') : '';?></textarea>
		<div class="help-block"><span id="charsLeft"></span> charaters left</div>
	</div>

	<div class="form-group">
		<label for="description">Description</label>
		<textarea name="description" class="form-control text-editor"><?php echo set_value('description') ? set_value('description') : '';?></textarea>

	</div>



	<div class="form-group">
		<label for="venue">Venue</label>
		<input type="text" name="venue"  class="form-control" value="<?php echo set_value('venue') ? set_value('venue') : '';?>"/>
	</div>

	<div class="form-group">
		<div class="col-xs-6">
			<label for="starting_on">Starting On</label>
			<input type="text" name="starting_on" value="<?php echo set_value('starting_on')? set_value('starting_on') : ''?>" class="event_datepicker"/>

		</div>
		<div class="col-xs-3">
			<?php echo form_dropdown('starting_time', $aTimeNumbers, '', 'class="form-control"');?>
		</div>
		<div class="col-xs-3">
			<?php echo form_dropdown('starting_time_period', $aAMPM, 'am', ' class="form-control" id="starting_on_period"');?>
		</div>
	</div>

	<div class="form-group clearfix">
		<div class="col-xs-6">
			<label for="ending_on">Ending On</label>
			<input type="text" name="ending_on" value="<?php echo set_value('ending_on')? set_value('ending_on') : ''?>" class="event_datepicker"/>
		</div>
		<div class="col-xs-3">
			<?php echo form_dropdown('ending_time', $aTimeNumbers, '', 'class="form-control"');?>
		</div>
		<div class="col-xs-3">
			<?php echo form_dropdown('ending_time_period', $aAMPM, 'am', ' class="form-control" id="ending_on_period"');?>
		</div>
	</div>



    <input type="hidden" name="event_date_range_from_year" id="event_date_range_from_year" value="<?php echo $sEventDateRangeFrom_Year;?>"/>
    <input type="hidden" name="event_date_range_to_year" id="event_date_range_to_year" value="<?php echo $sEventDateRangeTo_Year;?>"/>
    <input type="hidden" name="excerpt_character_limit" id="excerpt_character_limit" value="<?php echo $iExcerptCharacterLimit;?>"/>


	<div class="form-group">&nbsp;</div>
	<div class="form-group">
			<input type="submit" name="create" value="Create Event" class="btn btn-default btn btn-default-primary"/>
			<?php echo backButton('', 'Back');?>
	</div>

</div>
</div>
<?php echo form_close(); ?>
