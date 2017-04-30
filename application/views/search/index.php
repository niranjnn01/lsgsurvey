
<div class="row">
	<div class="col-md-12" style="font-size:10px;">
		<span style="font-size:10px;">* (വ്യക്തിപരമായ വിവരങ്ങൾ ഗ്രഹനാഥൻ / ഗൃഹനാഥയുമായി ബന്ധിപ്പിച്ചിരിക്കുന്നു )</span>
	</div>
</div>

<br/>
<form method="post" id="searchForm">
<div class="row">
	<input type="submit" name="submit" value="Click to search" class="btn btn-primary col-md-12"/>
</div>


<div class="row" style="font-size:10px;">

		<?php $iNumColumns = 6;?>
		<?php $aQuestionsUIDs = array(
							19, 20, 21, 22, 23, 24,
							25, 26, 29, 32,
							33, 34, 35, 36,
							37, 38, 39, 43,
							44, 45, 47, 48,
							49, 50, 51,
							53, 54, 55, 56,
							57, 58,
							//60,
							61,
							62, 63, 64, 65,
							66, 67, 68, 69,
							70, 71
						);
		?>

		<?php
			$iQuestionCount = count($aQuestionsUIDs);
			$iOffset = 0;
			$iLength = ceil($iQuestionCount / $iNumColumns);
		?>
		<?php for($i = 0; $i < $iNumColumns; ++$i):?>

			<div class="col-md-2">

				<?php
							//$aQuestionUids = array_chunk($aQuestionsUIDs, ($iQuestionCount / $iNumColumns));



							$aQuestionUids = array_slice($aQuestionsUIDs, $iOffset, $iLength);
							$iOffset += $iLength;
							//echo $iOffset, ' - ';
							//p($iLength);
							//p($aQuestionUids);exit;
							//p($aQuestionUids);exit;
				?>


				<?php foreach($aQuestionUids AS $iQuestionUid):?>

					<?php

						if($aQuestionDetails = $this->question_model->getQuestionDetailsByUID($iQuestionUid)) {
							echo $this->question_model->constructFormRow_forSearch($aQuestionDetails);
							//echo $iQuestionUid;
						} else {
							echo 'Empty question';
						}

					?>

				<?php endforeach;?>

				<?php if($i == 1):?>

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

				<?php endif;?>



			</div>


		<?php endfor;?>

</div>

<div class="row">
	<input type="submit" name="submit" value="Click to search" class="btn btn-primary col-md-12"/>
</div>

</form>


<?php /*?>

		<div class="form-group">
			<input type="submit" name="submit" value="Click to search" class="btn btn-primary"/>
		</div>

<?php */?>



<?php // -------- // ?>






<div class="row">
	<div class="col-md-12">
		<h5 id="search_message">Submit the search form to see results.<h5>
	</div>
</div>

<div class="row">
	<div class="col-md-12">

		<?php if($bTesting):?>
				<pre>
					<div id="query_cnt"></div>
				</pre>
		<?php endif;?>

	</div>
</div>

<div id="result_container">
</div>
