<?php if (! defined ( 'BASEPATH' ))	exit ( 'No direct script access allowed' );

/*

THIS LOGIC IS NOT TO BE IMPLEMENTED HERE. UPLOAD QUEUE CODE
SHOULD HANDLE ONLY THE UPLOAD RELATED STUFF

function getExistingUploadsforEntity($iAccountNo, $sScenario, $iEntityId=0) {

	$iNum = 0;

	switch($sScenario) {

		case "resource":
			break;
	}
	return $iNum;
}

function getMaxFileUploadsPermitted($iAccountNo, $sScenario, $iEntityId=0) {

    $iNum = 3;

		if( $aScenarioDetails = $CI->config->item('upload_scenarios')[$sScenario] ) {
			$iNum = 0;
		}



    $iExistingUploads = getExistingUploadsforEntity($iAccountNo, $sScenario, $iEntityId);
    $iMaxPermissibleUploads = 3;

    if( $iExistingUploads >= $iMaxPermissibleUploads) {

        $iNum = 0;
    } else {
        $iNum = $iMaxPermissibleUploads - $iExistingUploads;
    }

    return $iNum;
}
*/


/**
 *
 * check if a given scenario is valid or not
 */
function isValidFileUploadScenario($sScenario, $bReturnDetails = FALSE) {

		$CI = & get_instance();

		$CI->load->config('upload_queue');

		$result = FALSE;
//p($sScenario);
		if( in_array($sScenario, array_keys( $CI->config->item('upload_scenarios') )) ) {
			$result = TRUE;
		}

		if($result) {
			$result = $bReturnDetails ? $CI->config->item('upload_scenarios')[$sScenario] : $result;
		}

		return $result;
}


function requireFileUpload ($sScenario, $iNumUploads) {

	$CI = & get_instance();

	// get the JS and CSS files
	$CI->mcontents['load_js'] = '';

	$CI->load->config('upload_queue');

	// get the iframe URL
	$CI->mcontents['sFileUpload_IframeURL'] = $CI->mcontents['c_base_url'] . 'resource_uploader?'.
																						'scenario=' . $sScenario .
																						'&num_uploads=' . $iNumUploads

																						;
}

/**
 *
 * Check if there are entires in the upload queue
 */
function checkUploadQueue($sType, $iAccountNo) {

	$CI = & get_instance ();

	$CI->db->where('type', $sType);
	$CI->db->where('account_no', $iAccountNo);
	$query = $CI->db->get('upload_queue');



	if( $query->num_rows() ) {
		return $query->row();
	} else {
		return array();
	}
}



/**
 *
 * Temporarily store files which are uploaded, but not finalized by the user
 *
 * @param unknown_type $sType
 * @param unknown_type $iMageName
 * @param unknown_type $iAccountNo
 * @param boolean $bMulti | indicates multiple file uploads
 *
 */
function pushToUploadQueue($sScenario, $sImageName, $iAccountNo, $bMulti=false, $sMultiUploadToken='', $aUploadData=array(), $sUUid='' ) {

	$CI = &get_instance();

	$CI->load->helper('custom_file');

	$CI->db->select('
										image_name,
										multi_upload_token'
									);
	$CI->db->where('account_no', $iAccountNo);
	$CI->db->where('scenario', $sScenario);

	// Remove any previously uploaded files by this user

	if( $oData = $CI->db->get('upload_queue')->row() ) {

		if( $bMulti ) {

			if( $sMultiUploadToken != $oData->multi_upload_token ) {


				// multiple file upload is permitted, and the user is using uploadify to upload yet another picture.
				// problem is that the multi_upload_token doesn match. meaning the user has once again brought up the pop up window for
				// an upload. in this case, check if there are any pending images from the previous upload attempt and
				// delete them

				$CI->db->select('image_name');
				$CI->db->where('account_no', $iAccountNo);
				$CI->db->where('scenario', $sScenario);
				$CI->db->where('multi_upload_token <> ', $sMultiUploadToken);
				foreach($CI->db->get('upload_queue')->result() AS $oRow){

					//deletePendingImage($sType, $oRow->image_name, $iAccountNo, true);
					deleteFromUploadQueue('account_no', $iAccountNo, $sScenario);
				}

			}

		} else {

			//delete any previously uploaded file by this user.
			deleteFromUploadQueue('account_no', $iAccountNo, $sScenario);
		}

	}


	// Now that any previously uploaded files are removed by the
	// above code, lets add this file to the pending images queue

	$CI->db->set('uuid', $sUUid);
	$CI->db->set('account_no', $iAccountNo);
	$CI->db->set('scenario', $sScenario);
	$CI->db->set('image_name', $sImageName);
	$CI->db->set('set_on', time());


	if( $aUploadData ) {
		$CI->db->set( 'serialized_upload_data', serialize( $aUploadData ) );
	}


	if( $bMulti ) {

		// multi_upload_token is set only in case of multiple uploads, in order to identify the group
		// the flash-session-token can be used here
		$CI->db->set('multi_upload_token', $sMultiUploadToken);
	}

	$CI->db->insert('upload_queue');


	return $CI->db->insert_id();
}


/**
 * [clearUploadQueue clear the upload que by deleting the files and the database entries]
 * @param  integer $iOlderThan [files older than "$iOlderThan" number of hours will be deleted ]
 * @return [type]              [description]
 */
	function clearUploadQueue($iOlderThan=0) {

		$CI = & get_instance();

		if($iOlderThan) {
			$CI->db->where('set_on < ', (time() - ($iOlderThan * 60 * 60))); // older than 24 hours
		}

		if( $aData = $CI->db->get('upload_queue')->result() ) {

			p($aData);
			foreach ($aData AS $oItem) {
				deleteFromUploadQueue('uuid', $oItem->uuid, $oItem->scenario);
			}
		}

	}


	/**
	 *
	 * Delete a file from the upload queue
	 */
	function deleteFromUploadQueue($sBy='uuid', $sValue='', $sScenario='') {

		$CI = & get_instance();

		$CI->load->config('upload_queue');

		$sError = '';

		if( $sBy && $sValue) {

			$CI->db->where($sBy, $sValue);
			if($sScenario) {
				$CI->db->where('scenario', $sScenario);
			}

			$aItem = $CI->db->get('upload_queue')->result();

			if( $aItem ) {

				foreach($aItem AS $oItem) {

					//delete the file from folder
					$CI->load->helper('file');



					$sRawPath = $CI->config->item('upload_queue_path');
					$sFileName = $oItem->image_name;

					$sFilePath = $sRawPath . $sFileName;

					if( file_exists($sFilePath) ) {

						unlink($sFilePath);
					}

					$CI->db->where('id', $oItem->id);
					$CI->db->delete('upload_queue');
				}

			}

		} else {
			$sError = 'There was some error';
		}

		return $sError;
	}

/**
 *
 * Delete a file from the upload queue
 */
function deleteFromUploadQueue_old($sScenario, $sBy='uuid', $sValue='') {

	$CI = & get_instance();

	$sError = '';

	if( $sBy && $sValue) {

		$CI->db->where($sBy, $sValue);
		$aItem = $CI->db->get('upload_queue')->result();

		if( $aItem ) {

			foreach($aItem AS $oItem) {

				//delete the file from folder
				$CI->load->helper('file');


				$sRawPath = $CI->config->item($sScenario.'_raw_path');
				$sFileName = $oItem->image_name;

				$sFilePath = $sRawPath . $sFileName;

				//log_message('error', $sFilePath);

				if( file_exists($sFilePath) ) {

					unlink($sFilePath);
				}

				$CI->db->where('uuid', $sValue);
				$CI->db->delete('upload_queue');
			}

		}

	} else {
		$sError = 'There was some error';
	}

	return $sError;
}
