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
 * Description:  TODO To be written.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

require_once('XTemplate/xtpl.php');
require_once('data/Tracker.php');
require_once('modules/Invoice/Invoice.php');
require_once('modules/Quotes/Quote.php');
require_once('modules/Orders/SalesOrder.php');
require_once('modules/Invoice/Forms.php');
require_once('modules/Potentials/Opportunity.php');
require_once('include/CustomFieldUtil.php');
require_once('include/ComboUtil.php');
require_once('include/uifromdbutil.php');
require_once('include/FormValidationUtil.php');

global $app_strings;
global $mod_strings;
global $current_user;

$focus = new Invoice();

if(isset($_REQUEST['record']) && $_REQUEST['record'] != '') 
{
    if(isset($_REQUEST['convertmode']) &&  $_REQUEST['convertmode'] == 'quotetoinvoice')
    {
	$quoteid = $_REQUEST['record'];
	$quote_focus = new Quote();
	$quote_focus->id = $quoteid;
	$quote_focus->retrieve_entity_info($quoteid,"Quotes");
	$focus = getConvertQuoteToInvoice($focus,$quote_focus,$quoteid);
			
    }
    elseif(isset($_REQUEST['convertmode']) &&  $_REQUEST['convertmode'] == 'sotoinvoice')
    {
	$soid = $_REQUEST['record'];
	$so_focus = new SalesOrder();
	$so_focus->id = $soid;
	$so_focus->retrieve_entity_info($soid,"SalesOrder");
	$focus = getConvertSoToInvoice($focus,$so_focus,$soid);
			
    }
    elseif(isset($_REQUEST['convertmode']) &&  $_REQUEST['convertmode'] == 'update_so_val')
    {
        //Updating the Selected SO Value in Edit Mode
        foreach($focus->column_fields as $fieldname => $val)
        {
                if(isset($_REQUEST[$fieldname]))
                {
                        $value = $_REQUEST[$fieldname];
                        $focus->column_fields[$fieldname] = $value;
                }

        }
	//Handling for dateformat in invoicedate field
        if($focus->column_fields['invoicedate'] != '')
        {
              $curr_due_date = $focus->column_fields['invoicedate'];
              $focus->column_fields['invoicedate'] = getDBInsertDateValue($curr_due_date);
        }

	$soid = $focus->column_fields['salesorder_id'];
        $so_focus = new SalesOrder();
        $so_focus->id = $soid;
        $so_focus->retrieve_entity_info($soid,"SalesOrder");
        $focus = getConvertSoToInvoice($focus,$so_focus,$soid);
        $focus->id = $_REQUEST['record'];
        $focus->mode = 'edit';
        $focus->name=$focus->column_fields['subject'];

    }		
    else
    {	
 	    $focus->id = $_REQUEST['record'];
	    $focus->mode = 'edit'; 	
	    $focus->retrieve_entity_info($_REQUEST['record'],"Invoice");		
	    $focus->name=$focus->column_fields['subject'];
    } 
}
else
{
	if(isset($_REQUEST['convertmode']) &&  $_REQUEST['convertmode'] == 'update_so_val')
	{
		//Updating the Selected SO Value in Create Mode
		foreach($focus->column_fields as $fieldname => $val)
		{
			if(isset($_REQUEST[$fieldname]))
			{
				$value = $_REQUEST[$fieldname];
				$focus->column_fields[$fieldname] = $value;
			}

		}
		//Handling for dateformat in invoicedate field
                if($focus->column_fields['invoicedate'] != '')
                {
                        $curr_due_date = $focus->column_fields['invoicedate'];
                        $focus->column_fields['invoicedate'] = getDBInsertDateValue($curr_due_date);
                }

		$soid = $focus->column_fields['salesorder_id'];
		$so_focus = new SalesOrder();
		$so_focus->id = $soid;
		$so_focus->retrieve_entity_info($soid,"SalesOrder");
		$focus = getConvertSoToInvoice($focus,$so_focus,$soid);

	}
}
if(isset($_REQUEST['isDuplicate']) && $_REQUEST['isDuplicate'] == 'true') {
	$num_of_products = getNoOfAssocProducts("Invoice",$focus);
	$associated_prod = getAssociatedProducts("Invoice",$focus);
	$focus->id = "";
    	$focus->mode = ''; 	
}
if(isset($_REQUEST['opportunity_id']) || $_REQUEST['opportunity_id'] !='')
{
	$potfocus = new Potential();
        $potfocus->column_fields['potential_id'] = $_REQUEST['opportunity_id'];
	$num_of_products = getNoOfAssocProducts("Potentials",$potfocus,$potfocus->column_fields['potential_id']);
        $associated_prod = getAssociatedProducts("Potentials",$potfocus,$potfocus->column_fields['potential_id']);
	$focus->id = "";
    	$focus->mode = ''; 	

	
}
if(isset($_REQUEST['product_id']) && $_REQUEST['product_id'] != '') {
        $focus->column_fields['product_id'] = $_REQUEST['product_id'];
	$num_of_products = getNoOfAssocProducts("Products",$focus,$focus->column_fields['product_id']);
	$associated_prod = getAssociatedProducts("Products",$focus,$focus->column_fields['product_id']);
	$focus->id = "";
    	$focus->mode = ''; 	
} 
 
 
if(isset($_REQUEST['account_id']) && $_REQUEST['account_id']!='' && ($_REQUEST['record']=='' || $_REQUEST['convertmode'] == "potentoinvoice")){
	require_once('modules/Accounts/Account.php');
	$acct_focus = new Account();
	$acct_focus->retrieve_entity_info($_REQUEST['account_id'],"Accounts");
	$focus->column_fields['bill_city']=$acct_focus->column_fields['bill_city'];
	$focus->column_fields['ship_city']=$acct_focus->column_fields['ship_city'];
	$focus->column_fields['bill_street']=$acct_focus->column_fields['bill_street'];
	$focus->column_fields['ship_street']=$acct_focus->column_fields['ship_street'];
	$focus->column_fields['bill_state']=$acct_focus->column_fields['bill_state'];
	$focus->column_fields['ship_state']=$acct_focus->column_fields['ship_state'];
	$focus->column_fields['bill_code']=$acct_focus->column_fields['bill_code'];
	$focus->column_fields['ship_code']=$acct_focus->column_fields['ship_code'];
	$focus->column_fields['bill_country']=$acct_focus->column_fields['bill_country'];
	$focus->column_fields['ship_country']=$acct_focus->column_fields['ship_country'];

}

//get Block 1 Information
$block_1_header = getBlockTableHeader("LBL_INVOICE_INFORMATION");
$block_1 = getBlockInformation("Invoice",1,$focus->mode,$focus->column_fields);



//get Address Information

$block_2_header = getBlockTableHeader("LBL_ADDRESS_INFORMATION");
$block_2 = getBlockInformation("Invoice",2,$focus->mode,$focus->column_fields);

//get Description Information

$block_3_header = getBlockTableHeader("LBL_DESCRIPTION_INFORMATION");
$block_3 = getBlockInformation("Invoice",3,$focus->mode,$focus->column_fields);


$block_4_header = getBlockTableHeader("LBL_RELATED_PRODUCTS");

$block_6_header = getBlockTableHeader("LBL_TERMS_INFORMATION");
$block_6 = getBlockInformation("Invoice",6,$focus->mode,$focus->column_fields);

//get Custom Field Information
$block_5 = getBlockInformation("Invoice",5,$focus->mode,$focus->column_fields);
if(trim($block_5) != '')
{
        $cust_fld = '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="formOuterBorder">';
        $cust_fld .=  '<tr><td>';
	$block_5_header = getBlockTableHeader("LBL_CUSTOM_INFORMATION");
        $cust_fld .= $block_5_header;
        $cust_fld .= '<table width="100%" border="0" cellspacing="1" cellpadding="0">';
        $cust_fld .= $block_5;
        $cust_fld .= '</table>';
        $cust_fld .= '</td></tr></table>';
	$cust_fld .='<BR>';
}


global $theme;
$theme_path="themes/".$theme."/";
$image_path=$theme_path."images/";
//retreiving the combo values array
$comboFieldNames = Array('accounttype'=>'account_type_dom'
                      ,'industry'=>'industry_dom');
$comboFieldArray = getComboArray($comboFieldNames);


require_once($theme_path.'layout_utils.php');

$log->info("Invoice view");

$xtpl=new XTemplate ('modules/Invoice/EditView.html');
$xtpl->assign("MOD", $mod_strings);
$xtpl->assign("APP", $app_strings);
$xtpl->assign("BLOCK1", $block_1);
$xtpl->assign("BLOCK1_HEADER", $block_1_header);
$xtpl->assign("BLOCK2", $block_2);
$xtpl->assign("BLOCK2_HEADER", $block_2_header);
$xtpl->assign("BLOCK3", $block_3);
$xtpl->assign("BLOCK3_HEADER", $block_3_header);
$xtpl->assign("BLOCK4_HEADER", $block_4_header);
$xtpl->assign("BLOCK6", $block_6);
$xtpl->assign("BLOCK6_HEADER", $block_6_header);

if (isset($focus->name)) $xtpl->assign("NAME", $focus->name);
else $xtpl->assign("NAME", "");


if(isset($_REQUEST['convertmode']) &&  $_REQUEST['convertmode'] == 'quotetoinvoice')
{
	$num_of_products = getNoOfAssocProducts("Quotes",$quote_focus);
	$xtpl->assign("ROWCOUNT", $num_of_products);
	$associated_prod = getAssociatedProducts("Quotes",$quote_focus);
	$xtpl->assign("ASSOCIATEDPRODUCTS", $associated_prod);
	$xtpl->assign("MODE", $quote_focus->mode);
	$xtpl->assign("TAXVALUE", $quote_focus->column_fields['txtTax']);
	$xtpl->assign("ADJUSTMENTVALUE", $quote_focus->column_fields['txtAdjustment']);
	$xtpl->assign("SUBTOTAL", $quote_focus->column_fields['hdnSubTotal']);
	$xtpl->assign("GRANDTOTAL", $quote_focus->column_fields['hdnGrandTotal']);
}
elseif(isset($_REQUEST['convertmode']) &&  ($_REQUEST['convertmode'] == 'sotoinvoice' || $_REQUEST['convertmode'] == 'update_so_val'))
{
	$num_of_products = getNoOfAssocProducts("SalesOrder",$so_focus);
	$xtpl->assign("ROWCOUNT", $num_of_products);
	$associated_prod = getAssociatedProducts("SalesOrder",$so_focus);
	$xtpl->assign("ASSOCIATEDPRODUCTS", $associated_prod);
	$xtpl->assign("MODE", $focus->mode);
	$xtpl->assign("TAXVALUE", $so_focus->column_fields['txtTax']);
	$xtpl->assign("ADJUSTMENTVALUE", $so_focus->column_fields['txtAdjustment']);
	$xtpl->assign("SUBTOTAL", $so_focus->column_fields['hdnSubTotal']);
	$xtpl->assign("GRANDTOTAL", $so_focus->column_fields['hdnGrandTotal']);
}
elseif($focus->mode == 'edit')
{
	$num_of_products = getNoOfAssocProducts("Invoice",$focus);
	$xtpl->assign("ROWCOUNT", $num_of_products);
	$associated_prod = getAssociatedProducts("Invoice",$focus);
	$xtpl->assign("ASSOCIATEDPRODUCTS", $associated_prod);
	$xtpl->assign("MODE", $focus->mode);
	$xtpl->assign("TAXVALUE", $focus->column_fields['txtTax']);
	$xtpl->assign("ADJUSTMENTVALUE", $focus->column_fields['txtAdjustment']);
	$xtpl->assign("SUBTOTAL", $focus->column_fields['hdnSubTotal']);
	$xtpl->assign("GRANDTOTAL", $focus->column_fields['hdnGrandTotal']);
}
elseif(isset($_REQUEST['isDuplicate']) && $_REQUEST['isDuplicate'] == 'true')
{
	$xtpl->assign("ROWCOUNT", $num_of_products);
	$xtpl->assign("ASSOCIATEDPRODUCTS", $associated_prod);
	$xtpl->assign("MODE", $focus->mode);
	$xtpl->assign("TAXVALUE", $focus->column_fields['txtTax']);
	$xtpl->assign("ADJUSTMENTVALUE", $focus->column_fields['txtAdjustment']);
	$xtpl->assign("SUBTOTAL", $focus->column_fields['hdnSubTotal']);
	$xtpl->assign("GRANDTOTAL", $focus->column_fields['hdnGrandTotal']);
}
elseif((isset($_REQUEST['product_id']) && $_REQUEST['product_id'] != '') || (isset($_REQUEST['opportunity_id']) && $_REQUEST['opportunity_id'] != '')) {
        $xtpl->assign("ROWCOUNT", $num_of_products);
        $xtpl->assign("ASSOCIATEDPRODUCTS", $associated_prod);
        $xtpl->assign("MODE", $focus->mode);
        $xtpl->assign("TAXVALUE", "0.000");
        $xtpl->assign("ADJUSTMENTVALUE", "0.000");
        $xtpl->assign("SUBTOTAL", $focus->column_fields['hdnSubTotal']);
        $xtpl->assign("GRANDTOTAL", $focus->column_fields['hdnGrandTotal']);
}
else
{
	$xtpl->assign("ROWCOUNT", '1');
	$xtpl->assign("TAXVALUE", '0');
	$xtpl->assign("ADJUSTMENTVALUE", '0');
	$output ='';
	$output .= '<tr id="row1" class="oddListRow">';
        $output .= '<td height="25" style="padding:3px;" nowrap><input id="txtProduct1" name="txtProduct1" type="text" readonly> <img src="'.$image_path.'search.gif" onClick=\'productPickList(this)\' align="absmiddle" style=\'cursor:hand;cursor:pointer\'></td>';
        $output .= '<td WIDTH="1" class="blackLine"><IMG SRC="'.$image_path.'blank.gif"></td>';
        $output .= '<td style="padding:3px;"><div id="qtyInStock1"></div>&nbsp;</td>';
        $output .= '<td WIDTH="1" class="blackLine"><IMG SRC="'.$image_path.'blank.gif"></td>';
        $output .= '<td style="padding:3px;"><input type=text id="txtQty1" name="txtQty1" size="7" onBlur=\'calcTotal(this)\'></td>';
        $output .='<td WIDTH="1" class="blackLine"><IMG SRC="'.$image_path.'blank.gif"></td>';
        $output .= '<td style="padding:3px;"><div id="unitPrice1"></div>&nbsp;</td>';
        $output .= '<td WIDTH="1" class="blackLine"><IMG SRC="'.$image_path.'blank.gif"></td>';
        $output .= '<td style="padding:3px;"><input type=text id="txtListPrice1" name="txtListPrice1" value="0.00" size="12" onBlur="calcTotal(this)"> <img src="'.$image_path.'pricebook.gif" onClick=\'priceBookPickList(this)\' align="absmiddle" style="cursor:hand;cursor:pointer" title="Price Book"></td>';
        $output .= '<td WIDTH="1" class="blackLine"><IMG SRC="'.$image_path.'blank.gif"></td>';
        $output .= '<td style="padding:3px;"><div id="total1" align="right"></div></td>';
        $output .= '<td WIDTH="1" class="blackLine"><IMG SRC="'.$image_path.'blank.gif"></td>';
        $output .= '<td style="padding:0px 3px 0px 3px;" align="center" width="50">';
        $output .= '<input type="hidden" id="hdnProductId1" name="hdnProductId1">';
        $output .= '<input type="hidden" id="hdnRowStatus1" name="hdnRowStatus1">';
        $output .= '<input type="hidden" id="hdnTotal1" name="hdnTotal1">';
        $output .= '</td></tr>';
	$xtpl->assign("ROW1", $output);	
}

if(isset($cust_fld))
{
        $xtpl->assign("CUSTOMFIELD", $cust_fld);
}

		

if(isset($_REQUEST['return_module'])) $xtpl->assign("RETURN_MODULE", $_REQUEST['return_module']);
else $xtpl->assign("RETURN_MODULE","Invoice");
if(isset($_REQUEST['return_action'])) $xtpl->assign("RETURN_ACTION", $_REQUEST['return_action']);
else $xtpl->assign("RETURN_ACTION","index");
if(isset($_REQUEST['return_id'])) $xtpl->assign("RETURN_ID", $_REQUEST['return_id']);
$xtpl->assign("JAVASCRIPT", get_set_focus_js().get_validate_record_js());
$xtpl->assign("THEME", $theme);
$xtpl->assign("IMAGE_PATH", $image_path);$xtpl->assign("PRINT_URL", "phprint.php?jt=".session_id().$GLOBALS['request_string']);
$xtpl->assign("ID", $focus->id);


 $xtpl->assign("CALENDAR_LANG", "en");$xtpl->assign("CALENDAR_DATEFORMAT", parse_calendardate($app_strings['NTC_DATE_FORMAT']));





$invoice_tables = Array('invoice','invoicebillads','invoiceshipads'); 
 $tabid = getTabid("Invoice");
 $validationData = getDBValidationData($invoice_tables,$tabid);
 $fieldName = '';
 $fieldLabel = '';
 $fldDataType = '';

 $rows = count($validationData);
 foreach($validationData as $fldName => $fldLabel_array)
 {
   if($fieldName == '')
   {
     $fieldName="'".$fldName."'";
   }
   else
   {
     $fieldName .= ",'".$fldName ."'";
   }
   foreach($fldLabel_array as $fldLabel => $datatype)
   {
	if($fieldLabel == '')
	{
			
     		$fieldLabel = "'".$fldLabel ."'";
	}		
      else
       {
      $fieldLabel .= ",'".$fldLabel ."'";
        }
 	if($fldDataType == '')
         {
      		$fldDataType = "'".$datatype ."'";
    	}
	 else
        {
       		$fldDataType .= ",'".$datatype ."'";
     	}
   }
 }

$xtpl->assign("VALIDATION_DATA_FIELDNAME",$fieldName);
$xtpl->assign("VALIDATION_DATA_FIELDDATATYPE",$fldDataType);
$xtpl->assign("VALIDATION_DATA_FIELDLABEL",$fieldLabel);










//CustomField
//$date_format = parse_calendardate($app_strings['NTC_DATE_FORMAT']);
//$custfld = CustomFieldEditView($focus->id, "Accounts", "accountcf", "accountid", $app_strings, $theme);
//$xtpl->assign("CUSTOMFIELD", $custfld);

$xtpl->parse("main");

$xtpl->out("main");

?>
