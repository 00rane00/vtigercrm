<!--  USER  SETTINGS PAGE STARTS HERE -->
<script language="javascript">
function ajaxSaveResponse(response)
{ldelim}
	hide("status");
	document.getElementById("email_con").innerHTML=response.responseText;
{rdelim}
function ajaxgetResponse(response)
{ldelim}
	hide("status");
	document.getElementById("EmailDetails").innerHTML=response.responseText;
{rdelim}
function setSubject(subject)
{ldelim}
document.getElementById("subjectsetter").innerHTML=subject
{rdelim}
function getEmailContents(id)
{ldelim}
	show("status");
	var ajaxObj = new Ajax(ajaxgetResponse);
	var urlstring ="module=Emails&action=EmailsAjax&file=DetailView&mode=ajax&record="+id;
	ajaxObj.process("index.php?",urlstring);
{rdelim}
{literal}
function DeleteEmail(id)
{
	if(confirm("Are you sure you want to delete ?"))
		{	
			show("status");
			var ajaxObj = new Ajax(ajaxDelResponse);
			var urlstring ="module=Users&action=massdelete&return_module=Emails&idlist="+id;
		    	ajaxObj.process("index.php?",urlstring);
		}
		else
		{
			return false;
		}
}
function ajaxDelResponse(response)
{
	hide("status");
	document.getElementById("EmailDetails").innerHTML='';
	document.getElementById("subjectsetter").innerHTML='';
	document.getElementById("email_con").innerHTML=response.responseText;
}
{/literal}
</script>
<script language="JavaScript" type="text/javascript" src="modules/Emails/Email.js"></script>
<table width="100%" border="0" cellpadding="0" cellspacing="0" height="100%">
	<tr>
		 <td class="showPanelBg" valign="top" width="95%"  style="padding-left:20px; "><br />
        	        <span class="lvtHeaderText">Home&gt; Web Mail </span>
        	        <hr noshade="noshade" size="1" />
		</td>
		<td width="5%" class="showPanelBg">&nbsp;</td>
	</tr>
	<tr>
		<td width="95%" style="padding-left:20px;" valign="top">
			<!-- module Select Table -->
			<table width="100%"  border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td width="7" height="6" style="font-size:1px;font-family:Arial, Helvetica, sans-serif;"><img src="{$IMAGE_PATH}top_left.jpg" align="top"  /></td>
				<td bgcolor="#EBEBEB" style="font-size:1px;font-family:Arial, Helvetica, sans-serif;height:6px;"></td>
				<td width="8" height="6" style="font-size:1px;font-family:Arial, Helvetica, sans-serif;"><img src="{$IMAGE_PATH}top_right.jpg" width="8" height="6" align="top" /></td>
			  </tr>
			  <tr>
				<td bgcolor="#EBEBEB" width="7"></td>
				<td bgcolor="#ECECEC" style="padding-left:10px;height:20px;vertical-align:middle;"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td colspan="3" style="padding:10px;vertical-align:middle;">
							<table width="35%" cellpadding="0" cellspacing="0" border="0">
									<tr>
											<td>
												<img src="{$IMAGE_PATH}check_mail.gif" align="absmiddle" />
												&nbsp;<a href="#" class="webMnu" >Check Mail</a>
											</td>
											<td>
												<img src="{$IMAGE_PATH}compose.gif" align="absmiddle" />
												&nbsp;<a href="javascript:openPopUp('ComposeEmail',this,'index.php?module=Emails&action=EmailsAjax&file=EditView','createemailWin',655,652,'menubar=no,toolbar=no,location=no,status=no,resizable=no');" class="webMnu">Compose</a>
											</td>
											<td>
												<img src="{$IMAGE_PATH}webmail_settings.gif" align="absmiddle" />
												&nbsp;<a href="#" class="webMnu">Settings</a>
											</td>
									</tr>
							</table>
					</td>
                  </tr>
                  <tr>
                    <td width="28%" bgcolor="#949494"><span class="subHdr"><b>Email Folders</b></span> </td>
                    <td width="2%">&nbsp;</td>
					 <td width="60%" class="subHdr"><strong>Mails </strong></td>
                  </tr>
                  <tr>
                    <td rowspan="6" valign="top" bgcolor="#FFFFFF" style="padding:10px; ">
							<img src="{$IMAGE_PATH}webmail_root.gif" align="absmiddle" />&nbsp;<b>All Mails</b>
							<ul style="list-style-type:none;">
								<li><img src="{$IMAGE_PATH}webmail_downarrow.gif" align="absmiddle" />&nbsp;&nbsp;
										<a href="#" class="webMnu">Inbox</a>&nbsp;<b></b>
								</li>
								<li><img src="{$IMAGE_PATH}webmail_uparrow.gif" align="absmiddle" />&nbsp;&nbsp;
										<a href="#" class="webMnu">Sent</a>&nbsp;<b></b>
								</li>
								<li><img src="{$IMAGE_PATH}webmail_trash.gif" align="absmiddle" />&nbsp;&nbsp;
										<a href="#" class="webMnu">Trash</a>&nbsp;
								</li>
							</ul><br />
							<img src="{$IMAGE_PATH}webmail_root.gif" align="absmiddle" />&nbsp;<b class="txtGreen">Qualified Mails</b>
							<ul style="list-style-type:none;">
								<li><img src="{$IMAGE_PATH}webmail_downarrow.gif" align="absmiddle" />&nbsp;&nbsp;
										<a href="index.php?module=Emails&action=ListView" class="webMnu">Inbox</a>&nbsp;<b></b>
								</li>
								<li><img src="{$IMAGE_PATH}webmail_uparrow.gif" align="absmiddle" />&nbsp;&nbsp;
										<a href="#" class="webMnu">Sent</a>&nbsp;<b></b>
								</li>
								<li><img src="{$IMAGE_PATH}webmail_trash.gif" align="absmiddle" />&nbsp;&nbsp;
										<a href="#" class="webMnu">Trash</a>&nbsp;
								</li>
							</ul>
					</td>
                    <td>&nbsp;</td>
                    <td class="delBg"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
					<form name="massdelete" method="POST">
					<input name="idlist" type="hidden">
                      <tr>
                        <td width="25%"><input type="button" name="Button2" value=" Delete "  class="classWebBtn" onClick="return massDelete();"/> &nbsp;
                          <input type="button" name="Qualify" value=" Qualify " class="classWebBtn" />
                        </td>
                        <td width="75%" align="right">
							<font color="#000000">Search:</font>&nbsp;<input type="text" name="srch" class="importBox" />&nbsp;
							<select name="optionSel" class="importBox"><option selected>in Subject</option></select>&nbsp;
							<input type="button" name="find" value=" Find " class="classWebBtn" />
						</td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td style="padding:1px;" align="left">
						<div id="email_con">
						{include file="EmailContents.tpl"}
						</div>
				</td>
             </tr>
			 <tr>
			 	<td></td>
				<td height="5"></td>
			 </tr>
			</form>	
			 <tr>
			   <td>&nbsp;</td>
			   <td class="subHdr" id="subjectsetter"> </td>
			   </tr>
			   <tr><td colspan="2">
			   <div id="EmailDetails">
				{include file="EmailDetails.tpl"}
				</div>
				</td></tr>
                </table>
				</td>
				<td bgcolor="#EBEBEB" width="8"></td>
			  </tr>
			  <tr>
				<td width="7" height="8" style="font-size:1px;font-family:Arial, Helvetica, sans-serif;"><img src="{$IMAGE_PATH}bottom_left.jpg" align="bottom"  /></td>
				<td bgcolor="#ECECEC" height="8" style="font-size:1px;" ></td>
				<td width="8" height="8" style="font-size:1px;font-family:Arial, Helvetica, sans-serif;"><img src="{$IMAGE_PATH}bottom_right.jpg" align="bottom" /></td>
			  </tr>
		  </table><br />
		</td>
		<td>&nbsp;</td>
	</tr>
</table>
<!-- END -->
<div id="status" style="display:none;position:absolute;background-color:#bbbbbb;left:887px;top:0px;height:17px;white-space:nowrap;"">Processing Request...</div>

