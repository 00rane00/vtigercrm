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


require_once('database/DatabaseConnection.php');

?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="en">
<head>
  <title>Role Details</title>
<!--meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"-->
</head>
<body>

            <script language="javascript">
    function validate()
    {
        if( !emptyCheck( "roleName", "Role Name" ) )
            return false;    
            
        return true;
    }
    
    function cancelNewRoleCreation( roleId )
    {
    
    }
    
             </script>
            <div class="bodyText mandatory"> </div>
            <form name="newRoleForm" action="index.php">
                    <input type="hidden" name="module" value="Users">
                    <input type="hidden" name="action" value="UserInfoUtil">
              <table width="100%" border="0" cellpadding="0"
 cellspacing="0">
                <tbody>
                  <tr>
                    <td class="moduleTitle hline"><?php echo $mod_strings['LBL_CREATE_NEW_ROLE']; ?></td>
                  </tr>
                </tbody>
              </table>
              <p></p>
              <table width="40%" border="0" cellpadding="0"
 cellspacing="0">
                <tbody>
                  <tr>
                    <td>
                    <div align="right"><font class="required">*</font><?php echo $mod_strings['LBL_INDICATES_REQUIRED_FIELD']; ?> </div>
                    </td>
                  </tr>
                </tbody>
              </table>
              <table width="40%" border="0" cellpadding="0"
 cellspacing="1" class="formOuterBorder">
                <tbody>
                  <tr>
                    <td class="formSecHeader" colspan="2"><?php echo $mod_strings['LBL_NEW_ROLE']; ?></td>
                  </tr>
                  <tr>
                    <td class="dataLabel mandatory">* <?php echo $mod_strings['LBL_ROLE_NAME']; ?></td>
                    <td class="value"><input class="textField" type="text" name="roleName"></td>
                  </tr>
                  <tr>
                    <td class="dataLabel mandatory">*<?php echo $mod_strings['LBL_PARENT_ROLE']; ?></td>
                    <td class="value">
                    <select class="select" name="parentRoleName">
            <?php
             $sql = "select name from role";
                  $result = mysql_query($sql);
                  $temprow = mysql_fetch_array($result);
                  do
                  {
                    $name=$temprow["name"];
                    ?>
                      
                    <option value="<?php echo $name ?>"><?php echo $temprow["name"] ?></option>
                       <?php
                    }while($temprow = mysql_fetch_array($result));
                     ?>
                    
                    </select>
                    </td>
                  </tr>
                </tbody>
              </table>
              <p></p>
              <table width="40%" border="0" cellpadding="0"
 cellspacing="0">
                <tbody>
                  <tr>
                    <td>
                     <div align="center">
                   
 <input type="submit" class="button" name="save" value="<?php echo $app_strings['LBL_SAVE_BUTTON_LABEL'] ?>" tabindex="2">
  <input name="cancel" class="button" type="button" value="<?php echo $app_strings['LBL_CANCEL_BUTTON_LABEL'] ?>" onclick="window.history.back()">
</form> </div>
                    </td>
                  </tr>
                </tbody>
              </table>
</body>
</html>
