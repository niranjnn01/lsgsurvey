
<h4>സർവ്വേ വിവരങ്ങൾ</h4>
<div class="row" style="font-size:11px;">

	<div class="col-md-4">

		<h5><b>സ്ഥലം</b></h5>
		<table class="table">
			<tr>
				<td>Survey ID :</td>
				<td><?php echo $oSurveyData->id;?></td>
			</tr>

			<tr>
				<td>വിവരശേഖരണം:</td>
				<td><?php echo $oSurveyData->enumerator_name;?></td>
			</tr>
			<tr>
				<td>ജില്ല:</td>
				<td>ആലപ്പുഴ</td>
			</tr>
			<tr>
				<td>മുനിസിപ്പാലിറ്റി:</td>
				<td>ആലപ്പുഴ</td>
			</tr>
			<tr>
				<td>വാർഡ് നമ്പർ:</td>
				<td><?php echo $oHouseData->ward_id;?></td>
			</tr>
		</table>


		<h5><b>ഗൃഹനാഥൻ്റെ വ്യക്തിപരമായ വിവരങ്ങൾ</b></h5>
		<table class="table">

			<tr>
				<td class="col-xs-4">പേര്:</td>
				<td class="col-xs-8">
						<?php echo $oUserPersonalData->name;?>

						(<?php
							$aGenders = array(1=> 'സ്ത്രീ', 2=> 'പുരുഷൻ');
							echo $aGenders[$oUserPersonalData->gender];
						?>)

				</td>
			</tr>

      <tr>
				<td>ആധാർ നം :</td>
				<td><?php echo $oUserPersonalData->aadhar_id;?></td>
			</tr>

			<tr>
				<td>ഇലക്ഷൻ ഐ. ഡി.:</td>
				<td><?php echo $oUserPersonalData->election_id;?></td>
			</tr>

      <tr>
				<td><?php echo getQuestionText('belief_in_religion_id');?>:</td>
				<td><?php echo getQuestionAnswer('belief_in_religion_id', $oUserPersonalData->belief_in_religion_id);?></td>
			</tr>

      <tr>
				<td>സംവരണം:</td>
				<td>
					<?php
					$aReservations = array(
					0 => 'ഇല്ലാ',
					1 => 'പട്ടികജാതി/വർഗം',
					2 => 'പിന്നോക്ക സമുദായം');
					echo $aReservations[$oUserPersonalData->reservation];
					?>
				</td>
			</tr>
      <tr>
				<td>മൊബൈൽ ഫോൺ:</td>
				<td><?php echo $oUserPersonalData->mobile_number;?></td>
			</tr>
      <tr>
				<td>ഇമെയിൽ വിലാസം:</td>
				<td><?php echo $oUserPersonalData->email_id;?></td>
			</tr>
      <tr>
				<td>വാട്സപ്പ്‍ നമ്പർ:</td>
				<td><?php echo $oUserPersonalData->whatsapp_number;?></td>
			</tr>
      <tr>
				<td><?php echo getQuestionText('is_member_ayalkoottam');?>:</td>
				<td><?php echo getQuestionAnswer('is_member_ayalkoottam', $oUserPersonalData->is_member_ayalkoottam);?></td>
			</tr>
            <tr>
				<td><?php echo getQuestionText('is_office_bearer_ayalkoottam');?>:</td>
				<td><?php echo getQuestionAnswer('is_office_bearer_ayalkoottam', $oUserPersonalData->is_office_bearer_ayalkoottam);?></td>
			</tr>
            <tr>
				<td><?php echo getQuestionText('is_member_political_party');?>:</td>
				<td><?php echo getQuestionAnswer('is_member_political_party', $oUserPersonalData->is_member_political_party);?></td>
			</tr>
            <tr>
				<td><?php echo getQuestionText('is_memeber_socio_cultural_organization');?>:</td>
				<td><?php echo getQuestionAnswer('is_memeber_socio_cultural_organization', $oUserPersonalData->is_memeber_socio_cultural_organization);?></td>
			</tr>
            <tr>
				<td><?php echo getQuestionText('is_office_bearer_religious_organization');?>:</td>
				<td><?php echo getQuestionAnswer('is_office_bearer_religious_organization', $oUserPersonalData->is_office_bearer_religious_organization);?></td>
			</tr>
            <tr>
				<td><?php echo getQuestionText('is_member_library');?>:</td>
				<td><?php echo getQuestionAnswer('is_member_library', $oUserPersonalData->is_member_library);?></td>
			</tr>
            <tr>
				<td><?php echo getQuestionText('status');?>:</td>
				<td><?php echo getQuestionAnswer('status', $oUserPersonalData->is_ward_sabha_participant);?></td>
			</tr>
            <tr>
				<td><?php echo getQuestionText('reason');?>:</td>
				<td><?php echo getQuestionAnswer('reason', $oUserPersonalData->not_participation_reason);?></td>
			</tr>
            <tr>
				<td><?php echo getQuestionText('is_satisfied');?>:</td>
				<td><?php echo getQuestionAnswer('is_satisfied', $oUserPersonalData->is_participant_satisfied);?></td>
			</tr>
            <tr>
				<td><?php echo getQuestionText('have_suggestion');?>:</td>
				<td><?php echo getQuestionAnswer('have_suggestion', $oUserPersonalData->have_ward_sabha_suggestion);?></td>
			</tr>
            <tr>
				<td><?php echo getQuestionText('is_birth_same_ward');?>:</td>
				<td><?php echo getQuestionAnswer('is_birth_same_ward', $oUserPersonalData->is_birth_same_ward);?></td>
			</tr>
            <tr>
				<td><?php echo getQuestionText('ifnot_birth_place');?>:</td>
				<td><?php echo $oUserPersonalData->ifnot_birth_place;?></td>
			</tr>
            <tr>
				<td><?php echo getQuestionText('YEARS_OF_STAYING');?>:</td>
				<td><?php echo $oUserPersonalData->sFamilyResidenceHistory;?></td>
			</tr>

		</table>
	</div>

	<div class="col-md-4">

		<h5><b>വീട്</b></h5>
		<table class="table">

			<tr>
				<td>കെട്ടിട നമ്പർ:</td>
				<td><?php echo $oHouseData->house_number;?></td>
			</tr>
			<tr>
				<td>വിലാസം:</td>
				<td>
						<?php echo $oHouseData->address_house_name;?> <br/>
						<?php echo $oHouseData->address_street_name;?> <br/>
						<?php echo $oHouseData->address_pincode;?>
					</td>
			</tr>
            <tr>
				<td>ലാൻറ് ഫോൺ:</td>
				<td><?php echo $oUserPersonalData->landline_number;?></td>
			</tr>
            <tr>
				<td><?php echo getQuestionText('ration_card_no');?></td>
				<td><?php echo $oHouseData->ration_card_no;?></td>
			</tr>
            <tr>
				<td><?php echo getQuestionText('ration_card_type_id');?></td>
				<td><?php echo getQuestionAnswer('ration_card_type_id', $oHouseData->ration_card_type_id);?></td>
			</tr>

			<tr>
				<td>വീടിൻ്റെ ഉടമസ്ഥത:</td>
				<td><?php
				if($oHouseData->owner_id) {
					echo 'സ്വന്തം';
				} else {
					echo 'സ്വന്തം അല്ലാ';
				}?>
				</td>
			</tr>

			<tr>
				<td>വീട്ടിലെ താമസം:</td>
				<td>
					<?php echo $oHouseData->sResidenceType?></td>
			</tr>

			<tr>
				<td>സ്ഥലത്തിൻ്റെ ഉടമസ്ഥത</td>
				<td><?php echo $oLandData->sLandOwnershipType;?></td>
			</tr>

			<tr>
				<td>വീട് നിൽക്കുന്ന സ്ഥലത്തിന്റെ വിസ്തീർണം</td>
				<td><?php echo $aLandAreaRange[$oLandData->area_range];?></td>
			</tr>

			<tr>
				<td>വീടിന്റെ വിസ്തീർണം</td>
				<td><?php echo $aHouseAreaRange[$oHouseData->house_area_range_id];?></td>
			</tr>

			<tr>
				<td>വീടിന്റെ തരം</td>
				<td><?php echo $oHouseData->sHouseTypes;?></td>
			</tr>

            <tr>
				<td>നിലകളുടെ എണ്ണം(ഒന്നിൽ കൂടുതൽ ഉണ്ടെങ്കിൽ)</td>
				<td><?php echo getQuestionAnswer('num_rooms',$oHouseData->num_rooms);?></td>
			</tr>

			<tr>
				<td>വീടിൻ്റെ തറ</td>
				<td>
					<?php //p($oHouseData);?>
					<?php echo getQuestionAnswer('floor_type_id', $oHouseData->aFloorTypes);?>
				</td>
			</tr>

            <tr>
				<td>മുറികളുടെ എണ്ണം</td>
				<td><?php echo  getQuestionAnswer('num_rooms', $oHouseData->num_rooms);?></td>
			</tr>

            <tr>
				<td><?php echo getQuestionText('connection_type_to_septic_tank');?> കക്കൂസ്</td>
				<td><?php echo getQuestionAnswer('connection_type_to_septic_tank', $oHouseData->connection_type_to_septic_tank);?></td>
			</tr>

            <tr>
				<td>കക്കൂസിന്റെ എണ്ണം</td>
				<td><?php echo getQuestionAnswer('toilet_count', $oHouseData->toilet_count);?></td>
			</tr>

            <tr>
				<td>വാർഷിക കെട്ടിട നികുതി</td>
				<td><?php echo $oHouseData->tax_amount;?> രൂപ</td>
			</tr>
            <tr>
				<td><?php echo getQuestionText('largest_accessible_vehicle');?></td>
				<td><?php echo getQuestionAnswer('largest_accessible_vehicle', $oHouseData->largest_accessible_vehicle);?></td>
			</tr>
            <tr>
				<td><?php echo getQuestionText('road_type_id');?></td>
				<td><?php echo getQuestionAnswer('road_type_id', $oHouseData->sHomeRoadMap);?></td>
			</tr>

      <tr>
				<td><?php echo getQuestionText('public_utility_id');?></td>
				<td><?php echo getQuestionAnswer('public_utility_id', $oHouseData->aHomeUtilityServices);?>
                </td>
			</tr>
            <tr>
				<td><?php echo getQuestionText('house_water_source_id');?></td>
				<td><?php echo getQuestionAnswer('house_water_source_id', $oHouseData->aHomeWaterSources);?>
                </td>
			</tr>

			<tr>
				<td><?php echo getQuestionText('house_biodegradable_waste_management_solution_map', 'table_name');?></td>
				<td>
						<?php echo getQuestionAnswer('house_biodegradable_waste_management_solution_map',
																					$oHouseData->aHomeBioDegradableWasteManagementSolutions,
																					'table_name'
																				);?>
        </td>
			</tr>

			<tr>
				<td><?php echo getQuestionText('house_nonbiodegradable_waste_management_solution_map', 'table_name');?></td>
				<td>
						<?php echo getQuestionAnswer('house_nonbiodegradable_waste_management_solution_map',
																					$oHouseData->aHomeNonBioDegradableWasteManagementSolutions,
																					'table_name'
																				);?>
				</td>
			</tr>

			<tr>
				<td><?php echo getQuestionText('is_electrified');?></td>
				<td><?php echo getQuestionAnswer('is_electrified', $oHouseData->is_electrified);?></td>
			</tr>

			<tr>
				<td><?php echo getQuestionText('domestic_fuel_type_id');?></td>
				<td><?php echo getQuestionAnswer('domestic_fuel_type_id', $oFamily->aFamilyDomesticFuelTypes);?>
                </td>
			</tr>

		</table>
	</div>

    <div class="col-md-4">
    	<h5>&nbsp;</h5>
        <table class="table">
            <tr>
				<td>വാഹനങ്ങൾ</td>
				<td><?php echo getQuestionAnswer('vehicle_type_id', $oHouseData->aFamilyVehicleType);?></td>
			</tr>
            <tr>
                <td>വീട്ടുപകരണങ്ങൾ</td>
                <td><?php echo getQuestionAnswer('house_appliance_id', $oHouseData->aHomeAppliances);?></td>
            </tr>


            <tr>
                <td><?php echo getQuestionText('livestock_id');?></td>
                <td><?php echo getQuestionAnswer('livestock_id', array_keys($oFamily->aLiveStocks));?></td>
            </tr>

            <tr>
                <td><?php echo getQuestionText('pet_id');?></td>
                <td><?php echo getQuestionAnswer('pet_id', array_keys($oFamily->aPets));?></td>
            </tr>
						<?php if($oFamily->iHasDog):?>
							<tr>
									<td><?php echo getQuestionText('has_license');?></td>
									<td><?php echo getQuestionAnswer('has_license', $oFamily->iHasDogLicense);?></td>
							</tr>
						<?php endif;?>


            <tr>
                <td><?php echo getQuestionText('fruit_tree_id');?></td>
                <td><?php echo getQuestionAnswer('fruit_tree_id', $oLandData->aFruitTrees);?></td>
            </tr>

            <tr>
                <td><?php echo getQuestionText('cash_crop_id');?></td>
                <td><?php echo getQuestionAnswer('cash_crop_id', $oLandData->aCashCrops);?></td>
            </tr>

						<tr>
                <td><?php echo getQuestionText('bank_account_type_id');?></td>
                <td><?php echo getQuestionAnswer('bank_account_type_id', $oUserPersonalData->aBankAccountTypes);?></td>
            </tr>

						<tr>
                <td><?php echo getQuestionText('has_credit_or_debit_card');?></td>
                <td><?php echo getQuestionAnswer('has_credit_or_debit_card', $oUserPersonalData->has_credit_or_debit_card);?></td>
            </tr>

						<tr>
								<td><?php echo getQuestionText('has_internet_banking');?></td>
								<td><?php echo getQuestionAnswer('has_internet_banking', $oUserPersonalData->has_internet_banking);?></td>
						</tr>


						<tr>
								<td><?php echo getQuestionText('has_mobile_banking');?></td>
								<td><?php echo getQuestionAnswer('has_mobile_banking', $oUserPersonalData->has_mobile_banking);?></td>
						</tr>


						<tr>
                <td><?php echo getQuestionText('investment_type_id');?></td>
                <td><?php echo getQuestionAnswer('investment_type_id', $oUserPersonalData->aInvestmentTypes);?></td>
            </tr>


						<tr>
								<td><?php echo getQuestionText('loan_purpose_id');?></td>
								<td><?php echo getQuestionAnswer('loan_purpose_id', $oUserPersonalData->aLoanPurposes);?></td>
						</tr>


						<tr>
								<td><?php echo getQuestionText('loan_source_id');?></td>
								<td><?php echo getQuestionAnswer('loan_source_id', $oUserPersonalData->aLoanSources);?></td>
						</tr>


						<tr>
								<td><?php echo getQuestionText('nearest_auto_stand_access_time');?></td>
								<td><?php echo getQuestionAnswer('nearest_auto_stand_access_time', $oHouseData->nearest_auto_stand_access_time);?></td>
						</tr>




        </table>
    </div>

</div>
