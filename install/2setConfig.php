<?php
/*********************************************************************************
 * The contents of this file are subject to the SugarCRM Public License Version 1.1.2
 * ("License"); You may not use this file except in compliance with the 
 * License. You may obtain a copy of the License at http://www.sugarcrm.com/SPL
 * Software distributed under the License is distributed on an  "AS IS"  basis,
 * WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License for
 * the specific language governing rights and limitations under the License.
 * The Original Code is: SugarCRM Open Source
 * The Initial Developer of the Original Code is SugarCRM, Inc.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.;
 * All Rights Reserved.
 * Contributor(s): ______________________________________.
 ********************************************************************************/
/*********************************************************************************
 * $Header: /advent/projects/wesat/vtiger_crm/sugarcrm/install/2setConfig.php,v 1.41 2005/04/29 06:44:13 samk Exp $
 * Description:  Executes a step in the installation process.
 ********************************************************************************/
require_once("connection.php");

$web_root = $_SERVER['SERVER_NAME']. ":" .$_SERVER['SERVER_PORT'].$_SERVER['PHP_SELF'];
$web_root = str_replace("/install.php", "", $web_root);
$web_root = "http://$web_root";
$current_dir = pathinfo(dirname(__FILE__));
$current_dir=$current_dir['dirname']."/";
$cache_dir = "cache/";

// To make MySQL run in desired port  
$sock_path=":" .$mysql_port;

$H_NAME=gethostbyaddr($_SERVER['SERVER_ADDR']);
if (is_file("config.php")) {
	require_once("config.php");
	
	session_start();
	if(isset($upload_maxsize))
                 $_SESSION['upload_maxsize'] = $upload_maxsize;
         if(isset($allow_exports))
                 $_SESSION['allow_exports'] = $allow_exports;
	if(isset($disable_persistent_connections))
		$_SESSION['disable_persistent_connections'] = $disable_persistent_connections;
	if(isset($default_language))
		$_SESSION['default_language'] = $default_language;
	if(isset($translation_string_prefix))
		$_SESSION['translation_string_prefix'] = $translation_string_prefix;
	if(isset($default_charset))
		$_SESSION['default_charset'] = $default_charset;
	if(isset($languages))
	{
		// We need to encode the languages in a way that can be retrieved later.
		$language_keys = Array();
		$language_values = Array();
		
		foreach($languages as $key=>$value)
		{
			$language_keys[] = $key;
			$language_values[] = $value;
		}	
			
		$_SESSION['language_keys'] = urlencode(implode(",",$language_keys));
		$_SESSION['language_values'] = urlencode(implode(",",$language_values));
	}
	
	global $dbconfig;
	if (isset($_REQUEST['db_host_name'])) {
		$db_host_name = $_REQUEST['db_host_name'];
	}
	elseif (isset($dbconfig['db_host_name'])) {
		$db_host_name = $dbconfig['db_host_name'];
	}
	else {
		$db_host_name = $H_NAME.$sock_path;
	}
	
	if (isset($_REQUEST['db_user_name'])) {
		$db_user_name = $_REQUEST['db_user_name'];
	}
	elseif (isset($dbconfig['db_user_name'])) {
		$db_user_name = $dbconfig['db_user_name'];
	}
	else {
		$db_user_name = $mysql_username;
	}
	
	if (isset($_REQUEST['db_password'])) {
		$db_password = $_REQUEST['db_password'];
	}
	elseif (isset($dbconfig['db_password'])) {
		$db_password = $dbconfig['db_password']; 
	}
	else {
		$db_password = $mysql_password;
	}
	
	if (isset($_REQUEST['db_name'])){
		$db_name = $_REQUEST['db_name'];
	}
	elseif (isset($dbconfig['db_name'])) {
		$db_name = $dbconfig['db_name'];
	}
	else {
		$db_name = 'vtigercrm4_2alpha';
	}
	!isset($_REQUEST['db_drop_tables']) ? $db_drop_tables = "0" : $db_drop_tables = $_REQUEST['db_drop_tables'];
	
	if (isset($_REQUEST['host_name'])) $host_name = $_REQUEST['host_name'];
	else $host_name = $_SERVER['SERVER_NAME'];
	if (isset($_REQUEST['site_URL'])) $site_URL = $_REQUEST['site_URL'];
	else $site_URL = $web_root;
	if (isset($_REQUEST['root_directory'])) $root_directory = stripslashes($_REQUEST['root_directory']);
	else $root_directory = $current_dir;
	if (isset($_REQUEST['cache_dir'])) $cache_dir= $_REQUEST['cache_dir'];
	if (isset($_REQUEST['mail_server'])) $mail_server= $_REQUEST['mail_server'];
	if (isset($_REQUEST['mail_server_username'])) $mail_server_username= $_REQUEST['mail_server_username'];
	if (isset($_REQUEST['mail_server_password'])) $mail_server_password= $_REQUEST['mail_server_password'];
	if (isset($_REQUEST['admin_email'])) $admin_email = $_REQUEST['admin_email'];
	if (isset($_REQUEST['admin_password'])) $admin_password = $_REQUEST['admin_password'];
}
else {
	!isset($_REQUEST['db_host_name']) ? $db_host_name = $H_NAME.$sock_path : $db_host_name = $_REQUEST['db_host_name'];
	!isset($_REQUEST['db_user_name']) ? $db_user_name = $mysql_username : $db_user_name = $_REQUEST['db_user_name'];
	!isset($_REQUEST['db_password']) ? $db_password= $mysql_password : $db_password = $_REQUEST['db_password'];
	!isset($_REQUEST['db_name']) ? $db_name = "vtigercrm4_2alpha" : $db_name = $_REQUEST['db_name'];
	!isset($_REQUEST['db_drop_tables']) ? $db_drop_tables = "0" : $db_drop_tables = $_REQUEST['db_drop_tables'];
	!isset($_REQUEST['host_name']) ? $host_name= $_SERVER['SERVER_NAME'] : $host_name= $_REQUEST['host_name'];
	!isset($_REQUEST['site_URL']) ? $site_URL = $web_root : $site_URL = $_REQUEST['site_URL'];
	!isset($_REQUEST['root_directory']) ? $root_directory = $current_dir : $root_directory = stripslashes($_REQUEST['root_directory']);
	!isset($_REQUEST['cache_dir']) ? $cache_dir = $cache_dir : $cache_dir = stripslashes($_REQUEST['cache_dir']);
	
	!isset($_REQUEST['mail_server']) ? $mail_server = $mail_server : $mail_server = stripslashes($_REQUEST['mail_server']);
	!isset($_REQUEST['mail_server_username']) ? $mail_server_username = $mail_server_username : $mail_server_username = stripslashes($_REQUEST['mail_server_username']);
	!isset($_REQUEST['mail_server_password']) ? $mail_server_password = $mail_server_password : $mail_server_password = stripslashes($_REQUEST['mail_server_password']);
	!isset($_REQUEST['admin_email']) ? $admin_email = "" : $admin_email = $_REQUEST['admin_email'];
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>vtiger CRM Open Source Installer: Step 2</title>
<link rel="stylesheet" href="install/install.css" type="text/css" />
</head>
<body leftMargin="0" topMargin="0" marginheight="0" marginwidth="0">

<script type="text/javascript" language="Javascript">
<!--  to hide script contents from old browsers
function trim(s) {
        while (s.substring(0,1) == " ") {
                s = s.substring(1, s.length);
        }
        while (s.substring(s.length-1, s.length) == ' ') {
                s = s.substring(0,s.length-1);
        }

        return s;
}

function verify_data(form) {
	var isError = false;
	var errorMessage = "";
	// Here we decide whether to submit the form.
	if (trim(form.db_host_name.value) =='') {
		isError = true;
		errorMessage += "\n database host name";
		form.db_host_name.focus(); 
	}
	if (trim(form.db_user_name.value) =='') {
		isError = true;
		errorMessage += "\n database user name";
		form.db_user_name.focus(); 
	}
	if (trim(form.db_name.value) =='') {
		isError = true;
		errorMessage += "\n database name";
		form.db_name.focus(); 
	}
	if (trim(form.site_URL.value) =='') {
		isError = true;
		errorMessage += "\n site url";
		form.site_URL.focus(); 
	}
	if (trim(form.root_directory.value) =='') {
		isError = true;
		errorMessage += "\n path";
		form.root_directory.focus(); 
	}
/*
	 if (trim(form.admin_email.value) =='') {
                isError = true;
                errorMessage += "\n admin email";
                form.admin_email.focus();
        }
*/
	if (trim(form.admin_password.value) =='') {
		isError = true;
		errorMessage += "\n admin password";
		form.admin_password.focus(); 
	}
	if (trim(form.cache_dir.value) =='') {
                isError = true;
                errorMessage += "\n temp directory path";
                form.root_directory.focus();
        }
/*
	if (trim(form.mail_server.value) =='') {
                isError = true;
                errorMessage += "\n mail server name";
                form.mail_server.focus();
        }

 if (trim(form.mail_server_username.value) =='') {
                isError = true;
                errorMessage += "\n mail server username";
                form.mail_server_username.focus();
        }


 if (trim(form.mail_server_password.value) =='') {
                isError = true;
                errorMessage += "\n mail server password";
                form.mail_server_password.focus();
        }

*/




	// Here we decide whether to submit the form.
	if (isError == true) {
		alert("Missing required fields: " + errorMessage);
		return false;
	}

	return true;
}
// end hiding contents from old browsers  -->
</script>


<table width="100%" border="0" cellpadding="5" cellspacing="0"><tbody>
  <tr>
      <td align="center"><a href="http://www.vtiger.com" target="_blank" title="vtiger CRM"><IMG alt="vtiger CRM" border="0" src="include/images/vtiger.jpg"/></a></td>
    </tr>
</tbody></table>
<table align="center" border="0" cellpadding="2" cellspacing="2" border="1" width="60%"><tbody><tr> 
   <tr>
      <td width="100%">
		<table width=100% cellpadding="0" cellspacing="0" border="0"><tbody><tr>
			  <td>
			   <table cellpadding="0" cellspacing="0" border="0"><tbody><tr>
				<td class="formHeader" vAlign="top" align="left" height="20"> 
				 <IMG height="5" src="include/images/left_arc.gif" width="5" border="0"></td>
				<td class="formHeader" vAlign="middle" align="left" noWrap width="100%" height="20">Step 2: Database Configuration</td>
				<td  class="formHeader" vAlign="top" align="right" height="20">
				  <IMG height="5" src="include/images/right_arc.gif" width="5" border="0"></td>
				</tr></tbody></table>
			  </td>
			  <td width="100%" align="right">&nbsp;</td>
			  </tr><tr>
			  <td colspan="2" width="100%" class="formHeader"><IMG width="100%" height="2" src="include/images/blank.gif"></td>
			  </tr>
		</tbody></table>
	  </td>
          </tr>
          <tr>
            <td>
          <P>Please enter your database configuration information below... <P>
		  
		  If you do not have root access to your database (for example you are installing in a virtual 
		  hosting environment), you will need to have your database created for you before you proceed. 
		  However, this installer will still be able to create the necessary database tables.<P>
			
		  If you unsure of your database host, username or password, we suggest that you use the default
		  values below. <P>
		  <font color=red>* Required field</font></td>
          </tr>
		  <tr><td>&nbsp;</td></tr>
          <tr>
		    <td align="center">
			<form action="install.php" method="post" onsubmit="return verify_data(setConfig);" name="setConfig" id="form">
			<input type="hidden" name="file" value="3confirmConfig.php">
			<table width="50%" cellpadding="2" border="0"><tbody>
              <tr>
			<td colspan="3" class="moduleTitle" noWrap>Database Configuration</td>
              </tr>
			  <tr>
               <td><font color=red>*</font></td><td nowrap><strong>Host Name</strong></td>
               <td align="left"><input type="text" class="dataInput" name="db_host_name" value="<?php if (isset($db_host_name)) echo "$db_host_name"; ?>" /></td>
              </tr>
              <tr>
               <td><font color=red>*</font></td><td nowrap><strong>MySQL User Name</strong></td>
               <td align="left"><input type="text" class="dataInput" name="db_user_name" readonly value="<?php if (isset($db_user_name)) echo "$db_user_name"; ?>" /></td>
              </tr>
              <tr>
               <td></td><td nowrap><strong>MySQL Password</strong></td>
               <td align="left"><input type="password" class="dataInput" name="db_password" readonly value="<?php if (isset($db_password)) echo "$db_password"; ?>" /></td>
              </tr>
              <tr>
               <td><font color=red>*</font></td><td nowrap><strong>MySQL Database Name</strong></td>
               <td align="left"><input type="text" class="dataInput" name="db_name" readonly value="<?php if (isset($db_name)) echo "$db_name"; ?>" /></td>
              </tr>
              <!-- tr>
               <td></td><td nowrap><strong>Drop Existing Tables?</strong></td>
               <td align="left"><input type="checkbox" name="db_drop_tables" 
			   <?php if (isset($db_drop_tables) && $db_drop_tables==true) echo "checked "; ?> value="$db_drop_tables"/></td> 
              </tr -->
			<tr><td>&nbsp;</td></tr>
              <tr>
			<td colspan="3" class="moduleTitle" noWrap>Site Configuration</td>
              </tr>
              <tr>
			<td><font color=red>*</font></td><td nowrap><strong>URL</td>
            <td align="left"><input class="dataInput" type="text" name="site_URL" 
			value="<?php if (isset($site_URL)) echo $site_URL; ?>" size="40" /> 
		  	</td>
          </tr><tr>
            <td><font color=red>*</font></td><td nowrap><strong>Path</strong></td>
            <td align="left"><input class="dataInput" type="text" name="root_directory" value="<?php if (isset($root_directory)) echo "$root_directory"; ?>" size="40" /> </td>
	  </tr><tr valign="top">
            <td><font color=red>*</font></td><td nowrap><strong>Path to Cache Directory<br>(must be writable)</td>
            <td align="left"><?php echo $root_directory; ?><input class="dataInput" type="text" name="cache_dir" size='14' value="<?php if (isset($cache_dir)) echo $cache_dir; ?>" size="40" /> </td>
          </tr>
		<tr>
			<td colspan="3" class="moduleTitle" noWrap>Admin Configuration</td>
              </tr>
	<tr>
            <td></td><td nowrap><strong>username</strong></td>
            <td align="left">admin</td>
          </tr>

	<tr>
            <td><font color=red>*</font></td><td nowrap><strong>password</strong></td>
            <td align="left"><input class="dataInput" type="password" name="admin_password" value="<?php if (isset($admin_password)) echo "$admin_password"; else echo "admin"; ?>" size="40" /></td>
          </tr>
	<tr>
            <td colspan=3><font color=blue>( the default password is 'admin'. You can change the password if necessary now or else you can change it from the Admin page inside the vtiger CRM )</font></td>
        </tr>
		</tbody>
			</table>
		  </td></tr>
          <tr>
			<td align="right"><br /> <input class="button" type="submit" name="next" value="Next" /></td>
          </tr>
	</tbody></table>
		
</form>
</body>
</html>
