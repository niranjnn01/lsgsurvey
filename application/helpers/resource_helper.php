<?php if (! defined ( 'BASEPATH' ))	exit ( 'No direct script access allowed' );

/**
 *
 * Given a resource ID, get the details of it
 *
 */
function getResourceDetails($iResourceId) {


}


/**
 *
 * get resources list, that is associated with a particular item
 *
 */
function getResources($sType, $iUid, $sReturnType = 'object') {

    $CI = & get_instance();

    $sFn = 'result';
    if( $sReturnType == 'array' ) {
        $sFn = 'result_array';
    }

    $sItem_TableFieldName       = $sType . '_id';
    $sResource_TableFieldName   = 'resource_id';
    $sMappingTableName          = $sType . '_resource_map';

    if( $sType == 'issue' ) {

        $sResource_TableFieldName   = 'resource_uid resource_id';
        $sItem_TableFieldName       = 'issue_uid';
    }

    $CI->db->select( $sItem_TableFieldName . ', ' . $sResource_TableFieldName );
    $CI->db->where( $sItem_TableFieldName, $iUid );
    $aData = $CI->db->get( $sMappingTableName )->$sFn();

    //p( $CI->db->last_query() );

    return $aData;

}



/**
 *
 * get Data of resources that are associated with a particular item
 *
 */
function getResourceData( $sItemType, $iItemId, $aConfig = array(), $bGroupByResourceMappingGroups=FALSE ) {

    $CI = & get_instance();


    $sItem_TableFieldName       = $sItemType . '_id';
    $sResource_TableFieldName   = 'resource_id';
    $sMappingTableName          = $sItemType . '_resource_map';


    $aOrderBy = array('R.priority' => 'ASC');

    $aDefaultConfig = array(
                    'aWhere' => array(),
                    'aOrderBy' => array(),
                );
    $aConfig = array_merge($aDefaultConfig, $aConfig);


    switch($sItemType) {
        case 'issue':
            $sResource_TableFieldName   = 'resource_uid';
            $sItem_TableFieldName       = 'issue_uid';
            break;

        case 'people':
            $sItem_TableFieldName       = 'account_no';

            $aOrderBy = array('MAP.order' => 'ASC');

            if ( ! empty( $aConfig['aOrderBy'] ) ) {
                $aOrderBy = $aConfig['aOrderBy'];
            }

        case 'meeting':
            $sResource_TableFieldName   = 'resource_uid';
            $sItem_TableFieldName       = 'meeting_id';



            if ( ! empty( $aConfig['aOrderBy'] ) ) {
                $aOrderBy = $aConfig['aOrderBy'];
            }


            break;
    }



    $CI->db->select( '
                        R.uid resource_id,
                        R.file_name,
                        R.type,
                        R.status,
                        R.title,
                        R.seo_name,
                        R.excerpt,
                        R.description,
                        R.extension,
                        R.created_on,
                        R.updated_on,
                        MAP.group_id
                        ', false);

    $CI->db->join( $sItemType . '_resource_map MAP', 'MAP.'.$sResource_TableFieldName.' = R.uid' );
    $CI->db->where( 'MAP.' . $sItem_TableFieldName, $iItemId );


    if( isset( $aConfig['aWhere'] ) ) {

        $CI->db->where( $aConfig['aWhere'] );
    }
    /*
    if( isset( $aConfig['aOrderBy'] ) ) {

        $CI->db->order_by( $aConfig['aOrderBy'] );
    }
    */
    foreach($aOrderBy AS $sKey => $sValue) {
        $CI->db->order_by($sKey, $sValue);
    }

    $query = $CI->db->get( 'resources R');


    $aResourcesData = $query->result();

    /**
     *
     * group the data
     */
    $aGroupedResources = array();
    if($bGroupByResourceMappingGroups) {

        $CI->load->config('resource_config');

        $aResourceMappingGroups = $CI->config->item('resource_mapping_groups');

        $aProcessedItems = array();

        foreach($aResourcesData AS $oResourceItem) {

            foreach($aResourceMappingGroups[$sItemType]['groups'] AS $sGroupName => $iGroupValue) {

                if(! isset($aGroupedResources[$iGroupValue])) {
                    $aGroupedResources[$iGroupValue] = array();
                }

                if( ! in_array($oResourceItem->resource_id, $aProcessedItems) ) {
                    $aGroupedResources[$oResourceItem->group_id][$oResourceItem->resource_id] = $oResourceItem;
                }

                $aProcessedItems[] = $oResourceItem->resource_id;
            }
        }

        $aResourcesData = $aGroupedResources;
    }

    return $aResourcesData;

}


function getResources_($sType, $iUid, $sReturnType = 'object', $bGroupByResourceMappingGroups=FALSE) {

    $CI = & get_instance();

    $sFn = 'result';
    if( $sReturnType == 'array' ) {
        $sFn = 'result_array';
    }

    $sItem_TableFieldName       = $sType . '_id';
    $sResource_TableFieldName   = 'resource_id';
    $sMappingTableName          = $sType . '_resource_map';

    if( $sType == 'issue' ) {

        $sResource_TableFieldName   = 'resource_uid resource_id';
        $sItem_TableFieldName       = 'issue_uid';
    }

    $CI->db->select( $sItem_TableFieldName . ', ' . $sResource_TableFieldName );
    $CI->db->where( $sItem_TableFieldName, $iUid );
    $aResources = $CI->db->get( $sMappingTableName )->$sFn();



    //p( $CI->db->last_query() );

    return $aResources;

}

/**
 *
 * get Data of resources that are associated with a particular item
 *
 */
function getResourceData_old( $sItemType, $iItemId, $aConfig = array() ) {

    $CI = & get_instance();


    $sItem_TableFieldName       = $sItemType . '_id';
    $sResource_TableFieldName   = 'resource_id';
    $sMappingTableName          = $sItemType . '_resource_map';


    $aOrderBy = array('R.priority' => 'ASC');

    $aDefaultConfig = array(
                    'aWhere' => array(),
                    'aOrderBy' => array(),
                );
    $aConfig = array_merge($aDefaultConfig, $aConfig);

    //print_r($aConfig);

    switch($sItemType) {
        case 'issue':
            $sResource_TableFieldName   = 'resource_uid';
            $sItem_TableFieldName       = 'issue_uid';
            break;

        case 'people':
            $sItem_TableFieldName       = 'account_no';

            $aOrderBy = array('MAP.order' => 'ASC');

            if ( ! empty( $aConfig['aOrderBy'] ) ) {
                $aOrderBy = $aConfig['aOrderBy'];
            }



            break;
    }



    $CI->db->select( '
                        R.uid resource_id,
                        R.file_name,
                        R.type,
                        R.status,
                        R.title,
                        R.seo_name,
                        R.excerpt,
                        R.description,
                        R.extension,
                        R.created_on,
                        R.updated_on', false);

    $CI->db->join( $sItemType . '_resource_map MAP', 'MAP.'.$sResource_TableFieldName.' = R.uid' );
    $CI->db->where( 'MAP.' . $sItem_TableFieldName, $iItemId );


    if( isset( $aConfig['aWhere'] ) ) {

        $CI->db->where( $aConfig['aWhere'] );
    }
    /*
    if( isset( $aConfig['aOrderBy'] ) ) {

        $CI->db->order_by( $aConfig['aOrderBy'] );
    }
    */
    foreach($aOrderBy AS $sKey => $sValue) {
        $CI->db->order_by($sKey, $sValue);
    }

    $query = $CI->db->get( 'resources R');

    //p($CI->db->last_query());

    return $query->result();

}



/**
 *
 * Get only the resource IDs in an array
 *
 */
/**
 *
 * ########## - !!!!!!!!! DEPRECATED !!!!!!!!
 * ########## USE getResourceIds_in_array(). because the name of the function is more useful.
 * ########## To be replaced Soon - 13-7-2014
 *
 */
function getResourceList($sType, $iUid) {


    /**
     *
     * ########## - !!!!!!!!! DEPRECATED !!!!!!!!
     * ########## USE getResourceIds_in_array(). because the name of the function is more useful.
     * ########## To be replaced Soon - 13-7-2014
     *
     */

    $aData = array();
    foreach( getresources($sType, $iUid) AS $oResource) {

        $aData[] = $oResource->resource_id;
    }

    return $aData;
}


/**
 *
 * Get only the resource IDs of a particular item(program, issue, campaign etc) in an array
 *
 */
function getResourceIds_in_array($sType, $iUid) {

    $aData = array();
    foreach( getresources($sType, $iUid) AS $oResource) {
        //p($oResource);
        $aData[] = $oResource->resource_id;
    }

    return $aData;
}


function getResourceThumbnailUrl ( $iResourceId, $sSize ) {

    $CI = & get_instance();

    $CI->load->config('resource_config');

    $CI->db->where('uid', $iResourceId);
    if( $oResource = $CI->db->get('resources')->row() ) {
        //return ('test');
        $aResourceTypeUrl = $CI->config->item('resource_type_url');
        $aFilenameParts = explode('.', $oResource->file_name);

        //1 - is for resource type "image"
        return $aResourceTypeUrl[1] . 'thumbnails/' . $aFilenameParts[0] . '_' . $sSize . '.' . $aFilenameParts[1];
    }
    //echo $CI->db->last_query();
//echo ('test 2');

}



/**
 *
 * will get the HTML required for brining a resource includer to the page
 */
function getResourceIncluder($aConfig=array()) {

    $CI = & get_instance();

    return $CI->load->view('admin/resource/resource_includer', $aConfig, TRUE);
}
