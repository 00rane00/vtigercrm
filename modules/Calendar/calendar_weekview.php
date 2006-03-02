<?php
/**
 * Copyright 2001 - 2004 by Gero Kohnert
 *
 * A calendar for one week
 *
 * @modulegroup appointment
 * @module calendar_week
 */
 global $calpath,$callink;
 $calpath = 'modules/Calendar/';
 $callink = 'index.php?module=Calendar&action=';
 
 global $theme;
 $theme_path="themes/".$theme."/";
 $image_path=$theme_path."images/";
 require_once ($theme_path."layout_utils.php");
 global $mod_strings;

 echo get_module_title($mod_strings['LBL_MODULE_NAME'], $mod_strings['LBL_MODULE_APPOINTMENT'], true); 
 echo "\n<BR>\n";
 $t=Date("Ymd");
?>
<table border=0 cellspacing=0 cellpadding=0 width=95% align=center>
<tr>
  <td>
   <table border=0 cellspacing=0 cellpadding=3 width=100%>
   <tr>
      <td class="dvtTabCache" style="width:10px" nowrap>&nbsp;</td>
      <td class="dvtUnSelectedCell" align=center nowrap><a href="index.php?module=Calendar&action=new_calendar&sel=day">Day</a></td>
      <td class="dvtTabCache" style="width:10px">&nbsp;</td>
      <td class="dvtSelectedCell" align=center nowrap>Week</td>
      <td class="dvtTabCache" style="width:10px">&nbsp;</td>
      <td class="dvtUnSelectedCell" align=center nowrap><a href="index.php?module=Calendar&action=new_calendar&sel=month">Month</a></td>
      <td class="dvtTabCache" style="width:10px">&nbsp;</td>
      <td class="dvtTabCache" style="width:100%">&nbsp;</td>
   </tr>
   </table>
  </td>
</tr>
<tr>
  <td valign=top align=left >
   <table border=0 cellspacing=0 cellpadding=3 width=100% class="dvtContentSpace">
   <tr>
      <td align=left style="padding:5px">
<?php

 include_once $calpath .'webelements.p3';
 include_once $calpath .'permission.p3';
 #include_once $calpath .'task.pinc';
 include_once $calpath .'appointment.pinc';
 #include_once $calpath .'product.pinc';
 #include_once $calpath .'timetrack.pinc';

 require_once('modules/Calendar/preference.pinc');
 require_once('include/database/PearDatabase.php');
 require_once('modules/Calendar/UserCalendar.php');

 
 /* Check if user is allowed to use it */
 #check_user();
 loadmodules('appointment','show');
 loadlayout();
 /**
  * display a calendar dfor a week
  */
 class calendar_week extends layout {

   /**
    * A one week calendar sheet
    */
	
   Function calendar_week()
   {
   	$this->pref = new preference();
	$this->db = new PearDatabase();
	$calobj = new UserCalendar();
	$this->tablename = $calobj->table_name;

   }
   Function info() {
  //   global $lang,$tutos,$calpath,$callink,$image_path,$mod_strings;
	global $lang,$tutos,$calpath,$callink,$image_path,$mod_strings,$adb;

     //$adr = $this->user;
     //$adr = $this->pref;
     $ts = mktime(12,0,0,substr($this->t,4,2),substr($this->t,6,2),substr($this->t,0,4));

     $xy=Date("w",$ts);

     /* Back to last Monday or Sunday before ts */
     while ( Date("w",$ts) != $this->pref->weekstart ) {
       $ts -= 86400;
     }

     $w0 =  (( 1 + Date("w",mktime(12,0,0,1,1, Date("Y",$ts) ) )) % 7) > 3;
     $wn = sprintf("%02d", Round( (Date("z",$ts)+7 ) / 7) );


     #$yy = Date("y",$ts);
     $yy = Date("Y",$ts);
     $day_from = Date("d",$ts);
     $day_to = Date("d",$ts + 6 * 86400);
     $mon = Date("n",$ts);
     $m_name = $mod_strings['cal_month_long'][$mon];
     $mon_next = Date("n",$ts + 7 * 86400);
     $mn_name =  $mod_strings['cal_month_long'][$mon_next]."&nbsp;";
     $last_week = Date("Ymd",$ts -  7 * 86400);
     $next_week = Date("Ymd",$ts +  7 * 86400);


     if ($mn_name == $m_name)
     {
	$mn_name ="";
     }
     echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">";
     echo "<form action=\"". $callink ."calendar_weekview\" method=\"get\">\n";
     echo "<tr><td>";
     echo "<table border=0 cellspacing=0 cellpadding=0 width=100% class=\"calTopBg\"><tr><td>\n";
     echo "<img src=\"";
     echo $image_path."calTopLeft.gif\"></td><td>";
     echo $this->pref->menulink($callink ."calendar_weekview&t=".$last_week,$this->pref->getImage(left,'list'),$mod_strings['LBL_LAST_WEEK']) ."</td>";
     echo "<td><img src=\"";
     echo $image_path."calSep.gif\"></td>";
     echo "<td align=\"center\" width=\"100%\" class=\"lvtHeaderText\">";
     echo $mod_strings['LBL_WEEK'] ."&nbsp;of&nbsp;" . $m_name . "&nbsp;".$day_from."&nbsp;to&nbsp;".$mn_name.$day_to."&nbsp;". $yy ."&nbsp;";
     echo "</td><td><img src=\"";
     echo $image_path."calSep.gif\"></td><td>";
     echo $this->pref->menulink($callink ."calendar_weekview&t=".$next_week,$this->pref->getImage(right,'list') ,$mod_strings['LBL_NEXT_WEEK']) ."</td>\n";
     echo "<td align=right><img src=\"";
     echo $image_path."calTopRight.gif\"></td>";
     echo "</tr></table></td></tr>";
     echo "<tr><td>";
     echo "<!-- calendar list -->
              <table border=\"0\" cellspacing=\"0\" cellpadding=\"10\" width=\"100%\" class=\"calDisplay\">
              <tr><td align=center>";
     echo "
	     <div align=left style=\"padding:5px;width:95%\">
	     Time filter : <select class=small>
	     <option>Select ...</option>
	     <option> - Work hours (8am - 8pm)</option>

	     <option> - Early morning to Noon (12am - 12pm)</option>
	     <option> - Noon to Midnight (12pm - 12am)</option>
	     <option> - Full day (24 Hours)</option>
	     <option> - Custom time...</option>
	     </select>

	     </div>";
     echo "<div class=\"calDiv\" >";
	echo "<table border=0 cellspacing=1 cellpadding=5 width=100% class=\"calDayHour\" style=\"background-color: #dadada\">";

     $day = 0;
     $col = 1;
     $dd = new DateTime();
     for ($row=1;$row<=1;$row++)
     {
	     echo "<tr>";
	     echo "<td width=12% class=\"lvtCol\" bgcolor=\"blue\" valign=top>&nbsp;</td>";
	     for ($column=0;$column<=6;$column++)
	     {
		     $next = NextDay($ts);
		     echo "<td width=12% class=\"lvtCol\" bgcolor=\"blue\" valign=top>";
		     echo strftime($mod_strings['LBL_DATE_TITLE'],$ts);
		     echo "</td>";
		     $ts = $next;
	     }
     }
     for ($row=1;$row<=24;$row++)
     {
	     echo "<tr>";
	     for ($column=0;$column<=7;$column++)
	     {
		if ($column==0)
		{
		     echo "<td  style=\"background-color:#eaeaea; border-top:1px solid #efefef;height:40px\" width=12% valign=top>";
		     echo $row,"pm";
		}
		else
		{
		     $dd->setDateTimeTS($ts);
                     $d = $dd->getDate();
                     $tref = Date("Ymd",$ts);
                     $dinfo = GetDaysInfo($ts);

		     $from =  new DateTime();
		     $to =  new DateTime();
		     $from->setDateTimeTS($ts - 12 * 3600);
		     $to->setDateTimeTS($ts - 12 * 3600);
#$to->addDays(7);
		     $this->pref->callist = array();
		     appointment::readCal($this->pref,$from,$to);

		     $next = NextDay($ts);

		     echo "<td onmouseover=\"this.classname='cellnormalhover'\" onmouseout=\"this.classname='cellnormal'\" bgcolor=\"white\" style=\"height:40px\" width=12% valign=top>";

			foreach ($this->pref->callist as $idx => $x) {

                          //the correct day
                         if ( ! $this->pref->callist[$idx]->inside($dd) ) {
                           continue;
                         }
                         //if (!cal_check_against_list($this->pref->callist[$idx],$this->uids)) {
                           //continue;
                         //}
                         // do not show finished tasks
                         if ( ($this->pref->callist[$idx]->gettype() == "task") && ($this->pref->callist[$idx]
->state == 2) ) {

                           continue;
                         }
                        if ( !$hastable )
                        {

                                echo "<table width=\"100%\" class=\"event\" cellspacing=\"0\" cellpadding=\"2\" border=\"0\">\n";
                                $hastable = true;
                        }
                        else
                        {
                                echo "  <tr><td class=\"eventsep\" colspan=\"3\"><img src=\"". $image_path ."b
lank.gif\" width=\"100%\" height=\"1\"></td></tr>\n";

                        }
                        // show appointments or task or whatever
                        $color = "";
                        $username=$this->pref->callist[$idx]->creator;
                        if ($username!="")
			{
				$query="SELECT cal_color FROM users where user_name = '$username'";

				$result=$adb->query($query);
				if($adb->getRowCount($result)!=0)
				{
					$res = $adb->fetchByAssoc($result, -1, false);
					$usercolor = $res['cal_color'];
					$color="style=\"background: ".$usercolor.";\"";
				}
			}
			echo "\n<tr><td><table width=\"100%\" class=\"event\" $color cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n";
			$this->pref->callist[$idx]->formatted();
			echo "\n</table></td></tr>";

			}


		     echo "<div valign=bottom align=right onclick=\"gshow('addEvent')\"  width=10% class=\"small\" id=$row.\" pm\"><br>";
		     echo "+";
		     echo"</div></td>";
		}
	      }
	     echo "</tr>";
     }

     if ( $col == 2 ) {
       echo " </tr>\n";
     }
     echo "</table>\n";
     echo "</td></tr></table>\n";
     hiddenFormElements();
     $this->addHidden("t", $this->t);
     echo $this->getHidden();
     echo "</form>\n";
   }
   /**
    * naviagte
    */
   Function navigate() {
   }
   /**
    * prepare
    */
   Function prepare() {
     global $tutos, $lang;

     $this->name = $mod_strings['LBL_MODULE_NAME'];
     #if ( ! $this->user->feature_ok(usecalendar,PERM_SEE) ) {
     #  $msg .= sprintf($lang['Err0022'],"'". $this->name ."'");
     #  $this->stop = true;
     #}

     #$this->team = $this->user->get_prefteam();
     $this->teamname = "";
     #$this->uids = cal_parse_options($this->user,$this->teamname);
     $this->t = $_GET['t'];
     # menu
     #$m = appointment::getSelectLink($this->user);
     #$m[category][] = "obj";
     #$this->addmenu($m);
     #$m = appointment::getAddLink($this->user,$this->user);
     #$this->addMenu($m);
   }
 }

# info($_GET['t'],$current_user->get_prefteam(),$teamname,$uids);

 $l = new calendar_week($current_user);
 $l->display();
 #$dbconn->Close();
?>
<!--
    CVS Info:  $Id: calendar_week.php 2074 2005-10-14 11:51:34Z cooljaguar $
    $Author: cooljaguar $
-->	
