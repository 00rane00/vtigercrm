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


//5.0.3 to 5.0.4 database changes - added on 05-09-07
//we have to use the current object (stored in PatchApply.php) to execute the queries
$adb = $_SESSION['adodb_current_object'];
$conn = $_SESSION['adodb_current_object'];

$migrationlog->debug("\n\nDB Changes from 5.0.3 to 5.0.4 -------- Starts \n\n");



/**These two database changes are directly applied in index.php at line 186 to avoid fatal error before starting migration.
 * So that these two lines are commented.
 
	//Added for UserBased TagCloud
		ExecuteQuery("alter table vtiger_users add column tagcloud_view int(1) default 1");
	//Added for the Internal mailer option in Users module - By srini 04-09-07
		ExecuteQuery("alter table vtiger_users add column internal_mailer int(3) NOT NULL default '1'");
 */

//Added when prodving FCK editor feature in Email Templates.
//before using FCK editor we are using text area. it store next line as \n. so we change the \n to <br>when displaying the contents.
//Now we are using FCK editor. So new line character will be automatically saved as <br>//But the contents created with text area still having \n character as next line. So we need to change it to <br>
//this code will get the contents from db and then convert all \n character with <br> and again update in db.

$result=$adb->query("select templateid,body from vtiger_emailtemplates");

for($i=0;$i<$adb->num_rows($result);$i++)
{
$body=addslashes(nl2br($adb->query_result($result,$i,'body')));
$templateid=$adb->query_result($result,$i,'templateid');

$adb->query("update vtiger_emailtemplates set body='".$body."' where templateid=".$templateid);
}



//for Customer Portal Login details
$body='<table width="700" cellspacing="0" cellpadding="0" border="0" align="center" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; font-weight: normal; text-decoration: none; background-color: rgb(122, 122, 254);">
    <tbody>
        <tr>
            <td> </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td> </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td> </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td width="50"> </td>
            <td>
            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <tbody>
                    <tr>
                        <td>
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: rgb(27, 77, 140); font-family: Arial,Helvetica,sans-serif; font-size: 14px; color: rgb(255, 255, 255); font-weight: normal; line-height: 25px;">
                            <tbody>
                                <tr>
                                    <td align="center" rowspan="4">$logo$</td>
                                    <td align="center"> </td>
                                </tr>
                                <tr>
                                    <td align="left" style="background-color: rgb(27, 77, 140); font-family: Arial,Helvetica,sans-serif; font-size: 24px; color: rgb(255, 255, 255); font-weight: bolder; line-height: 35px;">vtiger CRM<br /> </td>
                                </tr>
                                <tr>
                                    <td align="right" style="padding-right: 100px;">The honest Open Source CRM </td>
                                </tr>
                                <tr>
                                    <td> </td>
                                </tr>
                            </tbody>
                        </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; font-weight: normal; color: rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
                            <tbody>
                                <tr>
                                    <td valign="top">
                                    <table width="100%" cellspacing="0" cellpadding="5" border="0">
                                        <tbody>
                                            <tr>
                                                <td align="right" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; font-weight: bolder; text-decoration: none; color: rgb(66, 66, 253);"> </td>
                                            </tr>
                                            <tr>
                                                <td> </td>
                                            </tr>
                                            <tr>
                                                <td style="font-family: Arial,Helvetica,sans-serif; font-size: 14px; color: rgb(22, 72, 134); font-weight: bolder; line-height: 15px;">Dear $contact_name$, </td>
                                            </tr>
                                            <tr>
                                                <td style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; color: rgb(0, 0, 0); font-weight: normal; text-align: justify; line-height: 20px;"> Thank you very much for subscribing to the vtiger CRM - annual support service.<br />Here is your self service portal login details:</td>
                                            </tr>
                                            <tr>
                                                <td align="center">
                                                <table width="75%" cellspacing="0" cellpadding="10" border="0" style="border: 2px solid rgb(180, 180, 179); background-color: rgb(226, 226, 225); font-family: Arial,Helvetica,sans-serif; font-size: 12px; color: rgb(0, 0, 0); font-weight: normal;">
                                                    <tbody>
                                                        <tr>
                                                            <td><br />User ID     : <font color="#990000"><strong> $login_name$</strong></font> </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Password: <font color="#990000"><strong> $password$</strong></font> </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center"> <strong>  $URL$<br /> </strong> </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; color: rgb(0, 0, 0); font-weight: normal; text-align: justify; line-height: 20px;"><strong>NOTE:</strong> We suggest you to change your password after logging in first time. <br /><br /> <strong><u>Help Documentation</u></strong><br />  <br /> After logging in to vtiger Self-service Portal first time, you can access the vtiger CRM documents from the <strong>Documents</strong> tab. Following documents are available for your reference:<br />
                                                <ul>
                                                    <li>Installation Manual (Windows &amp; Linux OS)<br /> </li>
                                                    <li>User &amp; Administrator Manual<br /> </li>
                                                    <li>vtiger Customer Portal - User Manual<br /> </li>
                                                    <li>vtiger Outlook Plugin - User Manual<br /> </li>
                                                    <li>vtiger Office Plug-in - User Manual<br /> </li>
                                                    <li>vtiger Thunderbird Extension - User Manual<br /> </li>
                                                    <li>vtiger Web Forms - User Manual<br /> </li>
                                                    <li>vtiger Firefox Tool bar - User Manual<br /> </li>
                                                </ul>
                                                <br />  <br /> <strong><u>Knowledge Base</u></strong><br /> <br /> Periodically we update frequently asked question based on our customer experiences. You can access the latest articles from the <strong>FAQ</strong> tab.<br /> <br /> <strong><u>vtiger CRM - Details</u></strong><br /> <br /> Kindly let us know your current vtiger CRM version and system specification so that we can provide you necessary guidelines to enhance your vtiger CRM system performance. Based on your system specification we alert you about the latest security &amp; upgrade patches.<br />  <br />			 Thank you once again and wish you a wonderful experience with vtiger CRM.<br /> </td>
                                            </tr>
                                            <tr>
                                                <td align="right"><strong style="padding: 2px; font-family: Arial,Helvetica,sans-serif; font-size: 12px; color: rgb(0, 0, 0); font-weight: bold;"><br /><br />Best Regards</strong></td>
                                            </tr>
                                            <tr>
                                                <td align="right" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; color: rgb(0, 0, 0); font-weight: normal; line-height: 20px;">$support_team$ </td>
                                            </tr>
                                            <tr>
                                                <td align="right"><a style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; font-weight: bolder; text-decoration: none; color: rgb(66, 66, 253);" href="http://www.vtiger.com">www.vtiger.com</a></td>
                                            </tr>
                                            <tr>
                                                <td> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    </td>
                                    <td width="1%" valign="top"> </td>
                                </tr>
                            </tbody>
                        </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <table width="100%" cellspacing="0" cellpadding="5" border="0" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; color: rgb(255, 255, 255); font-weight: normal; line-height: 15px; background-color: rgb(51, 51, 51);">
                            <tbody>
                                <tr>
                                    <td align="center">Shree Narayana Complex, No 11 Sarathy Nagar, Vijaya Nagar , Velachery, Chennai - 600 042 India </td>
                                </tr>
                                <tr>
                                    <td align="center">Telephone No: +91 - 44 - 4202 - 1990     Toll Free No: +1 877 788 4437</td>
                                </tr>
                                <tr>
                                    <td align="center">Email Id: <a style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; font-weight: bolder; text-decoration: none; color: rgb(255, 255, 255);" href="mailto:support@vtiger.com">support@vtiger.com</a></td>
                                </tr>
                            </tbody>
                        </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            </td>
            <td width="50"> </td>
        </tr>
        <tr>
            <td> </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td> </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td> </td>
            <td> </td>
            <td> </td>
        </tr>
    </tbody>
</table>';
	       
$fieldid = $adb->getUniqueID('vtiger_emailtemplates');
$login_id=$fieldid;
$adb->query("insert into vtiger_emailtemplates(foldername,templatename,subject,description,body,deleted,templateid) values ('Public','Customer Login Details','Customer Portal Login Details','Send Portal login details to customer','".$body."',0,".$fieldid.")");


//for Support end notification before a week	       
$body='<table width="700" cellspacing="0" cellpadding="0" border="0" align="center" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; font-weight: normal; text-decoration: none; background-color: rgb(122, 122, 254);">
    <tbody>
        <tr>
            <td> </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td> </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td> </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td width="50"> </td>
            <td>
            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <tbody>
                    <tr>
                        <td>
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: rgb(27, 77, 140); font-family: Arial,Helvetica,sans-serif; font-size: 14px; color: rgb(255, 255, 255); font-weight: normal; line-height: 25px;">
                            <tbody>
                                <tr>
                                    <td align="center" rowspan="4">$logo$</td>
                                    <td align="center"> </td>
                                </tr>
                                <tr>
                                    <td align="left" style="background-color: rgb(27, 77, 140); font-family: Arial,Helvetica,sans-serif; font-size: 24px; color: rgb(255, 255, 255); font-weight: bolder; line-height: 35px;">vtiger CRM </td>
                                </tr>
                                <tr>
                                    <td align="right" style="padding-right: 100px;">The honest Open Source CRM </td>
                                </tr>
                                <tr>
                                    <td> </td>
                                </tr>
                            </tbody>
                        </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; font-weight: normal; color: rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
                            <tbody>
                                <tr>
                                    <td valign="top">
                                    <table width="100%" cellspacing="0" cellpadding="5" border="0">
                                        <tbody>
                                            <tr>
                                                <td align="right" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; font-weight: bolder; text-decoration: none; color: rgb(66, 66, 253);"> </td>
                                            </tr>
                                            <tr>
                                                <td> </td>
                                            </tr>
                                            <tr>
                                                <td style="font-family: Arial,Helvetica,sans-serif; font-size: 14px; color: rgb(22, 72, 134); font-weight: bolder; line-height: 15px;">Dear $contacts-lastname$, </td>
                                            </tr>
                                            <tr>
                                                <td style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; color: rgb(0, 0, 0); font-weight: normal; text-align: justify; line-height: 20px;">This is just a notification mail regarding your support end.<br /><span style="font-weight: bold;">Priority:</span> Urgent<br />Your Support is going to expire on next week<br />Please contact support@vtiger.com.<br /><br /><br /></td>
                                            </tr>
                                            <tr>
                                                <td align="center"><br /></td>
                                            </tr>
                                            <tr>
                                                <td align="right"><strong style="padding: 2px; font-family: Arial,Helvetica,sans-serif; font-size: 12px; color: rgb(0, 0, 0); font-weight: bold;"><br /><br />Sincerly</strong></td>
                                            </tr>
                                            <tr>
                                                <td align="right" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; color: rgb(0, 0, 0); font-weight: normal; line-height: 20px;">Support Team </td>
                                            </tr>
                                            <tr>
                                                <td align="right"><a style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; font-weight: bolder; text-decoration: none; color: rgb(66, 66, 253);" href="http://www.vtiger.com">www.vtiger.com</a></td>
                                            </tr>
                                            <tr>
                                                <td> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    </td>
                                    <td width="1%" valign="top"> </td>
                                </tr>
                            </tbody>
                        </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <table width="100%" cellspacing="0" cellpadding="5" border="0" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; color: rgb(255, 255, 255); font-weight: normal; line-height: 15px; background-color: rgb(51, 51, 51);">
                            <tbody>
                                <tr>
                                    <td align="center">Shree Narayana Complex, No 11 Sarathy Nagar, Vijaya Nagar , Velachery, Chennai - 600 042 India </td>
                                </tr>
                                <tr>
                                    <td align="center">Telephone No: +91 - 44 - 4202 - 1990     Toll Free No: +1 877 788 4437</td>
                                </tr>
                                <tr>
                                    <td align="center">Email Id: <a style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; font-weight: bolder; text-decoration: none; color: rgb(255, 255, 255);" href="mailto:info@vtiger.com">info@vtiger.com</a></td>
                                </tr>
                            </tbody>
                        </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            </td>
            <td width="50"> </td>
        </tr>
        <tr>
            <td> </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td> </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td> </td>
            <td> </td>
            <td> </td>
        </tr>
    </tbody>
</table>';
$fieldid = $adb->getUniqueID('vtiger_emailtemplates');
$week_id=$fieldid;
$adb->query("insert into vtiger_emailtemplates(foldername,templatename,subject,description,body,deleted,templateid) values ('Public','Support end notification before a week','VtigerCRM Support Notification','Send Notification mail to customer before a week of support end date','".$body."',0,".$fieldid.")");




//for Support end notification before a month	       
$body='<table width="700" cellspacing="0" cellpadding="0" border="0" align="center" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; font-weight: normal; text-decoration: none; background-color: rgb(122, 122, 254);">
    <tbody>
        <tr>
            <td> </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td> </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td> </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td width="50"> </td>
            <td>
            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <tbody>
                    <tr>
                        <td>
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: rgb(27, 77, 140); font-family: Arial,Helvetica,sans-serif; font-size: 14px; color: rgb(255, 255, 255); font-weight: normal; line-height: 25px;">
                            <tbody>
                                <tr>
                                    <td align="center" rowspan="4">$logo$</td>
                                    <td align="center"> </td>
                                </tr>
                                <tr>
                                    <td align="left" style="background-color: rgb(27, 77, 140); font-family: Arial,Helvetica,sans-serif; font-size: 24px; color: rgb(255, 255, 255); font-weight: bolder; line-height: 35px;">vtiger CRM </td>
                                </tr>
                                <tr>
                                    <td align="right" style="padding-right: 100px;">The honest Open Source CRM </td>
                                </tr>
                                <tr>
                                    <td> </td>
                                </tr>
                            </tbody>
                        </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; font-weight: normal; color: rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
                            <tbody>
                                <tr>
                                    <td valign="top">
                                    <table width="100%" cellspacing="0" cellpadding="5" border="0">
                                        <tbody>
                                            <tr>
                                                <td align="right" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; font-weight: bolder; text-decoration: none; color: rgb(66, 66, 253);"> </td>
                                            </tr>
                                            <tr>
                                                <td> </td>
                                            </tr>
                                            <tr>
                                                <td style="font-family: Arial,Helvetica,sans-serif; font-size: 14px; color: rgb(22, 72, 134); font-weight: bolder; line-height: 15px;">Dear $contacts-lastname$, </td>
                                            </tr>
                                            <tr>
                                                <td style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; color: rgb(0, 0, 0); font-weight: normal; text-align: justify; line-height: 20px;">This is just a notification mail regarding your support end.<br /><span style="font-weight: bold;">Priority:</span> Normal<br />Your Support is going to expire on next month.<br />Please contact support@vtiger.com<br /><br /><br /></td>
                                            </tr>
                                            <tr>
                                                <td align="center"><br /></td>
                                            </tr>
                                            <tr>
                                                <td align="right"><strong style="padding: 2px; font-family: Arial,Helvetica,sans-serif; font-size: 12px; color: rgb(0, 0, 0); font-weight: bold;"><br /><br />Sincerly</strong></td>
                                            </tr>
                                            <tr>
                                                <td align="right" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; color: rgb(0, 0, 0); font-weight: normal; line-height: 20px;">Support Team </td>
                                            </tr>
                                            <tr>
                                                <td align="right"><a href="http://www.vtiger.com" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; font-weight: bolder; text-decoration: none; color: rgb(66, 66, 253);">www.vtiger.com</a></td>
                                            </tr>
                                            <tr>
                                                <td> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    </td>
                                    <td width="1%" valign="top"> </td>
                                </tr>
                            </tbody>
                        </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <table width="100%" cellspacing="0" cellpadding="5" border="0" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; color: rgb(255, 255, 255); font-weight: normal; line-height: 15px; background-color: rgb(51, 51, 51);">
                            <tbody>
                                <tr>
                                    <td align="center">Shree Narayana Complex, No 11 Sarathy Nagar, Vijaya Nagar , Velachery, Chennai - 600 042 India </td>
                                </tr>
                                <tr>
                                    <td align="center">Telephone No: +91 - 44 - 4202 - 1990     Toll Free No: +1 877 788 4437</td>
                                </tr>
                                <tr>
                                    <td align="center">Email Id: <a href="mailto:info@vtiger.com" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; font-weight: bolder; text-decoration: none; color: rgb(255, 255, 255);">info@vtiger.com</a></td>
                                </tr>
                            </tbody>
                        </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            </td>
            <td width="50"> </td>
        </tr>
        <tr>
            <td> </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td> </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td> </td>
            <td> </td>
            <td> </td>
        </tr>
    </tbody>
</table>';
$fieldid = $adb->getUniqueID('vtiger_emailtemplates');
$month_id=$fieldid;
$adb->query("insert into vtiger_emailtemplates(foldername,templatename,subject,description,body,deleted,templateid) values ('Public','Support end notification before a month','VtigerCRM Support Notification','Send Notification mail to customer before a month of support end date','".$body."',0,".$fieldid.")");



//Queries for Notification scheduler
//to add a new column type in vtiger_notificationscheduler

ExecuteQuery("alter table vtiger_notificationscheduler add column type varchar(10)");

$adb->query("update vtiger_notificationscheduler set notificationbody='".$login_id."',type='select' where schedulednotificationid=5");
$adb->query("update vtiger_notificationscheduler set notificationbody='".$week_id."',type='select' where schedulednotificationid=6");





$adb->query("update vtiger_notificationscheduler set schedulednotificationname='LBL_SUPPORT_DESCRIPTION_MONTH',active='1',notificationsubject='Support end notification',notificationbody='".$month_id."',label='LBL_SUPPORT_NOTICIATION_MONTH',type='select' where schedulednotificationid=7");


$fieldid = $adb->getUniqueID('vtiger_notificationscheduler');
$adb->query("insert into vtiger_notificationscheduler(schedulednotificationid,schedulednotificationname,active,notificationsubject,notificationbody,label,type) values (".$fieldid.",'LBL_ACTIVITY_REMINDER_DESCRIPTION',1,'Activity Reminder Notification','This is a reminder notification for the Activity','LBL_ACTIVITY_NOTIFICATION','')");


//End of Email templates and Notificatin Scheduler changes.


//creating the new tables vtiger_picklist,vtiger_picklist_seq and vtiger_role2picklist
$adb->query("CREATE TABLE `vtiger_picklist` (`picklistid` int(19) NOT NULL auto_increment,`name` varchar(200) NOT NULL,PRIMARY KEY (`picklistid`),UNIQUE KEY `picklist_name_idx` (`name`)) ENGINE=InnoDB ");

$adb->query("CREATE TABLE `vtiger_role2picklist` (
`roleid` varchar(255) NOT NULL,
`picklistvalueid` int(11) NOT NULL,
`picklistid` int(11) NOT NULL,
`sortid` int(11) default NULL,
PRIMARY KEY (`roleid`,`picklistvalueid`,`picklistid`),
KEY `role2picklist_roleid_picklistid_idx` (`roleid`,`picklistid`,`picklistvalueid`),
KEY `fk_2_vtiger_role2picklist` (`picklistid`),
CONSTRAINT `fk_2_vtiger_role2picklist` FOREIGN KEY (`picklistid`) REFERENCES `vtiger_picklist` (`picklistid`) ON DELETE CASCADE,
CONSTRAINT `fk_1_vtiger_role2picklist` FOREIGN KEY (`roleid`) REFERENCES `vtiger_role` (`roleid`) ON DELETE CASCADE) ENGINE=InnoDB ");

$adb->query("CREATE TABLE `vtiger_picklistvalues_seq` (`id` int(11) NOT NULL)");
$adb->query("insert into vtiger_picklistvalues_seq values(1)");
//Alter picklist tables
$picklist_arr = array('leadsource','accounttype','industry','leadstatus','rating','opportunity_type','salutationtype','sales_stage','ticketstatus','ticketpriorities','ticketseverities','ticketcategories','eventstatus','taskstatus','taskpriority','manufacturer','productcategory','faqcategories','usageunit','glacct','quotestage','carrier','faqstatus','invoicestatus','postatus','sostatus','campaigntype','campaignstatus','expectedresponse');

$custom_result = $adb->query("select * from vtiger_field where (uitype=15 or uitype=33) and fieldname like '%cf_%'");
$numrow = $adb->num_rows($custom_result);
for($i=0; $i < $numrow; $i++)
{
	$picklist_arr[] = $adb->query_result($custom_result,$i,'fieldname');
}

for($i=0;$i<count($picklist_arr); $i++)
{
	alter_picklist_tables($picklist_arr[$i]);
	insert_picklist_table($picklist_arr[$i]);
}

//Function to modify picklist table columns
function alter_picklist_tables($table_name)
{
global $adb;
	$adb->query("alter table vtiger_$table_name drop column sortorderid");
	$adb->query("alter table vtiger_$table_name add column picklist_valueid int(19) not null default '0'");
}

//Inserting values on vtiger_picklist tables
function insert_picklist_table($picklist)
{
	global $adb;
	$picklist_uniqueid = $adb->getUniqueID("vtiger_picklist");
	$adb->query("insert into vtiger_picklist values('$picklist_uniqueid','$picklist')");
	insert_values($picklist,$picklist_uniqueid);
}

//Function to insert values on vtiger_role2picklist table and updating the values for picklist tables
function insert_values($picklist,$picklistid)
{
	global $adb;
	$result = $adb->query("select * from vtiger_$picklist");
	$numrow = $adb->num_rows($result);
	for($i=0; $i < $numrow; $i++)
	{
		$picklist_name = $adb->query_result($result,$i,$picklist);
		$picklist_valueid = getUniquePicklistID();
		$adb->query("update vtiger_$picklist set picklist_valueid='$picklist_valueid' where $picklist='$picklist_name'");
		$sql="select roleid from vtiger_role";
		$role_result = $adb->query($sql);
		$numrows = $adb->num_rows($role_result);
		for($k=0; $k < $numrows; $k++)
		{
			$roleid = $adb->query_result($role_result,$k,'roleid');
			$adb->query("insert into vtiger_role2picklist values('".$roleid."',".$picklist_valueid.",$picklistid,".$i.")");
		}
	}
}



//drop the column description in troubletickets table -- by liza on 30-08-2007
ExecuteQuery("update vtiger_field set tablename='vtiger_crmentity' where tabid =13 and fieldname='description'");
ExecuteQuery("update vtiger_crmentity inner join vtiger_troubletickets on vtiger_troubletickets.ticketid=vtiger_crmentity.crmid  set vtiger_crmentity.description=vtiger_troubletickets.description");
ExecuteQuery("alter table vtiger_troubletickets drop column description");


//Changed the ordinary field to mandatory field for the field EventStatus??(Event Module)
//Changing the typeofdata as "V~M" from "V~O"--added by Bharath 30-08-07
ExecuteQuery("update vtiger_field set typeofdata='V~M' where tabid=16 and columnname='eventstatus'");

//Modified the vtiger_mail_accounts for change password in incoming mail server settings - by srini 04-09-07
ExecuteQuery("alter table vtiger_mail_accounts modify column mail_password varchar(150)");

//Modified the vtiger_portal table for make as default option in Mysites - by srini 04-09-07
ExecuteQuery("alter table vtiger_portal add column setdefault int(3) NOT NULL default '0'");

//Modifed the quantity field from integer to decimal -By shahul
//Added to fix the ticket # 4119
ExecuteQuery("alter table vtiger_inventoryproductrel modify column quantity decimal(25,3)");

//4065 -- to support email address as a user name -- by bharathi

//ALTER TABLE vtiger_users MODIFY user_name varchar(100);

//added for the ticket#4109 -- by bharathi
ExecuteQuery("update vtiger_relatedlists set sequence=sequence+1 where tabid=6 and sequence>6");
ExecuteQuery("insert into vtiger_relatedlists values(".$adb->getUniqueID("vtiger_relatedlists").",6,10,'get_emails',7,'Emails',0)");

//added by Dinakaran for the ticket(http://trac.vtiger.com/cgi-bin/trac.cgi/ticket/4125) Date:24/08/2007
ExecuteQuery("alter table vtiger_attachments add column subject varchar(200)");

//Added by mangai regarding performance 

ExecuteQuery("ALTER TABLE vtiger_cntactivityrel ADD CONSTRAINT fk_1_vtiger_cntactivityrel FOREIGN KEY (`activityid`) REFERENCES `vtiger_activity` (`activityid`) ON DELETE CASCADE");

ExecuteQuery("ALTER TABLE vtiger_recurringevents ADD CONSTRAINT fk_1_vtiger_recurringevents FOREIGN KEY(activityid) REFERENCES vtiger_activity(activityid)");

ExecuteQuery("alter table vtiger_activity add column recurringtype varchar(30) default NULL");

ExecuteQuery("UPDATE vtiger_field SET tablename='vtiger_activity' where fieldname='recurringtype'");

ExecuteQuery("update vtiger_activity inner join vtiger_recurringevents on vtiger_recurringevents.activityid=vtiger_activity.activityid set vtiger_activity.recurringtype = vtiger_recurringevents.recurringtype");

//Added for the fix 3919 by akilan on 20th september
ExecuteQuery("update vtiger_field set uitype=255 where tabid in (7,4) and columnname='lastname'");

//We need to remove the field team from quotes. To avoid data loss, we need to create a new custom field and to move the team field values into the newly created sutom field.	

//Getting the biggest custom field name
$query="select max(fieldname) as maxfieldname from vtiger_field where fieldname like 'cf_%'";
$result = $adb->query($query);
$max_cf_name=$adb->query_result($result,0,'maxfieldname');
//Forming New custom field by incrementing the biggest custom field name
$splitted=explode("_",$max_cf_name);
$new_cf_name=$splitted[0]."_".($splitted[1]+1);

//Getting block id for custom information
$blockid = $adb->query_result($adb->query("select blockid from vtiger_blocks where tabid=20 and blocklabel = 'LBL_CUSTOM_INFORMATION'"),0,'blockid');

//Getting the sequence
$seq = $adb->query_result($adb->query("select max(sequence) as seq from vtiger_field where block=".$blockid." and tabid=20"),0,'seq');

//Removing the Team field from field table.
ExecuteQuery("delete from vtiger_field where tabid=20 and fieldname = 'team' and columnname='team'");
//Creating new Custom field for quotes module and populating security entries.

$newfieldid=$adb->getUniqueID("vtiger_field");
$query="insert into vtiger_field values(20,".$newfieldid.",'".$new_cf_name."','vtiger_quotescf',2,1,'".$new_cf_name."','Team',0,0,0,100,".($seq+1).",".$blockid.",1,'V~O~LE~30',1,0,'BAS')";
$result = $adb->query($query);


//Populate security entries for this new field
$profileresult = $adb->query("select * from vtiger_profile");
$countprofiles = $adb->num_rows($profileresult);
for($i=0;$i<$countprofiles;$i++)
{
	$profileid = $adb->query_result($profileresult,$i,'profileid');
	$sqlProf2FieldInsert[$i] = 'insert into vtiger_profile2field values ('.$profileid.',20,'.$newfieldid.',0,1)';
	ExecuteQuery($sqlProf2FieldInsert[$i]);
}
$def_query = "insert into vtiger_def_org_field values (20,".$newfieldid.",0,1)";
ExecuteQuery($def_query);
//End of security popullation

ExecuteQuery("ALTER TABLE vtiger_quotescf ADD ".$new_cf_name." VARCHAR(100)");

//Copying all the existing values for team field in vtiger_quotes table into vtiger_quotescf table. ie, moving values from team field into a new custom field.
ExecuteQuery("update vtiger_quotescf inner join vtiger_quotes on vtiger_quotescf.quoteid=vtiger_quotes.quoteid set ".$new_cf_name."=vtiger_quotes.team");

//If any custom view referring to the deleted field 'team' then we need to update it to point the newly created custom field.
ExecuteQuery("update vtiger_cvcolumnlist set columnname='vtiger_quotescf:".$new_cf_name.":".$new_cf_name.":Quotes_Team:V' where columnname='vtiger_quotes:team:team:Quotes_Team:V'");
ExecuteQuery("update vtiger_cvadvfilter set columnname='vtiger_quotescf:".$new_cf_name.":".$new_cf_name.":Quotes_Team:V' where columnname='vtiger_quotes:team:team:Quotes_Team:V'");
//Removing the team column from the vtiger_quotes table
ExecuteQuery("ALTER TABLE vtiger_quotes drop team");

$migrationlog->debug("\n\nDB Changes from 5.0.3 to 5.0.4 -------- Ends \n\n");

?>