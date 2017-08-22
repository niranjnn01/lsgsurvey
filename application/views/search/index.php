
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


<div class="row">

	<div class="col-md-12" style="font-size:10px;">
		<?php echo $sSearchTemplate;?>
	</div>

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
