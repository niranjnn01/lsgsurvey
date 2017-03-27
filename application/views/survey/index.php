

<div class="row">
	<div class="col-md-8 col-md-offset-2">

		<!--<h5><b>District:</b> Alappuzha</h5>
		<h5><b>Municpality:</b> Alappuzha </h5>
		<h5><b>Ward No: 45 (Sea View)</b></h5>-->
        <h5><b>ജില്ല :</b> ആലപ്പുഴ </h5>
		<h5><b>മുനിസിപ്പാലിറ്റി :</b> ആലപ്പുഴ</h5>
		<h5><b>വാർഡ് നമ്പർ :</b> 45 (കടൽത്തീരം)</h5>
        <h3 id="question-group-id"></h3>
		<div id="survey_container">
			<div class="row">
				<div class="col-md-12">

					<div id="question_container" style="min-height:200px;border:3px solid #C8C8C8;padding:10px 30px;margin-bottom:10px;">


				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<?php /*?>
					<a href="#" id="previous_btn" class="btn btn-danger">Previous</a>
					<?php */?>
				</div>

				<div class="col-md-4">
					<?php /*?>
					<a href="#" id="skip_btn" class="btn btn-warning">Skip</a>
					<?php */?>
				</div>

				<div class="col-md-4">

					<a href="#" id="next_btn" class="btn btn-primary">Next Question</a>
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
		

	</div>
</div>
