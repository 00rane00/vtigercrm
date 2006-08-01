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
require_once('include/utils/utils.php');
require_once('modules/Calendar/Date.php');
class RecurringType
{
	var $recur_type;
	var $startdate;
	var $enddate;
	var $recur_freq;
	var $dayofweek_to_rpt = array();
	var $repeat_monthby;
	var $rptmonth_datevalue;
	var $rptmonth_daytype;
	var $recurringdates = array();
	var $reminder;

	/**
	 * Constructor for class RecurringType
	 * @param array  $repeat_arr     - array contains recurring info
	 */
	function RecurringType($repeat_arr)
	{
		$st_date = explode("-",getDBInsertDateValue($repeat_arr["startdate"]));
		$end_date = explode("-",getDBInsertDateValue($repeat_arr["enddate"]));
		$start_date = Array(
			'day'   => $st_date[2],
			'month' => $st_date[1],
			'year'  => $st_date[0]
		);
		$end_date = Array(
			'day'   => $end_date[2],
			'month' => $end_date[1],
			'year'  => $end_date[0]
		);
		//echo '<pre>';print_r($end_date);echo '</pre>';
		$this->recur_type = $repeat_arr['type'];
		$this->recur_freq = $repeat_arr['repeat_frequency'];
		$this->startdate = new DateTime($start_date,true);
		$this->enddate = new DateTime($end_date,true);
		//echo '<pre>';print_r($this->startdate);echo '</pre>';die;
		if($repeat_arr['sun_flag'])
		{
			$this->dayofweek_to_rpt[] = 0;
		}
		if($repeat_arr['mon_flag'])
		{
			$this->dayofweek_to_rpt[] = 1;
		}
		if($repeat_arr['tue_flag'])
		{
			$this->dayofweek_to_rpt[] = 2;
		}
		if($repeat_arr['wed_flag'])
		{
			$this->dayofweek_to_rpt[] = 3;
		}
		if($repeat_arr['thu_flag'])
		{
			$this->dayofweek_to_rpt[] = 4;
		}
		if($repeat_arr['fri_flag'])
		{
			$this->dayofweek_to_rpt[] = 5;
		}
		if($repeat_arr['sat_flag'])
		{
			$this->dayofweek_to_rpt[] = 6;
		}
		$this->repeat_monthby = $repeat_arr['repeatmonth_type'];
		if(isset($repeat_arr['repeatmonth_date']))
			$this->rptmonth_datevalue = $repeat_arr['repeatmonth_date'];
		$this->rptmonth_daytype = $repeat_arr['repeatmonth_daytype'];
		$this->recurringdates = $this->getRecurringDates();
		//echo '<pre>';print_r($this);echo '</pre>';die;
	}

	/**
	 *  Function to get recurring dates depending on the recurring type
	 *  return  array   $recurringDates     -  Recurring Dates in format
	 */
	   
	function getRecurringDates()
	{
		$startdate = $this->startdate->get_formatted_date();
		$tempdate = $startdate;
		$enddate = $this->enddate->get_formatted_date();
		while($tempdate <= $enddate)
		{
			if($this->recur_type == 'Daily')
			{
				$recurringDates[] = $tempdate;
				$st_date = explode("-",$tempdate);
				if(isset($this->recur_freq))
					$index = $st_date[2] + $this->recur_freq - 1;
				else
					$index = $st_date[2];
				$tempdateObj = $this->startdate->getThismonthDaysbyIndex($index,'',$st_date[1],$st_date[0]);
				$tempdate = $tempdateObj->get_formatted_date();
			}
			elseif($this->recur_type == 'Weekly')
			{
				$recurringDates[] = $tempdate;
				$st_date = explode("-",$tempdate);
				$date_arr = Array(
					'day'   => $st_date[2] + 7,
					'month' => $st_date[1],
					'year'  => $st_date[0]
				);
				$tempdateObj = new DateTime($date_arr,true);
				/*$recurringDates[] = $tempdate;
				$st_date = explode("-",$tempdate);
				if(isset($this->recur_freq) && $this->recur_freq != null)
					$index = $st_date[2] + ($this->recur_freq -1) ;
				else
					$index = $st_date[2] - 1 ;
				$index = $st_date[2] - 1 ;
				$tempdateObj = $this->startdate->getThismonthDaysbyIndex($index,'',$st_date[1],$st_date[0]);
				if(in_array($tempdateObj->dayofweek_inshort,$this->repeatdays))
				{
					$tempdate = $tempdateObj->get_formatted_date();
				}
				else
				{
				}
				echo '<pre>';print_r($this);echo '</pre>';die;*/
				$tempdate = $tempdateObj->get_formatted_date();
			}
			elseif($this->recur_type == 'Monthly')
			{
				$recurringDates[] = $tempdate;
				$st_date = explode("-",$tempdate);
				$date_arr = Array(
					'day'   => $st_date[2],
					'month' => $st_date[1],
					'year'  => $st_date[0]
				);
				$startdateObj = new DateTime($date_arr,true);
				if($this->repeat_monthby == 'date')
				{
					if($this->rptmonth_datevalue <= $st_date[2])
					{
						$index = $this->rptmonth_datevalue - 1;
						$day = $this->rptmonth_datevalue;
						if(isset($this->recur_freq))
							$month = $st_date[1] + $this->recur_freq;
						else
							$month = $st_date[1] + 1;
						$year = $st_date[0];
						$tempdateObj = $startdateObj->getThismonthDaysbyIndex($index,$day,$month,$year);
					}	
					else
					{
						$index = $this->rptmonth_datevalue - 1;
						$day = $this->rptmonth_datevalue;
						$month = $st_date[1];
						$year = $st_date[0];
						$tempdateObj = $startdateObj->getThismonthDaysbyIndex($index,$day,$month,$year);
					}
				}
				elseif($this->repeat_monthby == 'day')
				{
					if($this->rptmonth_daytype == 'first')
					{
						 $date_arr = Array(
							'day'   => 1,
						        'month' => $st_date[1],
						 	'year'  => $st_date[0]
					        );
						$tempdateObj = new DateTime($date_arr,true);
						$firstdayofmonthObj = $this->getFistdayofmonth($this->dayofweek_to_rpt[0],$tempdateObj); 
						if($firstdayofmonthObj->get_formatted_date() <= $tempdate)
						{
							if(isset($this->recur_freq))
								$month = $firstdayofmonthObj->month + $this->recur_freq;
							else
								$month = $firstdayofmonthObj->month + 1;
								$dateObj = $firstdayofmonthObj->getThismonthDaysbyIndex(0,1,$month,$firstdayofmonthObj->year);
							$nextmonthObj = $this->getFistdayofmonth($this->dayofweek_to_rpt[0],$dateObj);
							$tempdateObj = $nextmonthObj; 
						}
						else
						{
							$tempdateObj = $firstdayofmonthObj;
						}
						
					}
					elseif($this->rptmonth_daytype == 'last')
					{
						$date_arr = Array(
							'day'   => $startdateObj->daysinmonth,
							'month' => $startdateObj->month,
							'year'  => $startdateObj->year
						);
						$tempdateObj = new DateTime($date_arr,true);
						$lastdayofmonthObj = $this->getLastdayofmonth($this->dayofweek_to_rpt[0],$tempdateObj);
						if($lastdayofmonthObj->get_formatted_date() <= $tempdate)
						{
							if(isset($this->recur_freq))
								$month = $lastdayofmonthObj->month + $this->recur_freq;
							else
								$month = $lastdayofmonthObj->month + 1;
							$dateObj = $lastdayofmonthObj->getThismonthDaysbyIndex(0,1,$month,$lastdayofmonthObj->year); 
							$dateObj = $dateObj->getThismonthDaysbyIndex($dateObj->daysinmonth-1,$dateObj->daysinmonth,$month,$lastdayofmonthObj->year);
							$nextmonthObj = $this->getLastdayofmonth($this->dayofweek_to_rpt[0],$dateObj);
							$tempdateObj = $nextmonthObj;
						}
						else
						{
							$tempdateObj = $lastdayofmonthObj;
						}
					}
				}
				else
				{
					$date_arr = Array(
						'day'   => $st_date[2],
						'month' => $st_date[1]+1,
						'year'  => $st_date[0]
					);
					$tempdateObj = new DateTime($date_arr,true);
				}
				$tempdate = $tempdateObj->get_formatted_date();
			}
			elseif($this->recur_type == 'Yearly')
			{
				$recurringDates[] = $tempdate;
				$st_date = explode("-",$tempdate);
				if(isset($this->recur_freq))
					$index = $st_date[0] + $this->recur_freq;
				else
					$index = $st_date[0] + 1;
				if ($index > 2037 || $index < 1970)
				{
					print("<font color='red'>Sorry, Year must be between 1970 and 2037</font>");
				        exit;
				}
				$date_arr = Array(
					'day'   => $st_date[2],
					'month' => $st_date[1],
					'year'  => $index
				);
				$tempdateObj = new DateTime($date_arr,true);
				$tempdate = $tempdateObj->get_formatted_date();
			}
			else
			{
				die("Recurring Type ".$this->recur_type." is not defined");
			}
		}
		return $recurringDates;
	}

	function getFistdayofmonth($dayofweek,& $dateObj)
	{
		if($dayofweek < $dateObj->dayofweek)
		{
			$index = (7 - $dateObj->dayofweek) + $dayofweek;
			$day = 1 + $index;
			$month = $dateObj->month;
			$year = $dateObj->year;
			$dateObj = $dateObj->getThismonthDaysbyIndex($index,$day,$month,$year);
		}
	        else
		{
			$index = $dayofweek - $dateObj->dayofweek;
			$day = 1 + $index;
			$month = $dateObj->month;
			$year = $dateObj->year;
			$dateObj = $dateObj->getThismonthDaysbyIndex($index,$day,$month,$year);
		}
		return $dateObj;
	}

	function getLastdayofmonth($dayofweek,& $dateObj)
	{
		if($dayofweek == $dateObj->dayofweek)
		{
			return $dateObj;
		}
		else
		{
			if($dayofweek > $dateObj->dayofweek)
				$day = $dateObj->day - 7 + ($dayofweek - $dateObj->dayofweek);
			else
				$day = $dateObj->day - ($dateObj->dayofweek - $dayofweek);
			$index = $day - 1;
			$month = $dateObj->month;
			$year = $dateObj->year;
			$dateObj = $dateObj->getThismonthDaysbyIndex($index,$day,$month,$year);
			return $dateObj;
		}
		
	}
	
}	
      
?>
