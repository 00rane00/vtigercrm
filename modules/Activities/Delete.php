<?php
/*********************************************************************************
 * The contents of this file are subject to the SugarCRM Public License Version 1.1.2
 * ("License"); You may not use this file except in compliance with the 
 * License. You may obtain a copy of the License at http://www.mozilla.org/MPL
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
 * $Header: /advent/projects/wesat/vtiger_crm/sugarcrm/modules/Activities/Delete.php,v 1.6 2005/03/04 06:52:09 jack Exp $
 * Description:  TODO: To be written.
 ********************************************************************************/

require_once('modules/Activities/Activity.php');

require_once('include/logging.php');
$log = LoggerManager::getLogger('task_delete');

$focus = new Activity();

if(!isset($_REQUEST['record']))
	die($mod_strings['ERR_DELETE_RECORD']);

$sql= 'delete from seactivityrel where activityid='.$_REQUEST['record'];
$adb->query($sql);

if($_REQUEST['return_module'] == 'Contacts')
{
   $sql = 'delete from cntactivityrel where contactid = '.$_REQUEST['return_id'].' and activityid = '.$_REQUEST['record'];
   $adb->query($sql);
}

if($_REQUEST['module'] == $_REQUEST['return_module'])
        $focus->mark_deleted($_REQUEST['record']);

header("Location: index.php?module=".$_REQUEST['return_module']."&action=".$_REQUEST['return_action']."&record=".$_REQUEST['return_id']);
?>
