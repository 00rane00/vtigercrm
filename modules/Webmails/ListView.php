<?php
if($_REQUEST["mailbox"] && $_REQUEST["mailbox"] != "") {$mailbox=$_REQUEST["mailbox"];} else {$mailbox="INBOX";}
if($_REQUEST["start"] && $_REQUEST["start"] != "") {$start=$_REQUEST["start"];} else {$start="1";}
?>
<script type="text/javascript">
function add_to_vtiger(mid) {
	$("status").style.display="block";
        new Ajax.Request(
                'index.php',
                {queue: {position:'front', scope: 'command', limit:1},
                        method: 'post',
                        postBody: 'module=Webmails&action=Save&mailid='+mid+'&ajax=true',
                        onComplete: function(t) {
				$("status").style.display="none";
			}
		}
	);
}
function showBody(mid) {
	var el = $("body_"+mid);
	el.innerHTML = '<iframe src="index.php?module=Webmails&action=body&mailid='+mid+'&mailbox=<?php echo $mailbox;?>" width="100%" height="210">You must enabled iframes</iframe>';
}
</script>
<?php
global $current_user;
require_once('Smarty_setup.php');
require_once("data/Tracker.php");
require_once('themes/'.$theme.'/layout_utils.php');
require_once('include/logging.php');
require_once('include/utils/utils.php');
require_once('include/utils/UserInfoUtil.php');
require_once("modules/Webmails/MailParse.php");
require_once('modules/CustomView/CustomView.php');

$mailInfo = getMailServerInfo($current_user);
if($adb->num_rows($mailInfo) < 1) {
	echo "<center><font color='red'><h3>Please configure your mail settings</h3></font></center>";
	exit();
}

$temprow = $adb->fetch_array($mailInfo);
//print_r($temprow);
$login_username= $temprow["mail_username"];
$secretkey=$temprow["mail_password"];
$imapServerAddress=$temprow["mail_servername"];
$box_refresh=$temprow["box_refresh"];
$mails_per_page=$temprow["mails_per_page"];
$mail_protocol=$temprow["mail_protocol"];
$ssltype=$temprow["ssltype"];
$sslmeth=$temprow["sslmeth"];
$showbody=$temprow["showbody"];
?>

<script language="Javascript" type="text/javascript" src="modules/Webmails/js/ajax_connection.js"></script>
<script language="Javascript" type="text/javascript" src="modules/Webmails/js/script.js"></script>
<script language="JavaScript" type="text/javascript" src="general.js"></script>
<script language="JavaScript" type="text/javascript" src="include/js/prototype.js"></script>

<script type="text/Javascript">
var box_refresh=<?php echo $box_refresh;?>;
var timer = window.onload=window.setTimeout("refresh_list()",box_refresh);
function reset_timer() {
	timer = window.setTimeout("refresh_list()",box_refresh);
}
function refresh_list() {
	var sURL = unescape(window.location);
	window.location.replace( sURL );
	timer = window.setTimeout("refresh_list()",box_refresh);
}

var command;
var id;
function runEmailCommand(com,id) {
	$("status").style.display="block";
	command=com;
	id=id;
	new Ajax.Request(
                'index.php',
                {queue: {position:'front', scope: 'command', limit:1},
                        method: 'post',
                        postBody: 'module=Webmails&action=body&command='+command+'&mailid='+id+'&mailbox=<?php echo $_REQUEST["mailbox"];?>',
                        onComplete: function(t) {
				resp = t.responseText;
				if(resp.match(/ajax failed/)) {return;}
				switch(command) {
				    case 'delete_msg':
					var parent = $("row_"+id).parentNode;
					var node = $("row_"+id);
					parent.removeChild(node);
				    break;
				    case 'clear_flag':
					var nm = "clear_td_"+id;
                			var el = $(nm);
                			var tmp = el.innerHTML;
                			el.innerHTML ='<a href="javascript:void(0);" onclick="runEmailCommand(\'set_flag\','+id+');"><img src="modules/Webmails/images/plus.gif" border="0" width="11" height="11" id="set_flag_img_'+id+'"></a>';
                			el.id = "set_td_"+id;
				    break;
				    case 'set_flag':
					var nm = "set_td_"+id;
                			var el = $(nm);
                			var tmp = el.innerHTML;
                			el.innerHTML ='<a href="javascript:void(0);" onclick="runEmailCommand(\'clear_flag\','+id+');"><img src="modules/Webmails/images/stock_mail-priority-high.png" border="0" width="11" height="11" id="clear_flag_img'+id+'"></a>';
                			el.id = "clear_td_"+id;
				    break;

				}
				$("status").style.display="none";
                        }
                }
        );
}
function changeMbox(el) {
	destination = el.options[el.selectedIndex].value;
	if (destination) location.href = "index.php?module=Webmails&action=index&parenttab=My%20Home%20Page&mailbox="+destination+"&start=1";
}
</script>
<?

$viewname="20";

// CUSTOM VIEW
//<<<<cutomview>>>>>>>
global $currentModule;
$oCustomView = new CustomView("Webmails");
$viewid = $oCustomView->getViewId($currentModule);
$customviewcombo_html = $oCustomView->getCustomViewCombo($viewid);
$viewnamedesc = $oCustomView->getCustomViewByCvid($viewid);
//<<<<<customview>>>>>


global $mbox;
$mbox = @imap_open("\{$imapServerAddress/$mail_protocol}$mailbox", $login_username, $secretkey) or die("Connection to server failed with: ".imap_last_error());

function SureRemoveDir($dir) {
   if(!$dh = @opendir($dir)) return;
   while (($obj = readdir($dh))) {
     if($obj=='.' || $obj=='..') continue;
     if (!@unlink($dir.'/'.$obj)) {
         SureRemoveDir($dir.'/'.$obj);
     } else {
         $file_deleted++;
     }
   }
   if (@rmdir($dir)) $dir_deleted++;
}

$save_path='/usr/local/share/vtiger/modules/Webmails/tmp';
$user_dir=$save_path."/".$_SESSION["authenticated_user_id"];
if($_REQUEST["expunge"]) {
	imap_expunge($mbox);
	SureRemoveDir($user_dir);
}

$elist = fullMailList($mbox);
//print_r($elist);
$numEmails = $elist["count"];
$headers = $elist["headers"];

if($start > 1) {
	$skip_num = (($start - 1) * $mails_per_page);
	$start_message = ($numEmails - $skip_num);
}
if(!isset($start_message) || $start_message=="") {$start_message=$numEmails;}
if(isset($_REQUEST["start"]) && $_REQUEST["viewname"]=="20") {
	if($_REQUEST["start"] != 1)
		$start_message=($numEmails)-($_REQUEST["start"]*$mails_per_page);
	else 
		$start_message=$numEmails;
}

if($numEmails>=$mails_per_page && !$_REQUEST["allflag"] == "All")
	$c=$mails_per_page;
else
	$c=$numEmails;

$overview=$elist["overview"];
?>
</td>
</table>
</td></tr>
</table>

<!-- MAIN MSG LIST TABLE -->
<table width="100%" cellpadding="2" cellspacing="0" align="center" border="0" class=""><tr><td>
<?
if($numEmails != 0)
	$navigation_array = getNavigationValues($_REQUEST["start"], $numEmails, $c);

$mails = array();
if (is_array($overview)) {
   foreach ($overview as $val) {
	$mails[$val->msgno] = $val;
   }
}

$listview_header = array("Info","","","Subject","","Date","","From","","Del","Reply");
$listview_entries = array();
$thread_view = array();

if($numEmails <= 0)
	$listview_entries[0][] = '<td colspan="10" width="100%" align="center"><b>No Emails In This Folder</b></td>';
else {
$l=1;
$smTmp=($numEmails);
    while ($l<$numEmails) {
  	$num = $mails[$l]->msgno;
  	$thread_view[$l] = array();
  	$thread_view[$l]["id"] = $num;
  	$thread_view[$l]["message_id"] = $mails[$l]->message_id;
  	$thread_view[$l]["in_reply_to"] = $mails[$l]->in_reply_to;
  	$thread_view[$l]["subject"] = $mails[$l]->subject;
	$l++;
	//$smTmp--;
    }
$i=1;
//print_r($thread_view);
    // Main loop to create listview entries
    $c=20;
    while ($i<$c) {
  	$num = $mails[$start_message]->msgno;
  	$flags='<table border=0><tr>';

  	// TODO: scan the current db tables to find a
  	// matching email address that will make a good
  	// candidate for record_id
  	// this module will also need to be able to associate to any entity type
  	$record_id='';

  	// Let's pre-build our URL parameters since it's too much of a pain not to
  	$detailParams = 'record='.$record_id.'&mailbox='.$mailbox.'&mailid='.$num.'&parenttab=My Home Page';
 	$defaultParams = 'parenttab=My Home Page&mailbox='.$mailbox.'&start='.$start.'&viewname='.$viewname;

  	// Attachment Icons
  	if(getAttachmentDetails($start_message,$mbox))
		$flags.='<td><img src="modules/Webmails/images/stock_attach.png" border="0" width="14" height="14"></td>';
  	else
		$flags.='<td width="15px" heigh="15px">&nbsp;</td>';

  	// read/unread/forwarded/replied
  	if(!$mails[$start_message]->seen || $mails[$start_message]->recent)
  		$flags.='<td><a href="index.php?module=Webmails&action=DetailView&'.$detailParams.'"><img src="modules/Webmails/images/stock_mail-unread.png" border="0" width="14" height="14"></a></td> ';
  	elseif ($mails[$start_message]->in_reply_to || $mails[$start_message]->references || preg_match("/^re:/i",$mails[$start_message]->subject))
		$flags.='<td><img src="modules/Webmails/images/stock_mail-replied.png" border="0" width="12" height="12"></td>';
  	elseif (preg_match("/^fw:/i",$mails[$start_message]->subject))
		$flags.='<td><img src="modules/Webmails/images/stock_mail-forward.png" border="0" width="13" height="13"></td>';
  	else
  		$flags.='<td><a href="index.php?module=Webmails&action=DetailView&'.$detailParams.'"><img src="modules/Webmails/images/stock_mail-read.png" border="0" width="11" height="11"></a></td> ';

  	// Add to Vtiger
  	if($mails[$start_message]->flagged)
		$flags.='<td id="clear_td_'.$num.'"><a href="javascript:runEmailCommand(\'clear_flag\','.$num.');"><img src="modules/Webmails/images/stock_mail-priority-high.png" border="0" width="11" height="11" id="clear_flag_img_'.$num.'"></a></td>';
  	else 
		$flags.='<td id="set_td_'.$num.'"><a href="javascript:void(0);" onclick="runEmailCommand(\'set_flag\','.$num.');"><img src="modules/Webmails/images/plus.gif" border="0" width="11" height="11" id="set_flag_img_'.$num.'"></a></td>';

  	$flags.='</tr></table>';
  	
	if($mails[$start_message]->subject=="")
		$mails[$start_message]->subject="(No Subject)";

  	$tmp=imap_mime_header_decode($mails[$start_message]->from);
  	$from = $tmp[0]->text;
  	$listview_entries[$num] = array();

	$listview_entries[$num][] = '<a onClick="gshow(\'addEmail_'.$num.'\');window.clearTimeout(timer);" href="javascript:void(0)">Quick View</a><td nowrap>'.$flags.'</td>';
  	if ($mails[$start_message]->deleted) {
        	$listview_entries[$num][] = '<td align="left" width="50%" id="deleted_subject_'.$num.'"><s><a href="index.php?module=Webmails&action=DetailView&'.$detailParams.'">'.$mails[$start_message]->subject.'</a></s></td>';
        	$listview_entries[$num][] = '<td align="left" width="20%" nowrap id="deleted_date_'.$num.'"><s>'.$mails[$start_message]->date.'</s></td>';
        	$listview_entries[$num][] = '<td align="left" width="25%" id="deleted_from_'.$num.'"><s>'.$from.'</s></td>';
  	} elseif(!$mails[$start_message]->seen || $mails[$start_message]->recent) {
        	$listview_entries[$num][] = '<td align="left" width="50%"><b><a href="index.php?module=Webmails&action=DetailView&'.$detailParams.'" id="ndeleted_subject_'.$num.'">'.$mails[$start_message]->subject.'</a></b></td>';
        	$listview_entries[$num][] = '<td align="left" width="20%" nowrap id="ndeleted_date_'.$num.'"><b>'.$mails[$start_message]->date.'</b> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>';
        	$listview_entries[$num][] = '<td align="left" width="25%" id="ndeleted_from_'.$num.'"><b>'.$from.'</b></td>';
  	} else {
        	$listview_entries[$num][] = '<td align="left" width="50%"><a href="index.php?module=Webmails&action=DetailView&'.$detailParams.'" id="ndeleted_subject_'.$num.'">'.$mails[$start_message]->subject.'</a></td>';
        	$listview_entries[$num][] = '<td align="left" width="20%" nowrap id="ndeleted_date_'.$num.'">'.$mails[$start_message]->date.'</td>';
        	$listview_entries[$num][] = '<td align="left" width="25%" id="ndeleted_from_'.$num.'">'.$from.'</td>';
  	}

	if($mails[$start_message]->deleted)
  		$listview_entries[$num][] = '<td nowrap align="center" id="deleted_td_'.$num.'"><a href="javascript:void(0);" onclick="runEmailCommand(\'undelete_msg\','.$num.');"><img src="modules/Webmails/images/gnome-fs-trash-full.png" border="0" width="14" height="14" alt="del" id="del_img_'.$num.'"></a>&nbsp;';
	else
  		$listview_entries[$num][] = '<td nowrap align="center" id="ndeleted_td_'.$num.'"><a href="javascript:void(0);" onclick="runEmailCommand(\'delete_msg\','.$num.');"><img src="modules/Webmails/images/gnome-fs-trash-empty.png" border="0" width="14" height="14" alt="del" id="del_img_'.$num.'"></a>&nbsp;';

	$listview_entries[$num][] = '<a href="index.php?module=Webmails&action=EditView&reply=single&mailid='.$num.'&'.$defaultParams.'"><img src="modules/Webmails/images/stock_mail-reply.png" alt="reply" width="14" height="14"  border="0"></a>&nbsp;</td></tr>';

  	require("showOverviewUI.php");
  	$i++;
  	$start_message--;
    }
}
?>
  </table>
 </td></tr>
</table>
<?
$navigationOutput = getTableHeaderNavigation($navigation_array,'&parenttab=My%20Home%20Page&mailbox='.$mailbox,"Webmails","index",$viewid);
$navigationOutput .= '<td size="10%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td align="right"><a href="index.php?module=Webmails&action=index&'.$defaultParams.'">Check for new e-Mails</a></td>';

$list = imap_getmailboxes($mbox, "{".$imapServerAddress."}", "*");
sort($list);
if (is_array($list)) {
	$boxes = '<select name="mailbox" onchange="changeMbox(this)">';
        foreach ($list as $key => $val) {
		$tmpval = preg_replace(array("/\{.*?\}/i"),array(""),$val->name);
		if ($_REQUEST["mailbox"] == $tmpval) {
         		$boxes .= '<option value="'.$tmpval.'" SELECTED>'.$tmpval;
		} else
         		$boxes .= '<option value="'.$tmpval.'">'.$tmpval;
 	}
	$boxes .= '</select>';
}
$navigationOutput .= '<td size="100%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$navigationOutput .= $boxes;
$navigationOutput .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
$navigationOutput .= '<td align="right">Viewing Messages: <b>'.($start_message+$c).'</b> to <b>'.$start_message.'</b> ('.$numEmails.' Total)</td>';

imap_close($mbox);
//print_r($listview_entries);
$smarty = new vtigerCRM_Smarty;

$smarty->assign("CUSTOMVIEW_OPTION",$customviewcombo_html);
$smarty->assign("MOD", $mod_strings);
$smarty->assign("APP", $app_strings);
$smarty->assign("IMAGE_PATH",$image_path);
$smarty->assign("LISTENTITY", $listview_entries);
$smarty->assign("LISTHEADER", $listview_header);
$smarty->assign("MODULE","Webmails");
$smarty->assign("SINGLE_MOD",'Webmails');
$smarty->assign("BUTTONS",$other_text);
$smarty->assign("CATEGORY","My  Home Page");
$smarty->assign("NAVIGATION", $navigationOutput);
$smarty->assign("RECORD_COUNTS", $record_string);
$smarty->display("ListView.tpl");
?>
