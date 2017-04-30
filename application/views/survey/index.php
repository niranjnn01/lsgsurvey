

<div class="row">
	<div class="col-md-10 col-md-offset-1">
			<div class="row">
				<div class="col-md-6">
					<h5><b>ജില്ല :</b> ആലപ്പുഴ </h5>
					<h5><b>മുനിസിപ്പാലിറ്റി :</b> ആലപ്പുഴ</h5>
					<h5><b>വാർഡ് നമ്പർ :</b> 45 (കടൽത്തീരം)</h5>
				</div>
				<div class="col-md-6 text-right">
					<h5>
						Survey ID : <span id="survey_no_display_counter"></span>
					</h5>
					<br/>
					<a href="#" class="btn btn-danger" id="cancel_survey">Cancel Survey</a>

				</div>
			</div>

      <div class="row">
				<div class="col-md-12">
					<h3 id="question-group-id" class="pull-left"></h3>
					<h4 id="question-status" class="pull-right"></h4>
        </div>
      </div>

		<div id="survey_container" class="clearfix" style="border:3px solid #C8C8C8;padding:10px 30px;">
			<div class="row">
				<div class="col-md-1">

					<?php /* this can act as the space for control panel */?>
					<div id="add_button_cnt"></div>

				</div>
				<div class="col-md-11">
						<form id="current_form" action="#">
						<div id="question_container"
									style="min-height:200px;margin-bottom:10px;"
									></div>
						</form>
				</div>

				<div class="row">
	      	<div class="col-md-12">
	            <div class="col-md-4">
	           			<?php /*?>
	                <button id="previous_btn" class="btn btn-primary">Previous Question</button>
									<?php */?>
	            </div>

	            <div class="col-md-4">
	                <?php /*?>
	                <a href="#" id="skip_btn" class="btn btn-warning">Skip</a>
	                <?php */?>
	            </div>

	            <div class="col-md-4">
	                <button id="next_btn" class="btn btn-primary pull-right">Next Question</button>
	            </div>
					</div>
				</div>
			</div>

		<form>

			<input type="hidden" id="current_temporary_survey_status" value="<?php echo $iSurveyStatus;?>" />
			<input type="hidden" id="current_temporary_survey_number" value="<?php echo $iCurrentTemporarySurveyNumber;?>" />
			<input type="hidden" id="current_temporary_survey_last_procesed_question" value="<?php echo $iLastProcessedQuestion;?>" />
			<input type="hidden" id="current_temporary_survey_is_last_question" value="<?php echo $bIsLastQuestion ? 1 : 0;?>" />

		</form>

	</div>
</div>
<div id="overlay">
    <span>Please wait...<img src="<?php echo base_url();?>/asset/img/spinner.gif"/></span>
</div>

<style >
.repeating-row {
  margin:auto;display:inline-block;padding:10px 5px;
}
.repeating-row.odd-row{background-color:#e7e7e7;}
label.small{
	font-size: 12px;
	font-weight: normal;
}
.repeating-row .counter{
background-color:#bcb8b8;
padding:3px;
display: inline-block;
}


</style>
