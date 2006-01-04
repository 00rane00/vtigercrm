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
 * $Header$
 * Description:  Includes generic helper functions used throughout the application.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/



/** This function returns the name of the person.
  * It currently returns "first last".  It should not put the space if either name is not available.
  * It should not return errors if either name is not available.
  * If no names are present, it will return ""
  * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
  * All Rights Reserved.
  * Contributor(s): ______________________________________..
  */

  require_once('include/database/PearDatabase.php');
  require_once('include/ComboUtil.php'); //new
  require_once('include/utils/utils.php'); //new






/**
 * Check if user id belongs to a system admin.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 */
function is_admin($user) {
	if ($user->is_admin == 'on') return true;
	else return false;
}

/**
 * THIS FUNCTION IS DEPRECATED AND SHOULD NOT BE USED; USE get_select_options_with_id()
 * Create HTML to display select options in a dropdown list.  To be used inside
 * of a select statement in a form.
 * param $option_list - the array of strings to that contains the option list
 * param $selected - the string which contains the default value
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 */
function get_select_options (&$option_list, $selected, $advsearch='false') {
	return get_select_options_with_id($option_list, $selected, $advsearch);
}

/**
 * Create HTML to display select options in a dropdown list.  To be used inside
 * of a select statement in a form.   This method expects the option list to have keys and values.  The keys are the ids.  The values is an array of the datas 
 * param $option_list - the array of strings to that contains the option list
 * param $selected - the string which contains the default value
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 */
function get_select_options_with_id (&$option_list, $selected_key, $advsearch='false') {
	return get_select_options_with_id_separate_key($option_list, $option_list, $selected_key, $advsearch);
}

/**
 * Create HTML to display select options in a dropdown list.  To be used inside
 * of a select statement in a form.   This method expects the option list to have keys and values.  The keys are the ids.
 * The values are the display strings.
 */
function get_select_options_login (&$option_list, $selected_key, $advsearch='false') {
        return get_option_strings($option_list, $option_list, $selected_key, $advsearch);
}

/**
 * Create HTML to display select options in a dropdown list.  To be used inside
 * of a select statement in a form.   This method expects the option list to have keys and values.  The keys are the ids.  The value is an array of data
 * param $label_list - the array of strings to that contains the option list
 * param $key_list - the array of strings to that contains the values list
 * param $selected - the string which contains the default value
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 */
function get_select_options_with_id_separate_key (&$label_list, &$key_list, $selected_key, $advsearch='false') {
	global $app_strings;
	if($advsearch=='true')
	$select_options = "\n<OPTION value=''>--NA--</OPTION>";
	else
	$select_options = "";

	//for setting null selection values to human readable --None--
	$pattern = "/'0?'></";
	$replacement = "''>".$app_strings['LBL_NONE']."<";
	if (!is_array($selected_key)) $selected_key = array($selected_key);

	//create the type dropdown domain and set the selected value if $opp value already exists
	foreach ($key_list as $option_key=>$option_value) {
		$selected_string = '';
		// the system is evaluating $selected_key == 0 || '' to true.  Be very careful when changing this.  Test all cases.
		// The reported bug was only happening with one of the users in the drop down.  It was being replaced by none.
		if (($option_key != '' && $selected_key == $option_key) || ($selected_key == '' && $option_key == '') || (in_array($option_key, $selected_key)))
		{
			$selected_string = 'selected ';
		}

		$html_value = $option_key;

		$select_options .= "\n<OPTION ".$selected_string."value='$html_value'>$label_list[$option_key]</OPTION>";
		$options[$html_value]=array($label_list[$option_key]=>$selected_string);
	}
	$select_options = preg_replace($pattern, $replacement, $select_options);

	return $options;
}

/**
 * Create HTML to display select options in a dropdown list.  To be used inside
 * of a select statement in a form.   This method expects the option list to have keys and values.  The keys are the ids.
 * The values are the display strings.
 */

function get_option_strings(&$label_list, &$key_list, $selected_key, $advsearch='false')
{
    global $app_strings;
    if($advsearch=='true')
    $select_options = "\n<OPTION value=''>--NA--</OPTION>";
    else
    $select_options = "";

    $pattern = "/'0?'></";
    $replacement = "''>".$app_strings['LBL_NONE']."<";
    if (!is_array($selected_key)) $selected_key = array($selected_key);

    foreach ($key_list as $option_key=>$option_value) {
        $selected_string = '';
        if (($option_key != '' && $selected_key == $option_key) || ($selected_key == '' && $option_key == '') || (in_array($option_key, $selected_key)))
        {
            $selected_string = 'selected ';
        }

        $html_value = $option_key;

        $select_options .= "\n<OPTION ".$selected_string."value='$html_value'>$label_list[$option_key]</OPTION>";
    }
    $select_options = preg_replace($pattern, $replacement, $select_options);
    return $select_options;

}

/**
 * Converts localized date format string to jscalendar format
 * Example: $array = array_csort($array,'town','age',SORT_DESC,'name');
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 */
function parse_calendardate($local_format) {
	global $current_user;
	if($current_user->date_format == 'dd-mm-yyyy')
	{
		$dt_popup_fmt = "%d-%m-%Y";
	}
	elseif($current_user->date_format == 'mm-dd-yyyy')
	{
		$dt_popup_fmt = "%m-%d-%Y";
	}
	elseif($current_user->date_format == 'yyyy-mm-dd')
	{
		$dt_popup_fmt = "%Y-%m-%d";
	}
	return $dt_popup_fmt;
	//return "%Y-%m-%d";
}


function from_html($string, $encode=true){
        global $toHtml;
        //if($encode && is_string($string))$string = html_entity_decode($string, ENT_QUOTES);
        if($encode && is_string($string)){
                $string = str_replace(array_values($toHtml), array_keys($toHtml), $string);
        }
        return $string;
}


function get_group_options()
{
	global $adb,$noof_group_rows;;
	$sql = "select groupname from groups";
	$result = $adb->query($sql);
	$noof_group_rows=$adb->num_rows($result);
	return $result;
}


function getTabid($module)
{
        global $log;
        $log->info("module  is ".$module);
        global $adb;
	$sql = "select tabid from tab where name='".$module."'";
	$result = $adb->query($sql);
	$tabid=  $adb->query_result($result,0,"tabid");
	return $tabid;

}

function getSalesEntityType($crmid)
{
	global $log;
	$log->info("in getSalesEntityType ".$crmid);
	global $adb;
	$sql = "select * from crmentity where crmid=".$crmid;
        $result = $adb->query($sql);
	$parent_module = $adb->query_result($result,0,"setype");
	return $parent_module;
}

function getAccountName($account_id)
{
global $log;
$log->info("in getAccountName ".$account_id);

	global $adb;
	if($account_id != '')
	{
		$sql = "select accountname from account where accountid=".$account_id;
        	$result = $adb->query($sql);
		$accountname = $adb->query_result($result,0,"accountname");
	}
	return $accountname;
}

function getProductName($product_id)
{

global $log;
$log->info("in getproductname ".$product_id);

	global $adb;
	$sql = "select productname from products where productid=".$product_id;
        $result = $adb->query($sql);
	$productname = $adb->query_result($result,0,"productname");
	return $productname;
}


function getPotentialName($potential_id)
{
	global $log;
$log->info("in getPotentialName ".$potential_id);

	global $adb;
	$sql = "select potentialname from potential where potentialid=".$potential_id;
        $result = $adb->query($sql);
	$potentialname = $adb->query_result($result,0,"potentialname");
	return $potentialname;
}


function getContactName($contact_id)
{
global $log;
$log->info("in getContactName ".$contact_id);

        global $adb;
        $sql = "select * from contactdetails where contactid=".$contact_id;
        $result = $adb->query($sql);
        $firstname = $adb->query_result($result,0,"firstname");
        $lastname = $adb->query_result($result,0,"lastname");
        $contact_name = $lastname.' '.$firstname;
        return $contact_name;
}

function getVendorName($vendor_id)
{
global $log;
$log->info("in getVendorName ".$vendor_id);
        global $adb;
        $sql = "select * from vendor where vendorid=".$vendor_id;
        $result = $adb->query($sql);
        $vendor_name = $adb->query_result($result,0,"vendorname");
        return $vendor_name;
}

function getQuoteName($quote_id)
{
global $log;
$log->info("in getQuoteName ".$quote_id);
        global $adb;
        $sql = "select * from quotes where quoteid=".$quote_id;
        $result = $adb->query($sql);
        $quote_name = $adb->query_result($result,0,"subject");
        return $quote_name;
}
function getPriceBookName($pricebookid)
{
global $log;
$log->info("in getPriceBookName ".$pricebookid);
        global $adb;
        $sql = "select * from pricebook where pricebookid=".$pricebookid;
        $result = $adb->query($sql);
        $pricebook_name = $adb->query_result($result,0,"bookname");
        return $pricebook_name;
}

/** This Function returns the  Purchase Order Name.
  * The following is the input parameter for the function
  *  $po_id --> Purchase Order Id, Type:Integer
  */
function getPoName($po_id)
{

global $log;
        $log->info("in getPoName ".$po_id);

        global $adb;
        $sql = "select * from purchaseorder where purchaseorderid=".$po_id;
        $result = $adb->query($sql);
        $po_name = $adb->query_result($result,0,"subject");
        return $po_name;
}

function getSoName($so_id)
{
        global $log;
$log->info("in getSoName ".$so_id);
	global $adb;
        $sql = "select * from salesorder where salesorderid=".$so_id;
        $result = $adb->query($sql);
        $so_name = $adb->query_result($result,0,"subject");
        return $so_name;
}


function getGroupName($id, $module)
{
	global $log;
$log->info("in getGroupName ".$id.'  module is    '.$module);
	global $adb;
	if($module == 'Leads')
	{
		$sql = "select * from leadgrouprelation where leadid=".$id;
	}
        elseif($module == 'HelpDesk')
        {
                $sql = "select * from ticketgrouprelation where ticketid=".$id;
        }
	elseif($module = 'Calls')
	{
		$sql = "select * from activitygrouprelation where activityid=".$id;
	}
	elseif($module = 'Tasks')
	{
		$sql = "select * from taskgrouprelation where taskid=".$id;
	}
	$result = $adb->query($sql);
	$groupname = $adb->query_result($result,0,"groupname");
	return $groupname;
}


function getUserName($userid)
{
global $log;
$log->info("in getUserName ".$userid);

	global $adb;
	if($userid != '')
	{
		$sql = "select user_name from users where id=".$userid;
		$result = $adb->query($sql);
		$user_name = $adb->query_result($result,0,"user_name");
	}
	return $user_name;	
}


function getURLstring($focus)
{
	$qry = "";
	foreach($focus->column_fields as $fldname=>$val)
	{
		if(isset($_REQUEST[$fldname]) && $_REQUEST[$fldname] != '')
		{
			if($qry == '')
			$qry = "&".$fldname."=".$_REQUEST[$fldname];
			else
			$qry .="&".$fldname."=".$_REQUEST[$fldname];
		}
	}
	if(isset($_REQUEST['current_user_only']) && $_REQUEST['current_user_only'] !='')
	{
		$qry .="&current_user_only=".$_REQUEST['current_user_only'];
	}
	if(isset($_REQUEST['advanced']) && $_REQUEST['advanced'] =='true')
	{
		$qry .="&advanced=true";
	}

	if($qry !='')
	{
		$qry .="&query=true";
	}
	return $qry;

}


function getDisplayDate($cur_date_val)
{
	global $current_user;
	$dat_fmt = $current_user->date_format;
	if($dat_fmt == '')
	{
		$dat_fmt = 'dd-mm-yyyy';
	}

		//echo $dat_fmt;
		//echo '<BR>'.$cur_date_val.'<BR>';
		$date_value = explode(' ',$cur_date_val);
		list($y,$m,$d) = split('-',$date_value[0]);
		//echo $y.'----'.$m.'------'.$d;
		if($dat_fmt == 'dd-mm-yyyy')
		{
			//echo '<br> inside 1';
			$display_date = $d.'-'.$m.'-'.$y;
		}
		elseif($dat_fmt == 'mm-dd-yyyy')
		{

			//echo '<br> inside 2';
			$display_date = $m.'-'.$d.'-'.$y;
		}
		elseif($dat_fmt == 'yyyy-mm-dd')
		{

			//echo '<br> inside 3';
			$display_date = $y.'-'.$m.'-'.$d;
		}

		if($date_value[1] != '')
		{
			$display_date = $display_date.' '.$date_value[1];
		}
	return $display_date;
 			
}

function getNewDisplayDate()
{
	global $log;
        $log->info("in getNewDisplayDate ");

	global $current_user;
	$dat_fmt = $current_user->date_format;
	if($dat_fmt == '')
        {
                $dat_fmt = 'dd-mm-yyyy';
        }
	//echo $dat_fmt;
	//echo '<BR>';
	$display_date='';
	if($dat_fmt == 'dd-mm-yyyy')
	{
		$display_date = date('d-m-Y');
	}
	elseif($dat_fmt == 'mm-dd-yyyy')
	{
		$display_date = date('m-d-Y');
	}
	elseif($dat_fmt == 'yyyy-mm-dd')
	{
		$display_date = date('Y-m-d');
	}
		
	//echo $display_date;
	return $display_date;
}


function getDisplayCurrency()
{
	global $adb;
	$sql1 = "select * from currency_info";
	$result = $adb->query($sql1);
	$curr_name = $adb->query_result($result,0,"currency_name");
	$curr_symbol = $adb->query_result($result,0,"currency_symbol");
	$disp_curr = $curr_name.' : '.$curr_symbol;
	return $disp_curr;
}	



function getCurrencySymbol()
{
	global $adb;
	$sql1 = "select * from currency_info";
	$result = $adb->query($sql1);
	$curr_symbol = $adb->query_result($result,0,"currency_symbol");
	return $curr_symbol;
}

function getTermsandConditions()
{
        global $adb;
        $sql1 = "select * from inventory_tandc";
        $result = $adb->query($sql1);
        $tandc = $adb->query_result($result,0,"tandc");
        return $tandc;
}

function getModuleDirName($module)
{
	if($module == 'Vendor' || $module == 'PriceBook')
	{
		$dir_name = 'Products';	
	}
	else
	{
		$dir_name = $module;
	}
	return $dir_name;
}

function getReminderSelectOption($start,$end,$fldname,$selvalue='')
{
	global $mod_strings;
	global $app_strings;
	
	$def_sel ="";
	$OPTION_FLD = "<SELECT name=".$fldname.">";
	for($i=$start;$i<=$end;$i++)
	{
		if($i==$selvalue)
		$def_sel = "SELECTED";
		$OPTION_FLD .= "<OPTION VALUE=".$i." ".$def_sel.">".$i."</OPTION>\n";
		$def_sel = "";
	}
	$OPTION_FLD .="</SELECT>";
	return $OPTION_FLD;
}


function getListPrice($productid,$pbid)
{
	global $log;
        $log->info("in getListPrice productid ".$productid);

	global $adb;
	$query = "select listprice from pricebookproductrel where pricebookid=".$pbid." and productid=".$productid;
	$result = $adb->query($query);
	$lp = $adb->query_result($result,0,'listprice');
	return $lp;
}

function br2nl($str) {
   $str = preg_replace("/(\r\n)/", " ", $str);
   $str = preg_replace("/'/", " ", $str);
   $str = preg_replace("/\"/", " ", $str);
   return $str;
}

function make_clickable($text)
{
   $text = preg_replace('#(script|about|applet|activex|chrome):#is', "\\1&#058;", $text);
   // pad it with a space so we can match things at the start of the 1st line.
   $ret = ' ' . $text;

   // matches an "xxxx://yyyy" URL at the start of a line, or after a space.
   // xxxx can only be alpha characters.
   // yyyy is anything up to the first space, newline, comma, double quote or <
   $ret = preg_replace("#(^|[\n ])([\w]+?://.*?[^ \"\n\r\t<]*)#is", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $ret);

   // matches a "www|ftp.xxxx.yyyy[/zzzz]" kinda lazy URL thing
   // Must contain at least 2 dots. xxxx contains either alphanum, or "-"
   // zzzz is optional.. will contain everything up to the first space, newline,
   // comma, double quote or <.
   $ret = preg_replace("#(^|[\n ])((www|ftp)\.[\w\-]+\.[\w\-.\~]+(?:/[^ \"\t\n\r<]*)?)#is", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $ret);

   // matches an email@domain type address at the start of a line, or after a space.
   // Note: Only the followed chars are valid; alphanums, "-", "_" and or ".".
   $ret = preg_replace("#(^|[\n ])([a-z0-9&\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", "\\1<a href=\"mailto:\\2@\\3\">\\2@\\3</a>", $ret);

   // Remove our padding..
   $ret = substr($ret, 1);

   //remove comma, fullstop at the end of url
   $ret = preg_replace("#,\"|\.\"|\)\"|\)\.\"|\.\)\"#", "\"", $ret);

   return($ret);
}
/**
 * This function returns the blocks and its related information for given module.
 * Input Parameter are $module - module name, $disp_view = display view (edit,detail or create),$mode - edit, $col_fields - * column fields/
 * This function returns an array
 */

function getBlocks($module,$disp_view,$mode,$col_fields='')
{
        global $adb;
        global $mod_strings;
        global $log;
        $tabid = getTabid($module);
        $block_detail = Array();
        $getBlockinfo = "";
        $query="select blockid,blocklabel,show_title from blocks where tabid=$tabid and $disp_view=0 and visible = 0 order by sequence";

        $result = $adb->query($query);
        $noofrows = $adb->num_rows($result);
        $prev_header = "";
        for($i=0; $i<$noofrows; $i++)
        {
                $block_title = $mod_strings[$adb->query_result($result,$i,"blocklabel")];
                if($block_title !='')
                {
                        $prev_header = $block_title;

                        if($disp_view == "detail_view")
                        {
                                if($block_title=='LBL_RELATED_PRODUCTS')
                                {
                                        $getBlockInfo=getProductDetails();
                                }
                                else
				 {
                                        $getBlockInfo=getDetailBlockInformation($module,$adb->query_result($result,$i,"blockid"),$col_fields,$tabid);
                                }
                        }
                        else
                        {
                                $getBlockInfo=getBlockInformation($module,$adb->query_result($result,$i,"blockid"),$mode,$col_fields,$tabid);
                        }

                        if(is_array($getBlockInfo))
                        {
                                $block_detail[$block_title] = $getBlockInfo;
                        }
                }
                else
                {
                        if($disp_view == "detail_view")
                        {
                                $k=sizeof($block_detail[$prev_header]);
                                $temp_headerless_arr=getDetailBlockInformation($module,$adb->query_result($result,$i,"blockid"),$col_fields,$tabid);
                                foreach($temp_headerless_arr as $td_val=>$tr_val)
                                {
                                        $block_detail[$prev_header][$k]=$tr_val;
                                        $k++;
                                }

                        }
                        else
                        {
                                $k=sizeof($block_detail[$prev_header]);
                                $temp_headerless_arr=getBlockInformation($module,$adb->query_result($result,$i,"blockid"),$mode,$col_fields,$tabid);
                                foreach($temp_headerless_arr as $td_val=>$tr_val)
				{
                                        $block_detail[$prev_header][$k]=$tr_val;
                                        $k++;
                                }



                        }

                }

        }
        return $block_detail;
}

/**
 * This function is used to get the display type.
 * Takes the input parameter as $mode - edit  (mostly)
 * This returns string type value
 */

function getView($mode)
{
        if($mode=="edit")
        $disp_view = "edit_view";
        else
        $disp_view = "create_view";
        return $disp_view;
}
/**
 * This function is used to get the blockid of the customblock for a given module.
 * Takes the input parameter as $tabid - module tabid and $label - custom label
 * This returns string type value
 */

function getBlockId($tabid,$label)
{
        global $adb;
        $blockid = '';
        $query = "select blockid from blocks where tabid=$tabid and blocklabel = '$label'";
        $result = $adb->query($query);
        $noofrows = $adb->num_rows($result);
        if($noofrows == 1)
        {
                $blockid = $adb->query_result($result,0,"blockid");
        }
        return $blockid;
}


function getHeaderArray()
{
	global $adb;
	$query='select parenttabid from parenttab order by sequence';
	$result = $adb->query($query);
    $noofrows = $adb->num_rows($result);
	for($i=0; $i<$noofrows; $i++)
    {
		$subtabs =array();
		$parenttabid = $adb->query_result($result,$i,"parenttabid");
		$query1 = 'select tabid from parenttabrel where parenttabid='.$parenttabid.' order by sequence';
		$result1 = $adb->query($query1);
		$noofsubtabs = $adb->num_rows($result1);
		for($j=0; $j<$noofsubtabs; $j++)
		{
			$subtabid = $adb->query_result($result1,$j,"tabid");
			$module = getTabModuleName($subtabid);
			//$subtabs[] = getTabname($subtabid); 
			$subtabs[] = $module;
		}
		$parenttab = getParentTabName($parenttabid);
		if($parenttab == 'Settings')
		{
			$subtabs =array();
			$subtabs[] = 'Settings';
		}
		$relatedtabs[$parenttab] = $subtabs;
	}
	return $relatedtabs;
}
function getParentTabName($parenttabid)
{
    global $adb;
    $sql = "select parenttab_label from parenttab where parenttabid=".$parenttabid;
    $result = $adb->query($sql);
    $parent_tabname=  $adb->query_result($result,0,"parenttab_label");
    return $parent_tabname;
}
function getParentTabFromModule($module)
{
	global $adb;
	$sql = "select parenttab.* from parenttab inner join parenttabrel on parenttabrel.parenttabid=parenttab.parenttabid inner join tab on tab.tabid=parenttabrel.tabid where tab.name='".$module."'";
	$result = $adb->query($sql);
	$tab =  $adb->query_result($result,0,"parenttab_label");
	return $tab;
}

/**
 * This function returns the parenttab and for the given module.
 */
function getParentTab()
{
    if(isset($_REQUEST['parenttab']) && $_REQUEST['parenttab'] !='')
    {
               return $_REQUEST['parenttab'];
    }
    else
    {
                return getParentTabFromModule($_REQUEST['module']);
    }

}

?>
