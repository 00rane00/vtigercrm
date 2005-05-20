<?php

/*********************************************************************************
** The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
*
 ********************************************************************************/

require_once('include/database/PearDatabase.php');
require_once('modules/Settings/Forms.php');

global $app_strings;
global $mod_strings;
global $theme;
$theme_path="themes/".$theme."/";
$image_path=$theme_path."images/";

echo '<br>';
echo get_module_title($mod_strings['LBL_MODULE_NAME'], $mod_strings['LBL_MODULE_NAME'].' : '.$mod_strings['LBL_ADD_MAIL_ACCOUNT'], true);
echo '<br><br>';

?>

            <form action="index.php">
             <input type="hidden" name="module" value="Settings">
             <input type="hidden" name="action" value="createemailtemplate">
		
		<input title="<?php echo $mod_strings['LBL_NEW_MAIL_ACCOUNT_TITLE'];?>" accessKey="<?php echo $mod_strings['LBL_NEW_MAIL_ACCOUNT_KEY'];?>" class="button" onclick="this.form.action.value='AddMailAccount'" type="submit" name="button" value="  <?php echo $mod_strings['LBL_NEW_MAIL_ACCOUNT_LABEL'];?>  " >
		
		<input title="<?php echo $app_strings['LBL_DELETE_BUTTON_TITLE'];?>" accessKey="<?php echo $app_strings['LBL_DELETE_BUTTON_KEY'];?>" class="button" onclick="this.form.action.value='DeleteMailAccount';return formValidate() " type="submit" name="button" value="  <?php echo $app_strings['LBL_DELETE_BUTTON_LABEL'];?>  " >
<br><br>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="FormBorder">
		<tbody>
		<tr><td COLSPAN="12"></td></tr>
		<tr>
		<td WIDTH="1" class="moduleListTitle" style="padding:0px 3px 0px 3px;"><input type="checkbox" name="selectall" onClick=toggleSelect(this.checked,"selected_id")></td>
		<td WIDTH="1" class="blackLine" NOWRAP><IMG SRC="<?php echo $image_path;?>blank.gif"></td>
		<td width="25%"class="moduleListTitle" height="25">&nbsp;<b><?php echo $mod_strings['LBL_DISPLAY_NAME']; ?></b></td>
		<td WIDTH="1" class="blackLine" NOWRAP><IMG SRC="<?php echo $image_path;?>blank.gif"></td>
                <td width="30%" class="moduleListTitle">&nbsp;<b><?php echo $mod_strings['LBL_MAIL_SERVER_NAME']; ?></b></td>
		<td WIDTH="1" class="blackLine" NOWRAP><IMG SRC="<?php echo $image_path;?>blank.gif"></td>
		<td width="25%" class="moduleListTitle">&nbsp;<b><?php echo $mod_strings['LBL_EMAIL_ADDRESS']; ?></b></td>
		<td WIDTH="1" class="blackLine" NOWRAP><IMG SRC="<?php echo $image_path;?>blank.gif"></td>
		<td width="10%" class="moduleListTitle">&nbsp;<b><?php echo $mod_strings['LBL_DEFAULT']; ?></b></td>
		<td WIDTH="1" class="blackLine" NOWRAP><IMG SRC="<?php echo $image_path;?>blank.gif"></td>
		<td width="10%" class="moduleListTitle">&nbsp;<b><?php echo $mod_strings['Edit']; ?></b></td>
		<td WIDTH="1" class="blackLine" NOWRAP><IMG SRC="<?php echo $image_path;?>blank.gif"></td>
		</tr>
		<tr><td COLSPAN="12" class="blackLine"><IMG SRC="<?php echo $image_path;?>blank.gif"></td></tr>
<?php
   global $current_user;
   require_once('modules/Users/UserInfoUtil.php');

   $result = getMailServerInfo($current_user);
   $temprow = $adb->fetch_array($result);
   $rowcount = $adb->num_rows($result);
$edit="Edit  ";
$del="Del  ";
$bar="  | ";
$cnt=1;

if($rowcount!=0)
{
do
{

  if ($cnt%2==0)
  printf('<tr class="evenListRow"> <td height="25">&nbsp;<input type="checkbox" name="select_id"></td>');
  else
  printf('<tr class="oddListRow"> <td height="25">&nbsp;<input type="checkbox" name="select_id"></td>');
  printf('<td WIDTH="1" class="blackLine" NOWRAP><IMG SRC="'.$image_path.'%s"></td>','blank.gif');
  printf("<td height='25'>&nbsp;%s</td>",$temprow["display_name"]);
  printf('<td WIDTH="1" class="blackLine" NOWRAP><IMG SRC="'.$image_path.'%s"></td>','blank.gif');
  printf("<td height='25'>&nbsp;%s</td>",$temprow["mail_servername"]);
  printf('<td WIDTH="1" class="blackLine" NOWRAP><IMG SRC="'.$image_path.'%s"></td>','blank.gif');
  printf("<td height='25'>&nbsp;%s</td>",$temprow["mail_id"]);
  printf('<td WIDTH="1" class="blackLine" NOWRAP><IMG SRC="'.$image_path.'%s"></td>','blank.gif');
  if($temprow["set_default"]==1);
  $DEFAULT="Selected";
  printf('<td align=center><input type="radio" name="set_default" value="%s" '.$DEFAULT.'></td>',$temprow["account_id"]);
  printf('<td WIDTH="1" class="blackLine" NOWRAP><IMG SRC="'.$image_path.'%s"></td>','blank.gif');
  printf('<td>&nbsp;<a href="index.php?module=Settings&action=AddMailAccount&record=%s">'.$mod_strings["Edit"].'</a></td>',$temprow["account_id"]);
  $cnt++;
  printf("</tr>");	
  $DEFAULT='';
}
while($temprow = $adb->fetch_array($result));
}
?>
</tbody>
</table>
