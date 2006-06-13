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
 * $Header: /advent/projects/wesat/vtiger_crm/sugarcrm/modules/Users/DetailView.php,v 1.21 2005/04/19 14:44:02 ray Exp $
 * Description:  TODO: To be written.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

require_once('Smarty_setup.php');
require_once('data/Tracker.php');
require_once('modules/Users/User.php');
require_once('include/utils/utils.php');
require_once('include/utils/CommonUtils.php');
require_once('include/utils/UserInfoUtil.php');
require_once('include/database/PearDatabase.php');

global $current_user;
global $theme;
global $default_language;
global $adb;
global $currentModule;
global $app_strings;
global $mod_strings;

$focus = new User();

if(!empty($_REQUEST['record'])) {
	$focus->retrieve_entity_info($_REQUEST['record'],'Users');
	$focus->id = $_REQUEST['record'];	
}
else
{

    echo "
        <script type='text/javascript'>
            window.location = 'index.php?module=Users&action=ListView';
        </script>
        ";
}

if( $focus->user_name == "" )
{  
   
    echo "
            <table>
                <tr>
                    <td>
                        <b>User does not exist.</b>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href='index.php?module=Users&action=ListView'>List Users</a>
                    </td>
                </tr>
            </table>
        ";
    exit;  
}


if(isset($_REQUEST['isDuplicate']) && $_REQUEST['isDuplicate'] == 'true') {
	$focus->id = "";
}

global $theme;
$theme_path="themes/".$theme."/";
$image_path=$theme_path."images/";
require_once($theme_path.'layout_utils.php');

//the user might belong to multiple groups
if($focus->id != 1)
{
 $groupids = fetchUserGroupids($focus->id);
}
$log->info("User detail view");

$category = getParenttab();

$smarty = new vtigerCRM_Smarty;

$smarty->assign("UMOD", $mod_strings);
global $current_language;
$smod_strings = return_module_language($current_language, 'Settings');
$smarty->assign("MOD", $smod_strings);

$smarty->assign("APP", $app_strings);

$smarty->assign("THEME", $theme);
$smarty->assign("IMAGE_PATH", $image_path);$smarty->assign("PRINT_URL", "phprint.php?jt=".session_id().$GLOBALS['request_string']);
$smarty->assign("ID", $focus->id);
$smarty->assign("CATEGORY", $category);
if(isset($focus->imagename) && $focus->imagename!='')
{
	$imagestring="<div id='track1' style='margin: 4px 0pt 0pt 10px; width: 200px; background-image: url(themes/images/scaler_slider_track.gif); background-repeat: repeat-x; background-position: left center; height: 18px;'>
	<div class='selected' id='handle1' style='width: 18px; height: 18px; position: relative; left: 145px;cursor:pointer;'><img src='themes/images/scaler_slider.gif'></div>
	</div><script language='JavaScript' type='text/javascript' src='include/js/prototype.js'></script>
<script language='JavaScript' type='text/javascript' src='include/js/slider.js'></script>

	<div class='scale-image' style='padding: 10px; float: left; width: 83.415px;'><img src='test/user/".$focus->imagename."' width='100%'</div>
	<p><script type='text/javascript' src='include/js/scale_demo.js'></script></p>";
	//$smarty->assign("USER_IMAGE",$imagestring);
}
				
if(isset($_REQUEST['modechk']) && $_REQUEST['modechk'] != '' )
{
	$modepref = $_REQUEST['modechk'];
}
	if($_REQUEST['modechk'] == 'prefview')
		$parenttab = '';
	else
		$parenttab = 'Settings';

$smarty->assign("PARENTTAB", $parenttab);

if ((is_admin($current_user) || $_REQUEST['record'] == $current_user->id)
		&& isset($default_user_name)
		&& $default_user_name == $focus->user_name
		&& isset($lock_default_user_name)
		&& $lock_default_user_name == true	) {
	$buttons = "<input title='".$app_strings['LBL_EDIT_BUTTON_TITLE']."' accessKey='".$app_strings['LBL_EDIT_BUTTON_KEY']."' class='classBtn' onclick=\"this.form.return_module.value='Users'; this.form.return_action.value='DetailView'; this.form.return_id.value='$focus->id'; this.form.action.value='EditView'; this.form.parenttab.value='$parenttab'\" type='submit' name='Edit' value='  ".$app_strings['LBL_EDIT_BUTTON_LABEL']."  '>";
	$smarty->assign('EDIT_BUTTON',$buttons);
}
elseif (is_admin($current_user) || $_REQUEST['record'] == $current_user->id) {
	$buttons = "<input title='".$app_strings['LBL_EDIT_BUTTON_TITLE']."' accessKey='".$app_strings['LBL_EDIT_BUTTON_KEY']."' class='classBtn' onclick=\"this.form.return_module.value='Users'; this.form.return_action.value='DetailView'; this.form.return_id.value='$focus->id'; this.form.action.value='EditView'; this.form.parenttab.value='$parenttab'\" type='submit' name='Edit' value='  ".$app_strings['LBL_EDIT_BUTTON_LABEL']."  '>";
	$smarty->assign('EDIT_BUTTON',$buttons);
	
		$buttons = "<input title='".$mod_strings['LBL_CHANGE_PASSWORD_BUTTON_TITLE']."' accessKey='".$mod_strings['LBL_CHANGE_PASSWORD_BUTTON_KEY']."' class='classBtn' LANGUAGE=javascript onclick='return window.open(\"index.php?module=Users&action=ChangePassword&form=DetailView\",\"test\",\"width=320,height=165,resizable=no,scrollbars=0, toolbar=no, titlebar=no, left=100, top=126, screenX=100, screenY=126\");' type='button' name='password' value='".$mod_strings['LBL_CHANGE_PASSWORD_BUTTON_LABEL']."'>";
		$smarty->assign('CHANGE_PW_BUTTON',$buttons);
	
	$buttons = "<input title='".$mod_strings['LBL_LOGIN_HISTORY_BUTTON_TITLE']."' accessKey='".$mod_strings['LBL_LOGIN_HISTORY_BUTTON_KEY']."' class='classBtn' onclick=\"this.form.return_module.value='Users'; this.form.return_action.value='ShowHistory'; this.form.return_id.value='$focus->id'; this.form.action.value='ShowHistory'\" type='submit' name='LoginHistory' value=' ".$mod_strings['LBL_LOGIN_HISTORY_BUTTON_LABEL']." '>";	
	$smarty->assign('LOGIN_HISTORY_BUTTON',$buttons);
	$buttons = "<input title='".$mod_strings['LBL_LIST_MAILSERVER_BUTTON_TITLE']."' accessKey='".$mod_strings['LBL_LIST_MAILSERVER_BUTTON_KEY']."' class='classBtn' onclick=\"this.form.return_module.value='Users'; this.form.return_action.value='ListMailAccount'; this.form.return_id.value='$focus->id'; this.form.module.value='Settings' ;this.form.action.value='ListMailAccount'\" type='submit' name='ListMailServerAccount' value=' ".$mod_strings['LBL_LIST_MAILSERVER_BUTTON_LABEL']." '>";
	$smarty->assign('LIST_MAILSERVER_BUTTON',$buttons);
	$buttons = "<input title='".$mod_strings['LBL_CHANGE_HOMEPAGE_TITLE']."' class='classBtn' align='center' onclick=\"this.form.return_module.value='Users';  this.form.return_action.value='DetailView';  this.form.action.value='EditHomeOrder';  this.form.record.value='$focus->id';\"  type='submit' name='EditHomeOrder'  value='  ".$mod_strings['LBL_CHANGE_HOMEPAGE_LABEL']."  '>";
	$smarty->assign('CHANGE_HOMEPAGE_BUTTON',$buttons);

	
}
if (is_admin($current_user)) 
{
	$buttons = "<input title='".$app_strings['LBL_DUPLICATE_BUTTON_TITLE']."' accessKey='".$app_strings['LBL_DUPLICATE_BUTTON_KEY']."' class='classBtn' onclick=\"this.form.return_module.value='Users'; this.form.return_action.value='DetailView'; this.form.isDuplicate.value=true; this.form.return_id.value='".$_REQUEST['record']."';this.form.action.value='EditView'\" type='submit' name='Duplicate' value=' ".$app_strings['LBL_DUPLICATE_BUTTON_LABEL']."'   >";
	$smarty->assign('DUPLICATE_BUTTON',$buttons);
	
	//done so that only the admin user can see the customize tab button
	if($_REQUEST['record'] != $current_user->id)
	{
		$buttons = "<input title='".$app_strings['LBL_DELETE_BUTTON_TITLE']."' accessKey='".$app_strings['LBL_DELETE_BUTTON_KEY']."' class='classBtn' onclick=\"deleteUser('$focus->id')\" type='button' name='Delete' value='  ".$app_strings['LBL_DELETE_BUTTON_LABEL']."  '>";
		$smarty->assign('DELETE_BUTTON',$buttons);
	}

	if($_SESSION['authenticated_user_roleid'] == 'administrator')
	{
		$buttons = "<input title='".$app_strings['LBL_LISTROLES_BUTTON_TITLE']."' accessKey='".$app_strings['LBL_LISTROLES_BUTTON_KEY']."' class='classBtn' onclick=\"this.form.return_module.value='Users'; this.form.return_action.value='TabCustomise'; this.form.action.value='listroles'; this.form.record.value= '". $current_user->id ."'\" type='submit' name='ListRoles' value=' ".$app_strings['LBL_LISTROLES_BUTTON_LABEL']." '>";
		$smarty->assign('LISTROLES_BUTTON',$buttons);
	}

}



$smarty->assign("MODULE", 'Settings');
$smarty->assign("BLOCKS", getBlocks($currentModule,"detail_view",'',$focus->column_fields));


        $smarty->display("UserDetailView.tpl");


?>
