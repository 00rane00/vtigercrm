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
require_once('include/utils.php');
$uploaddir = $_SERVER['DOCUMENT_ROOT'] ."/test/upload/" ;// set this to wherever
//copy the file to some permanent location
if (move_uploaded_file($_FILES["binFile"]["tmp_name"],$uploaddir.$_FILES["binFile"]["name"])) 
{
  $binFile = $_FILES['binFile']['name'];
  $filename = basename($binFile);
    $filetype= $_FILES['binFile']['type'];

    $filesize = $_FILES['binFile']['size'];
    //$data = base64_encode(fread(fopen($uploaddir.$binFile, "r"), $filesize));
    $data = addslashes(fread(fopen($uploaddir.$binFile, "r"), $filesize));
    $textDesc = $_REQUEST['txtDescription'];	
    $strDescription = addslashes($textDesc);
    $fileid = create_guid();
    $date_entered = date('YmdHis');
    //Retreiving the return module and setting the parent type
    $ret_module = $_REQUEST['return_module'];
    $parent_type;		
    if($_REQUEST['return_module'] == 'Leads')
    {
	    $parent_type = 'Lead';
    }
    elseif($_REQUEST['return_module'] == 'Accounts')
    {
	    $parent_type = 'Account';
    }
    elseif($_REQUEST['return_module'] == 'Contacts')
    {
	    $parent_type = 'Contact';
    }
    elseif($_REQUEST['return_module'] == 'Opportunities')
    {
	    $parent_type = 'Opportunity';
    }
   elseif($_REQUEST['return_module'] == 'Cases')
    {
	    $parent_type = 'Case';
    }		

    $parent_id = $_REQUEST['return_id'];	 			

    $sql = "INSERT INTO filestorage ";
    $sql .= "(fileid,date_entered,parent_type,parent_id,data,description, filename, filesize, filetype) ";
    $sql .= "VALUES ('$fileid','$date_entered','$parent_type','$parent_id','$data','$strDescription',";
    $sql .= "'$filename', '$filesize', '$filetype')";
    $result = mysql_query($sql);
    //mysql_free_result($result); 
    //echo "Thank you. The new file was successfully added to our database.<br><br>";
    //echo "<a href='index.php'>Continue</a>";
  mysql_close();
    header("Location: index.php?action=DetailView&module=$ret_module&record=$parent_id");	

} 
else 
{
  $errorCode =  $_FILES['binFile']['error'];
	
  if($errorCode == 4)
  {
   include('themes/'.$theme.'/header.php');
    $errormessage = "<B><font color='red'>Kindly give a valid file for upload!</font></B> <br>" ;
    echo $errormessage;
    include "upload.php";
  }
  else if($errorCode == 2)
  {
    $errormessage = "<B><font color='red'>Sorry, the uploaded file exceeds the maximum filesize limit. Please try a smaller file</font></B> <br>";
    include('themes/'.$theme.'/header.php');
    echo $errormessage;
    include "upload.php";
    //echo $errorCode;
  }
  else if($errorCode == 3)
  {
   include('themes/'.$theme.'/header.php');
    echo "Problems in file upload. Please try again! <br>";
    include "upload.php";
  }
  
}
?>

