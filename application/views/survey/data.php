
<h4>Survey Data</h4>
<div class="row">

	<div class="col-md-4">

		<h5><b>General Data</b></h5>
		<table class="table">

			<tr>
				<td>Survey ID :</td>
				<td><?php echo $oSurveyData->id;?></td>
			</tr>
			<tr>
				<td>Enumerator ID :</td>
				<td><?php echo $oSurveyData->enumerator_account_no;?></td>
			</tr>
			<tr>
				<td>District</td>
				<td>Alappuzha</td>
			</tr>
			<tr>
				<td>Municpality</td>
				<td>Chengnnur</td>
			</tr>
			<tr>
				<td>Ward No:</td>
				<td><?php echo $oHouseData->ward_id;?></td>
			</tr>
		</table>


		<h5><b>Personal Details</b></h5>
		<table class="table">

			<tr>
				<td>Name</td>
				<td><?php echo $oUserPersonalData->name;?></td>
			</tr>
		</table>
	</div>

	<div class="col-md-4">

		<h5><b>House Data</b></h5>
		<table class="table">

			<tr>
				<td>House No</td>
				<td><?php echo $oHouseData->house_number;?></td>
			</tr>
			<tr>
				<td>Address</td>
				<td><?php echo $oHouseData->address;?></td>
			</tr>
			<tr>
				<td>residence Type</td>
				<td><?php echo $aResidenceTypes[$oUserPersonalData->residence_type_id]?></td>
			</tr>

			<tr>
				<td>Land Ownership</td>
				<td><?php echo $oLandData->sLandOwnershipType;?></td>
			</tr>

			<tr>
				<td>Land Area</td>
				<td><?php echo $aLandAreaRange[$oLandData->area_range];?></td>
			</tr>

			<tr>
				<td>House Area</td>
				<td><?php echo $aHouseAreaRange[$oHouseData->house_area_range_id];?></td>
			</tr>

			<tr>
				<td>House Type</td>
				<td><?php echo $aHouseAreaRange[$oHouseData->house_area_range_id];?></td>
			</tr>

		</table>
	</div>



		<div class="col-md-4">

		</div>

</div>