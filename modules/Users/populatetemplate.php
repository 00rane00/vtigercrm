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
//query the specific table and then get the data and write the data here 
require_once('include/database/PearDatabase.php');
include_once('modules/Contacts/Contact.php');
include_once('modules/Leads/Lead.php');


//download the template file and store it in some specific location
$sql = "select templatename,body from emailtemplates where templatename='".$_REQUEST["templatename"] ."'";
$tempresult = $adb->query($sql);
$tempArray = $adb->fetch_array($tempresult);
$fileContent = $tempArray["body"];
$handle = fopen($root_directory.'/modules/Emails/templates/'.$_REQUEST["templatename"],"wb") ;
fwrite($handle,$fileContent,700000);
fclose($handle);

//create a file and write to it so that it can be used as the emailtemplateusage.php file

if (is_file($root_directory.'/modules/Emails/templates/testemailtemplateusage.php')) {
	$is_writable = is_writable($root_directory.'/modules/Emails/templates/testemailtemplateusage.php');
}
else {
	$is_writable = is_writable('.');
}


//$config = "<?php \n";
// $config .= "/*********************************************************************************\n";
//$config .= " * The contents of this file are subject to the vtigerCRM License \n";
// $config .= " * All Rights Reserved.\n";
// $config .= " * Contributor(s): ______________________________________.\n";
// $config .= "********************************************************************************/\n\n";


 
  $myString = "<?php \n";
   $myString .= "/*********************************************************************************\n";
  $myString .= " * The contents of this file are subject to the vtigerCRM License \n";
  $myString .= " * All Rights Reserved.\n";
  $myString .= " * Contributor(s): ______________________________________.\n";
  $myString .= "********************************************************************************/\n\n";


 $module = $_REQUEST['entity'];
$recordid = $_REQUEST['entityid'];

//get the module
if($module == 'leads')
{
  $focus = new Lead();
}
else
{
  $focus = new Contact();
}

$focus->retrieve_entity_info($recordid,$module);
//$focus->column_fields();
$i=0;
$myString;
//storing the columnname and the value pairs
foreach ($focus->column_fields as $columnName=>$value)
{
  $myString .= "$" .$module ."_" .$columnName.' = "'. $value."\";\n\n";
  $colName[$i] = $columnName;
  $i++;
  $j=$i;

}

//storing the columnnames in a string

$myString .= "\$globals = \"";

for($i=0;$i<$j-1;$i++)
{
  $myString .= "\\$" .$module ."_" .$colName[$i].", ";
}
$myString .= "\\$" .$module ."_" .$colName[$i];
$myString .="\"; \n\n";

$myString .= "?> \n";

if ($is_writable && ($config_file = @ fopen($root_directory.'/modules/Emails/templates/testemailtemplateusage.php', "w"))) 
	{
        	fputs($config_file, $myString, strlen($myString));
	        fclose($config_file);
	}
$templatename = $root_directory.'/modules/Emails/templates/'.$_REQUEST["templatename"];
header("Location:index.php?module=Users&action=TemplateMerge&templatename=".$templatename);

?>
<script>
window.close()
</script>
