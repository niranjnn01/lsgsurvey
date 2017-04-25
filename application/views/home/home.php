
<?php showMessage();?>

<div class="row">
	<div class="col-md-9">
		<h4>കടൽത്തീരം വാർഡ്</h4>
		<p>സീ വ്യൂ വാർഡിനെ സംപൂർണ പങ്കാളിത്ത ജനാധിപത്യ വാർഡാക്കി മാറ്റുന്നതിനുവേണ്ടിയുള്ള വിവരശേഖരണ യജ്ഞം</p>

		<div class="row">
			<div class="col-md-12">

				<img src="<?php echo $c_static_image_url;?>ward_map.jpg" width="600" height="350" />
			</div>
		</div>
 
	</div>
	<div class="col-md-3">

		<div class="row">
			<div class="col-md-12">
				<h4></h4>
			</div>
		</div>
<?php $aCouncillorData = array(
	'name' => 'KAROLINE PETER',
	'url' => 'http://www.alappuzhamunicipality.in/council&cid=2015018504501',
	'party_name' => 'Indian National Congress',
	'img_filename' => 'ward_member_45.jpg'

);?>

<img 	src="<?php echo $c_base_url, 'uploads/councillor_photos/', $aCouncillorData['img_filename'];?>"
			class="thumbnail"
			style="height: 250px;margin: 10px auto;"
			/>
			<div class="text-center">
				<h6>
					<b>Councillor : <a href="<?php echo $aCouncillorData['url'];?>"  target="_blank"><?php echo $aCouncillorData['name'];?></a></b>
					</h6>
				<h6>
					<b>party : <?php echo $aCouncillorData['party_name'];?></b>
				</h6>
			</div>

		<table class="table">
			<tr>
				<td>
					<b>ജില്ല</b>
				</td>
				<td>
					ആലപ്പുഴ
				</td>
			</tr>
			<tr>
				<td>
					<b>മുനിസിപ്പാലിറ്റി</b>
				</td>
				<td>
					<a href='http://www.alappuzhamunicipality.in' target="_blank">ആലപ്പുഴ</a>
				</td>
			</tr>
			<tr>
				<td>
					<b>വാർഡ് നമ്പർ</b>
				</td>
				<td>45</td>
			</tr>
		</table>



	</div>
</div>
