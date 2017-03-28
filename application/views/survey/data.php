
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
				<td>പേര്:</td>
				<td><?php echo $oUserPersonalData->name;?></td>
			</tr>
			
            <tr>
				<td>ആധാർ നം:</td>
				<td><?php echo $oUserPersonalData->aadhar_id;?></td>
			</tr>
            
			<tr>
				<td>ഇലക്ഷൻ ഐ.ഡി:</td>
				<td><?php echo $oUserPersonalData->election_id;?></td>
			</tr>
			
            <tr>
				<td>മതം:</td>
				<td><?php echo getQuestionAnswer('belief_in_religion_id', $oUserPersonalData->belief_in_religion_id);?></td>
			</tr>
            
            <tr>
				<td>പട്ടികജാതി/വർഗം:</td>
				<td><?php echo ($oUserPersonalData->is_scst) ? 'അതെ' : 'അല്ല';?></td>
			</tr>
            
            <tr>
				<td>പിന്നോക്ക സമുദായം:</td>
				<td><?php echo ($oUserPersonalData->is_obc) ? 'അതെ' : 'അല്ല';?></td>
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
				<td>ഫേസ്ബുക്ക് അക്കൗണ്ട്:</td>
				<td><?php echo $oUserPersonalData->facebook_link;?></td>
			</tr>
            <tr>
				<td>ഏതെങ്കിലും അയൽക്കൂട്ടം അംഗമാണോ?:</td>
				<td><?php echo getQuestionAnswer('is_member_ayalkoottam', $oUserPersonalData->is_member_ayalkoottam);?></td>
			</tr>
            <tr>
				<td>അയൽക്കൂട്ടം ഭാരവാഹിയാണോ?:</td>
				<td><?php echo getQuestionAnswer('is_office_bearer_ayalkoottam', $oUserPersonalData->is_office_bearer_ayalkoottam);?></td>
			</tr>
            <tr>
				<td>രാഷ്ട്രീയ പാർട്ടിയിൽ അംഗത്വമുണ്ടോ?:</td>
				<td><?php echo getQuestionAnswer('is_member_political_party', $oUserPersonalData->is_member_political_party);?></td>
			</tr>
            <tr>
				<td>സാമൂഹിക സാംസ്‌കാരിക സംഘടനകളിൽ അംഗത്വം ഉണ്ടോ?:</td>
				<td><?php echo getQuestionAnswer('is_memeber_socio_cultural_organization', $oUserPersonalData->is_memeber_socio_cultural_organization);?></td>
			</tr>
            <tr>
				<td>മതസംഘടനയിൽ ഭാരവാഹിയാണോ?:</td>
				<td><?php echo getQuestionAnswer('is_office_bearer_religious_organization', $oUserPersonalData->is_office_bearer_religious_organization);?></td>
			</tr>
            <tr>
				<td>ലൈബ്രറി അംഗത്വം ഉണ്ടോ?:</td>
				<td><?php echo getQuestionAnswer('is_member_library', $oUserPersonalData->is_member_library);?></td>
			</tr>
            <tr>
				<td>വാർഡ് സഭകളിൽ പങ്കെടുക്കാറുണ്ടോ?:</td>
				<td><?php echo ($oUserPersonalData->aadhar_id) ? 'ഉണ്ട്' : 'ഇല്ല';?></td>
			</tr>
            <tr>
				<td>ഇല്ലെങ്കിൽ എന്തുകൊണ്ട്?:</td>
				<td></td>
			</tr>
            <tr>
				<td>പങ്കെടുക്കുന്നുണ്ടെങ്കിൽ  വാർഡ് സഭകളിൽ സംതൃപ്തിയുണ്ടോ?:</td>
				<td></td>
			</tr>
            <tr>
				<td>വാർഡ് സഭകളിൽ പങ്കെടുക്കാറുണ്ടെങ്കിൽ വാർഡ് സഭകൾ മെച്ചപ്പെടുത്താനുള്ള നിർദേശങ്ങൾ ഉണ്ടോ?:</td>
				<td></td>
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
				<td></td>
			</tr>            
		</table>
	</div>

    <div class="col-md-4">
        <table class="table">
            <tr>
                <td>വീട്ടുപകരണങ്ങൾ</td>
                <td></td>
            </tr>
            
            <tr>
				<td>വാഹനങ്ങൾ</td>
				<td></td>
			</tr>
        </table>
    </div>

</div>
