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
 * $Header:  vtiger_crm/sugarcrm/modules/Opportunities/DetailView.php,v 1.8 2004/12/16 10:28:55 jack Exp $
 * Description:  TODO: To be written.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

require_once('XTemplate/xtpl.php');
require_once('data/Tracker.php');
require_once('modules/Opportunities/Opportunity.php');
require_once('modules/Opportunities/Forms.php');
require_once('include/CustomFieldUtil.php');

global $mod_strings;
global $app_strings;
global $app_list_strings;

$focus = new Opportunity();

if(isset($_REQUEST['record'])) {
    $focus->retrieve($_REQUEST['record']);
}
if(isset($_REQUEST['isDuplicate']) && $_REQUEST['isDuplicate'] == 'true') {
	$focus->id = "";
} 

global $theme;
$theme_path="themes/".$theme."/";
$image_path=$theme_path."images/";
require_once($theme_path.'layout_utils.php');

$log->info("Opportunity detail view");

$xtpl=new XTemplate ('modules/Opportunities/DetailView.html');
$xtpl->assign("MOD", $mod_strings);
$xtpl->assign("APP", $app_strings);

$xtpl->assign("THEME", $theme);
$xtpl->assign("IMAGE_PATH", $image_path);$xtpl->assign("PRINT_URL", "phprint.php?jt=".session_id().$GLOBALS['request_string']);
$xtpl->assign("ID", $focus->id);
$xtpl->assign("ACCOUNT_NAME", $focus->account_name);	
$xtpl->assign("ACCOUNT_ID", $focus->account_id);	
$xtpl->assign("ASSIGNED_TO", $focus->assigned_user_name);
$xtpl->assign("LEAD_SOURCE", $focus->lead_source);
$xtpl->assign("NAME", $focus->name);
$xtpl->assign("TYPE", $focus->opportunity_type);
if ($focus->amount != '') $xtpl->assign("AMOUNT", $app_strings['LBL_CURRENCY_SYMBOL'].$focus->amount);
$xtpl->assign("DATE_ENTERED", $focus->date_entered);
$xtpl->assign("DATE_CLOSED", $focus->date_closed);
$xtpl->assign("NEXT_STEP", $focus->next_step);
$xtpl->assign("SALES_STAGE", $focus->sales_stage);
$xtpl->assign("PROBABILITY", $focus->probability);
$xtpl->assign("DESCRIPTION", nl2br($focus->description));
$xtpl->assign("DATE_MODIFIED", substr($focus->date_modified,0,16));
$xtpl->assign("DATE_ENTERED", substr($focus->date_entered,0,16));
//Assigning Custom Field Values
$custfld = CustomFieldDetailView($focus->id, "Opportunities", "opportunitycf", "opportunityid");
$xtpl->assign("CUSTOMFIELD", $custfld);



  if($entityDel)
        {
               $xtpl->assign("DELETEBUTTON","<td><input title=\"$app_strings[LBL_DELETE_BUTTON_TITLE]\" accessKey=\"$app_strings[LBL_DELETE_BUTTON_KEY]\" class=\"button\" onclick=\"this.form.return_module.value='Opportunities'; this.form.return_action.value='ListView'; this.form.action.value='Delete'; return confirm('$app_strings[NTC_DELETE_CONFIRMATION]')\" type=\"submit\" name=\"Delete\" value=\" $app_strings[LBL_DELETE_BUTTON_LABEL]\"></td>");
        }





$xtpl->parse("main");
$xtpl->out("main");

echo "<BR>\n";


include('modules/Contacts/SubPanelViewContactsAndUsers.php');
$SubPanel = new SubPanelViewContactsAndUsers();
$SubPanel->setFocus($focus);
$SubPanel->setHideUsers(true);
$SubPanel->ProcessSubPanelListView( 'modules/Contacts/SubPanelViewOpportunity.html',$mod_strings, $action);

echo "<BR>\n";

// Now get the list of activities that match this opportunity.
$focus_tasks_list = & $focus->get_tasks();
$focus_meetings_list = & $focus->get_meetings();
$focus_calls_list = & $focus->get_calls();
$focus_emails_list = & $focus->get_emails();
$focus_notes_list = & $focus->get_notes();

include('modules/Activities/SubPanelView.php');

echo "</td></tr>\n";

?>
