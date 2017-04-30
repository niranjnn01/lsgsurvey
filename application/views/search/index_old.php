
<div class="row">
	<div class="col-md-4" style="font-size:10px;">


<form method="post">


		<div class="form-group">
			<input type="submit" name="submit" value="Click to search" class="btn btn-primary"/>
			<span style="font-size:10px;">(വ്യക്തിപരമായ വിവരങ്ങൾ ഗ്രഹനാഥൻ / ഗൃഹനാഥയുമായി ബന്ധിപ്പിച്ചിരിക്കുന്നു )</span>
		</div>

		<?php $aQuestionUids = array(
																	19, 20, 22, 24,
																	25, 26, 29, 32,

 																);?>
		<?php foreach($aQuestionUids AS $iQuestionUid):?>

		<?php
			$aQuestionDetails = $this->question_model->getQuestionDetailsByUID($iQuestionUid);
			echo $this->question_model->constructFormRow_forSearch($aQuestionDetails);
		?>

		<?php endforeach;?>

		<h5><b>സംവരണം</b></h5>
		<div class="radio">
			<?php
				$aReservationCategories = array(
					0 => 'ഇല്ലാ',
					1 => 'പട്ടികജാതി/വർഗം',
					2 => 'പിന്നോക്ക സമുദായം'
				);
			?>
			<?php foreach($aReservationCategories AS $iValue => $sTitle):?>
				<label class="radio">
					<input type="radio" name="reservation_category" value="<?php echo $iValue;?>"/> <?php echo $sTitle;?>
				</label>
			<?php endforeach;?>

		</div>

		<h5><b>മൊബൈൽ നമ്പർ</b></h5>
		<div class="form-group">
				<input type="text" name="mobile_number" value="" class="form-control">
		</div>




		<div class="form-group">
			<input type="submit" name="submit" value="Click to search" class="btn btn-primary"/>
		</div>

</form>


	</div>

	<div class="col-md-4">



		<?php
					$aQuestionUids = array(

																	33, 34, 35, 36,
																	37, 38, 39, 43,


																);
		?>


		<?php foreach($aQuestionUids AS $iQuestionUid):?>

		<?php
			$aQuestionDetails = $this->question_model->getQuestionDetailsByUID($iQuestionUid);
			echo $this->question_model->constructFormRow_forSearch($aQuestionDetails);
		?>

		<?php endforeach;?>
	</div>


	<div class="col-md-4">

		<?php
					$aQuestionUids = array(
																44, 45, 47, 48,
																49, 50, 51, 51,
																53, 54, 55, 56,
																57, 58, 60, 61,
																62, 63, 64, 65,
																66, 67, 68, 69,
																70, 71
																);

		?>


		<?php foreach($aQuestionUids AS $iQuestionUid):?>

		<?php
			$aQuestionDetails = $this->question_model->getQuestionDetailsByUID($iQuestionUid);
			echo $this->question_model->constructFormRow_forSearch($aQuestionDetails);
		?>

		<?php endforeach;?>
	</div>

</div>






<?php // -------- // ?>






<div class="row">
	<div class="col-md-12">
		<h5 id="search_message">Submit the search form to see results.<h5>
	</div>
</div>

<div class="row">
	<div class="col-md-12">

		<pre>
			<div id="query_cnt"></div>
		</pre>

	</div>
</div>

<div id="result_container">
</div>
