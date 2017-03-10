
<div class="row">
	<div class="col-md-2" style="font-size:11px;">


<form method="post">


		<div class="form-group">
			<input type="submit" name="submit" value="Click to search" class="btn btn-primary"/>
		</div>

		<h5><b>വീടിൻ്റെ ഉടമസ്ഥത</b></h5>
		<div class="radio">

			<label class="radio">
				<input type="radio" name="house_ownership_type" value="1"/> സ്വന്തം
			</label>
			<label class="radio">
				<input type="radio" name="house_ownership_type" value="2"/> വാടക
			</label>
		</div>

		<h5><b>സ്ഥലത്തിൻ്റെ ഉടമസ്ഥത</b></h5>
		<div class="radio">

			<label class="radio">
				<input type="radio" name="land_ownership_type" value="1"/> സ്വന്തം
			</label>
			<label class="radio">
				<input type="radio" name="land_ownership_type" value="2"/> പാട്ടം
			</label>
			<label class="radio">
				<input type="radio" name="land_ownership_type" value="3"/> പാരമ്പര്യമായി  കിട്ടിയത്
			</label>
		</div>

		<h5><b>വീടിന്റെ വിസ്തീർണം</b></h5>
		<div class="radio">
			<label class="radio">
				<input type="radio" name="house_area_range" value="1"/> 300 ച: അടി വരെ
			</label>
			<label class="radio">
				<input type="radio" name="house_area_range" value="2"/> 300 - 600 ച: അടി
			</label>
			<label class="radio">
				<input type="radio" name="house_area_range" value="3"/> 600 - 1500 ച: അടി
			</label>
			<label class="radio">
				<input type="radio" name="house_area_range" value="4"/> 2000 ച: അടിയ്ക്ക് മുകളിൽ
			</label>
		</div>

		<h5><b>വീട് നിൽക്കുന്ന സ്ഥലത്തിന്റെ വിസ്തീർണം</b></h5>
		<div class="radio">
			<label class="radio">
				<input type="radio" name="land_area_range" value="1"/> 3 സെന്റിൽ താഴ
			</label>
			<label class="radio">
				<input type="radio" name="land_area_range" value="2"/> 3 - 5 സെന്റ്
			</label>
			<label class="radio">
				<input type="radio" name="land_area_range" value="3"/> 5 - 10  സെന്റ്
			</label>
			<label class="radio">
				<input type="radio" name="land_area_range" value="4"/> 10 സെന്റിനു മുകളിൽ
			</label>
		</div>

		<h5><b>വീടിന്റെ തരം</b></h5>
		<div class="checkbox">
			<label class="checkbox">
				<input type="checkbox" name="house_type[]" value="1"/> കുടിൽ
			</label>
			<label class="checkbox">
				<input type="checkbox" name="house_type[]" value="2"/> ഓല
			</label>
			<label class="checkbox">
				<input type="checkbox" name="house_type[]" value="3"/> ഷീറ്റ്
			</label>
			<label class="checkbox">
				<input type="checkbox" name="house_type[]" value="4"/> ഓട്
			</label>
			<label class="checkbox">
				<input type="checkbox" name="house_type[]" value="5"/> കോൺക്രീറ്റ്
			</label>
			<label class="checkbox">
				<input type="checkbox" name="house_type[]" value="6"/> ആസ്ബറ്റോസ് ഷീറ്റ്
			</label>
			<label class="checkbox">
				<input type="checkbox" name="house_type[]" value="7"/> അലുമിനിയം
			</label>
			<label class="checkbox">
				<input type="checkbox" name="house_type[]" value="8"/> ടിൻ ഷീറ്റ്റ്
			</label>
		</div>


		<div class="form-group">
			<input type="submit" name="submit" value="Click to search" class="btn btn-primary"/>
		</div>

</form>


	</div>

	<div class="col-md-10">

		<div class="row">
			<div class="col-md-12">
				<h5 id="search_message">Submit the search form to see results.<h5>
			</div>
		</div>
		<div id="result_container">
		</div>
	</div>
</div>
