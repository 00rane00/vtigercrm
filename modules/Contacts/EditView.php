<?php
/*********************************************************************************
 * The contents of this file are subject to the SugarCRM Public License Version 1.1.2
 * ("License"); You may not use this file except in compliance with the
 * License. You may obtain a copy of the License at http://www.sugarcrm.com/SPL
 * Software distributed under the License is distributed on an  "AS IS"  basis,
 * WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License for
 * the specific language governing rights and limitations under the License.
 * The Original Code is:  SugarCRM Open Source
 * The Initial Developer of the Original Code is SugarCRM, Inc.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.;
 * All Rights Reserved.
 * Contributor(s): ______________________________________.
 ********************************************************************************/
/*********************************************************************************
 * $Header: /advent/projects/wesat/vtiger_crm/sugarcrm/modules/Contacts/EditView.php,v 1.15 2005/02/21 15:39:40 jack Exp $
 * Description:  TODO: To be written.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

require_once('XTemplate/xtpl.php');
require_once('data/Tracker.php');
require_once('modules/Contacts/Contact.php');
require_once('modules/Contacts/Forms.php');
require_once('include/CustomFieldUtil.php');
require_once('include/ComboUtil.php');
require_once('include/uifromdbutil.php');

global $mod_strings;
global $app_list_strings;
global $app_strings;
global $current_user;
// Unimplemented until jscalendar language files are fixed
// global $current_language;
// global $default_language;
// global $cal_codes;

$focus = new Contact();

if(isset($_REQUEST['record']) && isset($_REQUEST['record'])) 
{
    $focus->id = $_REQUEST['record'];
    $focus->mode = 'edit';
    $focus->retrieve_entity_info($_REQUEST['record'],"Contacts");
    $focus->firstname=$focus->column_fields['firstname'];
    $focus->lastname=$focus->column_fields['lastname'];

}
if(isset($_REQUEST['account_id']))
{
        $focus->column_fields['account_id'] = $_REQUEST['account_id'];
}
if(isset($_REQUEST['isDuplicate']) && $_REQUEST['isDuplicate'] == 'true') 
{
	$focus->id = "";
	$focus->mode = "";
}

//get Block 1 Information
$block_1 = getBlockInformation("Contacts",1,$focus->mode,$focus->column_fields);

//get Address Information
$block_2 = getBlockInformation("Contacts",2,$focus->mode,$focus->column_fields);

//get Description Information
$block_3 = getBlockInformation("Contacts",3,$focus->mode,$focus->column_fields);

$block_5 = getBlockInformation("Contacts",5,$focus->mode,$focus->column_fields);
if(trim($block_5) != '')
{
        $cust_fld = '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="formOuterBorder">';
        $cust_fld .=  '<tr><td>';
        $cust_fld .= '<table width="100%" border="0" cellspacing="1" cellpadding="0">';
        $cust_fld .= '<tr><th align="left" class="formSecHeader" colspan="2">Custom Information</th></tr>';
        $cust_fld .= $block_5;
        $cust_fld .= '</table>';
        $cust_fld .= '</td></tr></table>';
        $cust_fld .='<BR>';
}


//needed when creating a new contact with a default account value passed in
if (isset($_REQUEST['account_name']) && is_null($focus->account_name)) {
	$focus->account_name = $_REQUEST['account_name'];
	

}
if (isset($_REQUEST['account_id']) && is_null($focus->account_id)) {
	$focus->account_id = $_REQUEST['account_id'];
}

global $theme;
$theme_path="themes/".$theme."/";
$image_path=$theme_path."images/";
//retreiving the combo values array
$comboFieldNames = Array('leadsource'=>'lead_source_dom'
                      ,'salutationtype'=>'salutation_dom');
$comboFieldArray = getComboArray($comboFieldNames);

require_once($theme_path.'layout_utils.php');

$log->info("Contact detail view");

$xtpl=new XTemplate ('modules/Contacts/EditView.html');
$xtpl->assign("MOD", $mod_strings);
$xtpl->assign("APP", $app_strings);
$xtpl->assign("BLOCK1", $block_1);
$xtpl->assign("BLOCK2", $block_2);
$xtpl->assign("BLOCK3", $block_3);

if (isset($focus->firstname)) $xtpl->assign("FIRST_NAME", $focus->firstname);
else $xtpl->assign("FIRST_NAME", "");
$xtpl->assign("LAST_NAME", $focus->lastname);
$xtpl->assign("JAVASCRIPT", get_set_focus_js().get_validate_record_js());
if(isset($cust_fld))
{
        $xtpl->assign("CUSTOMFIELD", $cust_fld);
}
$xtpl->assign("ID", $focus->id);
if($focus->mode == 'edit')
{
        $xtpl->assign("MODE", $focus->mode);
}

// Unimplemented until jscalendar language files are fixed
// $xtpl->assign("CALENDAR_LANG", ((empty($cal_codes[$current_language])) ? $cal_codes[$default_language] : $cal_codes[$current_language]));
$xtpl->assign("CALENDAR_LANG", "en");$xtpl->assign("CALENDAR_DATEFORMAT", parse_calendardate($app_strings['NTC_DATE_FORMAT']));

if (isset($_REQUEST['return_module'])) $xtpl->assign("RETURN_MODULE", $_REQUEST['return_module']);
if (isset($_REQUEST['return_action'])) $xtpl->assign("RETURN_ACTION", $_REQUEST['return_action']);
if (isset($_REQUEST['return_id'])) $xtpl->assign("RETURN_ID", $_REQUEST['return_id']);

$xtpl->assign("THEME", $theme);
$xtpl->assign("IMAGE_PATH", $image_path);$xtpl->assign("PRINT_URL", "phprint.php?jt=".session_id().$GLOBALS['request_string']);


$xtpl->parse("main");

$xtpl->out("main");

?>
