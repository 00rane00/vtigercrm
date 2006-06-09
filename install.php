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
 * $Header: /advent/projects/wesat/vtiger_crm/sugarcrm/install.php,v 1.2 2004/10/06 09:02:02 jack Exp $
 * Description:  Starts the installation process.
 ********************************************************************************/

if (is_file('config.php')) {
	require_once('config.php');
	if (isset($dbconfig['db_hostname']) & is_file('install_lock')) {
    	header("Location: index.php");
    	exit();
    }
}

function stripslashes_checkstrings($value) {
  if(is_string($value))
    return stripslashes($value);

  return $value;
}

if(get_magic_quotes_gpc() == 1) {
  $_REQUEST = array_map("stripslashes_checkstrings", $_REQUEST);
  $_POST = array_map("stripslashes_checkstrings", $_POST);
  $_GET = array_map("stripslashes_checkstrings", $_GET);
}

//Run command line if no web var detected
if (!isset($_SERVER['REQUEST_METHOD'])) {
	require("install/5createTables.inc.php");
	exit;
}

if (isset($_POST['file']))
  $the_file = $_POST['file'];
else
  $the_file = "0welcome.php";

include("install/".$the_file);

?>
