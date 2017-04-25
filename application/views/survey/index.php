

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
				</div>
			</div>

      <div class="row">
      	<div class="col-md-12">
              <h3 id="question-group-id" class="pull-left"></h3>
              <h4 id="question-status" class="pull-right"></h4>
          </div>
      </div>
		<div id="survey_container" class="clearfix">
			<div class="row">
				<div class="col-md-12">
						<form id="current_form" action="#">
						<div id="question_container"
									style="min-height:200px;border:3px solid #C8C8C8;padding:10px 30px;margin-bottom:10px;"
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
        <script>
					var question_groups = <?php echo $question_groups;?>;

					/*window.onbeforeunload = function() {
						if(check_reaload){
					  		return "Data will be lost if you leave the page, are you sure?";
						}else{
							return "";
						}
					};*/


					var leave_message = 'You sure you want to leave?'
					function goodbye(e)
					{
						if(dont_confirm_leave!==1)
						{
							if(!e) e = window.event;
							//e.cancelBubble is supported by IE - this will kill the bubbling process.
							e.cancelBubble = true;
							e.returnValue = leave_message;
							//e.stopPropagation works in Firefox.
							if (e.stopPropagation)
							{
								e.stopPropagation();
								e.preventDefault();
							}

							//return works for Chrome and Safari
							return leave_message;
						}
					}
				window.onbeforeunload=goodbye;

        	</script>
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
