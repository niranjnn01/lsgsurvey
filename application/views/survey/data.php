
<h4>സർവ്വേ വിവരങ്ങൾ</h4>
<div class="row">

	<div class="col-md-4">

		<h5><b>സ്ഥലം</b></h5>
		<table class="table">
			<!--<tr>
				<td>Survey ID :</td>
				<td><?php echo $oSurveyData->id;?></td>
			</tr>
            -->
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
				<td><?php echo getQuestionText('name');?>:</td>
				<td><?php echo $oUserPersonalData->name;?></td>
			</tr>
			
            <tr>
				<td><?php echo getQuestionText('aadhar_id');?>:</td>
				<td><?php echo $oUserPersonalData->aadhar_id;?></td>
			</tr>
            
			<tr>
				<td><?php echo getQuestionText('election_id');?>:</td>
				<td><?php echo $oUserPersonalData->election_id;?></td>
			</tr>
			
            <tr>
				<td><?php echo getQuestionText('belief_in_religion_id');?>:</td>
				<td><?php echo getQuestionAnswer('belief_in_religion_id', $oUserPersonalData->belief_in_religion_id);?></td>
			</tr>
            
            <tr>
				<td><?php echo getQuestionText('is_scst');?>:</td>
				<td><?php echo ($oUserPersonalData->is_scst) ? 'അതെ' : 'അല്ല';?></td>
			</tr>
            
            <tr>
				<td><?php echo getQuestionText('is_obc');?>:</td>
				<td><?php echo ($oUserPersonalData->is_obc) ? 'അതെ' : 'അല്ല';?></td>
			</tr>
            <tr>
				<td><?php echo getQuestionText('mobile_number');?>:</td>
				<td><?php echo $oUserPersonalData->mobile_number;?></td>
			</tr>
            <tr>
				<td><?php echo getQuestionText('email_id');?>:</td>
				<td><?php echo $oUserPersonalData->email_id;?></td>
			</tr>
            <tr>
				<td><?php echo getQuestionText('whatsapp_number');?>:</td>
				<td><?php echo $oUserPersonalData->whatsapp_number;?></td>
			</tr>
            <tr>
				<td><?php echo getQuestionText('facebook_link');?>:</td>
				<td><?php echo $oUserPersonalData->facebook_link;?></td>
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
				<td><?php echo $oHouseData->address;?></td>
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
				<td><?php echo $oHouseData->sResidenceType?></td>
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
				<td><?php echo getQuestionAnswer('floor_type_id', $oHouseData->floor_type_id);?></td>
			</tr>
            
            <tr>
				<td>മുറികളുടെ എണ്ണം</td>
				<td><?php echo  getQuestionAnswer('num_rooms', $oHouseData->num_rooms);?></td>
			</tr>
            
            <tr>
				<td>കക്കൂസ്</td>
				<td><?php echo getQuestionAnswer('toilet_type', $oHouseData->toilet_type);?></td>
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
				<td><?php echo getQuestionText('proximity');?></td>
				<td><?php echo isset($oHouseData->aHomeUtilityProximity[4]) ? $oHouseData->aHomeUtilityProximity[4] .' മീറ്റർ': '';?></td>
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
				<td><?php echo getQuestionText('waste_management_solution_id');?></td>
				<td><?php echo getQuestionAnswer('waste_management_solution_id', $oHouseData->aHomeWasteManagements);?>
                </td>
			</tr>
            <tr>
				<td><?php echo getQuestionText('is_electrified');?></td>
				<td><?php echo getQuestionAnswer('is_electrified', $oHouseData->is_electrified);?>
                </td>
			</tr>                     
            <tr>
				<td><?php echo getQuestionText('domestic_fuel_type_id');?></td>
				<td><?php echo getQuestionAnswer('domestic_fuel_type_id', $oHouseData->aFamilyDomesticFuelTypes);?>
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
                <td><?php echo getQuestionText('HAS_DOMESTIC_ANIMALS');?></td>
                <td><?php echo getQuestionAnswer('HAS_DOMESTIC_ANIMALS', $oHouseData->iHasPet);?></td>
            </tr>            
            <tr>
                <td><?php echo getQuestionText('pet_id');?></td>
                <td><?php echo getQuestionAnswer('pet_id', array_keys($oHouseData->aFamilyPets));?></td>
            </tr>           
            <tr>
                <td><?php echo getQuestionText('has_license');?></td>
                <td><?php echo ($oHouseData->iHasDog) ? getQuestionAnswer('has_license', $oHouseData->iHasDogLicense) : '';?></td>
            </tr>
            <tr>
                <td><?php echo getQuestionText('agriculture_location_id');?></td>
                <td><?php echo getQuestionAnswer('agriculture_location_id', $oHouseData->aFamilyAgricultureLocations);?></td>
            </tr>
            <tr>
                <td><?php echo getQuestionText('agricultural_produce_id');?></td>
                <td><?php echo getQuestionAnswer('agricultural_produce_id', $oHouseData->aFamilyAgricultureProduce);?></td>
            </tr>
            <tr>
                <td><?php echo getQuestionText('has_aquarium_fish');?></td>
                <td><?php echo getQuestionAnswer('has_aquarium_fish', $oHouseData->has_aquarium_fish);?></td>
            </tr>
            <tr>
                <td><?php echo getQuestionText('bank_account_type_id');?></td>
                <td><?php echo getQuestionAnswer('bank_account_type_id', $oUserPersonalData->aBankAccountTypes);?></td>
            </tr>
            
        </table>
    </div>

</div>
