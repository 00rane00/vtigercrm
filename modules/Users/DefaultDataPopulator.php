<?php

/*********************************************************************************
** The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ********************************************************************************/

include_once('config.php');
require_once('include/logging.php');
require_once('include/database/PearDatabase.php');
require_once('data/SugarBean.php');
require_once('data/CRMEntity.php');
require_once('include/utils/utils.php');

/** Class to populate the default required data during installation  
 */

class DefaultDataPopulator extends CRMEntity {
		
	function DefaultDataPopulator() {
		$this->log = LoggerManager::getLogger('DefaultDataPopulator');
		$this->db = new PearDatabase();
	}

	var $new_schema = true;


	/** Function to populate the default required data during installation  
 	*/
	function create_tables () {
		global $app_strings;

		$role1_id = $this->db->getUniqueID("vtiger_role");
		$role2_id = $this->db->getUniqueID("vtiger_role");
		$role3_id = $this->db->getUniqueID("vtiger_role");
		$role4_id = $this->db->getUniqueID("vtiger_role");
		$role5_id = $this->db->getUniqueID("vtiger_role");

		$profile1_id = $this->db->getUniqueID("vtiger_profile");
		$profile2_id = $this->db->getUniqueID("vtiger_profile");
		$profile3_id = $this->db->getUniqueID("vtiger_profile");
		$profile4_id = $this->db->getUniqueID("vtiger_profile");

                $this->db->query("insert into vtiger_role values('H".$role1_id."','Organisation','H".$role1_id."',0)");
                $this->db->query("insert into vtiger_role values('H".$role2_id."','CEO','H".$role1_id."::H".$role2_id."',1)");
                $this->db->query("insert into vtiger_role values('H".$role3_id."','Vice President','H".$role1_id."::H".$role2_id."::H".$role3_id."',2)");
                $this->db->query("insert into vtiger_role values('H".$role4_id."','Sales Manager','H".$role1_id."::H".$role2_id."::H".$role3_id."::H".$role4_id."',3)");
                $this->db->query("insert into vtiger_role values('H".$role5_id."','Sales Man','H".$role1_id."::H".$role2_id."::H".$role3_id."::H".$role4_id."::H".$role5_id."',4)");
                

 $this->db->query("INSERT INTO vtiger_tab VALUES (3,'Home',0,1,'Home',null,null,0,1)");
 $this->db->query("INSERT INTO vtiger_tab VALUES (7,'Leads',0,4,'Leads',null,null,0,0)");
 $this->db->query("INSERT INTO vtiger_tab VALUES (6,'Accounts',0,5,'Accounts',null,null,0,0)");
 $this->db->query("INSERT INTO vtiger_tab VALUES (4,'Contacts',0,6,'Contacts',null,null,0,0)");
 $this->db->query("INSERT INTO vtiger_tab VALUES (2,'Potentials',0,7,'Potentials',null,null,0,0)");
 $this->db->query("INSERT INTO vtiger_tab VALUES (8,'Documents',0,9,'Documents',null,null,0,0)");
 $this->db->query("INSERT INTO vtiger_tab VALUES (9,'Calendar',0,3,'Calendar',null,null,0,0)");
 $this->db->query("INSERT INTO vtiger_tab VALUES (10,'Emails',0,10,'Emails',null,null,0,1)");
 $this->db->query("INSERT INTO vtiger_tab VALUES (13,'HelpDesk',0,11,'HelpDesk',null,null,0,0)");
 $this->db->query("INSERT INTO vtiger_tab VALUES (14,'Products',0,8,'Products',null,null,0,1)");
 $this->db->query("INSERT INTO vtiger_tab VALUES (1,'Dashboard',0,12,'Dashboards',null,null,0,1)");
 $this->db->query("INSERT INTO vtiger_tab VALUES (15,'Faq',0,14,'Faq',null,null,0,1)");
 $this->db->query("INSERT INTO vtiger_tab VALUES (16,'Events',2,13,'Events',null,null,0,0)");
 $this->db->query("INSERT INTO vtiger_tab VALUES (18,'Vendors',0,15,'Vendors',null,null,0,1)");
 $this->db->query("INSERT INTO vtiger_tab VALUES (19,'PriceBooks',0,16,'PriceBooks',null,null,0,1)");
 $this->db->query("INSERT INTO vtiger_tab VALUES (20,'Quotes',0,17,'Quotes',null,null,0,0)");
 $this->db->query("INSERT INTO vtiger_tab VALUES (21,'PurchaseOrder',0,18,'PurchaseOrder',null,null,0,0)");
 $this->db->query("INSERT INTO vtiger_tab VALUES (22,'SalesOrder',0,19,'SalesOrder',null,null,0,0)");
 $this->db->query("INSERT INTO vtiger_tab VALUES (23,'Invoice',0,20,'Invoice',null,null,0,0)");
 $this->db->query("INSERT INTO vtiger_tab VALUES (24,'Rss',0,21,'Rss',null,null,0,1)");
 $this->db->query("INSERT INTO vtiger_tab VALUES (25,'Reports',0,22,'Reports',null,null,0,1)");
 $this->db->query("INSERT INTO vtiger_tab VALUES (26,'Campaigns',0,23,'Campaigns',null,null,0,0)");
 $this->db->query("INSERT INTO vtiger_tab VALUES (27,'Portal',0,24,'Portal',null,null,0,1)");
 $this->db->query("INSERT INTO vtiger_tab VALUES (28,'Webmails',0,25,'Webmails',null,null,0,1)");
 $this->db->query("insert into vtiger_tab values (29,'Users',0,26,'Users',null,null,0,1)");
 $this->db->query("insert into vtiger_tab values(30,'Recyclebin',0,27,'Recyclebin',null,null,0,1)");

// Populate the vtiger_blocks vtiger_table
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",2,'LBL_OPPORTUNITY_INFORMATION',1,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",2,'LBL_CUSTOM_INFORMATION',2,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",2,'LBL_DESCRIPTION_INFORMATION',3,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",4,'LBL_CONTACT_INFORMATION',1,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",4,'LBL_CUSTOM_INFORMATION',2,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",4,'LBL_CUSTOMER_PORTAL_INFORMATION',3,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",4,'LBL_ADDRESS_INFORMATION',4,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",4,'LBL_DESCRIPTION_INFORMATION',6,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",6,'LBL_ACCOUNT_INFORMATION',1,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",6,'LBL_CUSTOM_INFORMATION',2,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",6,'LBL_ADDRESS_INFORMATION',3,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",6,'LBL_DESCRIPTION_INFORMATION',4,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",7,'LBL_LEAD_INFORMATION',1,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",7,'LBL_CUSTOM_INFORMATION',2,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",7,'LBL_ADDRESS_INFORMATION',3,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",7,'LBL_DESCRIPTION_INFORMATION',4,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",8,'LBL_NOTE_INFORMATION',1,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",8,'',2,1,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",9,'LBL_TASK_INFORMATION',1,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",9,'',2,1,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",10,'LBL_EMAIL_INFORMATION',1,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",10,'',2,1,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",10,'',3,1,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",10,'',4,1,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",13,'LBL_TICKET_INFORMATION',1,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",13,'',2,1,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",13,'LBL_CUSTOM_INFORMATION',3,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",13,'LBL_DESCRIPTION_INFORMATION',4,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",13,'LBL_TICKET_RESOLUTION',5,0,0,1,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",13,'LBL_COMMENTS',6,0,0,1,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",14,'LBL_PRODUCT_INFORMATION',1,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",14,'LBL_PRICING_INFORMATION',2,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",14,'LBL_STOCK_INFORMATION',3,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",14,'LBL_CUSTOM_INFORMATION',4,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",14,'LBL_IMAGE_INFORMATION',5,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",14,'LBL_DESCRIPTION_INFORMATION',6,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",15,'LBL_FAQ_INFORMATION',1,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",15,'',2,1,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",15,'',3,1,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",15,'LBL_COMMENT_INFORMATION',4,0,0,1,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",16,'LBL_EVENT_INFORMATION',1,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",16,'',2,1,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",16,'',3,1,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",18,'LBL_VENDOR_INFORMATION',1,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",18,'LBL_CUSTOM_INFORMATION',2,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",18,'LBL_VENDOR_ADDRESS_INFORMATION',3,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",18,'LBL_DESCRIPTION_INFORMATION',4,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",19,'LBL_PRICEBOOK_INFORMATION',1,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",19,'LBL_CUSTOM_INFORMATION',2,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",19,'LBL_DESCRIPTION_INFORMATION',3,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",20,'LBL_QUOTE_INFORMATION',1,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",20,'LBL_CUSTOM_INFORMATION',2,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",20,'LBL_ADDRESS_INFORMATION',3,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",20,'LBL_RELATED_PRODUCTS',4,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",20,'LBL_TERMS_INFORMATION',5,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",20,'LBL_DESCRIPTION_INFORMATION',6,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",21,'LBL_PO_INFORMATION',1,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",21,'LBL_CUSTOM_INFORMATION',2,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",21,'LBL_ADDRESS_INFORMATION',3,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",21,'LBL_RELATED_PRODUCTS',4,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",21,'LBL_TERMS_INFORMATION',5,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",21,'LBL_DESCRIPTION_INFORMATION',6,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",22,'LBL_SO_INFORMATION',1,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",22,'LBL_CUSTOM_INFORMATION',2,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",22,'LBL_ADDRESS_INFORMATION',3,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",22,'LBL_RELATED_PRODUCTS',4,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",22,'LBL_TERMS_INFORMATION',5,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",22,'LBL_DESCRIPTION_INFORMATION',6,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",23,'LBL_INVOICE_INFORMATION',1,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",23,'LBL_CUSTOM_INFORMATION',2,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",23,'LBL_ADDRESS_INFORMATION',3,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",23,'LBL_RELATED_PRODUCTS',4,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",23,'LBL_TERMS_INFORMATION',5,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",23,'LBL_DESCRIPTION_INFORMATION',6,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",4,'LBL_IMAGE_INFORMATION',5,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",26,'LBL_CAMPAIGN_INFORMATION',1,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",26,'LBL_CUSTOM_INFORMATION',2,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",26,'LBL_EXPECTATIONS_AND_ACTUALS',3,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",29,'LBL_USERLOGIN_ROLE',1,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",29,'LBL_MORE_INFORMATION',2,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",29,'LBL_ADDRESS_INFORMATION',3,0,0,0,0,0,1)");
//Added an extra block for new UI Settings in Campaigns module 
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",26,'LBL_DESCRIPTION_INFORMATION',4,0,0,0,0,0,1)");
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",29,'LBL_USER_IMAGE_INFORMATION',4,0,0,0,0,0,1)"); //Added a New Block User Image Info in Users Module
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",29,'LBL_USER_ADV_OPTIONS',5,0,0,0,0,0,1)"); //Added a New Block User Image Info in Users Module
//Added block 'File Information' to Documents module
$this->db->query("insert into vtiger_blocks values (".$this->db->getUniqueID('vtiger_blocks').",8,'LBL_FILE_INFORMATION',3,0,0,0,0,0,1)");

//Start: Entries for vtiger_os table in Documents module
$this->db->query("insert into vtiger_os values(1,'Windows',0,1)");
$this->db->query("insert into vtiger_os values(2,'Linux',1,1)");
$this->db->query("insert into vtiger_os values(3,'Mac',2,1)");
//End: Entries for vtiger_os table in Documents module

//Account Details -- START
 //Block9

$this->db->query("insert into vtiger_field values (6,".$this->db->getUniqueID("vtiger_field").",'accountname','vtiger_account',1,'2','accountname','Account Name',1,0,0,100,1,9,1,'V~M',0,1,'BAS')");	
 $this->db->query("insert into vtiger_field values (6,".$this->db->getUniqueID("vtiger_field").",'phone','vtiger_account',1,'11','phone','Phone',1,0,0,100,2,9,1,'V~O',0,2,'BAS')");	
 $this->db->query("insert into vtiger_field values (6,".$this->db->getUniqueID("vtiger_field").",'website','vtiger_account',1,'17','website','Website',1,0,0,100,3,9,1,'V~O',0,3,'BAS')");	

 $this->db->query("insert into vtiger_field values (6,".$this->db->getUniqueID("vtiger_field").",'fax','vtiger_account',1,'1','fax','Fax',1,0,0,100,4,9,1,'V~O',1,null,'BAS')");	
 $this->db->query("insert into vtiger_field values (6,".$this->db->getUniqueID("vtiger_field").",'tickersymbol','vtiger_account',1,'1','tickersymbol','Ticker Symbol',1,0,0,100,5,9,1,'V~O',1,null,'BAS')");	
 $this->db->query("insert into vtiger_field values (6,".$this->db->getUniqueID("vtiger_field").",'otherphone','vtiger_account',1,'11','otherphone','Other Phone',1,0,0,100,6,9,1,'V~O',1,null,'ADV')");
 $this->db->query("insert into vtiger_field values (6,".$this->db->getUniqueID("vtiger_field").",'parentid','vtiger_account',1,'51','account_id','Member Of',1,0,0,100,7,9,1,'I~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (6,".$this->db->getUniqueID("vtiger_field").",'email1','vtiger_account',1,'13','email1','Email',1,0,0,100,8,9,1,'E~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (6,".$this->db->getUniqueID("vtiger_field").",'employees','vtiger_account',1,'7','employees','Employees',1,0,0,100,9,9,1,'I~O',1,null,'ADV')");
 $this->db->query("insert into vtiger_field values (6,".$this->db->getUniqueID("vtiger_field").",'email2','vtiger_account',1,'13','email2','Other Email',1,0,0,100,10,9,1,'E~O',1,null,'ADV')");

 $this->db->query("insert into vtiger_field values (6,".$this->db->getUniqueID("vtiger_field").",'ownership','vtiger_account',1,'1','ownership','Ownership',1,0,0,100,11,9,1,'V~O',1,null,'ADV')");
 $this->db->query("insert into vtiger_field values (6,".$this->db->getUniqueID("vtiger_field").",'rating','vtiger_account',1,'15','rating','Rating',1,0,0,100,12,9,1,'V~O',1,null,'ADV')");
 $this->db->query("insert into vtiger_field values (6,".$this->db->getUniqueID("vtiger_field").",'industry','vtiger_account',1,'15','industry','industry',1,0,0,100,13,9,1,'V~O',1,null,'ADV')");
 $this->db->query("insert into vtiger_field values (6,".$this->db->getUniqueID("vtiger_field").",'siccode','vtiger_account',1,'1','siccode','SIC Code',1,0,0,100,14,9,1,'V~O',1,null,'ADV')");
 $this->db->query("insert into vtiger_field values (6,".$this->db->getUniqueID("vtiger_field").",'account_type','vtiger_account',1,'15','accounttype','Type',1,0,0,100,15,9,1,'V~O',1,null,'ADV')");
 $this->db->query("insert into vtiger_field values (6,".$this->db->getUniqueID("vtiger_field").",'annualrevenue','vtiger_account',1,'71','annual_revenue','Annual Revenue',1,0,0,100,16,9,1,'I~O',1,null,'ADV')");
 //Added vtiger_field emailoptout for vtiger_accounts -- after 4.2 patch2
 $this->db->query("insert into vtiger_field values (6,".$this->db->getUniqueID("vtiger_field").",'emailoptout','vtiger_account',1,'56','emailoptout','Email Opt Out',1,0,0,100,17,9,1,'C~O',1,null,'ADV')");
 $this->db->query("insert into vtiger_field values (6,".$this->db->getUniqueID("vtiger_field").",'notify_owner','vtiger_account',1,56,'notify_owner','Notify Owner',1,0,0,10,18,9,1,'C~O',1,NULL,'ADV')");
 $this->db->query("insert into vtiger_field values (6,".$this->db->getUniqueID("vtiger_field").",'smownerid','vtiger_crmentity',1,'53','assigned_user_id','Assigned To',1,0,0,100,19,9,1,'V~M',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (6,".$this->db->getUniqueID("vtiger_field").",'createdtime','vtiger_crmentity',1,'70','createdtime','Created Time',1,0,0,100,20,9,2,'T~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (6,".$this->db->getUniqueID("vtiger_field").",'modifiedtime','vtiger_crmentity',1,'70','modifiedtime','Modified Time',1,0,0,100,21,9,2,'T~O',1,null,'BAS')");




 //Block 11
$this->db->query("insert into vtiger_field values (6,".$this->db->getUniqueID("vtiger_field").",'bill_street','vtiger_accountbillads',1,'21','bill_street','Billing Address',1,0,0,100,1,11,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (6,".$this->db->getUniqueID("vtiger_field").",'ship_street','vtiger_accountshipads',1,'21','ship_street','Shipping Address',1,0,0,100,2,11,1,'V~O',1,null,'BAS')");

 $this->db->query("insert into vtiger_field values (6,".$this->db->getUniqueID("vtiger_field").",'bill_city','vtiger_accountbillads',1,'1','bill_city','Billing City',1,0,0,100,5,11,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (6,".$this->db->getUniqueID("vtiger_field").",'ship_city','vtiger_accountshipads',1,'1','ship_city','Shipping City',1,0,0,100,6,11,1,'V~O',1,null,'BAS')");

 $this->db->query("insert into vtiger_field values (6,".$this->db->getUniqueID("vtiger_field").",'bill_state','vtiger_accountbillads',1,'1','bill_state','Billing State',1,0,0,100,7,11,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (6,".$this->db->getUniqueID("vtiger_field").",'ship_state','vtiger_accountshipads',1,'1','ship_state','Shipping State',1,0,0,100,8,11,1,'V~O',1,null,'BAS')");

 $this->db->query("insert into vtiger_field values (6,".$this->db->getUniqueID("vtiger_field").",'bill_code','vtiger_accountbillads',1,'1','bill_code','Billing Code',1,0,0,100,9,11,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (6,".$this->db->getUniqueID("vtiger_field").",'ship_code','vtiger_accountshipads',1,'1','ship_code','Shipping Code',1,0,0,100,10,11,1,'V~O',1,null,'BAS')");


 $this->db->query("insert into vtiger_field values (6,".$this->db->getUniqueID("vtiger_field").",'bill_country','vtiger_accountbillads',1,'1','bill_country','Billing Country',1,0,0,100,11,11,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (6,".$this->db->getUniqueID("vtiger_field").",'ship_country','vtiger_accountshipads',1,'1','ship_country','Shipping Country',1,0,0,100,12,11,1,'V~O',1,null,'BAS')");

$this->db->query("insert into vtiger_field values (6,".$this->db->getUniqueID("vtiger_field").",'bill_pobox','vtiger_accountbillads',1,'1','bill_pobox','Billing Po Box',1,0,0,100,3,11,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (6,".$this->db->getUniqueID("vtiger_field").",'ship_pobox','vtiger_accountshipads',1,'1','ship_pobox','Shipping Po Box',1,0,0,100,4,11,1,'V~O',1,null,'BAS')");


 //Block12
$this->db->query("insert into vtiger_field values (6,".$this->db->getUniqueID("vtiger_field").",'description','vtiger_crmentity',1,'19','description','Description',1,0,0,100,1,12,1,'V~O',1,null,'BAS')");
 


//Account Details -- END

			
//Lead Details --- START

//Block13 -- Start

$this->db->query("insert into vtiger_field values (7,".$this->db->getUniqueID("vtiger_field").",'salutation','vtiger_leaddetails',1,'55','salutationtype','Salutation',1,0,0,100,1,13,3,'V~O',1,null,'BAS')");	
 $this->db->query("insert into vtiger_field values (7,".$this->db->getUniqueID("vtiger_field").",'firstname','vtiger_leaddetails',1,'55','firstname','First Name',1,0,0,100,2,13,1,'V~O',0,1,'BAS')");	
 $this->db->query("insert into vtiger_field values (7,".$this->db->getUniqueID("vtiger_field").",'phone','vtiger_leadaddress',1,'11','phone','Phone',1,0,0,100,3,13,1,'V~O',0,4,'BAS')");	

 $this->db->query("insert into vtiger_field values (7,".$this->db->getUniqueID("vtiger_field").",'lastname','vtiger_leaddetails',1,'255','lastname','Last Name',1,0,0,100,4,13,1,'V~M',0,2,'BAS')");	
 $this->db->query("insert into vtiger_field values (7,".$this->db->getUniqueID("vtiger_field").",'mobile','vtiger_leadaddress',1,'1','mobile','Mobile',1,0,0,100,5,13,1,'V~O',1,null,'BAS')");	
 $this->db->query("insert into vtiger_field values (7,".$this->db->getUniqueID("vtiger_field").",'company','vtiger_leaddetails',1,'2','company','Company',1,0,0,100,6,13,1,'V~M',0,3,'BAS')");
 $this->db->query("insert into vtiger_field values (7,".$this->db->getUniqueID("vtiger_field").",'fax','vtiger_leadaddress',1,'1','fax','Fax',1,0,0,100,7,13,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (7,".$this->db->getUniqueID("vtiger_field").",'designation','vtiger_leaddetails',1,'1','designation','Designation',1,0,0,100,8,13,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (7,".$this->db->getUniqueID("vtiger_field").",'email','vtiger_leaddetails',1,'13','email','Email',1,0,0,100,9,13,1,'E~O',0,5,'BAS')");
 $this->db->query("insert into vtiger_field values (7,".$this->db->getUniqueID("vtiger_field").",'leadsource','vtiger_leaddetails',1,'15','leadsource','Lead Source',1,0,0,100,10,13,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (7,".$this->db->getUniqueID("vtiger_field").",'website','vtiger_leadsubdetails',1,'17','website','Website',1,0,0,100,11,13,1,'V~O',1,null,'ADV')");
 $this->db->query("insert into vtiger_field values (7,".$this->db->getUniqueID("vtiger_field").",'industry','vtiger_leaddetails',1,'15','industry','Industry',1,0,0,100,12,13,1,'V~O',1,null,'ADV')");
 $this->db->query("insert into vtiger_field values (7,".$this->db->getUniqueID("vtiger_field").",'leadstatus','vtiger_leaddetails',1,'15','leadstatus','Lead Status',1,0,0,100,13,13,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (7,".$this->db->getUniqueID("vtiger_field").",'annualrevenue','vtiger_leaddetails',1,'71','annualrevenue','Annual Revenue',1,0,0,100,14,13,1,'I~O',1,null,'ADV')");
 $this->db->query("insert into vtiger_field values (7,".$this->db->getUniqueID("vtiger_field").",'rating','vtiger_leaddetails',1,'15','rating','Rating',1,0,0,100,15,13,1,'V~O',1,null,'ADV')");
 $this->db->query("insert into vtiger_field values (7,".$this->db->getUniqueID("vtiger_field").",'noofemployees','vtiger_leaddetails',1,'1','noofemployees','No Of Employees',1,0,0,100,16,13,1,'I~O',1,null,'ADV')");
 $this->db->query("insert into vtiger_field values (7,".$this->db->getUniqueID("vtiger_field").",'smownerid','vtiger_crmentity',1,'53','assigned_user_id','Assigned To',1,0,0,100,17,13,1,'V~M',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (7,".$this->db->getUniqueID("vtiger_field").",'yahooid','vtiger_leaddetails',1,'13','yahooid','Yahoo Id',1,0,0,100,18,13,1,'E~O',1,null,'ADV')");
$this->db->query("insert into vtiger_field values (7,".$this->db->getUniqueID("vtiger_field").",'createdtime','vtiger_crmentity',1,'70','createdtime','Created Time',1,0,0,100,19,13,2,'T~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (7,".$this->db->getUniqueID("vtiger_field").",'modifiedtime','vtiger_crmentity',1,'70','modifiedtime','Modified Time',1,0,0,100,20,13,2,'T~O',1,null,'BAS')");

//Block13 -- End


//Block15 -- Start

$this->db->query("insert into vtiger_field values (7,".$this->db->getUniqueID("vtiger_field").",'lane','vtiger_leadaddress',1,'21','lane','Street',1,0,0,100,1,15,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (7,".$this->db->getUniqueID("vtiger_field").",'code','vtiger_leadaddress',1,'1','code','Postal Code',1,0,0,100,3,15,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (7,".$this->db->getUniqueID("vtiger_field").",'city','vtiger_leadaddress',1,'1','city','City',1,0,0,100,4,15,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (7,".$this->db->getUniqueID("vtiger_field").",'country','vtiger_leadaddress',1,'1','country','Country',1,0,0,100,5,15,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (7,".$this->db->getUniqueID("vtiger_field").",'state','vtiger_leadaddress',1,'1','state','State',1,0,0,100,6,15,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (7,".$this->db->getUniqueID("vtiger_field").",'pobox','vtiger_leadaddress',1,'1','pobox','Po Box',1,0,0,100,2,15,1,'V~O',1,null,'BAS')");

//Block15 --End

//Block16 -- Start

$this->db->query("insert into vtiger_field values (7,".$this->db->getUniqueID("vtiger_field").",'description','vtiger_crmentity',1,'19','description','Description',1,0,0,100,1,16,1,'V~O',1,null,'BAS')");

//Block16 -- End

//Lead Details -- END


//Contact Details -- START
//Block4 -- Start

$this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'salutation','vtiger_contactdetails',1,'55','salutationtype','Salutation',1,0,0,100,1,4,3,'V~O',1,null,'BAS')");	
 $this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'firstname','vtiger_contactdetails',1,'55','firstname','First Name',1,0,0,100,2,4,1,'V~O',0,1,'BAS')");	
 $this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'phone','vtiger_contactdetails',1,'11','phone','Office Phone',1,0,0,100,3,4,1,'V~O',0,4,'BAS')");	
 $this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'lastname','vtiger_contactdetails',1,'255','lastname','Last Name',1,0,0,100,4,4,1,'V~M',0,2,'BAS')");	
 $this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'mobile','vtiger_contactdetails',1,'1','mobile','Mobile',1,0,0,100,5,4,1,'V~O',1,null,'BAS')");	
 $this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'accountid','vtiger_contactdetails',1,'51','account_id','Account Name',1,0,0,100,6,4,1,'I~O',0,3,'BAS')");	
 $this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'homephone','vtiger_contactsubdetails',1,'11','homephone','Home Phone',1,0,0,100,7,4,1,'V~O',1,null,'ADV')");	
 $this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'leadsource','vtiger_contactsubdetails',1,'15','leadsource','Lead Source',1,0,0,100,8,4,1,'V~O',1,null,'BAS')");	
 $this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'otherphone','vtiger_contactsubdetails',1,'11','otherphone','Other Phone',1,0,0,100,9,4,1,'V~O',1,null,'ADV')");
 $this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'title','vtiger_contactdetails',1,'1','title','Title',1,0,0,100,10,4,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'fax','vtiger_contactdetails',1,'1','fax','Fax',1,0,0,100,11,4,1,'V~O',1,null,'BAS')");	
 $this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'department','vtiger_contactdetails',1,'1','department','Department',1,0,0,100,12,4,1,'V~O',1,null,'ADV')");
 $this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'birthday','vtiger_contactsubdetails',1,'5','birthday','Birthdate',1,0,0,100,14,4,1,'V~O',1,null,'ADV')");
 $this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'email','vtiger_contactdetails',1,'13','email','Email',1,0,0,100,15,4,1,'E~O',0,5,'BAS')");
 $this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'reportsto','vtiger_contactdetails',1,'57','contact_id','Reports To',1,0,0,100,16,4,1,'V~O',1,null,'ADV')");
 $this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'assistant','vtiger_contactsubdetails',1,'1','assistant','Assistant',1,0,0,100,17,4,1,'V~O',1,null,'ADV')");
 $this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'yahooid','vtiger_contactdetails',1,'13','yahooid','Yahoo Id',1,0,0,100,18,4,1,'E~O',1,null,'ADV')");
 $this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'assistantphone','vtiger_contactsubdetails',1,'11','assistantphone','Assistant Phone',1,0,0,100,19,4,1,'V~O',1,null,'ADV')");
 $this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'donotcall','vtiger_contactdetails',1,'56','donotcall','Do Not Call',1,0,0,100,20,4,1,'C~O',1,null,'ADV')");
 $this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'emailoptout','vtiger_contactdetails',1,'56','emailoptout','Email Opt Out',1,0,0,100,21,4,1,'C~O',1,null,'ADV')");
 $this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'smownerid','vtiger_crmentity',1,'53','assigned_user_id','Assigned To',1,0,0,100,22,4,1,'V~M',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'reference','vtiger_contactdetails',1,'56','reference','Reference',1,0,0,10,23,4,1,'C~O',1,null,'ADV')");
 $this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'notify_owner','vtiger_contactdetails',1,'56','notify_owner','Notify Owner',1,0,0,10,24,4,1,'C~O',1,null,'ADV')");
 $this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'createdtime','vtiger_crmentity',1,'70','createdtime','Created Time',1,0,0,100,25,4,2,'T~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'modifiedtime','vtiger_crmentity',1,'70','modifiedtime','Modified Time',1,0,0,100,26,4,2,'T~O',1,null,'BAS')");

//Block4 -- End

//Block6 - Begin Customer Portal

$this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'portal','vtiger_customerdetails',1,'56','portal','Portal User',1,0,0,100,1,6,1,'C~O',1,null,'ADV')");
$this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'support_start_date','vtiger_customerdetails',1,'5','support_start_date','Support Start Date',1,0,0,100,2,6,1,'D~O',1,null,'ADV')");
$this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'support_end_date','vtiger_customerdetails',1,'5','support_end_date','Support End Date',1,0,0,100,3,6,1,'D~O~OTH~GE~support_start_date~Support Start Date',1,null,'ADV')");

//Block6 - End Customer Portal

//Block 7 -- Start

$this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'mailingstreet','vtiger_contactaddress',1,'21','mailingstreet','Mailing Street',1,0,0,100,1,7,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'otherstreet','vtiger_contactaddress',1,'21','otherstreet','Other Street',1,0,0,100,2,7,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'mailingcity','vtiger_contactaddress',1,'1','mailingcity','Mailing City',1,0,0,100,5,7,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'othercity','vtiger_contactaddress',1,'1','othercity','Other City',1,0,0,100,6,7,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'mailingstate','vtiger_contactaddress',1,'1','mailingstate','Mailing State',1,0,0,100,7,7,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'otherstate','vtiger_contactaddress',1,'1','otherstate','Other State',1,0,0,100,8,7,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'mailingzip','vtiger_contactaddress',1,'1','mailingzip','Mailing Zip',1,0,0,100,9,7,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'otherzip','vtiger_contactaddress',1,'1','otherzip','Other Zip',1,0,0,100,10,7,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'mailingcountry','vtiger_contactaddress',1,'1','mailingcountry','Mailing Country',1,0,0,100,11,7,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'othercountry','vtiger_contactaddress',1,'1','othercountry','Other Country',1,0,0,100,12,7,1,'V~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'mailingpobox','vtiger_contactaddress',1,'1','mailingpobox','Mailing Po Box',1,0,0,100,3,7,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'otherpobox','vtiger_contactaddress',1,'1','otherpobox','Other Po Box',1,0,0,100,4,7,1,'V~O',1,null,'BAS')");
//Block7 -- End

//ContactImageInformation
 $this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'imagename','vtiger_contactdetails',1,'69','imagename','Contact Image',1,0,0,100,1,75,1,'V~O',1,null,'ADV')");


//Block8 -- Start
$this->db->query("insert into vtiger_field values (4,".$this->db->getUniqueID("vtiger_field").",'description','vtiger_crmentity',1,'19','description','Description',1,0,0,100,1,8,1,'V~O',1,null,'BAS')");
//Block8 -- End
//Contact Details -- END


//Potential Details -- START
//Block1 -- Start

$this->db->query("insert into vtiger_field values (2,".$this->db->getUniqueID("vtiger_field").",'potentialname','vtiger_potential',1,'2','potentialname','Potential Name',1,0,0,100,1,1,1,'V~M',0,1,'BAS')");	
 $this->db->query("insert into vtiger_field values (2,".$this->db->getUniqueID("vtiger_field").",'amount','vtiger_potential',1,71,'amount','Amount',1,0,0,100,2,1,1,'N~O',0,5,'BAS')");	
 $this->db->query("insert into vtiger_field values (2,".$this->db->getUniqueID("vtiger_field").",'accountid','vtiger_potential',1,'50','account_id','Account Name',1,0,0,100,3,1,1,'V~M',0,2,'BAS')");	
 $this->db->query("insert into vtiger_field values (2,".$this->db->getUniqueID("vtiger_field").",'closingdate','vtiger_potential',1,'23','closingdate','Expected Close Date',1,0,0,100,5,1,1,'D~M',0,3,'BAS')");	
 $this->db->query("insert into vtiger_field values (2,".$this->db->getUniqueID("vtiger_field").",'potentialtype','vtiger_potential',1,'15','opportunity_type','Type',1,0,0,100,6,1,1,'V~O',1,null,'BAS')");	
 $this->db->query("insert into vtiger_field values (2,".$this->db->getUniqueID("vtiger_field").",'nextstep','vtiger_potential',1,'1','nextstep','Next Step',1,0,0,100,7,1,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (2,".$this->db->getUniqueID("vtiger_field").",'leadsource','vtiger_potential',1,'15','leadsource','Lead Source',1,0,0,100,8,1,1,'V~O',1,null,'BAS')");	
 $this->db->query("insert into vtiger_field values (2,".$this->db->getUniqueID("vtiger_field").",'sales_stage','vtiger_potential',1,'16','sales_stage','Sales Stage',1,0,0,100,9,1,1,'V~O',0,4,'BAS')");
 $this->db->query("insert into vtiger_field values (2,".$this->db->getUniqueID("vtiger_field").",'smownerid','vtiger_crmentity',1,'53','assigned_user_id','Assigned To',1,0,0,100,10,1,1,'V~M',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (2,".$this->db->getUniqueID("vtiger_field").",'probability','vtiger_potential',1,'9','probability','Probability',1,0,0,100,11,1,1,'N~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (2,".$this->db->getUniqueID("vtiger_field").",'campaignid','vtiger_potential',1,'58','campaignid','Campaign Source',1,0,0,100,12,1,1,'N~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (2,".$this->db->getUniqueID("vtiger_field").",'createdtime','vtiger_crmentity',1,'70','createdtime','Created Time',1,0,0,100,13,1,2,'T~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (2,".$this->db->getUniqueID("vtiger_field").",'modifiedtime','vtiger_crmentity',1,'70','modifiedtime','Modified Time',1,0,0,100,14,1,2,'T~O',1,null,'BAS')");

//Block1 -- End

//Block3 -- Start

 $this->db->query("insert into vtiger_field values (2,".$this->db->getUniqueID("vtiger_field").",'description','vtiger_crmentity',1,'19','description','Description',1,0,0,100,1,3,1,'V~O',1,null,'BAS')");

//Block3 -- End
//Potential Details -- END


//campaign entries being added


 $this->db->query("insert into vtiger_field values (26,".$this->db->getUniqueID("vtiger_field").",'campaignname','vtiger_campaign',1,'2','campaignname','Campaign Name',1,0,0,100,1,76,1,'V~M',0,1,'BAS')");
 $this->db->query("insert into vtiger_field values (26,".$this->db->getUniqueID("vtiger_field").",'campaigntype','vtiger_campaign',1,15,'campaigntype','Campaign Type',1,0,0,100,5,76,1,'V~O',0,3,'BAS')");
 $this->db->query("insert into vtiger_field values (26,".$this->db->getUniqueID("vtiger_field").",'product_id','vtiger_campaign',1,59,'product_id','Product',1,0,0,100,4,76,1,'I~O',0,5,'BAS')");
 $this->db->query("insert into vtiger_field values (26,".$this->db->getUniqueID("vtiger_field").",'campaignstatus','vtiger_campaign',1,15,'campaignstatus','Campaign Status',1,0,0,100,2,76,1,'V~O',0,6,'BAS')");
 $this->db->query("insert into vtiger_field values (26,".$this->db->getUniqueID("vtiger_field").",'closingdate','vtiger_campaign',1,'23','closingdate','Expected Close Date',1,0,0,100,6,76,1,'D~M',0,2,'BAS')");
 $this->db->query("insert into vtiger_field values (26,".$this->db->getUniqueID("vtiger_field").",'smownerid','vtiger_crmentity',1,'53','assigned_user_id','Assigned To',1,0,0,100,3,76,1,'V~M',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (26,".$this->db->getUniqueID("vtiger_field").",'numsent','vtiger_campaign',1,'9','numsent','Num Sent',1,0,0,100,10,76,1,'N~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (26,".$this->db->getUniqueID("vtiger_field").",'sponsor','vtiger_campaign',1,'1','sponsor','Sponsor',1,0,0,100,9,76,1,'V~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (26,".$this->db->getUniqueID("vtiger_field").",'targetaudience','vtiger_campaign',1,'1','targetaudience','Target Audience',1,0,0,100,7,76,1,'V~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values(26,".$this->db->getUniqueID("vtiger_field").",'targetsize','vtiger_campaign',1,'1','targetsize','TargetSize',1,0,0,100,8,76,1,'I~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (26,".$this->db->getUniqueID("vtiger_field").",'createdtime','vtiger_crmentity',1,'70','createdtime','Created Time',1,0,0,100,11,76,2,'T~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (26,".$this->db->getUniqueID("vtiger_field").",'modifiedtime','vtiger_crmentity',1,'70','modifiedtime','Modified Time',1,0,0,100,12,76,2,'T~O',1,null,'BAS')");

$this->db->query("insert into vtiger_field values (26,".$this->db->getUniqueID("vtiger_field").",'expectedresponse','vtiger_campaign',1,'15','expectedresponse','Expected Response',1,0,0,100,3,78,1,'V~O',0,4,'BAS')");
 $this->db->query("insert into vtiger_field values (26,".$this->db->getUniqueID("vtiger_field").",'expectedrevenue','vtiger_campaign',1,'1','expectedrevenue','Expected Revenue',1,0,0,100,4,78,1,'N~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (26,".$this->db->getUniqueID("vtiger_field").",'budgetcost','vtiger_campaign',1,'1','budgetcost','Budget Cost',1,0,0,100,1,78,1,'N~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (26,".$this->db->getUniqueID("vtiger_field").",'actualcost','vtiger_campaign',1,'1','actualcost','Actual Cost',1,0,0,100,2,78,1,'N~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values(26,".$this->db->getUniqueID("vtiger_field").",'expectedresponsecount','vtiger_campaign',1,'1','expectedresponsecount','Expected Response Count',1,0,0,100,7,78,1,'I~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values(26,".$this->db->getUniqueID("vtiger_field").",'expectedsalescount','vtiger_campaign',1,'1','expectedsalescount','Expected Sales Count',1,0,0,100,5,78,1,'I~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values(26,".$this->db->getUniqueID("vtiger_field").",'expectedroi','vtiger_campaign',1,'1','expectedroi','Expected ROI',1,0,0,100,9,78,1,'N~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values(26,".$this->db->getUniqueID("vtiger_field").",'actualresponsecount','vtiger_campaign',1,'1','actualresponsecount','Actual Response Count',1,0,0,100,8,78,1,'I~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values(26,".$this->db->getUniqueID("vtiger_field").",'actualsalescount','vtiger_campaign',1,'1','actualsalescount','Actual Sales Count',1,0,0,100,6,78,1,'I~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values(26,".$this->db->getUniqueID("vtiger_field").",'actualroi','vtiger_campaign',1,'1','actualroi','Actual ROI',1,0,0,100,10,78,1,'N~O',1,null,'BAS')");

$this->db->query("insert into vtiger_field values (26,".$this->db->getUniqueID("vtiger_field").",'description','vtiger_crmentity',1,'19','description','Description',1,0,0,100,1,82,1,'V~O',1,null,'BAS')");
//Campaign entries end


//Ticket Details -- START
//Block25 -- Start

 $this->db->query("insert into vtiger_field values (13,".$this->db->getUniqueID("vtiger_field").",'smownerid','vtiger_crmentity',1,'53','assigned_user_id','Assigned To',1,0,0,100,2,25,1,'V~M',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (13,".$this->db->getUniqueID("vtiger_field").",'parent_id','vtiger_troubletickets',1,'68','parent_id','Related To',1,0,0,100,4,25,1,'I~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (13,".$this->db->getUniqueID("vtiger_field").",'priority','vtiger_troubletickets',1,'15','ticketpriorities','Priority',1,0,0,100,5,25,1,'V~O',0,4,'BAS')");
 $this->db->query("insert into vtiger_field values (13,".$this->db->getUniqueID("vtiger_field").",'product_id','vtiger_troubletickets',1,'59','product_id','Product Name',1,0,0,100,6,25,1,'I~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (13,".$this->db->getUniqueID("vtiger_field").",'severity','vtiger_troubletickets',1,'15','ticketseverities','Severity',1,0,0,100,7,25,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (13,".$this->db->getUniqueID("vtiger_field").",'status','vtiger_troubletickets',1,'111','ticketstatus','Status',1,0,0,100,8,25,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (13,".$this->db->getUniqueID("vtiger_field").",'category','vtiger_troubletickets',1,'15','ticketcategories','Category',1,0,0,100,9,25,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (13,".$this->db->getUniqueID("vtiger_field").",'update_log','vtiger_troubletickets',1,'19','update_log','Update History',1,0,0,100,9,25,3,'V~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (13,".$this->db->getUniqueID("vtiger_field").",'createdtime','vtiger_crmentity',1,'70','createdtime','Created Time',1,0,0,100,10,25,2,'T~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (13,".$this->db->getUniqueID("vtiger_field").",'modifiedtime','vtiger_crmentity',1,'70','modifiedtime','Modified Time',1,0,0,100,11,25,2,'T~O',1,null,'BAS')");
 //Added on 26-12-2005 to add attachment in ticket editview
 $this->db->query("insert into vtiger_field values (13,".$this->db->getUniqueID("vtiger_field").",'filename','vtiger_attachments',1,'61','filename','Attachment',1,0,0,100,12,25,1,'V~O',0,3,'BAS')");

 $this->db->query("insert into vtiger_field values (13,".$this->db->getUniqueID("vtiger_field").",'title','vtiger_troubletickets',1,'22','ticket_title','Title',1,0,0,100,1,26,1,'V~M',0,1,'BAS')");
 $this->db->query("insert into vtiger_field values (13,".$this->db->getUniqueID("vtiger_field").",'description','vtiger_crmentity',1,'19','description','Description',1,0,0,100,1,28,1,'V~O',0,2,'BAS')");
 $this->db->query("insert into vtiger_field values (13,".$this->db->getUniqueID("vtiger_field").",'solution','vtiger_troubletickets',1,'19','solution','Solution',1,0,0,100,1,29,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (13,".$this->db->getUniqueID("vtiger_field").",'comments','vtiger_ticketcomments',1,'19','comments','Add Comment',1,0,0,100,1,30,1,'V~O',1,null,'BAS')");

//Block25-30 -- End
//Ticket Details -- END

//Product Details -- START
//Block31-36 -- Start

$this->db->query("insert into vtiger_field values (14,".$this->db->getUniqueID("vtiger_field").",'productname','vtiger_products',1,'2','productname','Product Name',1,0,0,100,1,31,1,'V~M',0,null,'BAS')");
 $this->db->query("insert into vtiger_field values (14,".$this->db->getUniqueID("vtiger_field").",'productcode','vtiger_products',1,'1','productcode','Part Number',1,0,0,100,2,31,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (14,".$this->db->getUniqueID("vtiger_field").",'discontinued','vtiger_products',1,'56','discontinued','Product Active',1,0,0,100,3,31,1,'V~O',0,null,'BAS')");
 $this->db->query("insert into vtiger_field values (14,".$this->db->getUniqueID("vtiger_field").",'manufacturer','vtiger_products',1,'15','manufacturer','Manufacturer',1,0,0,100,4,31,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (14,".$this->db->getUniqueID("vtiger_field").",'productcategory','vtiger_products',1,'15','productcategory','Product Category',1,0,0,100,4,31,1,'V~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (14,".$this->db->getUniqueID("vtiger_field").",'sales_start_date','vtiger_products',1,'5','sales_start_date','Sales Start Date',1,0,0,100,5,31,1,'D~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (14,".$this->db->getUniqueID("vtiger_field").",'sales_end_date','vtiger_products',1,'5','sales_end_date','Sales End Date',1,0,0,100,6,31,1,'D~O~OTH~GE~sales_start_date~Sales Start Date',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (14,".$this->db->getUniqueID("vtiger_field").",'start_date','vtiger_products',1,'5','start_date','Support Start Date',1,0,0,100,7,31,1,'D~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (14,".$this->db->getUniqueID("vtiger_field").",'expiry_date','vtiger_products',1,'5','expiry_date','Support Expiry Date',1,0,0,100,8,31,1,'D~O~OTH~GE~start_date~Start Date',1,null,'BAS')");
 

 $this->db->query("insert into vtiger_field values (14,".$this->db->getUniqueID("vtiger_field").",'website','vtiger_products',1,'17','website','Website',1,0,0,100,12,31,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (14,".$this->db->getUniqueID("vtiger_field").",'vendor_id','vtiger_products',1,'75','vendor_id','Vendor Name',1,0,0,100,13,31,1,'I~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (14,".$this->db->getUniqueID("vtiger_field").",'mfr_part_no','vtiger_products',1,'1','mfr_part_no','Mfr PartNo',1,0,0,100,14,31,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (14,".$this->db->getUniqueID("vtiger_field").",'vendor_part_no','vtiger_products',1,'1','vendor_part_no','Vendor PartNo',1,0,0,100,15,31,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (14,".$this->db->getUniqueID("vtiger_field").",'serialno','vtiger_products',1,'1','serial_no','Serial No',1,0,0,100,16,31,1,'V~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (14,".$this->db->getUniqueID("vtiger_field").",'productsheet','vtiger_products',1,'1','productsheet','Product Sheet',1,0,0,100,17,31,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (14,".$this->db->getUniqueID("vtiger_field").",'glacct','vtiger_products',1,'15','glacct','GL Account',1,0,0,100,18,31,1,'V~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (14,".$this->db->getUniqueID("vtiger_field").",'createdtime','vtiger_crmentity',1,'70','createdtime','Created Time',1,0,0,100,19,31,2,'T~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (14,".$this->db->getUniqueID("vtiger_field").",'modifiedtime','vtiger_crmentity',1,'70','modifiedtime','Modified Time',1,0,0,100,20,31,2,'T~O',1,null,'BAS')");


//Block32 Pricing Information

$this->db->query("insert into vtiger_field values (14,".$this->db->getUniqueID("vtiger_field").",'unit_price','vtiger_products',1,'71','unit_price','Unit Price',1,0,0,100,1,32,1,'N~O',0,null,'BAS')"); 
 $this->db->query("insert into vtiger_field values (14,".$this->db->getUniqueID("vtiger_field").",'commissionrate','vtiger_products',1,'9','commissionrate','Commission Rate',1,0,0,100,2,32,1,'N~O',1,null,'BAS')"); 
 $this->db->query("insert into vtiger_field values (14,".$this->db->getUniqueID("vtiger_field").",'taxclass','vtiger_products',1,'83','taxclass','Tax Class',1,0,0,100,4,32,1,'V~O',1,null,'BAS')");


//Block 33 stock info

 $this->db->query("insert into vtiger_field values (14,".$this->db->getUniqueID("vtiger_field").",'usageunit','vtiger_products',1,'15','usageunit','Usage Unit',1,0,0,100,1,33,1,'V~O',1,null,'ADV')");
 $this->db->query("insert into vtiger_field values (14,".$this->db->getUniqueID("vtiger_field").",'qty_per_unit','vtiger_products',1,'1','qty_per_unit','Qty/Unit',1,0,0,100,2,33,1,'N~O',1,null,'ADV')");
 $this->db->query("insert into vtiger_field values (14,".$this->db->getUniqueID("vtiger_field").",'qtyinstock','vtiger_products',1,'1','qtyinstock','Qty In Stock',1,0,0,100,3,33,1,'NN~O',0,null,'ADV')");
$this->db->query("insert into vtiger_field values (14,".$this->db->getUniqueID("vtiger_field").",'reorderlevel','vtiger_products',1,'1','reorderlevel','Reorder Level',1,0,0,100,4,33,1,'I~O',1,null,'ADV')");
 $this->db->query("insert into vtiger_field values (14,".$this->db->getUniqueID("vtiger_field").",'handler','vtiger_products',1,'52','assigned_user_id','Handler',1,0,0,100,5,33,1,'I~O',1,null,'ADV')");
 $this->db->query("insert into vtiger_field values (14,".$this->db->getUniqueID("vtiger_field").",'qtyindemand','vtiger_products',1,'1','qtyindemand','Qty In Demand',1,0,0,100,6,33,1,'I~O',1,null,'ADV')");


//ProductImageInformation

 $this->db->query("insert into vtiger_field values (14,".$this->db->getUniqueID("vtiger_field").",'imagename','vtiger_products',1,'69','imagename','Product Image',1,0,0,100,1,35,1,'V~O',1,null,'ADV')");


//Block 36 Description Info
 $this->db->query("insert into vtiger_field values (14,".$this->db->getUniqueID("vtiger_field").",'product_description','vtiger_products',1,'19','product_description','Description',1,0,0,100,1,36,1,'V~O',1,null,'BAS')");

//Product Details -- END

//Documents Details -- START
//Block17 -- Start

 $this->db->query("insert into vtiger_field values (8,".$this->db->getUniqueID("vtiger_field").",'title','vtiger_notes',1,'2','notes_title','Title',1,0,0,100,3,17,1,'V~M',0,1,'BAS')");
$this->db->query("insert into vtiger_field values (8,".$this->db->getUniqueID("vtiger_field").",'createdtime','vtiger_crmentity',1,'70','createdtime','Created Time',1,0,0,100,4,17,2,'T~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (8,".$this->db->getUniqueID("vtiger_field").",'modifiedtime','vtiger_crmentity',1,'70','modifiedtime','Modified Time',1,0,0,100,5,17,2,'T~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (8,".$this->db->getUniqueID("vtiger_field").",'filename','vtiger_notes',1,'61','filename','File',1,0,0,100,4,17,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (8,".$this->db->getUniqueID("vtiger_field").",'smownerid','vtiger_crmentity',1,'53','assigned_user_id','Assigned To',1,0,0,100,6,17,1,'V~M',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (8,".$this->db->getUniqueID("vtiger_field").",'notecontent','vtiger_notes',1,'19','notecontent','Note',1,0,0,100,5,18,1,'V~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values(8,".$this->db->getUniqueID("vtiger_field").",'filetype','vtiger_notes',1,1,'filetype','File Type',1,0,0,100,2,85,2,'V~O',1,'','BAS')");
$this->db->query("insert into vtiger_field values(8,".$this->db->getUniqueID("vtiger_field").",'filesize','vtiger_notes',1,1,'filesize','File Size',1,0,0,100,3,85,2,'V~O',1,'','BAS')");
$this->db->query("insert into vtiger_field values(8,".$this->db->getUniqueID("vtiger_field").",'filelocationtype','vtiger_notes',1,1,'filelocationtype','Download Type',1,0,0,100,4,85,2,'V~O',1,'','BAS')");
$this->db->query("insert into vtiger_field values(8,".$this->db->getUniqueID("vtiger_field").",'fileversion','vtiger_notes',1,1,'fileversion','Version',1,0,0,100,5,85,2,'V~O',1,'','BAS')");
$this->db->query("insert into vtiger_field values(8,".$this->db->getUniqueID("vtiger_field").",'filestatus','vtiger_notes',1,56,'filestatus','Active',1,0,0,100,6,85,2,'V~O',1,'','BAS')");
$this->db->query("insert into vtiger_field values(8,".$this->db->getUniqueID("vtiger_field").",'filedownloadcount','vtiger_notes',1,1,'filedownloadcount','Download Count',1,0,0,100,11,85,2,'I~O',1,'','BAS')");
$this->db->query("insert into vtiger_field values(8,".$this->db->getUniqueID("vtiger_field").",'os','vtiger_notes',1,1,'filearchitecture','Platform',1,0,0,100,12,85,2,'V~O',1,'','BAS')");

//Block17 -- End
//Documents Details -- END

//Email Details -- START
//Block21 -- Start

	$this->db->query("insert into vtiger_field values (10,".$this->db->getUniqueID("vtiger_field").",'date_start','vtiger_activity',1,'6','date_start','Date & Time Sent',1,0,0,100,1,21,1,'DT~M~time_start~Time Start',1,null,'BAS')");
	$this->db->query("insert into vtiger_field values (10,".$this->db->getUniqueID("vtiger_field").",'semodule','vtiger_activity',1,'2','parent_type','Sales Enity Module',1,0,0,100,2,21,3,'',1,null,'BAS')");
	$this->db->query("insert into vtiger_field values (10,".$this->db->getUniqueID("vtiger_field").",'activitytype','vtiger_activity',1,'2','activitytype','Activtiy Type',1,0,0,100,3,21,3,'V~O',1,null,'BAS')");
	$this->db->query("insert into vtiger_field values (10,".$this->db->getUniqueID("vtiger_field").",'crmid','vtiger_seactivityrel',1,'357','parent_id','Related To',1,0,0,100,1,22,1,'I~O',1,null,'BAS')");
	$this->db->query("insert into vtiger_field values (10,".$this->db->getUniqueID("vtiger_field").",'smownerid','vtiger_crmentity',1,'53','assigned_user_id','Assigned To',1,0,0,100,5,21,1,'V~M',1,null,'BAS')");
	$this->db->query("insert into vtiger_field values (10,".$this->db->getUniqueID("vtiger_field").",'subject','vtiger_activity',1,'2','subject','Subject',1,0,0,100,1,23,1,'V~M',1,null,'BAS')");
	$this->db->query("insert into vtiger_field values (10,".$this->db->getUniqueID("vtiger_field").",'filename','vtiger_attachments',1,'61','filename','Attachment',1,0,0,100,2,23,1,'V~O',1,null,'BAS')");
	$this->db->query("insert into vtiger_field values (10,".$this->db->getUniqueID("vtiger_field").",'description','vtiger_crmentity',1,'19','description','Description',1,0,0,100,1,24,1,'V~O',1,null,'BAS')");
	$this->db->query("insert into vtiger_field values (10,".$this->db->getUniqueID("vtiger_field").",'time_start','vtiger_activity',1,'2','time_start','Time Start',1,0,0,100,9,23,1,'T~O',1,null,'BAS')");
	$this->db->query("insert into vtiger_field values (10,".$this->db->getUniqueID("vtiger_field").",'createdtime','vtiger_crmentity',1,'70','createdtime','Created Time',1,0,0,100,10,22,1,'T~O',1,null,'BAS')");
 	$this->db->query("insert into vtiger_field values (10,".$this->db->getUniqueID("vtiger_field").",'modifiedtime','vtiger_crmentity',1,'70','modifiedtime','Modified Time',1,0,0,100,11,21,2,'T~O',1,null,'BAS')");

//Block21 -- End
//Email Details -- END

//Task Details --START
//Block19 -- Start
$this->db->query("insert into vtiger_field values (9,".$this->db->getUniqueID("vtiger_field").",'subject','vtiger_activity',1,'2','subject','Subject',1,0,0,100,1,19,1,'V~M',0,1,'BAS')");
 $this->db->query("insert into vtiger_field values (9,".$this->db->getUniqueID("vtiger_field").",'smownerid','vtiger_crmentity',1,'53','assigned_user_id','Assigned To',1,0,0,100,2,19,1,'V~M',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (9,".$this->db->getUniqueID("vtiger_field").",'date_start','vtiger_activity',1,'6','date_start','Start Date & Time',1,0,0,100,3,19,1,'DT~M~time_start',0,2,'BAS')");
 $this->db->query("insert into vtiger_field values (9,".$this->db->getUniqueID("vtiger_field").",'time_start','vtiger_activity',1,'2','time_start','Time Start',1,0,0,100,4,19,3,'T~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (9,".$this->db->getUniqueID("vtiger_field").",'time_end','vtiger_activity',1,'2','time_end','End Time',1,0,0,100,4,19,3,'T~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (9,".$this->db->getUniqueID("vtiger_field").",'due_date','vtiger_activity',1,'23','due_date','Due Date',1,0,0,100,5,19,1,'D~M~OTH~GE~date_start~Start Date & Time',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (9,".$this->db->getUniqueID("vtiger_field").",'crmid','vtiger_seactivityrel',1,'66','parent_id','Related To',1,0,0,100,7,19,1,'I~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (9,".$this->db->getUniqueID("vtiger_field").",'contactid','vtiger_cntactivityrel',1,'57','contact_id','Contact Name',1,0,0,100,8,19,1,'I~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (9,".$this->db->getUniqueID("vtiger_field").",'status','vtiger_activity',1,'111','taskstatus','Status',1,0,0,100,8,19,1,'V~O',0,3,'BAS')");
 $this->db->query("insert into vtiger_field values (9,".$this->db->getUniqueID("vtiger_field").",'eventstatus','vtiger_activity',1,'111','eventstatus','Status',1,0,0,100,9,19,3,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (9,".$this->db->getUniqueID("vtiger_field").",'priority','vtiger_activity',1,'15','taskpriority','Priority',1,0,0,100,10,19,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (9,".$this->db->getUniqueID("vtiger_field").",'sendnotification','vtiger_activity',1,'56','sendnotification','Send Notification',1,0,0,100,11,19,1,'C~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (9,".$this->db->getUniqueID("vtiger_field").",'createdtime','vtiger_crmentity',1,'70','createdtime','Created Time',1,0,0,100,14,19,2,'T~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (9,".$this->db->getUniqueID("vtiger_field").",'modifiedtime','vtiger_crmentity',1,'70','modifiedtime','Modified Time',1,0,0,100,15,19,2,'T~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (9,".$this->db->getUniqueID("vtiger_field").",'activitytype','vtiger_activity',1,'15','activitytype','Activity Type',1,0,0,100,16,19,3,'V~O',1,null,'BAS')");
 $this->db->query("Insert into vtiger_field values (9,".$this->db->getUniqueID("vtiger_field").",'visibility','vtiger_activity',1,15,'visibility','Visibility',1,0,0,100,17,19,3,'V~O',1,null,'BAS')");

 $this->db->query("insert into vtiger_field values (9,".$this->db->getUniqueID("vtiger_field").",'description','vtiger_crmentity',1,'19','description','Description',1,0,0,100,1,20,1,'V~O',1,null,'BAS')");


$this->db->query("insert into vtiger_field values (9,".$this->db->getUniqueID("vtiger_field").",'duration_hours','vtiger_activity',1,'63','duration_hours','Duration',1,0,0,100,17,19,3,'T~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (9,".$this->db->getUniqueID("vtiger_field").",'duration_minutes','vtiger_activity',1,'15','duration_minutes','Duration Minutes',1,0,0,100,18,19,3,'T~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (9,".$this->db->getUniqueID("vtiger_field").",'location','vtiger_activity',1,'1','location','Location',1,0,0,100,19,19,3,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (9,".$this->db->getUniqueID("vtiger_field").",'reminder_time','vtiger_activity_reminder',1,'30','reminder_time','Send Reminder',1,0,0,100,1,19,3,'I~O',1,null,'BAS')");
 
 $this->db->query("insert into vtiger_field values (9,".$this->db->getUniqueID("vtiger_field").",'recurringtype','vtiger_activity',1,'15','recurringtype','Recurrence',1,0,0,100,6,19,3,'O~O',1,null,'BAS')");

 $this->db->query("Insert into vtiger_field values (9,".$this->db->getUniqueID("vtiger_field").",'notime','vtiger_activity',1,56,'notime','No Time',1,0,0,100,20,19,3,'C~O',1,null,'BAS')");
//Block19 -- End
//Task Details -- END

//Event Details --START
//Block41-43-- Start
 $this->db->query("insert into vtiger_field values (16,".$this->db->getUniqueID("vtiger_field").",'subject','vtiger_activity',1,'2','subject','Subject',1,0,0,100,1,41,1,'V~M',0,1,'BAS')");
 $this->db->query("insert into vtiger_field values (16,".$this->db->getUniqueID("vtiger_field").",'smownerid','vtiger_crmentity',1,'53','assigned_user_id','Assigned To',1,0,0,100,2,41,1,'V~M',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (16,".$this->db->getUniqueID("vtiger_field").",'date_start','vtiger_activity',1,'6','date_start','Start Date & Time',1,0,0,100,3,41,1,'DT~M~time_start',0,2,'BAS')");
 $this->db->query("insert into vtiger_field values (16,".$this->db->getUniqueID("vtiger_field").",'time_start','vtiger_activity',1,'2','time_start','Time Start',1,0,0,100,4,41,3,'T~M',1,null,'BAS')");

 $this->db->query("insert into vtiger_field values (16,".$this->db->getUniqueID("vtiger_field").",'due_date','vtiger_activity',1,'23','due_date','End Date',1,0,0,100,5,41,1,'D~M~OTH~GE~date_start~Start Date & Time',0,5,'BAS')");
 $this->db->query("insert into vtiger_field values (16,".$this->db->getUniqueID("vtiger_field").",'time_end','vtiger_activity',1,'2','time_end','End Time',1,0,0,100,5,41,3,'T~M',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (16,".$this->db->getUniqueID("vtiger_field").",'recurringtype','vtiger_activity',1,'15','recurringtype','Recurrence',1,0,0,100,6,41,1,'O~O',1,null,'BAS')");
  
 $this->db->query("insert into vtiger_field values (16,".$this->db->getUniqueID("vtiger_field").",'duration_hours','vtiger_activity',1,'63','duration_hours','Duration',1,0,0,100,7,41,1,'I~M',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (16,".$this->db->getUniqueID("vtiger_field").",'duration_minutes','vtiger_activity',1,'15','duration_minutes','Duration Minutes',1,0,0,100,8,41,3,'O~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (16,".$this->db->getUniqueID("vtiger_field").",'crmid','vtiger_seactivityrel',1,'66','parent_id','Related To',1,0,0,100,9,41,1,'I~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (16,".$this->db->getUniqueID("vtiger_field").",'eventstatus','vtiger_activity',1,'111','eventstatus','Status',1,0,0,100,10,41,1,'V~M',0,3,'BAS')");
 $this->db->query("insert into vtiger_field values (16,".$this->db->getUniqueID("vtiger_field").",'sendnotification','vtiger_activity',1,'56','sendnotification','Send Notification',1,0,0,100,11,41,1,'C~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (16,".$this->db->getUniqueID("vtiger_field").",'activitytype','vtiger_activity',1,'15','activitytype','Activity Type',1,0,0,100,12,41,1,'V~O',0,4,'BAS')");
 $this->db->query("insert into vtiger_field values (16,".$this->db->getUniqueID("vtiger_field").",'location','vtiger_activity',1,'1','location','Location',1,0,0,100,13,41,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (16,".$this->db->getUniqueID("vtiger_field").",'createdtime','vtiger_crmentity',1,'70','createdtime','Created Time',1,0,0,100,14,41,2,'T~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (16,".$this->db->getUniqueID("vtiger_field").",'modifiedtime','vtiger_crmentity',1,'70','modifiedtime','Modified Time',1,0,0,100,15,41,2,'T~O',1,null,'BAS')");
 $this->db->query("Insert into vtiger_field values (16,".$this->db->getUniqueID("vtiger_field").",'priority','vtiger_activity',1,15,'taskpriority','Priority',1,0,0,100,16,41,1,'V~O',1,null,'BAS')");
 $this->db->query("Insert into vtiger_field values (16,".$this->db->getUniqueID("vtiger_field").",'notime','vtiger_activity',1,56,'notime','No Time',1,0,0,100,17,41,1,'C~O',1,null,'BAS')");
 $this->db->query("Insert into vtiger_field values (16,".$this->db->getUniqueID("vtiger_field").",'visibility','vtiger_activity',1,15,'visibility','Visibility',1,0,0,100,18,41,1,'V~O',1,null,'BAS')");
 
 $this->db->query("insert into vtiger_field values (16,".$this->db->getUniqueID("vtiger_field").",'description','vtiger_crmentity',1,'19','description','Description',1,0,0,100,1,43,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (16,".$this->db->getUniqueID("vtiger_field").",'reminder_time','vtiger_activity_reminder',1,'30','reminder_time','Send Reminder',1,0,0,100,1,42,1,'I~O',1,null,'BAS')");
//Block41-43 -- End
//Event Details -- END

//Faq Details -- START
//Block37-40 -- Start

$this->db->query("insert into vtiger_field values (15,".$this->db->getUniqueID("vtiger_field").",'product_id','vtiger_faq',1,'59','product_id','Product Name',1,0,0,100,1,37,1,'I~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (15,".$this->db->getUniqueID("vtiger_field").",'category','vtiger_faq',1,'15','faqcategories','Category',1,0,0,100,2,37,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (15,".$this->db->getUniqueID("vtiger_field").",'status','vtiger_faq',1,'111','faqstatus','Status',1,0,0,100,3,37,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (15,".$this->db->getUniqueID("vtiger_field").",'question','vtiger_faq',1,'20','question','Question',1,0,0,100,1,38,1,'V~M',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (15,".$this->db->getUniqueID("vtiger_field").",'answer','vtiger_faq',1,'20','faq_answer','Answer',1,0,0,100,1,39,1,'V~M',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (15,".$this->db->getUniqueID("vtiger_field").",'comments','vtiger_faqcomments',1,'19','comments','Add Comment',1,0,0,100,1,40,1,'V~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (15,".$this->db->getUniqueID("vtiger_field").",'createdtime','vtiger_crmentity',1,'70','createdtime','Created Time',1,0,0,100,3,37,2,'T~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (15,".$this->db->getUniqueID("vtiger_field").",'modifiedtime','vtiger_crmentity',1,'70','modifiedtime','Modified Time',1,0,0,100,4,37,2,'T~O',1,null,'BAS')");


//Block37-40 -- End
//Ticket Details -- END

//Vendor Details --START
//Block44-47

$this->db->query("insert into vtiger_field values (18,".$this->db->getUniqueID("vtiger_field").",'vendorname','vtiger_vendor',1,'2','vendorname','Vendor Name',1,0,0,100,1,44,1,'V~M',0,1,'BAS')");
 $this->db->query("insert into vtiger_field values (18,".$this->db->getUniqueID("vtiger_field").",'phone','vtiger_vendor',1,'1','phone','Phone',1,0,0,100,3,44,1,'V~O',0,2,'BAS')");
 $this->db->query("insert into vtiger_field values (18,".$this->db->getUniqueID("vtiger_field").",'email','vtiger_vendor',1,'13','email','Email',1,0,0,100,4,44,1,'E~O',0,3,'BAS')");
 $this->db->query("insert into vtiger_field values (18,".$this->db->getUniqueID("vtiger_field").",'website','vtiger_vendor',1,'17','website','Website',1,0,0,100,5,44,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (18,".$this->db->getUniqueID("vtiger_field").",'glacct','vtiger_vendor',1,'15','glacct','GL Account',1,0,0,100,6,44,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (18,".$this->db->getUniqueID("vtiger_field").",'category','vtiger_vendor',1,'1','category','Category',1,0,0,100,7,44,1,'V~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (18,".$this->db->getUniqueID("vtiger_field").",'createdtime','vtiger_crmentity',1,'70','createdtime','Created Time',1,0,0,100,8,44,2,'T~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (18,".$this->db->getUniqueID("vtiger_field").",'modifiedtime','vtiger_crmentity',1,'70','modifiedtime','Modified Time',1,0,0,100,9,44,2,'T~O',1,null,'BAS')");

//Block 46

$this->db->query("insert into vtiger_field values (18,".$this->db->getUniqueID("vtiger_field").",'street','vtiger_vendor',1,'21','street','Street',1,0,0,100,1,46,1,'V~O',1,null,'ADV')");
 $this->db->query("insert into vtiger_field values (18,".$this->db->getUniqueID("vtiger_field").",'pobox','vtiger_vendor',1,'1','pobox','Po Box',1,0,0,100,2,46,1,'V~O',1,null,'ADV')");
 $this->db->query("insert into vtiger_field values (18,".$this->db->getUniqueID("vtiger_field").",'city','vtiger_vendor',1,'1','city','City',1,0,0,100,3,46,1,'V~O',1,null,'ADV')");
 $this->db->query("insert into vtiger_field values (18,".$this->db->getUniqueID("vtiger_field").",'state','vtiger_vendor',1,'1','state','State',1,0,0,100,4,46,1,'V~O',1,null,'ADV')");
 $this->db->query("insert into vtiger_field values (18,".$this->db->getUniqueID("vtiger_field").",'postalcode','vtiger_vendor',1,'1','postalcode','Postal Code',1,0,0,100,5,46,1,'V~O',1,null,'ADV')");
 $this->db->query("insert into vtiger_field values (18,".$this->db->getUniqueID("vtiger_field").",'country','vtiger_vendor',1,'1','country','Country',1,0,0,100,6,46,1,'V~O',1,null,'ADV')");

//Block 47

$this->db->query("insert into vtiger_field values (18,".$this->db->getUniqueID("vtiger_field").",'description','vtiger_crmentity',1,'19','description','Description',1,0,0,100,1,47,1,'V~O',1,null,'ADV')");

//Vendor Details -- END

//PriceBook Details Start
//Block48

$this->db->query("insert into vtiger_field values (19,".$this->db->getUniqueID("vtiger_field").",'bookname','vtiger_pricebook',1,'2','bookname','Price Book Name',1,0,0,100,1,48,1,'V~M',0,1,'BAS')");
$this->db->query("insert into vtiger_field values (19,".$this->db->getUniqueID("vtiger_field").",'active','vtiger_pricebook',1,'56','active','Active',1,0,0,100,3,48,1,'C~O',0,2,'BAS')");
$this->db->query("insert into vtiger_field values (19,".$this->db->getUniqueID("vtiger_field").",'createdtime','vtiger_crmentity',1,'70','createdtime','Created Time',1,0,0,100,4,48,2,'T~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (19,".$this->db->getUniqueID("vtiger_field").",'modifiedtime','vtiger_crmentity',1,'70','modifiedtime','Modified Time',1,0,0,100,5,48,2,'T~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (19,".$this->db->getUniqueID("vtiger_field").",'currency_id','vtiger_pricebook',1,'117','currency_id','Currency',1,0,0,100,5,48,1,'I~M',0,3,'BAS')");
//Block50

$this->db->query("insert into vtiger_field values (19,".$this->db->getUniqueID("vtiger_field").",'description','vtiger_crmentity',1,'19','description','Description',1,0,0,100,1,50,1,'V~O',1,null,'BAS')");

//PriceBook Details End


//Quote Details -- START
 //Block51

 $this->db->query("insert into vtiger_field values (20,".$this->db->getUniqueID("vtiger_field").",'quote_no','vtiger_quotes',1,'3','quote_no','Quote No',1,0,0,100,3,51,1,'V~M',1,null,'BAS')");	
 $this->db->query("insert into vtiger_field values (20,".$this->db->getUniqueID("vtiger_field").",'subject','vtiger_quotes',1,'2','subject','Subject',1,0,0,100,1,51,1,'V~M',1,null,'BAS')");	
 $this->db->query("insert into vtiger_field values (20,".$this->db->getUniqueID("vtiger_field").",'potentialid','vtiger_quotes',1,'76','potential_id','Potential Name',1,0,0,100,2,51,1,'I~O',1,null,'BAS')");	
 $this->db->query("insert into vtiger_field values (20,".$this->db->getUniqueID("vtiger_field").",'quotestage','vtiger_quotes',1,'111','quotestage','Quote Stage',1,0,0,100,3,51,1,'V~O',1,null,'BAS')");	

 $this->db->query("insert into vtiger_field values (20,".$this->db->getUniqueID("vtiger_field").",'validtill','vtiger_quotes',1,'5','validtill','Valid Till',1,0,0,100,4,51,1,'D~O',1,null,'BAS')");	
 $this->db->query("insert into vtiger_field values (20,".$this->db->getUniqueID("vtiger_field").",'contactid','vtiger_quotes',1,'57','contact_id','Contact Name',1,0,0,100,6,51,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (20,".$this->db->getUniqueID("vtiger_field").",'carrier','vtiger_quotes',1,'15','carrier','Carrier',1,0,0,100,8,51,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (20,".$this->db->getUniqueID("vtiger_field").",'subtotal','vtiger_quotes',1,'1','hdnSubTotal','Sub Total',1,0,0,100,9,51,3,'N~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (20,".$this->db->getUniqueID("vtiger_field").",'shipping','vtiger_quotes',1,'1','shipping','Shipping',1,0,0,100,10,51,1,'V~O',1,null,'BAS')");

 $this->db->query("insert into vtiger_field values (20,".$this->db->getUniqueID("vtiger_field").",'inventorymanager','vtiger_quotes',1,'77','assigned_user_id1','Inventory Manager',1,0,0,100,11,51,1,'I~O',1,null,'BAS')");
 //$this->db->query("insert into vtiger_field values (20,".$this->db->getUniqueID("vtiger_field").",'tax','vtiger_quotes',1,'1','txtTax','Sales Tax',1,0,0,100,13,51,3,'N~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (20,".$this->db->getUniqueID("vtiger_field").",'adjustment','vtiger_quotes',1,'1','txtAdjustment','Adjustment',1,0,0,100,20,51,3,'NN~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (20,".$this->db->getUniqueID("vtiger_field").",'total','vtiger_quotes',1,'1','hdnGrandTotal','Total',1,0,0,100,14,51,3,'N~O',1,null,'BAS')");
//Added fields taxtype, discount percent, discount amount and S&H amount for Tax process
 $this->db->query("insert into vtiger_field values (20,".$this->db->getUniqueID("vtiger_field").",'taxtype','vtiger_quotes',1,'15','hdnTaxType','Tax Type',1,0,0,100,14,51,3,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (20,".$this->db->getUniqueID("vtiger_field").",'discount_percent','vtiger_quotes',1,'1','hdnDiscountPercent','Discount Percent',1,0,0,100,14,51,3,'N~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (20,".$this->db->getUniqueID("vtiger_field").",'discount_amount','vtiger_quotes',1,'1','hdnDiscountAmount','Discount Amount',1,0,0,100,14,51,3,'N~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (20,".$this->db->getUniqueID("vtiger_field").",'s_h_amount','vtiger_quotes',1,'1','hdnS_H_Amount','S&H Amount',1,0,0,100,14,51,3,'N~O',1,null,'BAS')");

 $this->db->query("insert into vtiger_field values (20,".$this->db->getUniqueID("vtiger_field").",'accountid','vtiger_quotes',1,'73','account_id','Account Name',1,0,0,100,16,51,1,'I~M',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (20,".$this->db->getUniqueID("vtiger_field").",'smownerid','vtiger_crmentity',1,'53','assigned_user_id','Assigned To',1,0,0,100,17,51,1,'V~M',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (20,".$this->db->getUniqueID("vtiger_field").",'createdtime','vtiger_crmentity',1,'70','createdtime','Created Time',1,0,0,100,18,51,2,'T~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (20,".$this->db->getUniqueID("vtiger_field").",'modifiedtime','vtiger_crmentity',1,'70','modifiedtime','Modified Time',1,0,0,100,19,51,2,'T~O',1,null,'BAS')");

 $this->db->query("insert into vtiger_field values (20,".$this->db->getUniqueID("vtiger_field").",'currency_id','vtiger_quotes',1,'117','currency_id','Currency',1,0,1,100,20,51,3,'I~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (20,".$this->db->getUniqueID("vtiger_field").",'conversion_rate','vtiger_quotes',1,'1','conversion_rate','Conversion Rate',1,0,1,100,21,51,3,'N~O',1,null,'BAS')");

 //Block 53

 $this->db->query("insert into vtiger_field values (20,".$this->db->getUniqueID("vtiger_field").",'bill_street','vtiger_quotesbillads',1,'24','bill_street','Billing Address',1,0,0,100,1,53,1,'V~M',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (20,".$this->db->getUniqueID("vtiger_field").",'ship_street','vtiger_quotesshipads',1,'24','ship_street','Shipping Address',1,0,0,100,2,53,1,'V~M',1,null,'BAS')");

 $this->db->query("insert into vtiger_field values (20,".$this->db->getUniqueID("vtiger_field").",'bill_city','vtiger_quotesbillads',1,'1','bill_city','Billing City',1,0,0,100,5,53,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (20,".$this->db->getUniqueID("vtiger_field").",'ship_city','vtiger_quotesshipads',1,'1','ship_city','Shipping City',1,0,0,100,6,53,1,'V~O',1,null,'BAS')");

 $this->db->query("insert into vtiger_field values (20,".$this->db->getUniqueID("vtiger_field").",'bill_state','vtiger_quotesbillads',1,'1','bill_state','Billing State',1,0,0,100,7,53,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (20,".$this->db->getUniqueID("vtiger_field").",'ship_state','vtiger_quotesshipads',1,'1','ship_state','Shipping State',1,0,0,100,8,53,1,'V~O',1,null,'BAS')");

 $this->db->query("insert into vtiger_field values (20,".$this->db->getUniqueID("vtiger_field").",'bill_code','vtiger_quotesbillads',1,'1','bill_code','Billing Code',1,0,0,100,9,53,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (20,".$this->db->getUniqueID("vtiger_field").",'ship_code','vtiger_quotesshipads',1,'1','ship_code','Shipping Code',1,0,0,100,10,53,1,'V~O',1,null,'BAS')");


 $this->db->query("insert into vtiger_field values (20,".$this->db->getUniqueID("vtiger_field").",'bill_country','vtiger_quotesbillads',1,'1','bill_country','Billing Country',1,0,0,100,11,53,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (20,".$this->db->getUniqueID("vtiger_field").",'ship_country','vtiger_quotesshipads',1,'1','ship_country','Shipping Country',1,0,0,100,12,53,1,'V~O',1,null,'BAS')");

 $this->db->query("insert into vtiger_field values (20,".$this->db->getUniqueID("vtiger_field").",'bill_pobox','vtiger_quotesbillads',1,'1','bill_pobox','Billing Po Box',1,0,0,100,3,53,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (20,".$this->db->getUniqueID("vtiger_field").",'ship_pobox','vtiger_quotesshipads',1,'1','ship_pobox','Shipping Po Box',1,0,0,100,4,53,1,'V~O',1,null,'BAS')");
 //Block55

 $this->db->query("insert into vtiger_field values (20,".$this->db->getUniqueID("vtiger_field").",'description','vtiger_crmentity',1,'19','description','Description',1,0,0,100,1,56,1,'V~O',1,null,'ADV')");

//Block 56
 $this->db->query("insert into vtiger_field values (20,".$this->db->getUniqueID("vtiger_field").",'terms_conditions','vtiger_quotes',1,'19','terms_conditions','Terms & Conditions',1,0,0,100,1,55,1,'V~O',1,null,'ADV')");


//Quote Details -- END

//Purchase Order Details -- START
 //Block57
 $this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'purchaseorder_no','vtiger_purchaseorder',1,'3','purchaseorder_no','PurchaseOrder No',1,0,0,100,3,57,1,'V~M',1,null,'BAS')");	
 $this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'subject','vtiger_purchaseorder',1,'2','subject','Subject',1,0,0,100,1,57,1,'V~M',1,null,'BAS')");	
 $this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'vendorid','vtiger_purchaseorder',1,'81','vendor_id','Vendor Name',1,0,0,100,3,57,1,'I~M',1,null,'BAS')");	
 $this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'requisition_no','vtiger_purchaseorder',1,'1','requisition_no','Requisition No',1,0,0,100,4,57,1,'V~O',1,null,'BAS')");	

 $this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'tracking_no','vtiger_purchaseorder',1,'1','tracking_no','Tracking Number',1,0,0,100,5,57,1,'V~O',1,null,'BAS')");	
 $this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'contactid','vtiger_purchaseorder',1,'57','contact_id','Contact Name',1,0,0,100,6,57,1,'I~O',1,null,'BAS')");	
 $this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'duedate','vtiger_purchaseorder',1,'5','duedate','Due Date',1,0,0,100,7,57,1,'D~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'carrier','vtiger_purchaseorder',1,'15','carrier','Carrier',1,0,0,100,8,57,1,'V~O',1,null,'BAS')");
 //$this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'salestax','vtiger_purchaseorder',1,'1','txtTax','Sales Tax',1,0,0,100,10,57,3,'N~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'adjustment','vtiger_purchaseorder',1,'1','txtAdjustment','Adjustment',1,0,0,100,10,57,3,'NN~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'salescommission','vtiger_purchaseorder',1,'1','salescommission','Sales Commission',1,0,0,100,11,57,1,'N~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'exciseduty','vtiger_purchaseorder',1,'1','exciseduty','Excise Duty',1,0,0,100,12,57,1,'N~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'total','vtiger_purchaseorder',1,'1','hdnGrandTotal','Total',1,0,0,100,13,57,3,'N~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'subtotal','vtiger_purchaseorder',1,'1','hdnSubTotal','Sub Total',1,0,0,100,14,57,3,'N~O',1,null,'BAS')");
//Added fields taxtype, discount percent, discount amount and S&H amount for Tax process
 $this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'taxtype','vtiger_purchaseorder',1,'15','hdnTaxType','Tax Type',1,0,0,100,14,57,3,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'discount_percent','vtiger_purchaseorder',1,'1','hdnDiscountPercent','Discount Percent',1,0,0,100,14,57,3,'N~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'discount_amount','vtiger_purchaseorder',1,'1','hdnDiscountAmount','Discount Amount',1,0,0,100,14,57,3,'N~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'s_h_amount','vtiger_purchaseorder',1,'1','hdnS_H_Amount','S&H Amount',1,0,0,100,14,57,3,'N~O',1,null,'BAS')");
 
 $this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'postatus','vtiger_purchaseorder',1,'111','postatus','Status',1,0,0,100,15,57,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'smownerid','vtiger_crmentity',1,'53','assigned_user_id','Assigned To',1,0,0,100,16,57,1,'V~M',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'createdtime','vtiger_crmentity',1,'70','createdtime','Created Time',1,0,0,100,17,57,2,'T~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'modifiedtime','vtiger_crmentity',1,'70','modifiedtime','Modified Time',1,0,0,100,18,57,2,'T~O',1,null,'BAS')");

 $this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'currency_id','vtiger_purchaseorder',1,'117','currency_id','Currency',1,0,1,100,19,57,3,'I~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'conversion_rate','vtiger_purchaseorder',1,'1','conversion_rate','Conversion Rate',1,0,1,100,20,57,3,'N~O',1,null,'BAS')");

 //Block 59

 $this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'bill_street','vtiger_pobillads',1,'24','bill_street','Billing Address',1,0,0,100,1,59,1,'V~M',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'ship_street','vtiger_poshipads',1,'24','ship_street','Shipping Address',1,0,0,100,2,59,1,'V~M',1,null,'BAS')");

 $this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'bill_city','vtiger_pobillads',1,'1','bill_city','Billing City',1,0,0,100,5,59,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'ship_city','vtiger_poshipads',1,'1','ship_city','Shipping City',1,0,0,100,6,59,1,'V~O',1,null,'BAS')");

 $this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'bill_state','vtiger_pobillads',1,'1','bill_state','Billing State',1,0,0,100,7,59,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'ship_state','vtiger_poshipads',1,'1','ship_state','Shipping State',1,0,0,100,8,59,1,'V~O',1,null,'BAS')");

 $this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'bill_code','vtiger_pobillads',1,'1','bill_code','Billing Code',1,0,0,100,9,59,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'ship_code','vtiger_poshipads',1,'1','ship_code','Shipping Code',1,0,0,100,10,59,1,'V~O',1,null,'BAS')");


 $this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'bill_country','vtiger_pobillads',1,'1','bill_country','Billing Country',1,0,0,100,11,59,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'ship_country','vtiger_poshipads',1,'1','ship_country','Shipping Country',1,0,0,100,12,59,1,'V~O',1,null,'BAS')");

 $this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'bill_pobox','vtiger_pobillads',1,'1','bill_pobox','Billing Po Box',1,0,0,100,3,59,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'ship_pobox','vtiger_poshipads',1,'1','ship_pobox','Shipping Po Box',1,0,0,100,4,59,1,'V~O',1,null,'BAS')");
  
 //Block61
 $this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'description','vtiger_crmentity',1,'19','description','Description',1,0,0,100,1,62,1,'V~O',1,null,'ADV')");

 //Block62
 $this->db->query("insert into vtiger_field values (21,".$this->db->getUniqueID("vtiger_field").",'terms_conditions','vtiger_purchaseorder',1,'19','terms_conditions','Terms & Conditions',1,0,0,100,1,61,1,'V~O',1,null,'ADV')");

//Purchase Order Details -- END

//Sales Order Details -- START
 //Block63
 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'salesorder_no','vtiger_salesorder',1,'3','salesorder_no','SalesOrder No',1,0,0,100,3,63,1,'V~M',1,null,'BAS')");	
 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'subject','vtiger_salesorder',1,'2','subject','Subject',1,0,0,100,1,63,1,'V~M',1,null,'BAS')");	
 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'potentialid','vtiger_salesorder',1,'76','potential_id','Potential Name',1,0,0,100,2,63,1,'I~O',1,null,'BAS')");	
 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'customerno','vtiger_salesorder',1,'1','customerno','Customer No',1,0,0,100,3,63,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'quoteid','vtiger_salesorder',1,'78','quote_id','Quote Name',1,0,0,100,4,63,1,'I~O',1,null,'BAS')");	
 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'purchaseorder','vtiger_salesorder',1,'1','vtiger_purchaseorder','Purchase Order',1,0,0,100,5,63,1,'V~O',1,null,'BAS')");	

 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'contactid','vtiger_salesorder',1,'57','contact_id','Contact Name',1,0,0,100,6,63,1,'I~O',1,null,'BAS')");	
 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'duedate','vtiger_salesorder',1,'5','duedate','Due Date',1,0,0,100,8,63,1,'D~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'carrier','vtiger_salesorder',1,'15','carrier','Carrier',1,0,0,100,9,63,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'pending','vtiger_salesorder',1,'1','pending','Pending',1,0,0,100,10,63,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'sostatus','vtiger_salesorder',1,'111','sostatus','Status',1,0,0,100,11,63,1,'V~O',1,null,'BAS')");
 //$this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'salestax','vtiger_salesorder',1,'1','txtTax','Sales Tax',1,0,0,100,12,63,3,'N~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'adjustment','vtiger_salesorder',1,'1','txtAdjustment','Adjustment',1,0,0,100,12,63,3,'NN~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'salescommission','vtiger_salesorder',1,'1','salescommission','Sales Commission',1,0,0,100,13,63,1,'N~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'exciseduty','vtiger_salesorder',1,'1','exciseduty','Excise Duty',1,0,0,100,13,63,1,'N~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'total','vtiger_salesorder',1,'1','hdnGrandTotal','Total',1,0,0,100,14,63,3,'N~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'subtotal','vtiger_salesorder',1,'1','hdnSubTotal','Sub Total',1,0,0,100,15,63,3,'N~O',1,null,'BAS')");
//Added fields taxtype, discount percent, discount amount and S&H amount for Tax process
 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'taxtype','vtiger_salesorder',1,'15','hdnTaxType','Tax Type',1,0,0,100,15,63,3,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'discount_percent','vtiger_salesorder',1,'1','hdnDiscountPercent','Discount Percent',1,0,0,100,15,63,3,'N~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'discount_amount','vtiger_salesorder',1,'1','hdnDiscountAmount','Discount Amount',1,0,0,100,15,63,3,'N~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'s_h_amount','vtiger_salesorder',1,'1','hdnS_H_Amount','S&H Amount',1,0,0,100,15,63,3,'N~O',1,null,'BAS')");

 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'accountid','vtiger_salesorder',1,'73','account_id','Account Name',1,0,0,100,16,63,1,'I~M',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'smownerid','vtiger_crmentity',1,'53','assigned_user_id','Assigned To',1,0,0,100,17,63,1,'V~M',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'createdtime','vtiger_crmentity',1,'70','createdtime','Created Time',1,0,0,100,18,63,2,'T~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'modifiedtime','vtiger_crmentity',1,'70','modifiedtime','Modified Time',1,0,0,100,19,63,2,'T~O',1,null,'BAS')");

 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'currency_id','vtiger_salesorder',1,'117','currency_id','Currency',1,0,1,100,20,63,3,'I~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'conversion_rate','vtiger_salesorder',1,'1','conversion_rate','Conversion Rate',1,0,1,100,21,63,3,'N~O',1,null,'BAS')");


 //Block 65

 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'bill_street','vtiger_sobillads',1,'24','bill_street','Billing Address',1,0,0,100,1,65,1,'V~M',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'ship_street','vtiger_soshipads',1,'24','ship_street','Shipping Address',1,0,0,100,2,65,1,'V~M',1,null,'BAS')");

 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'bill_city','vtiger_sobillads',1,'1','bill_city','Billing City',1,0,0,100,5,65,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'ship_city','vtiger_soshipads',1,'1','ship_city','Shipping City',1,0,0,100,6,65,1,'V~O',1,null,'BAS')");

 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'bill_state','vtiger_sobillads',1,'1','bill_state','Billing State',1,0,0,100,7,65,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'ship_state','vtiger_soshipads',1,'1','ship_state','Shipping State',1,0,0,100,8,65,1,'V~O',1,null,'BAS')");

 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'bill_code','vtiger_sobillads',1,'1','bill_code','Billing Code',1,0,0,100,9,65,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'ship_code','vtiger_soshipads',1,'1','ship_code','Shipping Code',1,0,0,100,10,65,1,'V~O',1,null,'BAS')");


 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'bill_country','vtiger_sobillads',1,'1','bill_country','Billing Country',1,0,0,100,11,65,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'ship_country','vtiger_soshipads',1,'1','ship_country','Shipping Country',1,0,0,100,12,65,1,'V~O',1,null,'BAS')");

 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'bill_pobox','vtiger_sobillads',1,'1','bill_pobox','Billing Po Box',1,0,0,100,3,65,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'ship_pobox','vtiger_soshipads',1,'1','ship_pobox','Shipping Po Box',1,0,0,100,4,65,1,'V~O',1,null,'BAS')");
  
//Block67
 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'description','vtiger_crmentity',1,'19','description','Description',1,0,0,100,1,68,1,'V~O',1,null,'ADV')");

 //Block68
 $this->db->query("insert into vtiger_field values (22,".$this->db->getUniqueID("vtiger_field").",'terms_conditions','vtiger_salesorder',1,'19','terms_conditions','Terms & Conditions',1,0,0,100,1,67,1,'V~O',1,null,'ADV')");


//Sales Order Details -- END

//Invoice Details -- START
 //Block69

 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'subject','vtiger_invoice',1,'2','subject','Subject',1,0,0,100,1,69,1,'V~M',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'salesorderid','vtiger_invoice',1,'80','salesorder_id','Sales Order',1,0,0,100,2,69,1,'I~O',1,null,'BAS')");	
 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'customerno','vtiger_invoice',1,'1','customerno','Customer No',1,0,0,100,3,69,1,'V~O',1,null,'BAS')");	

 
//to include contact name vtiger_field in Invoice-start
 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'contactid','vtiger_invoice',1,'57','contact_id','Contact Name',1,0,0,100,4,69,1,'I~O',1,null,'BAS')");
//end

 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'invoicedate','vtiger_invoice',1,'5','invoicedate','Invoice Date',1,0,0,100,5,69,1,'D~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'duedate','vtiger_invoice',1,'5','duedate','Due Date',1,0,0,100,6,69,1,'D~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'purchaseorder','vtiger_invoice',1,'1','vtiger_purchaseorder','Purchase Order',1,0,0,100,8,69,1,'V~O',1,null,'BAS')");
 //$this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'salestax','vtiger_invoice',1,'1','txtTax','Sales Tax',1,0,0,100,9,69,3,'N~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'adjustment','vtiger_invoice',1,'1','txtAdjustment','Adjustment',1,0,0,100,9,69,3,'NN~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'salescommission','vtiger_invoice',1,'1','salescommission','Sales Commission',1,0,0,10,13,69,1,'N~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'exciseduty','vtiger_invoice',1,'1','exciseduty','Excise Duty',1,0,0,100,11,69,1,'N~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'subtotal','vtiger_invoice',1,'1','hdnSubTotal','Sub Total',1,0,0,100,12,69,3,'N~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'total','vtiger_invoice',1,'1','hdnGrandTotal','Total',1,0,0,100,13,69,3,'N~O',1,null,'BAS')");
//Added fields taxtype, discount percent, discount amount and S&H amount for Tax process
 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'taxtype','vtiger_invoice',1,'15','hdnTaxType','Tax Type',1,0,0,100,13,69,3,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'discount_percent','vtiger_invoice',1,'1','hdnDiscountPercent','Discount Percent',1,0,0,100,13,69,3,'N~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'discount_amount','vtiger_invoice',1,'1','hdnDiscountAmount','Discount Amount',1,0,0,100,13,69,3,'N~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'s_h_amount','vtiger_invoice',1,'1','hdnS_H_Amount','S&H Amount',1,0,0,100,14,57,3,'N~O',1,null,'BAS')");

 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'accountid','vtiger_invoice',1,'73','account_id','Account Name',1,0,0,100,14,69,1,'I~M',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'invoicestatus','vtiger_invoice',1,'111','invoicestatus','Status',1,0,0,100,15,69,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'smownerid','vtiger_crmentity',1,'53','assigned_user_id','Assigned To',1,0,0,100,16,69,1,'V~M',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'createdtime','vtiger_crmentity',1,'70','createdtime','Created Time',1,0,0,100,17,69,2,'T~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'modifiedtime','vtiger_crmentity',1,'70','modifiedtime','Modified Time',1,0,0,100,18,69,2,'T~O',1,null,'BAS')"); 

 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'currency_id','vtiger_invoice',1,'117','currency_id','Currency',1,0,1,100,19,69,3,'I~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'conversion_rate','vtiger_invoice',1,'1','conversion_rate','Conversion Rate',1,0,1,100,20,69,3,'N~O',1,null,'BAS')");

 //Block 71

 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'bill_street','vtiger_invoicebillads',1,'24','bill_street','Billing Address',1,0,0,100,1,71,1,'V~M',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'ship_street','vtiger_invoiceshipads',1,'24','ship_street','Shipping Address',1,0,0,100,2,71,1,'V~M',1,null,'BAS')");

 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'bill_city','vtiger_invoicebillads',1,'1','bill_city','Billing City',1,0,0,100,5,71,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'ship_city','vtiger_invoiceshipads',1,'1','ship_city','Shipping City',1,0,0,100,6,71,1,'V~O',1,null,'BAS')");

 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'bill_state','vtiger_invoicebillads',1,'1','bill_state','Billing State',1,0,0,100,7,71,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'ship_state','vtiger_invoiceshipads',1,'1','ship_state','Shipping State',1,0,0,100,8,71,1,'V~O',1,null,'BAS')");

 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'bill_code','vtiger_invoicebillads',1,'1','bill_code','Billing Code',1,0,0,100,9,71,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'ship_code','vtiger_invoiceshipads',1,'1','ship_code','Shipping Code',1,0,0,100,10,71,1,'V~O',1,null,'BAS')");


 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'bill_country','vtiger_invoicebillads',1,'1','bill_country','Billing Country',1,0,0,100,11,71,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'ship_country','vtiger_invoiceshipads',1,'1','ship_country','Shipping Country',1,0,0,100,12,71,1,'V~O',1,null,'BAS')");

 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'bill_pobox','vtiger_invoicebillads',1,'1','bill_pobox','Billing Po Box',1,0,0,100,3,71,1,'V~O',1,null,'BAS')");
 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'ship_pobox','vtiger_invoiceshipads',1,'1','ship_pobox','Shipping Po Box',1,0,0,100,4,71,1,'V~O',1,null,'BAS')");

//Block73
 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'description','vtiger_crmentity',1,'19','description','Description',1,0,0,100,1,74,1,'V~O',1,null,'ADV')");
 //Block74
 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'terms_conditions','vtiger_invoice',1,'19','terms_conditions','Terms & Conditions',1,0,0,100,1,73,1,'V~O',1,null,'ADV')");
//Added for Custom invoice Number
 $this->db->query("insert into vtiger_field values (23,".$this->db->getUniqueID("vtiger_field").",'invoice_no','vtiger_invoice',1,'3','invoice_no','Invoice No',1,0,0,100,3,69,1,'V~M',1,null,'BAS')");	

//Invoice Details -- END
 //users Details Starts Block 79,80,81
$this->db->query("insert into vtiger_field values (29,".$this->db->getUniqueID("vtiger_field").",'user_name','vtiger_users',1,'106','user_name','User Name',1,0,0,11,1,79,1,'V~M',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (29,".$this->db->getUniqueID("vtiger_field").",'is_admin','vtiger_users',1,'156','is_admin','Admin',1,0,0,3,2,79,1,'V~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (29,".$this->db->getUniqueID("vtiger_field").",'user_password','vtiger_users',1,'99','user_password','Password',1,0,0,30,3,79,4,'P~M',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (29,".$this->db->getUniqueID("vtiger_field").",'confirm_password','vtiger_users',1,'99','confirm_password','Confirm Password',1,0,0,30,5,79,4,'P~M',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (29,".$this->db->getUniqueID("vtiger_field").",'first_name','vtiger_users',1,'1','first_name','First Name',1,0,0,30,7,79,1,'V~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (29,".$this->db->getUniqueID("vtiger_field").",'last_name','vtiger_users',1,'2','last_name','Last Name',1,0,0,30,9,79,1,'V~M',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (29,".$this->db->getUniqueID("vtiger_field").",'roleid','vtiger_user2role',1,'98','roleid','Role',1,0,0,200,11,79,1,'V~M',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (29,".$this->db->getUniqueID("vtiger_field").",'email1','vtiger_users',1,'104','email1','Email',1,0,0,100,4,79,1,'E~M',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (29,".$this->db->getUniqueID("vtiger_field").",'status','vtiger_users',1,'115','status','Status',1,0,0,100,6,79,1,'V~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (29,".$this->db->getUniqueID("vtiger_field").",'activity_view','vtiger_users',1,'15','activity_view','Default Activity View',1,0,0,100,12,79,1,'V~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (29,".$this->db->getUniqueID("vtiger_field").",'lead_view','vtiger_users',1,'15','lead_view','Default Lead View',1,0,0,100,10,79,1,'V~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (29,".$this->db->getUniqueID("vtiger_field").",'currency_id','vtiger_users',1,'116','currency_id','Currency',1,0,0,100,8,79,1,'I~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (29,".$this->db->getUniqueID("vtiger_field").",'hour_format','vtiger_users',1,'116','hour_format','Calendar Hour Format',1,0,0,100,13,79,3,'V~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (29,".$this->db->getUniqueID("vtiger_field").",'end_hour','vtiger_users',1,'116','end_hour','Day ends at',1,0,0,100,15,79,3,'V~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (29,".$this->db->getUniqueID("vtiger_field").",'start_hour','vtiger_users',1,'116','start_hour','Day starts at',1,0,0,100,14,79,3,'V~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (29,".$this->db->getUniqueID("vtiger_field").",'title','vtiger_users',1,'1','title','Title',1,0,0,50,1,80,1,'V~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (29,".$this->db->getUniqueID("vtiger_field").",'phone_work','vtiger_users',1,'1','phone_work','Office Phone',1,0,0,50,5,80,1,'V~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (29,".$this->db->getUniqueID("vtiger_field").",'department','vtiger_users',1,'1','department','Department',1,0,0,50,3,80,1,'V~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (29,".$this->db->getUniqueID("vtiger_field").",'phone_mobile','vtiger_users',1,'1','phone_mobile','Mobile',1,0,0,50,7,80,1,'V~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (29,".$this->db->getUniqueID("vtiger_field").",'reports_to_id','vtiger_users',1,'101','reports_to_id','Reports To',1,0,0,50,8,80,1,'V~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (29,".$this->db->getUniqueID("vtiger_field").",'phone_other','vtiger_users',1,'1','phone_other','Other Phone',1,0,0,50,11,80,1,'V~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (29,".$this->db->getUniqueID("vtiger_field").",'email2','vtiger_users',1,'13','email2','Other Email',1,0,0,100,4,80,1,'E~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (29,".$this->db->getUniqueID("vtiger_field").",'phone_fax','vtiger_users',1,'1','phone_fax','Fax',1,0,0,50,2,80,1,'V~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (29,".$this->db->getUniqueID("vtiger_field").",'yahoo_id','vtiger_users',1,'13','yahoo_id','Yahoo id',1,0,0,100,6,80,1,'E~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (29,".$this->db->getUniqueID("vtiger_field").",'phone_home','vtiger_users',1,'1','phone_home','Home Phone',1,0,0,50,9,80,1,'V~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (29,".$this->db->getUniqueID("vtiger_field").",'date_format','vtiger_users',1,'15','date_format','Date Format',1,0,0,30,12,80,1,'V~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (29,".$this->db->getUniqueID("vtiger_field").",'signature','vtiger_users',1,'21','signature','Signature',1,0,0,250,13,80,1,'V~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (29,".$this->db->getUniqueID("vtiger_field").",'description','vtiger_users',1,'21','description','Documents',1,0,0,250,14,80,1,'V~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (29,".$this->db->getUniqueID("vtiger_field").",'address_street','vtiger_users',1,'21','address_street','Street Address',1,0,0,250,1,81,1,'V~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (29,".$this->db->getUniqueID("vtiger_field").",'address_city','vtiger_users',1,'1','address_city','City',1,0,0,100,3,81,1,'V~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (29,".$this->db->getUniqueID("vtiger_field").",'address_state','vtiger_users',1,'1','address_state','State',1,0,0,100,5,81,1,'V~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (29,".$this->db->getUniqueID("vtiger_field").",'address_postalcode','vtiger_users',1,'1','address_postalcode','Postal Code',1,0,0,100,4,81,1,'V~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (29,".$this->db->getUniqueID("vtiger_field").",'address_country','vtiger_users',1,'1','address_country','Country',1,0,0,100,2,81,1,'V~O',1,null,'BAS')");

//User Image Information
$this->db->query("insert into vtiger_field values (29,".$this->db->getUniqueID("vtiger_field").",'imagename','vtiger_users',1,'105','imagename','User Image',1,0,0,250,10,83,1,'V~O',1,null,'BAS')");
//added for internl_mailer
$this->db->query("insert into vtiger_field values (29,".$this->db->getUniqueID("vtiger_field").",'internal_mailer','vtiger_users',1,'56','internal_mailer','INTERNAL_MAIL_COMPOSER',1,0,0,50,15,80,1,'V~O',1,null,'BAS')");
$this->db->query("insert into vtiger_field values (29,".$this->db->getUniqueID("vtiger_field").",'reminder_interval','vtiger_users',1,'15','reminder_interval','Reminder Interval',1,0,0,100,1,84,1,'V~O',1,null,'BAS')");
 //user Details End


//The Entity Name for the modules are maintained in this table
$this->db->query("insert into vtiger_entityname values(7,'Leads','vtiger_leaddetails','lastname,firstname','leadid','leadid')");
$this->db->query("insert into vtiger_entityname values(6,'Accounts','vtiger_account','accountname','accountid','account_id')");
$this->db->query("insert into vtiger_entityname values(4,'Contacts','vtiger_contactdetails','lastname,firstname','contactid','contact_id')");
$this->db->query("insert into vtiger_entityname values(2,'Potentials','vtiger_potential','potentialname','potentialid','potential_id')");
$this->db->query("insert into vtiger_entityname values(8,'Documents','vtiger_notes','title','notesid','notesid')");
$this->db->query("insert into vtiger_entityname values(13,'HelpDesk','vtiger_troubletickets','title','ticketid','ticketid')");
$this->db->query("insert into vtiger_entityname values(9,'Calendar','vtiger_activity','subject','activityid','activityid')");
$this->db->query("insert into vtiger_entityname values(10,'Emails','vtiger_activity','subject','activityid','activityid')");
$this->db->query("insert into vtiger_entityname values(14,'Products','vtiger_products','productname','productid','product_id')");
$this->db->query("insert into vtiger_entityname values(29,'Users','vtiger_users','last_name,first_name','id','id')");
$this->db->query("insert into vtiger_entityname values(23,'Invoice','vtiger_invoice','subject','invoiceid','invoiceid')");
$this->db->query("insert into vtiger_entityname values(20,'Quotes','vtiger_quotes','subject','quoteid','quote_id')");
$this->db->query("insert into vtiger_entityname values(21,'PurchaseOrder','vtiger_purchaseorder','subject','purchaseorderid','purchaseorderid')");
$this->db->query("insert into vtiger_entityname values(22,'SalesOrder','vtiger_salesorder','subject','salesorderid','salesorder_id')");
$this->db->query("insert into vtiger_entityname values(18,'Vendors','vtiger_vendor','vendorname','vendorid','vendor_id')");
$this->db->query("insert into vtiger_entityname values(19,'PriceBooks','vtiger_pricebook','bookname','pricebookid','pricebookid')");
$this->db->query("insert into vtiger_entityname values(26,'Campaigns','vtiger_campaign','campaignname','campaignid','campaignid')");
$this->db->query("insert into vtiger_entityname values(15,'Faq','vtiger_faq','question','id','id')");
                // Insert End
		
		//Inserting into vtiger_groups table
		$group1_id = $this->db->getUniqueID("vtiger_groups");
 		$group2_id = $this->db->getUniqueID("vtiger_groups");
 		$group3_id = $this->db->getUniqueID("vtiger_groups");
		
		$this->db->query("insert into vtiger_groups values ('".$group1_id."','Team Selling','Group Related to Sales')");	
		$this->db->query("insert into vtiger_group2role values ('".$group1_id."','H".$role4_id."')");	
		$this->db->query("insert into vtiger_group2rs values ('".$group1_id."','H".$role5_id."')");	

		$this->db->query("insert into vtiger_groups values ('".$group2_id."','Marketing Group','Group Related to Marketing Activities')");	
		$this->db->query("insert into vtiger_group2role values ('".$group2_id."','H".$role2_id."')");	
		$this->db->query("insert into vtiger_group2rs values ('".$group2_id."','H".$role3_id."')");	

		$this->db->query("insert into vtiger_groups values ('".$group3_id."','Support Group','Group Related to providing Support to Customers')");
		$this->db->query("insert into vtiger_group2role values ('".$group3_id."','H".$role3_id."')");
		$this->db->query("insert into vtiger_group2rs values ('".$group3_id."','H".$role3_id."')");

		//New Security Start
		//Inserting into vtiger_profile vtiger_table
		$this->db->query("insert into vtiger_profile values ('".$profile1_id."','Administrator','Admin Profile')");	
		$this->db->query("insert into vtiger_profile values ('".$profile2_id."','Sales Profile','Profile Related to Sales')");
		$this->db->query("insert into vtiger_profile values ('".$profile3_id."','Support Profile','Profile Related to Support')");
		$this->db->query("insert into vtiger_profile values ('".$profile4_id."','Guest Profile','Guest Profile for Test Users')");
		
		//Inserting into vtiger_profile2gloabal permissions
		$this->db->query("insert into vtiger_profile2globalpermissions values ('".$profile1_id."',1,0)");
		$this->db->query("insert into vtiger_profile2globalpermissions values ('".$profile1_id."',2,0)");
		$this->db->query("insert into vtiger_profile2globalpermissions values ('".$profile2_id."',1,1)");
		$this->db->query("insert into vtiger_profile2globalpermissions values ('".$profile2_id."',2,1)");
		$this->db->query("insert into vtiger_profile2globalpermissions values ('".$profile3_id."',1,1)");
		$this->db->query("insert into vtiger_profile2globalpermissions values ('".$profile3_id."',2,1)");
		$this->db->query("insert into vtiger_profile2globalpermissions values ('".$profile4_id."',1,1)");
		$this->db->query("insert into vtiger_profile2globalpermissions values ('".$profile4_id."',2,1)");

		//Inserting into vtiger_profile2tab
		$this->db->query("insert into vtiger_profile2tab values (".$profile1_id.",1,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile1_id.",2,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile1_id.",3,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile1_id.",4,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile1_id.",6,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile1_id.",7,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile1_id.",8,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile1_id.",9,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile1_id.",10,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile1_id.",13,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile1_id.",14,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile1_id.",15,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile1_id.",16,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile1_id.",18,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile1_id.",19,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile1_id.",20,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile1_id.",21,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile1_id.",22,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile1_id.",23,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile1_id.",24,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile1_id.",25,0)");
       	$this->db->query("insert into vtiger_profile2tab values (".$profile1_id.",26,0)");
       	$this->db->query("insert into vtiger_profile2tab values (".$profile1_id.",27,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile1_id.",30,0)");

		//Inserting into vtiger_profile2tab
		$this->db->query("insert into vtiger_profile2tab values (".$profile2_id.",1,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile2_id.",2,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile2_id.",3,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile2_id.",4,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile2_id.",6,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile2_id.",7,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile2_id.",8,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile2_id.",9,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile2_id.",10,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile2_id.",13,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile2_id.",14,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile2_id.",15,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile2_id.",16,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile2_id.",18,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile2_id.",19,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile2_id.",20,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile2_id.",21,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile2_id.",22,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile2_id.",23,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile2_id.",24,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile2_id.",25,0)");
        $this->db->query("insert into vtiger_profile2tab values (".$profile2_id.",26,0)");
       	$this->db->query("insert into vtiger_profile2tab values (".$profile2_id.",27,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile2_id.",30,0)");

		$this->db->query("insert into vtiger_profile2tab values (".$profile3_id.",1,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile3_id.",2,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile3_id.",3,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile3_id.",4,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile3_id.",6,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile3_id.",7,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile3_id.",8,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile3_id.",9,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile3_id.",10,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile3_id.",13,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile3_id.",14,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile3_id.",15,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile3_id.",16,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile3_id.",18,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile3_id.",19,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile3_id.",20,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile3_id.",21,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile3_id.",22,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile3_id.",23,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile3_id.",24,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile3_id.",25,0)");
        $this->db->query("insert into vtiger_profile2tab values (".$profile3_id.",26,0)");
       	$this->db->query("insert into vtiger_profile2tab values (".$profile3_id.",27,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile3_id.",30,0)");        

		$this->db->query("insert into vtiger_profile2tab values (".$profile4_id.",1,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile4_id.",2,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile4_id.",3,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile4_id.",4,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile4_id.",6,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile4_id.",7,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile4_id.",8,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile4_id.",9,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile4_id.",10,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile4_id.",13,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile4_id.",14,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile4_id.",15,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile4_id.",16,0)");	
		$this->db->query("insert into vtiger_profile2tab values (".$profile4_id.",18,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile4_id.",19,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile4_id.",20,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile4_id.",21,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile4_id.",22,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile4_id.",23,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile4_id.",24,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile4_id.",25,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile4_id.",26,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile4_id.",27,0)");
		$this->db->query("insert into vtiger_profile2tab values (".$profile4_id.",30,0)"); 
		//Inserting into vtiger_profile2standardpermissions  Adminsitrator
		
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",2,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",2,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",2,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",2,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",2,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",4,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",4,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",4,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",4,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",4,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",6,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",6,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",6,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",6,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",6,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",7,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",7,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",7,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",7,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",7,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",8,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",8,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",8,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",8,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",8,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",9,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",9,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",9,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",9,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",9,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",13,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",13,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",13,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",13,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",13,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",14,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",14,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",14,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",14,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",14,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",15,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",15,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",15,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",15,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",15,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",16,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",16,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",16,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",16,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",16,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",18,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",18,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",18,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",18,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",18,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",19,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",19,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",19,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",19,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",19,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",20,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",20,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",20,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",20,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",20,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",21,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",21,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",21,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",21,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",21,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",22,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",22,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",22,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",22,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",22,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",23,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",23,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",23,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",23,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",23,4,0)");



        	$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",26,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",26,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",26,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",26,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile1_id.",26,4,0)");


		//Insert into Profile 2 std permissions for Sales User  
		//Help Desk Create/Delete not allowed. Read-Only	

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",2,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",2,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",2,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",2,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",2,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",4,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",4,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",4,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",4,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",4,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",6,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",6,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",6,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",6,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",6,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",7,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",7,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",7,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",7,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",7,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",8,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",8,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",8,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",8,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",8,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",9,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",9,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",9,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",9,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",9,4,0)");
		
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",13,0,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",13,1,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",13,2,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",13,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",13,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",14,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",14,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",14,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",14,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",14,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",15,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",15,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",15,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",15,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",15,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",16,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",16,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",16,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",16,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",16,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",18,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",18,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",18,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",18,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",18,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",19,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",19,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",19,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",19,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",19,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",20,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",20,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",20,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",20,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",20,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",21,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",21,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",21,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",21,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",21,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",22,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",22,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",22,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",22,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",22,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",23,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",23,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",23,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",23,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",23,4,0)");


        	$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",26,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",26,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",26,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",26,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile2_id.",26,4,0)");

		//Inserting into vtiger_profile2std for Support Profile
		// Potential is read-only

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",2,0,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",2,1,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",2,2,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",2,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",2,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",4,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",4,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",4,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",4,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",4,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",6,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",6,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",6,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",6,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",6,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",7,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",7,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",7,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",7,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",7,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",8,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",8,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",8,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",8,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",8,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",9,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",9,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",9,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",9,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",9,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",13,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",13,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",13,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",13,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",13,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",14,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",14,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",14,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",14,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",14,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",15,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",15,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",15,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",15,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",15,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",16,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",16,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",16,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",16,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",16,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",18,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",18,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",18,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",18,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",18,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",19,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",19,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",19,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",19,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",19,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",20,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",20,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",20,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",20,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",20,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",21,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",21,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",21,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",21,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",21,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",22,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",22,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",22,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",22,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",22,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",23,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",23,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",23,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",23,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",23,4,0)");


        	$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",26,0,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",26,1,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",26,2,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",26,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile3_id.",26,4,0)");
        
		//Inserting into vtiger_profile2stdper for Profile Guest Profile
		//All Read-Only
		
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",2,0,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",2,1,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",2,2,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",2,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",2,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",4,0,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",4,1,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",4,2,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",4,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",4,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",6,0,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",6,1,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",6,2,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",6,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",6,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",7,0,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",7,1,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",7,2,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",7,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",7,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",8,0,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",8,1,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",8,2,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",8,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",8,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",9,0,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",9,1,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",9,2,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",9,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",9,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",13,0,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",13,1,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",13,2,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",13,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",13,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",14,0,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",14,1,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",14,2,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",14,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",14,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",15,0,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",15,1,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",15,2,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",15,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",15,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",16,0,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",16,1,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",16,2,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",16,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",16,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",18,0,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",18,1,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",18,2,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",18,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",18,4,0)");	
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",19,0,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",19,1,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",19,2,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",19,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",19,4,0)");	
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",20,0,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",20,1,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",20,2,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",20,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",20,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",21,0,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",21,1,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",21,2,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",21,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",21,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",22,0,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",22,1,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",22,2,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",22,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",22,4,0)");

		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",23,0,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",23,1,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",23,2,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",23,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",23,4,0)");	


        	$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",26,0,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",26,1,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",26,2,1)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",26,3,0)");
		$this->db->query("insert into vtiger_profile2standardpermissions values (".$profile4_id.",26,4,0)");

		//Insert into vtiger_role2profile
		$this->db->query("insert into vtiger_role2profile values ('H".$role2_id."',".$profile1_id.")");
		$this->db->query("insert into vtiger_role2profile values ('H".$role3_id."',".$profile2_id.")");
	  	$this->db->query("insert into vtiger_role2profile values ('H".$role4_id."',".$profile2_id.")");
		$this->db->query("insert into vtiger_role2profile values ('H".$role5_id."',".$profile2_id.")"); 
	   
		//Insert into vtiger_profile2field
			
                insertProfile2field($profile1_id);
                insertProfile2field($profile2_id);	
                insertProfile2field($profile3_id);	
                insertProfile2field($profile4_id);

		insert_def_org_field();	
		

		//Inserting into vtiger_profile 2 utility Admin
        $this->db->query("insert into vtiger_profile2utility values (".$profile1_id.",2,5,0)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile1_id.",2,6,0)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile1_id.",4,5,0)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile1_id.",4,6,0)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile1_id.",6,5,0)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile1_id.",6,6,0)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile1_id.",7,5,0)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile1_id.",7,6,0)");
        //$this->db->query("insert into vtiger_profile2utility values (".$profile1_id.",8,6,0)");
        //$this->db->query("insert into vtiger_profile2utility values (".$profile1_id.",9,6,0)");
        //$this->db->query("insert into vtiger_profile2utility values (".$profile1_id.",10,6,0)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile1_id.",7,8,0)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile1_id.",6,8,0)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile1_id.",4,8,0)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile1_id.",13,5,0)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile1_id.",13,6,0)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile1_id.",13,8,0)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile1_id.",14,5,0)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile1_id.",14,6,0)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile1_id.",7,9,0)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile1_id.",18,5,0)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile1_id.",18,6,0)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile1_id.",30,3,0)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile1_id.",7,10,0)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile1_id.",6,10,0)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile1_id.",4,10,0)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile1_id.",2,10,0)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile1_id.",13,10,0)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile1_id.",14,10,0)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile1_id.",18,10,0)");

		//Inserting into vtiger_profile2utility Sales Profile
		//Import Export Not Allowed.	
		$this->db->query("insert into vtiger_profile2utility values (".$profile2_id.",2,5,1)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile2_id.",2,6,1)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile2_id.",4,5,1)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile2_id.",4,6,1)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile2_id.",6,5,1)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile2_id.",6,6,1)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile2_id.",7,5,1)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile2_id.",7,6,1)");
        //$this->db->query("insert into vtiger_profile2utility values (".$profile2_id.",8,6,1)");
        //$this->db->query("insert into vtiger_profile2utility values (".$profile2_id.",9,6,1)");
        //$this->db->query("insert into vtiger_profile2utility values (".$profile2_id.",10,6,1)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile2_id.",7,8,0)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile2_id.",6,8,0)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile2_id.",4,8,0)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile2_id.",13,5,1)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile2_id.",13,6,1)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile2_id.",13,8,0)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile2_id.",14,5,1)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile2_id.",14,6,1)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile2_id.",7,9,0)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile2_id.",18,5,1)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile2_id.",18,6,1)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile2_id.",30,3,0)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile2_id.",7,10,0)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile2_id.",6,10,0)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile2_id.",4,10,0)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile2_id.",2,10,0)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile2_id.",13,10,0)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile2_id.",14,10,0)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile2_id.",18,10,0)");

		//Inserting into vtiger_profile2utility Support Profile
		//Import Export Not Allowed.	
		$this->db->query("insert into vtiger_profile2utility values (".$profile3_id.",2,5,1)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile3_id.",2,6,1)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile3_id.",4,5,1)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile3_id.",4,6,1)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile3_id.",6,5,1)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile3_id.",6,6,1)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile3_id.",7,5,1)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile3_id.",7,6,1)");
        //$this->db->query("insert into vtiger_profile2utility values (".$profile3_id.",8,6,1)");
        //$this->db->query("insert into vtiger_profile2utility values (".$profile3_id.",9,6,1)");
        //$this->db->query("insert into vtiger_profile2utility values (".$profile3_id.",10,6,1)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile3_id.",7,8,0)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile3_id.",6,8,0)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile3_id.",4,8,0)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile3_id.",13,5,1)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile3_id.",13,6,1)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile3_id.",13,8,0)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile3_id.",14,5,1)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile3_id.",14,6,1)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile3_id.",7,9,0)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile3_id.",18,5,1)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile3_id.",18,6,1)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile3_id.",30,3,0)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile3_id.",7,10,0)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile3_id.",6,10,0)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile3_id.",4,10,0)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile3_id.",2,10,0)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile3_id.",13,10,0)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile3_id.",14,10,0)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile3_id.",18,10,0)");

		//Inserting into vtiger_profile2utility Guest Profile Read-Only
		//Import Export BusinessCar Not Allowed.	
		$this->db->query("insert into vtiger_profile2utility values (".$profile4_id.",2,5,1)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile4_id.",2,6,1)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile4_id.",4,5,1)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile4_id.",4,6,1)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile4_id.",6,5,1)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile4_id.",6,6,1)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile4_id.",7,5,1)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile4_id.",7,6,1)");
        //$this->db->query("insert into vtiger_profile2utility values (".$profile4_id.",8,6,1)");
        //$this->db->query("insert into vtiger_profile2utility values (".$profile4_id.",9,6,1)");
        //$this->db->query("insert into vtiger_profile2utility values (".$profile4_id.",10,6,1)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile4_id.",7,8,1)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile4_id.",6,8,1)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile4_id.",4,8,1)");	
		$this->db->query("insert into vtiger_profile2utility values (".$profile4_id.",13,5,1)");
    	$this->db->query("insert into vtiger_profile2utility values (".$profile4_id.",13,6,1)");	 
        $this->db->query("insert into vtiger_profile2utility values (".$profile4_id.",13,8,1)");		
		$this->db->query("insert into vtiger_profile2utility values (".$profile4_id.",14,5,1)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile4_id.",14,6,1)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile4_id.",7,9,0)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile4_id.",18,5,1)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile4_id.",18,6,1)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile4_id.",30,3,0)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile4_id.",7,10,0)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile4_id.",6,10,0)");
        $this->db->query("insert into vtiger_profile2utility values (".$profile4_id.",4,10,0)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile4_id.",2,10,0)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile4_id.",13,10,0)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile4_id.",14,10,0)");
		$this->db->query("insert into vtiger_profile2utility values (".$profile4_id.",18,10,0)");

		//Inserting values into org share action mapping
                $this->db->query("insert into vtiger_org_share_action_mapping values(0,'Public: Read Only')");
                $this->db->query("insert into vtiger_org_share_action_mapping values(1,'Public: Read, Create/Edit')");
                $this->db->query("insert into vtiger_org_share_action_mapping values(2,'Public: Read, Create/Edit, Delete')");
                $this->db->query("insert into vtiger_org_share_action_mapping values(3,'Private')");

                $this->db->query("insert into vtiger_org_share_action_mapping values(4,'Hide Details')");
                $this->db->query("insert into vtiger_org_share_action_mapping values(5,'Hide Details and Add Events')");
                $this->db->query("insert into vtiger_org_share_action_mapping values(6,'Show Details')");
                $this->db->query("insert into vtiger_org_share_action_mapping values(7,'Show Details and Add Events')");


		//Inserting for all vtiger_tabs
                $def_org_tabid= Array(2,4,6,7,8,9,10,13,16,20,21,22,23,26);

                foreach($def_org_tabid as $def_tabid)
                {
                        $this->db->query("insert into vtiger_org_share_action2tab values(0,".$def_tabid.")");
                        $this->db->query("insert into vtiger_org_share_action2tab values(1,".$def_tabid.")");
                        $this->db->query("insert into vtiger_org_share_action2tab values(2,".$def_tabid.")");
                        $this->db->query("insert into vtiger_org_share_action2tab values(3,".$def_tabid.")");
                }

		//Insert into default_org_sharingrule
               $this->db->query("insert into vtiger_def_org_share values (".$this->db->getUniqueID('vtiger_def_org_share').",2,2,0)");

               $this->db->query("insert into vtiger_def_org_share values (".$this->db->getUniqueID('vtiger_def_org_share').",4,2,2)");

               $this->db->query("insert into vtiger_def_org_share values (".$this->db->getUniqueID('vtiger_def_org_share').",6,2,0)");

               $this->db->query("insert into vtiger_def_org_share values (".$this->db->getUniqueID('vtiger_def_org_share').",7,2,0)");

               $this->db->query("insert into vtiger_def_org_share values (".$this->db->getUniqueID('vtiger_def_org_share').",9,3,1)");
               $this->db->query("insert into vtiger_def_org_share values (".$this->db->getUniqueID('vtiger_def_org_share').",13,2,0)");
               $this->db->query("insert into vtiger_def_org_share values (".$this->db->getUniqueID('vtiger_def_org_share').",16,3,2)");
               $this->db->query("insert into vtiger_def_org_share values (".$this->db->getUniqueID('vtiger_def_org_share').",20,2,0)");
               $this->db->query("insert into vtiger_def_org_share values (".$this->db->getUniqueID('vtiger_def_org_share').",21,2,0)");
               $this->db->query("insert into vtiger_def_org_share values (".$this->db->getUniqueID('vtiger_def_org_share').",22,2,0)");
               $this->db->query("insert into vtiger_def_org_share values (".$this->db->getUniqueID('vtiger_def_org_share').",23,2,0)");
               $this->db->query("insert into vtiger_def_org_share values (".$this->db->getUniqueID('vtiger_def_org_share').",26,2,0)");
               $this->db->query("insert into vtiger_def_org_share values (".$this->db->getUniqueID('vtiger_def_org_share').",8,2,0)");

		//Populating the DataShare Related Modules

		//Lead Related Module

		//Account Related Module
		$this->db->query("insert into vtiger_datashare_relatedmodules values (".$this->db->getUniqueID('vtiger_datashare_relatedmodules').",6,2)");
		$this->db->query("insert into vtiger_datashare_relatedmodules values (".$this->db->getUniqueID('vtiger_datashare_relatedmodules').",6,13)");
		$this->db->query("insert into vtiger_datashare_relatedmodules values (".$this->db->getUniqueID('vtiger_datashare_relatedmodules').",6,20)");
		$this->db->query("insert into vtiger_datashare_relatedmodules values (".$this->db->getUniqueID('vtiger_datashare_relatedmodules').",6,22)");
		$this->db->query("insert into vtiger_datashare_relatedmodules values (".$this->db->getUniqueID('vtiger_datashare_relatedmodules').",6,23)");

		//Potential Related Module
		$this->db->query("insert into vtiger_datashare_relatedmodules values (".$this->db->getUniqueID('vtiger_datashare_relatedmodules').",2,20)");
		$this->db->query("insert into vtiger_datashare_relatedmodules values (".$this->db->getUniqueID('vtiger_datashare_relatedmodules').",2,22)");

		//Quote Related Module
		$this->db->query("insert into vtiger_datashare_relatedmodules values (".$this->db->getUniqueID('vtiger_datashare_relatedmodules').",20,22)");

		//SO Related Module
		$this->db->query("insert into vtiger_datashare_relatedmodules values (".$this->db->getUniqueID('vtiger_datashare_relatedmodules').",22,23)");	


			
					
  // New Secutity End


         //insert into the vtiger_notificationscheduler vtiger_table

	//insert into related list vtiger_table
	//Inserting for vtiger_account related lists
		
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Accounts").",".getTabid("Contacts").",'get_contacts',1,'Contacts',0)");

	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Accounts").",".getTabid("Potentials").",'get_opportunities',2,'Potentials',0)");	

	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Accounts").",".getTabid("Quotes").",'get_quotes',3,'Quotes',0)");

	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Accounts").",".getTabid("SalesOrder").",'get_salesorder',4,'Sales Order',0)");

	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Accounts").",".getTabid("Invoice").",'get_invoices',5,'Invoice',0)");

	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Accounts").",".getTabid("Calendar").",'get_activities',6,'Activities',0)");

	//added for the ticket4109
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Accounts").",".getTabid("Emails").",'get_emails',7,'Emails',0)");

	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Accounts").",".getTabid("Calendar").",'get_history',8,'Activity History',0)");

	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Accounts").",0,'get_attachments',9,'Attachments',0)");

	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Accounts").",".getTabid("HelpDesk").",'get_tickets',10,'HelpDesk',0)");
	
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Accounts").",".getTabid("Products").",'get_products',11,'Products',0)");

	//Inserting Lead Related Lists	

	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Leads").",".getTabid("Calendar").",'get_activities',1,'Activities',0)");
	
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Leads").",".getTabid("Emails").",'get_emails',2,'Emails',0)");
	
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Leads").",".getTabid("Calendar").",'get_history',3,'Activity History',0)");
	
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Leads").",0,'get_attachments',4,'Attachments',0)");
	
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Leads").",".getTabid("Products").",'get_products',5,'Products',0)");

	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Leads").",".getTabid("Campaigns").",'get_campaigns',6,'Campaigns',0)");

	//Inserting for contact related lists
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Contacts").",".getTabid("Potentials").",'get_opportunities',1,'Potentials',0)");	
		
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Contacts").",".getTabid("Calendar").",'get_activities',2,'Activities',0)");

	
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Contacts").",".getTabid("Emails").",'get_emails',3,'Emails',0)");

	
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Contacts").",".getTabid("HelpDesk").",'get_tickets',4,'HelpDesk',0)");
	
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Contacts").",".getTabid("Quotes").",'get_quotes',5,'Quotes',0)");
	
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Contacts").",".getTabid("PurchaseOrder").",'get_purchase_orders',6,'Purchase Order',0)");
	
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Contacts").",".getTabid("SalesOrder").",'get_salesorder',7,'Sales Order',0)");
	
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Contacts").",".getTabid("Products").",'get_products',8,'Products',0)");

	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Contacts").",".getTabid("Calendar").",'get_history',9,'Activity History',0)");

	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Contacts").",0,'get_attachments',10,'Attachments',0)");

	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Contacts").",".getTabid("Campaigns").",'get_campaigns',11,'Campaigns',0)");

	//Inserting Potential Related Lists	

	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Potentials").",".getTabid("Calendar").",'get_activities',1,'Activities',0)");

	
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Potentials").",".getTabid("Contacts").",'get_contacts',2,'Contacts',0)");

	
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Potentials").",".getTabid("Products").",'get_products',3,'Products',0)");

	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Potentials").",0,'get_stage_history',4,'Sales Stage History',0)");
	
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Potentials").",0,'get_attachments',5,'Attachments',0)");
	
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Potentials").",".getTabid("Quotes").",'get_Quotes',6,'Quotes',0)");
	
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Potentials").",".getTabid("SalesOrder").",'get_salesorder',7,'Sales Order',0)");
	
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Potentials").",".getTabid("Calendar").",'get_history',8,'Activity History',0)");

		//Inserting Product Related Lists	

	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Products").",".getTabid("HelpDesk").",'get_tickets',1,'HelpDesk',0)");

	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Products").",0,'get_attachments',3,'Attachments',0)");
	
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Products").",".getTabid("Quotes").",'get_quotes',4,'Quotes',0)");
	
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Products").",".getTabid("PurchaseOrder").",'get_purchase_orders',5,'Purchase Order',0)");
	
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Products").",".getTabid("SalesOrder").",'get_salesorder',6,'Sales Order',0)");
	
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Products").",".getTabid("Invoice").",'get_invoices',7,'Invoice',0)");
	
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Products").",".getTabid("PriceBooks").",'get_product_pricebooks',8,'PriceBooks',0)");

	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Products").",".getTabid("Leads").",'get_leads',9,'Leads',0)");
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Products").",".getTabid("Accounts").",'get_accounts',10,'Accounts',0)");
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Products").",".getTabid("Contacts").",'get_contacts',11,'Contacts',0)");
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Products").",".getTabid("Potentials").",'get_opportunities',12,'Potentials',0)");

		//Inserting Emails Related Lists	

	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Emails").",".getTabid("Contacts").",'get_contacts',1,'Contacts',0)");

	
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Emails").",0,'get_users',2,'Users',0)");

	
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Emails").",0,'get_attachments',3,'Attachments',0)");

		//Inserting HelpDesk Related Lists
		
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("HelpDesk").",".getTabid("Calendar").",'get_activities',1,'Activities',0)");

	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("HelpDesk").",0,'get_attachments',2,'Attachments',0)");

	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("HelpDesk").",0,'get_ticket_history',3,'Ticket History',0)");
	
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("HelpDesk").",".getTabid("Calendar").",'get_history',4,'Activity History',0)");

	//Inserting PriceBook Related Lists
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("PriceBooks").",14,'get_pricebook_products',2,'Products',0)");

        // Inserting Vendor Related Lists
        $this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Vendors").",14,'get_products',1,'Products',0)");

        $this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Vendors").",21,'get_purchase_orders',2,'Purchase Order',0)");

        $this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Vendors").",4,'get_contacts',3,'Contacts',0)");

	// Inserting Quotes Related Lists
	
        $this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Quotes").",".getTabid("Invoice").",'get_salesorder',1,'Sales Order',0)");
        
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Quotes").",9,'get_activities',2,'Activities',0)");
	
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Quotes").",0,'get_attachments',3,'Attachments',0)");
	
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Quotes").",9,'get_history',4,'Activity History',0)");

	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Quotes").",0,'get_quotestagehistory',5,'Quote Stage History',0)");

	// Inserting Purchase order Related Lists

	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("PurchaseOrder").",9,'get_activities',1,'Activities',0)");
	
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("PurchaseOrder").",0,'get_attachments',2,'Attachments',0)");
	
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("PurchaseOrder").",".getTabid("Calendar").",'get_history',3,'Activity History',0)");
	
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("PurchaseOrder").",0,'get_postatushistory',4,'PurchaseOrder Status History',0)");

	// Inserting Sales order Related Lists

	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("SalesOrder").",9,'get_activities',1,'Activities',0)");
	
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("SalesOrder").",0,'get_attachments',2,'Attachments',0)");
	
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("SalesOrder").",".getTabid("Invoice").",'get_invoices',3,'Invoice',0)");
	
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("SalesOrder").",".getTabid("Calendar").",'get_history',4,'Activity History',0)");
	
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("SalesOrder").",0,'get_sostatushistory',5,'SalesOrder Status History',0)");

	// Inserting Invoice Related Lists

	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Invoice").",9,'get_activities',1,'Activities',0)");
	
	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Invoice").",0,'get_attachments',2,'Attachments',0)");

	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Invoice").",".getTabid("Calendar").",'get_history',3,'Activity History',0)");

	$this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Invoice").",0,'get_invoicestatushistory',4,'Invoice Status History',0)");

	// Inserting Activities Related Lists
	
	$this->db->query("insert into vtiger_relatedlists values (".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Calendar").",0,'get_users',1,'Users',0)");
	$this->db->query("insert into vtiger_relatedlists values (".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Calendar").",4,'get_contacts',2,'Contacts',0)");

	// Inserting Campaigns Related Lists

         $this->db->query("insert into vtiger_relatedlists values (".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Campaigns").",".getTabid("Contacts").",'get_contacts',1,'Contacts',0)");
         $this->db->query("insert into vtiger_relatedlists values (".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Campaigns").",".getTabid("Leads").",'get_leads',2,'Leads',0)");
	 $this->db->query("insert into vtiger_relatedlists values (".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Campaigns").",".getTabid("Potentials").",'get_opportunities',3,'Potentials',0)");
	 $this->db->query("insert into vtiger_relatedlists values(".$this->db->getUniqueID('vtiger_relatedlists').",".getTabid("Campaigns").",9,'get_activities',4,'Activities',0)");

               $this->db->query("insert into vtiger_notificationscheduler(schedulednotificationid,schedulednotificationname,active,notificationsubject,notificationbody,label) values (".$this->db->getUniqueID("vtiger_notificationscheduler").",'LBL_TASK_NOTIFICATION_DESCRITPION',1,'Task Delay Notification','Tasks delayed beyond 24 hrs ','LBL_TASK_NOTIFICATION')");


                $this->db->query("insert into vtiger_notificationscheduler(schedulednotificationid,schedulednotificationname,active,notificationsubject,notificationbody,label) values (".$this->db->getUniqueID("vtiger_notificationscheduler").",'LBL_BIG_DEAL_DESCRIPTION' ,1,'Big Deal notification','Success! A big deal has been won! ','LBL_BIG_DEAL')");


                $this->db->query("insert into vtiger_notificationscheduler(schedulednotificationid,schedulednotificationname,active,notificationsubject,notificationbody,label) values (".$this->db->getUniqueID("vtiger_notificationscheduler").",'LBL_TICKETS_DESCRIPTION',1,'Pending Tickets notification','Ticket pending please ','LBL_PENDING_TICKETS')");


                $this->db->query("insert into vtiger_notificationscheduler(schedulednotificationid,schedulednotificationname,active,notificationsubject,notificationbody,label) values (".$this->db->getUniqueID("vtiger_notificationscheduler").",'LBL_MANY_TICKETS_DESCRIPTION',1,'Too many tickets Notification','Too many tickets pending against this entity ','LBL_MANY_TICKETS')");
		
		$this->db->query("insert into vtiger_notificationscheduler(schedulednotificationid,schedulednotificationname,active,notificationsubject,notificationbody,label,type) values (".$this->db->getUniqueID("vtiger_notificationscheduler").",'LBL_START_DESCRIPTION' ,1,'Support Start Notification','10','LBL_START_NOTIFICATION','select')");

                $this->db->query("insert into vtiger_notificationscheduler(schedulednotificationid,schedulednotificationname,active,notificationsubject,notificationbody,label,type) values (".$this->db->getUniqueID("vtiger_notificationscheduler").",'LBL_SUPPORT_DESCRIPTION',1,'Support ending please','11','LBL_SUPPORT_NOTICIATION','select')");
                $this->db->query("insert into vtiger_notificationscheduler(schedulednotificationid,schedulednotificationname,active,notificationsubject,notificationbody,label,type) values (".$this->db->getUniqueID("vtiger_notificationscheduler").",'LBL_SUPPORT_DESCRIPTION_MONTH',1,'Support ending please','12','LBL_SUPPORT_NOTICIATION_MONTH','select')");

		
 		$this->db->query("insert into vtiger_notificationscheduler(schedulednotificationid,schedulednotificationname,active,notificationsubject,notificationbody,label) values (".$this->db->getUniqueID("vtiger_notificationscheduler").",'LBL_ACTIVITY_REMINDER_DESCRIPTION' ,1,'Activity Reminder Notification','This is a reminder notification for the Activity','LBL_ACTIVITY_NOTIFICATION')");

		//Inserting Inventory Notifications
	$invoice_body = 'Dear {HANDLER},

The current stock of {PRODUCTNAME} in our warehouse is {CURRENTSTOCK}. Kindly procure required number of units as the stock level is below reorder level {REORDERLEVELVALUE}.

Please treat this information as Urgent as the invoice is already sent  to the customer.

Severity: Critical

Thanks,
{CURRENTUSER}';

		
               $this->db->query("insert into vtiger_inventorynotification(notificationid,notificationname,notificationsubject,notificationbody,label) values (".$this->db->getUniqueID("vtiger_inventorynotification").",'InvoiceNotification','{PRODUCTNAME} Stock Level is Low','".$invoice_body." ','InvoiceNotificationDescription')");

		$quote_body = 'Dear {HANDLER},

Quote is generated for {QUOTEQUANTITY} units of {PRODUCTNAME}. The current stock of {PRODUCTNAME} in our warehouse is {CURRENTSTOCK}. 

Severity: Minor

Thanks,
{CURRENTUSER}';	
		
		
               $this->db->query("insert into vtiger_inventorynotification(notificationid,notificationname,notificationsubject,notificationbody,label) values (".$this->db->getUniqueID("vtiger_inventorynotification").",'QuoteNotification','Quote given for {PRODUCTNAME}','".$quote_body." ','QuoteNotificationDescription')");

		$so_body = 'Dear {HANDLER},

SalesOrder is generated for {SOQUANTITY} units of {PRODUCTNAME}. The current stock of {PRODUCTNAME} in our warehouse is {CURRENTSTOCK}. 

Please treat this information  with priority as the sales order is already generated.

Severity: Major

Thanks,
{CURRENTUSER}';

		
               $this->db->query("insert into vtiger_inventorynotification(notificationid,notificationname,notificationsubject,notificationbody,label) values (".$this->db->getUniqueID("vtiger_inventorynotification").",'SalesOrderNotification','Sales Order generated for {PRODUCTNAME}','".$so_body." ','SalesOrderNotificationDescription')");

//insert into inventory terms and conditions table

	$inv_tandc_text='
 - Unless otherwise agreed in writing by the supplier all invoices are payable within thirty (30) days of the date of invoice, in the currency of the invoice, drawn on a bank based in India or by such other method as is agreed in advance by the Supplier.

 - All prices are not inclusive of VAT which shall be payable in addition by the Customer at the applicable rate.';

	$this->db->query("insert into vtiger_inventory_tandc(id,type,tandc) values (".$this->db->getUniqueID("vtiger_inventory_tandc").", 'Inventory', '".$inv_tandc_text."')");	

//insert into email template vtiger_table

	$body='Hello!   <br />
	<br />
	On behalf of the vtiger team,  I am pleased to announce the release of vtiger crm4.2 . This is a feature packed release including the mass email template handling, custom view feature, vtiger_reports feature and a host of other utilities. vtiger runs on all platforms.    <br />
        <br />
	Notable Features of vtiger are :   <br />
	<br />
	-Email Client Integration    <br />
	-Trouble Ticket Integration   <br />
	-Invoice Management Integration   <br />
	-Reports Integration   <br />
	-Portal Integration   <br />
	-Enhanced Word Plugin Support   <br />
	-Custom View Integration   <br />
	<br />
	Known Issues:   <br />
	-ABCD   <br />
	-EFGH   <br />
	-IJKL   <br />
	-MNOP   <br />
	-QRST';

          $this->db->query("insert into vtiger_emailtemplates(foldername,templatename,subject,description,body,deleted,templateid) values ('Public','Announcement for Release','Announcement for Release','Announcement of a release','".$body."',0,".$this->db->getUniqueID('vtiger_emailtemplates').")");
	


$body='name <br />
street, <br />
city, <br />
state, <br />
 zip) <br />
  <br />
 Dear <br />
 <br />
 Please check the following invoices that are yet to be paid by you: <br />
 <br />
 No. Date      Amount <br />
 1   1/1/01    $4000 <br />
 2   2/2//01   $5000 <br />
 3   3/3/01    $10000 <br />
 4   7/4/01    $23560 <br />
 <br />
 Kindly let us know if there are any issues that you feel are pending to be discussed. <br />
 We will be more than happy to give you a call. <br />
 We would like to continue our business with you.';


               $this->db->query("insert into vtiger_emailtemplates(foldername,templatename,subject,description,body,deleted,templateid) values ('Public','Pending Invoices','Invoices Pending','Payment Due','".$body."',0,".$this->db->getUniqueID('vtiger_emailtemplates').")");





$body=' Dear <br />
 <br />
Your proposal on the project XYZW has been reviewed by us <br />
and is acceptable in its entirety. <br />
 <br />
We are eagerly looking forward to this project <br />
and are pleased about having the opportunity to work <br />
together. We look forward to a long standing relationship <br />
with your esteemed firm. <br />
<br />
I would like to take this opportunity to invite you <br />
to a game of golf on Wednesday morning 9am at the <br />
Cuff Links Ground. We will be waiting for you in the <br />
Executive Lounge. <br />
<br />
Looking forward to seeing you there.';

	       
               $this->db->query("insert into vtiger_emailtemplates(foldername,templatename,subject,description,body,deleted,templateid) values ('Public','Acceptance Proposal','Acceptance Proposal','Acceptance of Proposal','".$body."',0,".$this->db->getUniqueID('vtiger_emailtemplates').")");


$body= ' The undersigned hereby acknowledges receipt and delivery of the goods. <br />
The undersigned will release the payment subject to the goods being discovered not satisfactory. <br />
<br />
Signed under seal this <date>';

	       
               $this->db->query("insert into vtiger_emailtemplates(foldername,templatename,subject,description,body,deleted,templateid) values ('Public','Goods received acknowledgement','Goods received acknowledgement','Acknowledged Receipt of Goods','".$body."',0,".$this->db->getUniqueID('vtiger_emailtemplates').")");


	       $body= ' Dear <br />
         We are in receipt of your order as contained in the <br />
   purchase order form.We consider this to be final and binding on both sides. <br />
If there be any exceptions noted, we shall consider them <br />
only if the objection is received within ten days of receipt of <br />
this notice. <br />
 <br />
Thank you for your patronage.';



	       
               $this->db->query("insert into vtiger_emailtemplates(foldername,templatename,subject,description,body,deleted,templateid) values ('Public','Accept Order','Accept Order','Acknowledgement/Acceptance of Order','".$body."',0,".$this->db->getUniqueID('vtiger_emailtemplates').")");




$body='Dear <br />
 <br />
We are relocating our office to <br />
11111,XYZDEF Cross, <br />
UVWWX Circle <br />
The telephone number for this new location is (101) 1212-1328. <br />
<br />
Our Manufacturing Division will continue operations <br />
at 3250 Lovedale Square Avenue, in Frankfurt. <br />
<br />
We hope to keep in touch with you all. <br />
Please update your addressbooks.';

	       
               $this->db->query("insert into vtiger_emailtemplates(foldername,templatename,subject,description,body,deleted,templateid) values ('Public','Address Change','Change of Address','Address Change','".$body."',0,".$this->db->getUniqueID('vtiger_emailtemplates').")");



$body='Dear <br />
<br />
Thank you for extending us the opportunity to meet with <br />
you and members of your staff. <br />
<br />
I know that John Doe serviced your account <br />
for many years and made many friends at your firm. He has personally <br />
discussed with me the deep relationship that he had with your firm. <br />
While his presence will be missed, I can promise that we will <br />
continue to provide the fine service that was accorded by <br />
John to your firm. <br />
<br />
I was genuinely touched to receive such fine hospitality. <br />
<br />
Thank you once again.';


	       
               $this->db->query("insert into vtiger_emailtemplates(foldername,templatename,subject,description,body,deleted,templateid) values ('Public','Follow Up','Follow Up','Follow Up of meeting','".$body."',0,".$this->db->getUniqueID('vtiger_emailtemplates').")");



$body='Congratulations! <br />
<br />
The numbers are in and I am proud to inform you that our <br />
total sales for the previous quarter <br />
amounts to $100,000,00.00!. This is the first time <br />
we have exceeded the target by almost 30%. <br />
We have also beat the previous quarter record by a <br />
whopping 75%! <br />
<br />
Let us meet at Smoking Joe for a drink in the evening! <br />

C you all there guys!';


	       
               $this->db->query("insert into vtiger_emailtemplates(foldername,templatename,subject,description,body,deleted,templateid) values ('Public','Target Crossed!','Target Crossed!','Fantastic Sales Spree!','".$body."',0,".$this->db->getUniqueID('vtiger_emailtemplates').")");

$body='Dear <br />
<br />
Thank you for your confidence in our ability to serve you. <br />
We are glad to be given the chance to serve you.I look <br />
forward to establishing a long term partnership with you. <br />
Consider me as a friend. <br />
Should any need arise,please do give us a call.';


	       
               $this->db->query("insert into vtiger_emailtemplates(foldername,templatename,subject,description,body,deleted,templateid) values ('Public','Thanks Note','Thanks Note','Note of thanks','".$body."',0,".$this->db->getUniqueID('vtiger_emailtemplates').")");

//Added for HTML Eemail templates..
//for Customer Portal Login details
$body='<table width="700" cellspacing="0" cellpadding="0" border="0" align="center" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; font-weight: normal; text-decoration: none; background-color: rgb(122, 122, 254);">
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
                    <tr>
                        <td>
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: rgb(27, 77, 140); font-family: Arial,Helvetica,sans-serif; font-size: 14px; color: rgb(255, 255, 255); font-weight: normal; line-height: 25px;">
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
                        </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; font-weight: normal; color: rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
                                <tr>
                                    <td valign="top">
                                    <table width="100%" cellspacing="0" cellpadding="5" border="0">
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
                                                        <tr>
                                                            <td><br />User ID     : <font color="#990000"><strong> $login_name$</strong></font> </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Password: <font color="#990000"><strong> $password$</strong></font> </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center"> <strong>  $URL$<br /> </strong> </td>
                                                        </tr>
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
                                    </table>
                                    </td>
                                    <td width="1%" valign="top"> </td>
                                </tr>
                        </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <table width="100%" cellspacing="0" cellpadding="5" border="0" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; color: rgb(255, 255, 255); font-weight: normal; line-height: 15px; background-color: rgb(51, 51, 51);">
                                <tr>
                                    <td align="center">Shree Narayana Complex, No 11 Sarathy Nagar, Vijaya Nagar , Velachery, Chennai - 600 042 India </td>
                                </tr>
                                <tr>
                                    <td align="center">Telephone No: +91 - 44 - 4202 - 1990     Toll Free No: +1 877 788 4437</td>
                                </tr>
                                <tr>
                                    <td align="center">Email Id: <a style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; font-weight: bolder; text-decoration: none; color: rgb(255, 255, 255);" href="mailto:support@vtiger.com">support@vtiger.com</a></td>
                                </tr>
                        </table>
                        </td>
                    </tr>
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
</table>';
	       
               $this->db->query("insert into vtiger_emailtemplates(foldername,templatename,subject,description,body,deleted,templateid) values ('Public','Customer Login Details','Customer Portal Login Details','Send Portal login details to customer','".$body."',0,".$this->db->getUniqueID('vtiger_emailtemplates').")");


//for Support end notification before a week	       
$body='<table width="700" cellspacing="0" cellpadding="0" border="0" align="center" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; font-weight: normal; text-decoration: none; background-color: rgb(122, 122, 254);">
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
                    <tr>
                        <td>
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: rgb(27, 77, 140); font-family: Arial,Helvetica,sans-serif; font-size: 14px; color: rgb(255, 255, 255); font-weight: normal; line-height: 25px;">
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
                        </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; font-weight: normal; color: rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
                                <tr>
                                    <td valign="top">
                                    <table width="100%" cellspacing="0" cellpadding="5" border="0">
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
                                    </table>
                                    </td>
                                    <td width="1%" valign="top"> </td>
                                </tr>
                        </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <table width="100%" cellspacing="0" cellpadding="5" border="0" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; color: rgb(255, 255, 255); font-weight: normal; line-height: 15px; background-color: rgb(51, 51, 51);">
                                <tr>
                                    <td align="center">Shree Narayana Complex, No 11 Sarathy Nagar, Vijaya Nagar , Velachery, Chennai - 600 042 India </td>
                                </tr>
                                <tr>
                                    <td align="center">Telephone No: +91 - 44 - 4202 - 1990     Toll Free No: +1 877 788 4437</td>
                                </tr>
                                <tr>
                                    <td align="center">Email Id: <a style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; font-weight: bolder; text-decoration: none; color: rgb(255, 255, 255);" href="mailto:info@vtiger.com">info@vtiger.com</a></td>
                                </tr>
                        </table>
                        </td>
                    </tr>
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
</table>';
               $this->db->query("insert into vtiger_emailtemplates(foldername,templatename,subject,description,body,deleted,templateid) values ('Public','Support end notification before a week','VtigerCRM Support Notification','Send Notification mail to customer before a week of support end date','".$body."',0,".$this->db->getUniqueID('vtiger_emailtemplates').")");
	       
	       
//for Support end notification before a month	       
$body='<table width="700" cellspacing="0" cellpadding="0" border="0" align="center" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; font-weight: normal; text-decoration: none; background-color: rgb(122, 122, 254);">
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
                    <tr>
                        <td>
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: rgb(27, 77, 140); font-family: Arial,Helvetica,sans-serif; font-size: 14px; color: rgb(255, 255, 255); font-weight: normal; line-height: 25px;">
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
                        </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; font-weight: normal; color: rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
                                <tr>
                                    <td valign="top">
                                    <table width="100%" cellspacing="0" cellpadding="5" border="0">
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
                                    </table>
                                    </td>
                                    <td width="1%" valign="top"> </td>
                                </tr>
                        </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <table width="100%" cellspacing="0" cellpadding="5" border="0" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; color: rgb(255, 255, 255); font-weight: normal; line-height: 15px; background-color: rgb(51, 51, 51);">
                                <tr>
                                    <td align="center">Shree Narayana Complex, No 11 Sarathy Nagar, Vijaya Nagar , Velachery, Chennai - 600 042 India </td>
                                </tr>
                                <tr>
                                    <td align="center">Telephone No: +91 - 44 - 4202 - 1990     Toll Free No: +1 877 788 4437</td>
                                </tr>
                                <tr>
                                    <td align="center">Email Id: <a href="mailto:info@vtiger.com" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; font-weight: bolder; text-decoration: none; color: rgb(255, 255, 255);">info@vtiger.com</a></td>
                                </tr>
                        </table>
                        </td>
                    </tr>
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
</table>';
	       $this->db->query("insert into vtiger_emailtemplates(foldername,templatename,subject,description,body,deleted,templateid) values ('Public','Support end notification before a month','VtigerCRM Support Notification','Send Notification mail to customer before a month of support end date','".$body."',0,".$this->db->getUniqueID('vtiger_emailtemplates').")");


		
	       //Insert into vtiger_organizationdetails vtiger_table 
	       $this->db->query("insert into vtiger_organizationdetails(organizationname,address,city,state,country,code,phone,fax,website,logoname) values ('vtiger',' 40-41-42, Sivasundar Apartments, Flat D-II, Shastri Street, Velachery','Chennai','Tamil Nadu','India','600 042','+91-44-5202-1990','+91-44-5202-1990','www.vtiger.com','vtiger-crm-logo.jpg')");


	$this->db->query("insert into vtiger_actionmapping values(0,'Save',0)");
	$this->db->query("insert into vtiger_actionmapping values(1,'EditView',0)");
	$this->db->query("insert into vtiger_actionmapping values(2,'Delete',0)");
	$this->db->query("insert into vtiger_actionmapping values(3,'index',0)");
	$this->db->query("insert into vtiger_actionmapping values(4,'DetailView',0)");
	$this->db->query("insert into vtiger_actionmapping values(5,'Import',0)");
	$this->db->query("insert into vtiger_actionmapping values(6,'Export',0)");
	//$this->db->query("insert into vtiger_actionmapping values(7,'AddBusinessCard',0)");
	$this->db->query("insert into vtiger_actionmapping values(8,'Merge',0)");
	$this->db->query("insert into vtiger_actionmapping values(1,'VendorEditView',1)");
	$this->db->query("insert into vtiger_actionmapping values(4,'VendorDetailView',1)");
	$this->db->query("insert into vtiger_actionmapping values(0,'SaveVendor',1)");
	$this->db->query("insert into vtiger_actionmapping values(2,'DeleteVendor',1)");
	$this->db->query("insert into vtiger_actionmapping values(1,'PriceBookEditView',1)");
	$this->db->query("insert into vtiger_actionmapping values(4,'PriceBookDetailView',1)");
	$this->db->query("insert into vtiger_actionmapping values(0,'SavePriceBook',1)");
	$this->db->query("insert into vtiger_actionmapping values(2,'DeletePriceBook',1)");
	$this->db->query("insert into vtiger_actionmapping values(9,'ConvertLead',0)");
	$this->db->query("insert into vtiger_actionmapping values(1,'DetailViewAjax',1)");
	$this->db->query("insert into vtiger_actionmapping values(4,'TagCloud',1)");
	$this->db->query("insert into vtiger_actionmapping values(1,'QuickCreate',1)");
	$this->db->query("insert into vtiger_actionmapping values(3,'Popup',1)");
	$this->db->query("insert into vtiger_actionmapping values(10,'DuplicatesHandling',0)");

	//Insert values for vtiger_moduleowners vtiger_table which contains the modules and their vtiger_users. default user id admin - after 4.2 patch 2
	$module_array = Array('Potentials','Contacts','Accounts','Leads','Documents','Calendar','Emails','HelpDesk','Products','Faq','Vendors','PriceBooks','Quotes','PurchaseOrder','SalesOrder','Invoice','Reports','Campaigns');
	foreach($module_array as $mod)
	{
		$this->db->query("insert into vtiger_moduleowners values(".getTabid($mod).",1)");
	}
	//added by jeri for category view from db
	$this->db->query("insert into vtiger_parenttab values (1,'My Home Page',1,0)");
	$this->db->query("insert into vtiger_parenttab values (2,'Marketing',2,0)");
	$this->db->query("insert into vtiger_parenttab values (3,'Sales',3,0)");
	$this->db->query("insert into vtiger_parenttab values (4,'Support',4,0)");
	$this->db->query("insert into vtiger_parenttab values (5,'Analytics',5,0)");
	$this->db->query("insert into vtiger_parenttab values (6,'Inventory',6,0)");
	$this->db->query("insert into vtiger_parenttab values (7,'Tools',7,0)");
	$this->db->query("insert into vtiger_parenttab values (8,'Settings',8,0)");

	$this->db->query("insert into vtiger_parenttabrel values (1,9,2)");
	$this->db->query("insert into vtiger_parenttabrel values (1,28,4)");
	$this->db->query("insert into vtiger_parenttabrel values (1,3,1)");
	$this->db->query("insert into vtiger_parenttabrel values (3,7,1)");
	$this->db->query("insert into vtiger_parenttabrel values (3,6,2)");
	$this->db->query("insert into vtiger_parenttabrel values (3,4,3)");
	$this->db->query("insert into vtiger_parenttabrel values (3,2,4)");
	$this->db->query("insert into vtiger_parenttabrel values (3,20,5)");
	$this->db->query("insert into vtiger_parenttabrel values (3,22,6)");
	$this->db->query("insert into vtiger_parenttabrel values (3,23,7)");
	$this->db->query("insert into vtiger_parenttabrel values (3,14,8)");
	$this->db->query("insert into vtiger_parenttabrel values (3,19,9)");
	$this->db->query("insert into vtiger_parenttabrel values (3,8,10)");
	$this->db->query("insert into vtiger_parenttabrel values (4,13,1)");
	$this->db->query("insert into vtiger_parenttabrel values (4,15,2)");
	$this->db->query("insert into vtiger_parenttabrel values (4,6,3)");
	$this->db->query("insert into vtiger_parenttabrel values (4,4,4)");
	$this->db->query("insert into vtiger_parenttabrel values (4,14,5)");
	$this->db->query("insert into vtiger_parenttabrel values (4,8,6)");
	$this->db->query("insert into vtiger_parenttabrel values (5,1,1)");
	$this->db->query("insert into vtiger_parenttabrel values (5,25,2)");
	$this->db->query("insert into vtiger_parenttabrel values (6,14,1)");
	$this->db->query("insert into vtiger_parenttabrel values (6,18,2)");
	$this->db->query("insert into vtiger_parenttabrel values (6,19,3)");
	$this->db->query("insert into vtiger_parenttabrel values (6,21,4)");
	$this->db->query("insert into vtiger_parenttabrel values (6,22,5)");
	$this->db->query("insert into vtiger_parenttabrel values (6,20,6)");
	$this->db->query("insert into vtiger_parenttabrel values (6,23,7)");
	$this->db->query("insert into vtiger_parenttabrel values (7,24,1)");
	$this->db->query("insert into vtiger_parenttabrel values (7,27,2)");
	$this->db->query("insert into vtiger_parenttabrel values (7,8,3)");
	$this->db->query("insert into vtiger_parenttabrel values (2,26,1)");
	$this->db->query("insert into vtiger_parenttabrel values (2,6,2)");
	$this->db->query("insert into vtiger_parenttabrel values (2,4,3)");
	$this->db->query("insert into vtiger_parenttabrel values (2,28,4)");
	$this->db->query("insert into vtiger_parenttabrel values (4,28,7)");
	$this->db->query("insert into vtiger_parenttabrel values (2,7,5)");
	$this->db->query("insert into vtiger_parenttabrel values (2,9,6)");
	$this->db->query("insert into vtiger_parenttabrel values (4,9,8)");
	$this->db->query("insert into vtiger_parenttabrel values (2,8,8)");
	$this->db->query("insert into vtiger_parenttabrel values (3,9,11)");
	$this->db->query("insert into vtiger_parenttabrel values(7,30,4)");
		
	//Added to populate the default inventory tax informations
	$vatid = $this->db->getUniqueID("vtiger_inventorytaxinfo");
	$salesid = $this->db->getUniqueID("vtiger_inventorytaxinfo");
	$serviceid = $this->db->getUniqueID("vtiger_inventorytaxinfo");
	$this->db->query("insert into vtiger_inventorytaxinfo values($vatid,'tax".$vatid."','VAT','4.50','0')");
	$this->db->query("insert into vtiger_inventorytaxinfo values($salesid,'tax".$salesid."','Sales','10.00','0')");
	$this->db->query("insert into vtiger_inventorytaxinfo values($serviceid,'tax".$serviceid."','Service','12.50','0')");
	//After added these taxes we should add these taxes as columns in vtiger_inventoryproductrel table
	$this->db->query("alter table vtiger_inventoryproductrel add column tax$vatid decimal(7,3) default NULL");
	$this->db->query("alter table vtiger_inventoryproductrel add column tax$salesid decimal(7,3) default NULL");
	$this->db->query("alter table vtiger_inventoryproductrel add column tax$serviceid decimal(7,3) default NULL");
	
	//Added to handle picklist uniqueid for the picklist values
        $this->db->query("insert into vtiger_picklistvalues_seq values(1)");

	//Added to populate the default Shipping & Hanlding tax informations
	$shvatid = $this->db->getUniqueID("vtiger_shippingtaxinfo");
	$shsalesid = $this->db->getUniqueID("vtiger_shippingtaxinfo");
	$shserviceid = $this->db->getUniqueID("vtiger_shippingtaxinfo");
	$this->db->query("insert into vtiger_shippingtaxinfo values($shvatid,'shtax".$shvatid."','VAT','4.50','0')");
	$this->db->query("insert into vtiger_shippingtaxinfo values($shsalesid,'shtax".$shsalesid."','Sales','10.00','0')");
	$this->db->query("insert into vtiger_shippingtaxinfo values($shserviceid,'shtax".$shserviceid."','Service','12.50','0')");
	//After added these taxes we should add these taxes as columns in vtiger_inventoryshippingrel table
	$this->db->query("alter table vtiger_inventoryshippingrel add column shtax$shvatid decimal(7,3) default NULL");
	$this->db->query("alter table vtiger_inventoryshippingrel add column shtax$shsalesid decimal(7,3) default NULL");
	$this->db->query("alter table vtiger_inventoryshippingrel add column shtax$shserviceid decimal(7,3) default NULL");

	//version file is included here because without including this file version cannot be get
	include('vtigerversion.php');
	$this->db->query("insert into vtiger_version values('','".$vtiger_current_version."','".$vtiger_current_version."')");
	
	$this->db->query("INSERT INTO vtiger_inventory_num values(".$this->db->getUniqueID('vtiger_inventory_num').",'Invoice','INV','1','6','1')");
	$this->db->query("INSERT INTO vtiger_inventory_num values(".$this->db->getUniqueID('vtiger_inventory_num').",'Quotes','QUOTE','1','6','1')");
	$this->db->query("INSERT INTO vtiger_inventory_num values(".$this->db->getUniqueID('vtiger_inventory_num').",'SalesOrder','SO','1','6','1')");
	$this->db->query("INSERT INTO vtiger_inventory_num values(".$this->db->getUniqueID('vtiger_inventory_num').",'PurchaseOrder','PO','1','6','1')");

	$this->db->query("INSERT INTO vtiger_reminder_interval values(".$this->db->getUniqueID('vtiger_reminder_interval').",'None',0,1)");
	$this->db->query("INSERT INTO vtiger_reminder_interval values(".$this->db->getUniqueID('vtiger_reminder_interval').",'1 Minute',1,1)");
	$this->db->query("INSERT INTO vtiger_reminder_interval values(".$this->db->getUniqueID('vtiger_reminder_interval').",'5 Minutes',2,1)");
	$this->db->query("INSERT INTO vtiger_reminder_interval values(".$this->db->getUniqueID('vtiger_reminder_interval').",'15 Minutes',3,1)");
	$this->db->query("INSERT INTO vtiger_reminder_interval values(".$this->db->getUniqueID('vtiger_reminder_interval').",'30 Minutes',4,1)");
	$this->db->query("INSERT INTO vtiger_reminder_interval values(".$this->db->getUniqueID('vtiger_reminder_interval').",'45 Minutes',5,1)");
	$this->db->query("INSERT INTO vtiger_reminder_interval values(".$this->db->getUniqueID('vtiger_reminder_interval').",'1 Hour',6,1)");
	$this->db->query("INSERT INTO vtiger_reminder_interval values(".$this->db->getUniqueID('vtiger_reminder_interval').",'1 Day',7,1)");

	$this->insertUser2mergefields(0);
	$this->insertUser2mergefields(1);
    $this->insertUser2mergefields(2);
	$this->db->query("update vtiger_user2mergefields set visible=1 where fieldid in(1,38,40,65,104,106,111,152,156,255)");

	}	
		
	//Added to insert the records in vtiger_user_mergefields
	function insertUser2mergefields($userid)
	{
		global $log;
		$log->debug("Entering insertUser2mergefields(".$userid.") method ...");
	        $log->info("in insertUser2mergefields ".$userid);
	
		//$this->db->database->SetFetchMode(ADODB_FETCH_ASSOC); 
		$fld_result = $this->db->query("select * from vtiger_field where generatedtype=1 and displaytype in (1,2,3) and tabid != 29 and uitype not in(70,69) and fieldid not in(87,148,151,155,102)");
	    $num_rows = $this->db->num_rows($fld_result);
        for($i=0; $i<$num_rows; $i++)
        {
			$tab_id = $this->db->query_result($fld_result,$i,'tabid');
			$field_id = $this->db->query_result($fld_result,$i,'fieldid');
			$this->db->query("insert into vtiger_user2mergefields values ($userid, $tab_id, $field_id, 0)");
		}
		$log->debug("Exiting insertUser2mergefields method ...");
	}
}
?>
