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

// TabMenu shown in the header page.
class Security extends SugarBean {
	var $table_name = "role";
		
	function Security() {
		$this->log = LoggerManager::getLogger('security');
		$this->db = new PearDatabase();
	}

	var $new_schema = true;

	function create_tables () {
		global $app_strings;
                //role table must have role name as the primary key		
		$query = 'CREATE TABLE '.$this->table_name.' ( ';
		$query .='name varchar(60) NOT NULL';
		$query .=',description  varchar(100)';
		$query .=',PRIMARY KEY (name) )'; 

		$this->log->info($query);
		mysql_query($query) or die($app_strings['ERR_CREATING_TABLE'].mysql_error());	
		
                mysql_query("insert into role(name,description) values('administrator','')");
		mysql_query("insert into role(name,description) values('standard_user','')");
                
		// Create the indexes
		$this->create_index("create index idx_role_name on role (name)");




                

                $table_name="user2role";

                //user2role must have userid as the primary key
                $query = 'CREATE TABLE '.$table_name.' ( ';
		$query .='userid varchar(100) NOT NULL  ';
		$query .=', rolename varchar (50) NOT NULL';
		$query .=', PRIMARY KEY (userid) )'; 

		$this->log->info($query);
		mysql_query($query) or die($app_strings['ERR_CREATING_TABLE'].mysql_error());	
                // Create the indexes
		$this->create_index("create index idx_user2role_name on user2role(userid)");

		mysql_query("insert into user2role values(1,'administrator')");
                $this->log->info($query);
                mysql_query($query);
                
                //primary key will be rolename and tabid
                $table_name="role2tab";
                            
                $query = 'CREATE TABLE '.$table_name.' ( ';
		$query .='rolename varchar(100) NOT NULL';
                $query .=', tabid int NOT NULL';
		$query .=', module_permission tinyint(4) NOT NULL';
		$query .=', description varchar(100) NOT NULL';
		$query .=', PRIMARY KEY (rolename,tabid) )'; 


		$this->log->info($query);
		mysql_query($query) or die($app_strings['ERR_CREATING_TABLE'].mysql_error());	
		// Create the indexes
		$this->create_index("create index idx_role2tab_name on role2tab (rolename,tabid)");

                
                mysql_query("insert into role2tab(rolename,tabid,module_permission,description) values ('administrator',1,1,'')");
                mysql_query("insert into role2tab(rolename,tabid,module_permission,description) values ('administrator',2,1,'')");
                mysql_query("insert into role2tab(rolename,tabid,module_permission,description) values ('administrator',3,1,'')");
                mysql_query("insert into role2tab(rolename,tabid,module_permission,description) values ('administrator',4,1,'')");
                mysql_query("insert into role2tab(rolename,tabid,module_permission,description) values ('administrator',5,1,'')");
                mysql_query("insert into role2tab(rolename,tabid,module_permission,description) values ('administrator',6,1,'')");
                mysql_query("insert into role2tab(rolename,tabid,module_permission,description) values ('administrator',7,1,'')");
		mysql_query("insert into role2tab(rolename,tabid,module_permission,description) values ('administrator',8,1,'')");

                mysql_query("insert into role2tab(rolename,tabid,module_permission,description) values ('administrator',9,1,'')");
                mysql_query("insert into role2tab(rolename,tabid,module_permission,description) values ('administrator',10,1,'')");
                mysql_query("insert into role2tab(rolename,tabid,module_permission,description) values ('administrator',11,1,'')");
		mysql_query("insert into role2tab(rolename,tabid,module_permission,description) values ('administrator',12,1,'')");
                mysql_query("insert into role2tab(rolename,tabid,module_permission,description) values ('administrator',13,1,'')");
		
                mysql_query("insert into role2tab(rolename,tabid,module_permission,description) values ('administrator',14,1,'')");
                mysql_query("insert into role2tab(rolename,tabid,module_permission,description) values ('administrator',15,1,'')");

                mysql_query("insert into role2tab(rolename,tabid,module_permission,description) values ('administrator',16,1,'')");



                
                mysql_query("insert into role2tab(rolename,tabid,module_permission,description) values ('standard_user',1,1,'')");
                mysql_query("insert into role2tab(rolename,tabid,module_permission,description) values ('standard_user',2,1,'')");
                mysql_query("insert into role2tab(rolename,tabid,module_permission,description) values ('standard_user',3,1,'')");
                mysql_query("insert into role2tab(rolename,tabid,module_permission,description) values ('standard_user',4,1,'')");
                mysql_query("insert into role2tab(rolename,tabid,module_permission,description) values ('standard_user',5,1,'')");
                mysql_query("insert into role2tab(rolename,tabid,module_permission,description) values ('standard_user',6,1,'')");
                mysql_query("insert into role2tab(rolename,tabid,module_permission,description) values ('standard_user',7,1,'')");
                mysql_query("insert into role2tab(rolename,tabid,module_permission,description) values ('standard_user',8,1,'')");
                mysql_query("insert into role2tab(rolename,tabid,module_permission,description) values ('standard_user',9,1,'')");
                mysql_query("insert into role2tab(rolename,tabid,module_permission,description) values ('standard_user',10,1,'')");
                mysql_query("insert into role2tab(rolename,tabid,module_permission,description) values ('standard_user',11,1,'')");
                mysql_query("insert into role2tab(rolename,tabid,module_permission,description) values ('standard_user',12,1,'')");
                mysql_query("insert into role2tab(rolename,tabid,module_permission,description) values ('standard_user',13,1,'')");
                mysql_query("insert into role2tab(rolename,tabid,module_permission,description) values ('standard_user',14,1,'')");
                mysql_query("insert into role2tab(rolename,tabid,module_permission,description) values ('standard_user',15,1,'')");
                mysql_query("insert into role2tab(rolename,tabid,module_permission,description) values ('standard_user',16,1,'')");












                $table_name="role2action";
                
                //primary key will be rolename,tabid and actionname
                $query = 'CREATE TABLE '.$table_name.' ( ';
		$query .='rolename varchar(50)';
                $query .=', tabid int(11) NOT NULL ';
                $query .=', actionname varchar(100) NOT NULL';
		$query .=', action_permission tinyint(4) NOT NULL';
                $query .=', description varchar(100) NOT NULL';
		$query .=', PRIMARY KEY (rolename,tabid,actionname) )'; 


		$this->log->info($query);
		mysql_query($query) or die($app_strings['ERR_CREATING_TABLE'].mysql_error());	
		// Create the indexes
		$this->create_index("create index idx_role2action_name on role2action (rolename,tabid,actionname)");
                
		
                

                
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',1,'index',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',1,'EditView',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',1,'Delete',1,'')");
                 mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',1,'Save',1,'')");

                

                
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',2,'index',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',2,'EditView',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',2,'Delete',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',2,'Save',1,'')");
                
                

                
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',3,'index',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',3,'EditView',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',3,'Delete',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',3,'Save',1,'')");

                
                
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',4,'index',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',4,'EditView',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',4,'Delete',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',4,'Save',1,'')");

                
                
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',5,'index',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',5,'EditView',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',5,'Delete',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',5,'Save',1,'')");

                
                
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',6,'index',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',6,'EditView',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',6,'Delete',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',6,'Save',1,'')");

                
                
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',7,'index',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',7,'EditView',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',7,'Delete',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',7,'Save',1,'')");

                

                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',8,'index',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',8,'EditView',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',8,'Delete',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',8,'Save',1,'')");

                
                
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',9,'index',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',9,'EditView',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',9,'Delete',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',9,'Save',1,'')");

                
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',10,'index',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',10,'EditView',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',10,'Delete',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',10,'Save',1,'')");

                


                
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',11,'index',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',11,'EditView',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',11,'Delete',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',11,'Save',1,'')");

                
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',12,'index',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',12,'EditView',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',12,'Delete',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',12,'Save',1,'')");

                
                
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',13,'index',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',13,'EditView',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',13,'Delete',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',13,'Save',1,'')");

 
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',14,'index',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',14,'CreateTicket',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',14,'SaveTicket',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',14,'DeleteTicket',1,'')");



 
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',15,'index',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',15,'EditView',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',15,'Delete',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',15,'Save',1,'')");




               //entries for the import features 
               mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',3,'fetchfile',1,'')");
               mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',4,'BusinessCard',1,'')");
               mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',4,'Import',1,'')");
               mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',5,'Import',1,'')");
               mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('administrator',6,'Import',1,'')");
                
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',1,'index',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',1,'EditView',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',1,'Delete',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',1,'Save',1,'')");
                






                
                
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',2,'index',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',2,'EditView',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',2,'Delete',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',2,'Save',1,'')");

                

                
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',3,'index',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',3,'EditView',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',3,'Delete',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',3,'Save',1,'')");

                
                
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',4,'index',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',4,'EditView',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',4,'Delete',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',4,'Save',1,'')");

                
                
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',5,'index',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',5,'EditView',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',5,'Delete',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',5,'Save',1,'')");

                
                
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',6,'index',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',6,'EditView',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',6,'Delete',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',6,'Save',1,'')");

                
                
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',7,'index',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',7,'EditView',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',7,'Delete',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',7,'Save',1,'')");

                

                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',8,'index',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',8,'EditView',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',8,'Delete',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',8,'Save',1,'')");

                
                
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',9,'index',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',9,'EditView',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',9,'Delete',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',9,'Save',1,'')");

                
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',10,'index',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',10,'EditView',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',10,'Delete',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',10,'Save',1,'')");

                


                
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',11,'index',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',11,'EditView',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',11,'Delete',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',11,'Save',1,'')");

                
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',12,'index',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',12,'EditView',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',12,'Delete',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',12,'Save',1,'')");

                
                
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',13,'index',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',13,'EditView',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',13,'Delete',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',13,'Save',1,'')");

                  
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',14,'index',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',14,'CreateTicket',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',14,'SaveTicket',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',14,'DeleteTicket',1,'')");

                

                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',15,'index',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',15,'EditView',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',15,'Delete',1,'')");
                mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',15,'Save',1,'')");

                


  //entries for the import features
               mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',3,'fetchfile',0,'')");
               mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',4,'BusinessCard',1,'')");
               mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',4,'Import',0,'')");
               mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',5,'Import',0,'')");
               mysql_query("insert into role2action(rolename,tabid,actionname,action_permission,description) values ('standard_user',6,'Import',0,'')");



                //GROUPS TABLE
                $table_name="groups";
                            
                $query = 'CREATE TABLE '.$table_name.' ( ';
		$query .='name varchar(100) NOT NULL';
                $query .=', primary key(name)';
		$query .=', description TEXT';
		$query .=' )'; 


		$this->log->info($query);
		mysql_query($query) or die($app_strings['ERR_CREATING_TABLE'].mysql_error());	
		// Create the indexes
		$this->create_index("create index idx_groups_name on groups (name)");


		//users2group table 
                $table_name="users2group";
                            
                $query = 'CREATE TABLE '.$table_name.' ( ';
		$query .='groupname varchar(100) NOT NULL';
                $query .=', userid varchar(50)';
		$query .=', primary key(groupname,userid)';
		$query .=')'; 


		$this->log->info($query);
		mysql_query($query) or die($app_strings['ERR_CREATING_TABLE'].mysql_error());	
		// Create the indexes
		$this->create_index("create index idx_users2group on users2group (groupname,userid)");


 $table_name="productcollaterals";
                $query = "create table " .$table_name ." ( productid int(11) NOT NULL ";
                $query .=",date_entered datetime NOT NULL default '0000-00-00 00:00:00'";
                $query .= ",parent_type varchar(50) NOT NULL default '',parent_id varchar(100) NOT NULL default '',data longblob NOT NULL,description tinytext,filename varchar(50) NOT NULL default '',filesize varchar(50) NOT NULL default '',filetype varchar(20) NOT NULL default '',PRIMARY KEY  (productid,filename))";
                $this->log->info($query);
                mysql_query($query) or die($app_strings['ERR_CREATING_TABLE'].mysql_error());
                $this->create_index("create index idx_collaterals_name on productcollaterals (productid,filename)");


	 $table_name="email_attachments";
                $query = "create table " .$table_name ." (id int(11) NOT NULL auto_increment,date_entered datetime NOT NULL,parent_type varchar(100), parent_id varchar(100) NOT NULL,data longblob NOT NULL,filename varchar(50) NOT NULL,filesize varchar(50) NOT NULL,filetype varchar(20) NOT NULL,PRIMARY KEY (id,filename ) )";
                $this->log->info($query);
                mysql_query($query) or die($app_strings['ERR_CREATING_TABLE'].mysql_error());
                $this->create_index("create index idx_email_attachments_name on email_attachments (id,filename)");


		$query = "create table wordtemplatestorage(filename varchar(100) NOT NULL,`date_entered` datetime NOT NULL default '0000-00-00 00:00:00',`parent_type` varchar(50) NOT NULL default '',`parent_id` varchar(100) NOT NULL default '',`data` longblob NOT NULL,`description` TEXT,`filesize` varchar(50) NOT NULL default '',`filetype` varchar(20) NOT NULL default '',PRIMARY KEY(filename))";
	 	$this->log->info($query);
                mysql_query($query) or die($app_strings['ERR_CREATING_TABLE'].mysql_error());
                $this->create_index("create index idx_wordtemplatestorage on wordtemplatestorage (filename)");

		$query="create table emailtemplatestorage (foldername varchar(100) NOT NULL default '',templatename varchar (100) NOT NULL,subject varchar(100) NOT NULL, description TEXT, body TEXT , PRIMARY KEY (foldername,templatename,subject))";

	 	$this->log->info($query);
                mysql_query($query) or die($app_strings['ERR_CREATING_TABLE'].mysql_error());
                $this->create_index("create index idx_emailtemplatestorage on emailtemplatestorage (foldername,templatename,subject)");
	       	}

	function drop_tables () {

		$query = 'DROP TABLE IF EXISTS '.$this->table_name;

		$this->log->info($query);
                mysql_query($query);

                $table_name="user2role";
                $query = 'DROP TABLE IF EXISTS '.$table_name;
                                
		$this->log->info($query);
                mysql_query($query);

                
                
                $table_name="role2tab";
                $query = 'DROP TABLE IF EXISTS '.$table_name;
                                
		$this->log->info($query);
                mysql_query($query);

                
                $table_name="role2action";
                $query = 'DROP TABLE IF EXISTS '.$table_name;
                                
		$this->log->info($query);
                mysql_query($query);

		$table_name="groups";
                $query = 'DROP TABLE IF EXISTS '.$table_name;
                                
		$this->log->info($query);
                mysql_query($query);
	
		$table_name="users2group";
                $query = 'DROP TABLE IF EXISTS '.$table_name;
                                
		$this->log->info($query);
                mysql_query($query);
		
		$table_name="productcollaterals";
                $query = 'DROP TABLE IF EXISTS '.$table_name;
                                
		$this->log->info($query);
                mysql_query($query);
	
		$table_name="email_attachments";
                $query = 'DROP TABLE IF EXISTS '.$table_name;
                                
		$this->log->info($query);
                mysql_query($query);

		$table_name="wordtemplatestorage";
               $query = 'DROP TABLE IF EXISTS '.$table_name;
                                
		$this->log->info($query);
                mysql_query($query);

		$table_name="emailtemplatestorage";
               $query = 'DROP TABLE IF EXISTS '.$table_name;
                                
		$this->log->info($query);
                mysql_query($query);


	
	}
	
	function get_summary_text()
	{
		return "$this->name";
	}
}
?>
