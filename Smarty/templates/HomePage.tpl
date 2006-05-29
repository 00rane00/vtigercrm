{*<!--
/*********************************************************************************
  ** The contents of this file are subject to the vtiger CRM Public License Version 1.0
   * ("License"); You may not use this file except in compliance with the License
   * The Original Code is:  vtiger CRM Open Source
   * The Initial Developer of the Original Code is vtiger.
   * Portions created by vtiger are Copyright (C) vtiger.
   * All Rights Reserved.
  *
 ********************************************************************************/
-->*}
<script language="javascript" type="text/javascript" src="include/scriptaculous/prototype.js"></script>
<script language="JavaScript" type="text/javascript" src="include/js/ajax.js"></script>
<script language="javascript" type="text/javascript" src="include/scriptaculous/scriptaculous.js"></script>
<script language="javascript" type="text/javascript" src="include/scriptaculous/effects.js"></script>
<script language="javascript" type="text/javascript" src="include/scriptaculous/builder.js"></script>
<script language="javascript" type="text/javascript" src="include/scriptaculous/dragdrop.js"></script>
<script language="javascript" type="text/javascript" src="include/scriptaculous/controls.js"></script>
<script language="javascript" type="text/javascript" src="include/scriptaculous/slider.js"></script>
<script language="javascript" type="text/javascript" src="include/scriptaculous/dom-drag.js"></script>
<script type="text/javascript" language="JavaScript" src="include/js/general.js"></script>


{*<!--Home Page Entries  -->*}
{* login history commented out
{if isset($LOGINHISTORY.0)}
    <div id="loginhistory" style="float:left;position:absolute;left:300px;top:150px;height:100px:width:200px;overflow:auto;border:1px solid #dadada;">
    <table border="0" cellpadding="4" cellspacing="0" width="100%">
        <tr><td class=tblPro1ColHeader>{$MOD.LBL_LOGIN_ID}</td><td class=tblPro1ColHeader>{$MOD.LBL_TYPE}</td><td class=tblPro1ColHeader>{$MOD.LBL_MODIFIED_BY}</t
d><td class=tblPro1ColHeader nowrap><img src="{$IMAGE_PATH}tblPro1BtnHide.gif" alt="Close" align="right" border="0" onClick
="document.getElementById('loginhistory').style.display='none';">{$MOD.LBL_MODIFIED_TIME}</td></tr>
        {foreach key=label item=detail from=$LOGINHISTORY}
            <tr><td class=tblPro1DataCell>{$detail.crmid}</td><td class=tblPro1DataCell>{$detail.setype}</td><td class=tblP
ro1DataCell>{$detail.modifiedby}</td><td class=tblPro1DataCell>{$detail.modifiedtime}</td></tr>
        {/foreach}
    </table>
    </div>
{/if}
*}


<TABLE border=0 cellspacing=0 cellpadding=0 width=100% class=small>
 	<tr><td style="height:2px"></td></tr>
 	<tr>
     <td style="padding-left:10px;padding-right:10px" class="moduleName" nowrap>{$MOD.LBL_MY_HOME}</td>
     <td class="sep1" style="width:1px"></td>
     <td class=small >
     	<table border=0 cellspacing=0 cellpadding=0>
  		<tr>
        <td>
    		<table border=0 cellspacing=0 cellpadding=5>
			<tr>
			<td style="padding-right:0px">&nbsp;</td>
			</tr>
			</table>
		</td>
		<td nowrap width=50>&nbsp;</td>
		<td>
			<table border=0 cellspacing=0 cellpadding=5>
			<tr>
			<td style="padding-right:0px"><a href="#" onClick='fnvshobj(this,"miniCal");getMiniCal();'><img src="{$IMAGE_PATH}btnL3Calendar.gif" alt="{$APP.LBL_CALENDAR_ALT}" title="{$APP.LBL_CALENDAR_TITLE}" border=0></a></a></td>
		
            <td style="padding-right:0px"><a href="#"><img src="{$IMAGE_PATH}btnL3Clock.gif" alt="{$APP.LBL_CLOCK_ALT}" title="{$APP.LBL_CLOCK_TITLE}" border=0 onClick="fnvshobj(this,'wclock')"></a></a></td>
            <td style="padding-right:0px"><a href="#"><img src="{$IMAGE_PATH}btnL3Calc.gif" alt="{$APP.LBL_CALCULATOR_ALT}" title="{$APP.LBL_CALCULATOR_TITLE}" border=0 onClick="fnvshobj(this,'calculator_cont');fetch_calc();"></a></a></td>
			<td nowrap="nowrap" width="50">&nbsp;</td>
			<td style="padding-right: 0px;"><a href="#" onClick="fnvshobj(this,'allMenu')"><img src="{$IMAGE_PATH}btnL3AllMenu.gif" alt="{$APP.LBL_ALL_MENU_ALT}" title="{$APP.LBL_ALL_MENU_TITLE}" border="0"></a></td>
		
			</tr>
			</table>
		</td>
		<td>
			<table border=0 cellspacing=0 cellpadding=5>
			<tr>
			</tr>
			</table>
		</td>
		</tr>
		</table>
	</td>
	<td nowrap style="width:50%;padding:10px">&nbsp;</td>
   </tr>
   <tr><td style="height:2px"></td></tr>

</TABLE>

{* Main Contents Start Here *}
<table width="98%" cellpadding="0" cellspacing="0" border="0" class="small showPanelBg" align="center">
			<tr>
				<td align=right valign=top><img src="{$IMAGE_PATH}showPanelTopLeft.gif"></td>
					<td width="75%" align="center" style="border-right:1px solid #666666;" >

	<div id="MainMatrix">
				{foreach item=tabledetail from=$HOMEDETAILS}
				{if $tabledetail neq ''}
				
					<div class="MatrixLayer" style="float:left;" id="{$tabledetail.Title.2}">
	<table width="100%" border="0" cellpadding="5" cellspacing="0" class="small">
  <tr style="cursor:move;">
		<td align="left" style="border-bottom:1px solid #666666;"><b>{$tabledetail.Title.1}</b></td>
		<td align="right" style="border-bottom:1px solid #666666;"><img src="{$IMAGE_PATH}uparrow.gif" align="absmiddle" /></td>
           </tr>
	{foreach item=elements from=$tabledetail.Entries}
	    <tr >
		{if $tabledetail.Title.2 neq 'home_mytopinv' && $tabledetail.Title.2 neq 'home_mytopso' && $tabledetail.Title.2 neq 'home_mytopquote'}
		<td colspan="2"><img src="{$IMAGE_PATH}bookMark.gif" align="absmiddle" /> {$elements.0}</td>
		{else}
		<td colspan="2"><img src="{$IMAGE_PATH}bookMark.gif" align="absmiddle" /> {$elements.1}</td>
		{/if}
		
           </tr>
{/foreach}
	</table>
				
			</div>
			{/if}	
{/foreach}
</div>
</td>

<td width="25%" valign="top" style="padding:5px;">
	{if $ACTIVITIES.0.Entries.noofactivities > 0}	
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
	<td width="13" height="38"><img src="{$IMAGE_PATH}upcoming_left.gif" align="top"  /></td>
	<td width="100%" background="{$IMAGE_PATH}upcomingEvents.gif" style="background-repeat:repeat-x; ">&nbsp;</td>
	<td width="14" height="38" align="left"><img src="{$IMAGE_PATH}upcoming_right.gif" align="top"  /></td>
	</tr>		
	<tr>
	<td colspan="3" bgcolor="#FFFFCF" style="border-left:2px solid #A6A4A5;border-right:2px solid #A6A4A5;border-bottom:2px solid #A6A4A5;">
	<table width="100%" border="0" cellpadding="5" cellspacing="0">
	<tr>
	<td width="75%" colspan="2"><b class="fontBold">{$MOD.LBL_UPCOMING_EVENTS}</b><br />{$ACTIVITIES.0.Entries.noofactivities} {$APP.Events} {$APP.LBL_FOR} {$ACTIVITIES.0.Title.0}</td>
	<td width="25%" valign="top" align="right"><img src="{$IMAGE_PATH}up.gif" align="absmiddle" /></td>
	</tr>
	{foreach item=entries from=$ACTIVITIES.0.Entries}
	<tr>
	<td align="right" width="15%">{$entries.IMAGE}</td>
	<td align="left" valign="middle" colspan="2" width="85%"><b class="style_Gray">{$entries.0}</b><br />{$entries.ACCOUNT_NAME}</td>
	</tr>
	{/foreach}
	<tr><td colspan="3" height="10"></td></tr>
	</table>
	</td>
	</tr>
	</table><br />
	{/if}

	{if $ACTIVITIES.1.Entries.noofactivities > 0}	
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="small">
	<tr>
	<td width="14" height="70" background="{$IMAGE_PATH}pending_left.gif" ></td>
	<td width="90%" background="{$IMAGE_PATH}pendingEvents.gif" valign="bottom" style="background-repeat:repeat-x;">
	<b class="fontBold">{$MOD.LBL_PENDING_EVENTS}</b><br />
	{$ACTIVITIES.1.Entries.noofactivities} {$MOD.LBL_TODAYEVENT}</td>
	<td width="15" height="70" background="{$IMAGE_PATH}pending_right.gif" valign="bottom">
	<img src="{$IMAGE_PATH}up.gif" align="top" />&nbsp;</td>
	</tr>		
	<tr>
	<td colspan="3" bgcolor="#FEF7C1" style="border-left:2px solid #A6A4A5;border-right:2px solid #A6A4A5;border-bottom:2px solid #A6A4A5;">
	<table width="100%" border="0" cellpadding="5" cellspacing="0">
	<tr>
	<td colspan="3" height="10"></td>
	</tr>
	{foreach item=entries from=$ACTIVITIES.1.Entries}
	<tr>
	<td align="right" width="15%">{$entries.IMAGE}</td>
	<td align="left" valign="middle" colspan="2" width="85%"><b class="style_Gray">{$entries.0}</b><br />{$entries.ACCOUNT_NAME}</td>
	</tr>
	{/foreach}
	<tr>
	<td colspan="3" height="10"></td>
	</tr>
	</table></td>
	</tr>
	</table>
	<br>
	{/if}
    {if $TAGCLOUD_JS ne ''}
    <table width="100%" border=0>
    <tr><td>
    <link href="{$TAGCLOUD_CSS}" rel="stylesheet" type="text/css">
    <script language="JavaScript" type="text/javascript" src="{$TAGCLOUD_JS}"></script>
    </td></tr>
    </table>
    {/if}

					<table border=0 cellspacing=0 cellpadding=0 width=100% class="rightMailMerge">
    					<tr>
    					   <td class="rightMailMergeHeader"><b>Tag Cloud</b></td>
    					</tr>
    					<tr style="height:25px">
    						<td class="rightMailMergeContent">
        						<table border=0 cellspacing=0 cellpadding=0 width=100% >
          						<tr><td>
          						<table width="250" border="0" cellspacing="0" cellpadding="0">
            						<tr>
            						  <td colspan="3"><img src="{$IMAGE_PATH}cloud_top.gif" width=250 height=38 alt=""></td>
            						</tr>
            						<tr>
              						<td width="16" height="10"><img src="{$IMAGE_PATH}cloud_top_left.gif" width="16" height="10"></td>
              						<td width="221" height="10"><img src="{$IMAGE_PATH}tagcloud_03.gif" width="221" height="10"></td>
              						<td width="13" height="10"><img src="{$IMAGE_PATH}cloud_top_right.gif" width="13" height="10"></td>
            						</tr>
            						<tr>
            						  <td class="cloudLft"></td>
            						  <td><span id="tagfields">{$ALL_TAG}</span></td>
            						  <td class="cloudRht"></td>
            						</tr>
            						<tr>
            						<td width="16" height="13"><img src="{$IMAGE_PATH}cloud_btm_left.gif" width="16" height="13"></td>
            						<td width="221" height="13"><img src="{$IMAGE_PATH}cloud_btm_bdr.gif" width="221" height="13"></td>
            						<td width="13" height="13"><img src="{$IMAGE_PATH}cloud_btm_right.gif" width="13" height="13"></td>
            						</tr>
          						</table>
      						    </td></tr>
    						    </table>
    					</td>
    				</tr>
				</table>


</td>
						<td align=right valign=top><img src="{$IMAGE_PATH}showPanelTopRight.gif"></td>

</tr>
</table>

{literal}
<script  language="javascript">
		Sortable.create("MainMatrix",
        {constraint:false,tag:'div',overlap:'horizontal',
			onUpdate:function(){
			//	alert(Sortable.serialize('MainMatrix')); 
			}
		});
	 
		//new Sortable.create('MainMatrix','div');
</script>
{/literal}
<script>
function showhide(tab)
{ldelim}
//alert(document.getElementById(tab))
var divid = document.getElementById(tab);
if(divid.style.display!='none')
	hide(tab)
else
	show(tab)
{rdelim}
</script>

	
			
