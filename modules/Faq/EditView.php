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
 * $Header$
 * Description:  TODO To be written.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

require_once('Smarty_setup.php');
require_once('modules/Faq/Faq.php');
require_once('include/CustomFieldUtil.php');
require_once('include/ComboUtil.php');
require_once('include/utils/utils.php');
require_once('include/FormValidationUtil.php');

global $app_strings;
global $mod_strings;
global $current_user;

$focus = new Faq();
$smarty = new vtigerCRM_Smarty();

if(isset($_REQUEST['record'])) 
{
    $focus->id = $_REQUEST['record'];
    $focus->mode = 'edit'; 	
    $focus->retrieve_entity_info($_REQUEST['record'],"Faq");		
}
if(isset($_REQUEST['isDuplicate']) && $_REQUEST['isDuplicate'] == 'true') {
	$focus->id = "";
    	$focus->mode = ''; 	
} 


global $theme;
$theme_path="themes/".$theme."/";
$image_path=$theme_path."images/";

require_once($theme_path.'layout_utils.php');

$disp_view = getView($focus->mode);
$smarty->assign("BLOCKS",getBlocks("Faq",$disp_view,$mode,$focus->column_fields));
//echo '<pre>';print_r(getBlocks("Faq",$disp_view,$mode,$focus->column_fields));echo '</pre>';
$smarty->assign("OP_MODE",$disp_view);

$smarty->assign("MODULE",$currentModule);
$smarty->assign("SINGLE_MOD","Faq");
$smarty->assign("MOD", $mod_strings);
$smarty->assign("APP", $app_strings);

if($focus->mode == 'edit')
{
	$smarty->assign("MODE", $focus->mode);
}		

if(isset($_REQUEST['return_module'])) $smarty->assign("RETURN_MODULE", $_REQUEST['return_module']);
else $smarty->assign("RETURN_MODULE","Faq");
if(isset($_REQUEST['return_action'])) $smarty->assign("RETURN_ACTION", $_REQUEST['return_action']);
else $smarty->assign("RETURN_ACTION","index");
if(isset($_REQUEST['return_id'])) $smarty->assign("RETURN_ID", $_REQUEST['return_id']);
$smarty->assign("THEME", $theme);
$smarty->assign("IMAGE_PATH", $image_path);$smarty->assign("PRINT_URL", "phprint.php?jt=".session_id().$GLOBAL
S['request_string']);
$smarty->assign("ID", $focus->id);

$smarty->assign("CALENDAR_LANG", $app_strings['LBL_JSCALENDAR_LANG']);
$smarty->assign("CALENDAR_DATEFORMAT", parse_calendardate($app_strings['NTC_DATE_FORMAT']));


$faq_tables = Array('faq'); 

$validationData = getDBValidationData($faq_tables);
$fieldName = '';
$fieldLabel = '';
$fldDataType = '';

$rows = count($validationData);
foreach($validationData as $fldName => $fldLabel_array)
{
	if($fieldName == '')
	{
		$fieldName="'".$fldName."'";
	}
	else
	{
		$fieldName .= ",'".$fldName ."'";
	}
	foreach($fldLabel_array as $fldLabel => $datatype)
	{
		if($fieldLabel == '')
		{

			$fieldLabel = "'".$fldLabel ."'";
		}		
		else
		{
			$fieldLabel .= ",'".$fldLabel ."'";
		}
		if($fldDataType == '')
		{
			$fldDataType = "'".$datatype ."'";
		}
		else
		{
			$fldDataType .= ",'".$datatype ."'";
		}
	}
}

$smarty->assign("VALIDATION_DATA_FIELDNAME",$fieldName);
$smarty->assign("VALIDATION_DATA_FIELDDATATYPE",$fldDataType);
$smarty->assign("VALIDATION_DATA_FIELDLABEL",$fieldLabel);

$smarty->display("salesEditView.tpl");
?>
