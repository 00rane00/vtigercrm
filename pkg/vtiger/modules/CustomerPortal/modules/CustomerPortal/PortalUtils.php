<?PHP
/*********************************************************************************
** The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
*
 ********************************************************************************/
 require_once('include/utils/utils.php');
 
/* Function to get a list of modules that is supporting Customer Portal
 */
function getPortalModuleinfo(){
 	global $adb;
	
	$query = $adb->query("SELECT vtiger_customerportal_tabs.*,vtiger_tab.name from vtiger_customerportal_tabs INNER JOIN vtiger_tab ON vtiger_customerportal_tabs.tabid = vtiger_tab.tabid and vtiger_tab.presence = 0 ORDER BY vtiger_customerportal_tabs.sequence");
	$rows = $adb->num_rows($query);
	for($i = 0;$i < $rows; $i++){
		$portalmodules[$i]['tabid']  = $adb->query_result($query,$i,'tabid');
		$portalmodules[$i]['visible']  = $adb->query_result($query,$i,'visible');
		$portalmodules[$i]['sequence'] = $adb->query_result($query,$i,'sequence');
		$portalmodules[$i]['name'] = $adb->query_result($query,$i,'name');
	}
	return $portalmodules;
}
 
/* Function is used to change the order of modules in Customer portal
 * 
 */
function changeTabOrder($tabid,$move) {
 	global $adb,$log;
 	$log->fatal("$tabid,$move");
 	if($move == 'Down'){
 		$sequence = $adb->query("SELECT sequence FROM vtiger_customerportal_tabs WHERE tabid = $tabid");
 		$oldsequence = $adb->query_result($sequence,0,'sequence');
 		
 		$nexttab = $adb->query("SELECT sequence,tabid FROM vtiger_customerportal_tabs WHERE sequence > $oldsequence ORDER BY SEQUENCE LIMIT 0,1"); 
 		$newsequence = $adb->query_result($nexttab,0,'sequence');
 		$righttabid = $adb->query_result($nexttab,0,'tabid');
 		
 		$adb->query("UPDATE vtiger_customerportal_tabs set sequence=$newsequence WHERE tabid = $tabid");
 		$adb->query("UPDATE vtiger_customerportal_tabs set sequence=$oldsequence WHERE tabid = $righttabid");
 	}elseif ($move == 'Up') {
 		$sequence = $adb->query("SELECT sequence FROM vtiger_customerportal_tabs WHERE tabid = $tabid");
 		$oldsequence = $adb->query_result($sequence,0,'sequence');
 		
 		$nexttab = $adb->query("SELECT sequence,tabid FROM vtiger_customerportal_tabs WHERE sequence < $oldsequence ORDER BY SEQUENCE DESC LIMIT 0,1"); 
 		$newsequence = $adb->query_result($nexttab,0,'sequence');
 		$lefttabid = $adb->query_result($nexttab,0,'tabid');
 		
 		$adb->query("UPDATE vtiger_customerportal_tabs SET sequence=$newsequence WHERE tabid = $tabid");
 		$adb->query("UPDATE vtiger_customerportal_tabs SET sequence=$oldsequence WHERE tabid = $lefttabid");
 	
 	}
 	
}

/* Function to obtain related info for Customer Portal(contacts can see other contacts info ar not)
 */ 
 
function getrelatedinfo() {
	global $adb;
	$relatedinfo = $adb->query("SELECT vtiger_customerportal_prefs.*,vtiger_tab.name FROM vtiger_customerportal_prefs INNER JOIN vtiger_tab ON vtiger_tab.tabid = vtiger_customerportal_prefs.tabid  WHERE prefkey = 'showrelatedinfo' AND vtiger_tab.presence = 0");
	$norows = $adb->num_rows($relatedinfo);
	for($i = 0;$i < $norows;$i++) { 
		$module_viewall[$i]['module'] = $adb->query_result($relatedinfo,$i,'name');
		$module_viewall[$i]['value'] = $adb->query_result($relatedinfo,$i,'prefvalue');
	}
	return $module_viewall;
}

/* Function to show/hide the tabs(modules) in Customer Portal
 */
function changeModuleVisibility($tabid,$status) {
	global $adb,$log;
	if($status == 'module_disable'){
		$updatevisibility = $adb->query("UPDATE vtiger_customerportal_tabs SET visible = 0 WHERE tabid = $tabid");
	}else {
		$updatevisibility = $adb->query("UPDATE vtiger_customerportal_tabs SET visible = 1 WHERE tabid = $tabid");
	}
}

/* Function to save Advanced info fro Customer Portal
 */
function saveAdvancedSettings($input) {
	global $adb;
	
	$portalmodules = array("Accounts","Contacts","HelpDesk","Invoice","Quotes","Documents","Faq","Services","Products");
	foreach($portalmodules as $modules) {
		$view = $input['view_'.$modules];
		$tabid = getTabid($modules);
		if($view == 'showall'){
			$adb->query("UPDATE vtiger_customerportal_prefs SET prefvalue = 1  WHERE prefkey = 'showrelatedinfo' and tabid = $tabid");
		}else {
			$adb->query("UPDATE vtiger_customerportal_prefs SET prefvalue = 0  WHERE prefkey = 'showrelatedinfo' and tabid = $tabid");
		}
	}
	
	//user update
	$userid = $input['userid'];
	$adb->query("UPDATE vtiger_customerportal_prefs SET prefvalue = $userid WHERE prefkey = 'userid' and tabid = 0");
	
}

/*	It gives you a list of users
 * 
 */
function getUsers(){
	global $adb;
	$res = $adb->query("SELECT id,user_name from vtiger_users");
	$norows = $adb->num_rows($res);
	for($i = 0;$i < $norows;$i++) {
		$users[$i]['id'] = $adb->query_result($res,$i,'id');
		$users[$i]['name'] = $adb->query_result($res,$i,'user_name');
	}
	return $users;
}

/* Function to get the customer portal user id 
 */
function getCurrentUser() {
	global $adb;
	$res = $adb->query("SELECT prefvalue FROM vtiger_customerportal_prefs WHERE prefkey = 'userid' AND tabid = 0");
	$userid = $adb->query_result($res,0,'prefvalue');
	if($userid != '') {
		return $userid;
	}
	return false;
}
?>