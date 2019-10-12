<?php

class objDate
{
    function createdisplaydate($dt)
    {


        $dt = date_format(date_create($dt), 'd-M-Y');
        return $dt;
    }



    function createtimeform($dt)
    {


        $dt = date_format(date_create($dt), 'h:i a');
        return $dt;
    }




    function create24to12($time)
    {
        return date('h:i a', strtotime($time));
    }

    function getOrdinal($number)
    {
        // get first digit
        $digit = abs($number) % 10;
        $ext = 'th';
        $ext = ((abs($number) % 100 < 21 && abs($number) % 100 > 4) ? 'th' : (($digit < 4) ? ($digit < 3) ? ($digit < 2) ? ($digit < 1) ? 'th' : 'st' : 'nd' : 'rd' : 'th'));
        return $number . $ext;
    }


    function createtextdate($dt)
    {
      

        $date   = array();
        $date[] = explode("-" , $dt  );

        $NEWDATE = $date[0][2].'/'.$date[0][1].'/'.$date[0][0];
        return $NEWDATE;


    }


    function getTodaydate()
    {
        $currentdate = date('Y-m-d');
        return $currentdate;

    }


      function getFormattedTodaydate($format)
    {
        $currentdate = date($format);
        return $currentdate;

    }

    function dateDiff($startDate, $endDate)
    {
        $difference = NULL;
        $yy = substr($endDate, 0, 4);
        $mm = substr($endDate, 5, 2);
        $dd = substr($endDate, 8, 10);
        $futuretime = mktime(0, 0, 0, $mm, $dd + 1, $yy, -1);
        $currentTime = time();
        $difference = $futuretime - $currentTime;
        return objDate::convertTime($difference);

    }


    function createdbdate($dt)
    {


         $date   = array();
            $date[] = explode("/" , $dt  );
          
         $NEWDATE = $date[0][2].'-'.$date[0][1].'-'.$date[0][0];


        


        return $NEWDATE;
    }

    function leftdays($startDate)
    {
        $mainsplit = explode(" ", $startDate);
        $datesplit = explode("-", $mainsplit[0]);
        $newdate = $datesplit[2] . "-" . $datesplit[1] . "-" . $datesplit[0] . " " . $mainsplit[1];
        $currentTime = time();
        $difference = mktime(0, 0, 0, $datesplit[1], $datesplit[2], $datesplit[0]) - $currentTime;
        $days = intval($difference / 86400);
        return $days;

    }


    function convertTime($difference)
    {

        //Calculate how many days are within $difference

        $days = intval($difference / 86400);

        //Keep the remainder

        $difference = $difference % 86400;

        //Calculate how many hours are within $difference

        $hours = intval($difference / 3600);

        //Keep the remainder

        $difference = $difference % 3600;

        //Calculate how many minutes are within $difference

        $minutes = intval($difference / 60);

        //Keep the remainder

        $difference = $difference % 60;

        //Calculate how many seconds are within $difference

        $seconds = intval($difference);

        //Output:

        // return $days.  " days " .$hours." hours ".$minutes." minutes ".$seconds." seconds left ";


        // echo "Days: ".$days." Hours: ".$hours." Minutes: ".$minutes." Seconds: ".$seconds. "<br/>";

        $retStr;
        $retStr = NULL;


        if ($days <= 0 and $hours <= 0 and $minutes <= 0 and $seconds <= 0) {
            $retStr = "<span style='font-size:14px;color:#CC006F ' >0</span>";
        }

        if ($days <= 0 and $hours <= 0 and $minutes <= 0 and $seconds > 0) {
            $retStr = "0";
        }


        if ($days > 0) {
            $retStr = $days . " days &nbsp; ";

        }

        if ($hours > 0) {
            $retStr = $retStr . $hours . " hrs ";

        }

        if ($minutes > 0 and $days <= 0) {
            $retStr = $retStr . $minutes . " mins ";

        }

        return $retStr;


    }


    function time_stamp($session_time)
    {

        if (time() > $session_time) {
            $time_difference = time() - $session_time;
        } else {
            $time_difference = $session_time - time();
        }

        $seconds = $time_difference;
        $minutes = round($time_difference / 60);
        $hours = round($time_difference / 3600);
        $days = round($time_difference / 86400);
        $weeks = round($time_difference / 604800);
        $months = round($time_difference / 2419200);
        $years = round($time_difference / 29030400);

        if ($seconds <= 60) {
            return "$seconds seconds ";
        } else if ($minutes <= 60) {
            if ($minutes == 1) {
                return "one minute ";
            } else {
                return "$minutes minutes ";
            }
        } else if ($hours <= 24) {
            if ($hours == 1) {
                return "one hour ";
            } else {
                return "$hours hours ";
            }
        } else if ($days <= 7) {
            if ($days == 1) {
                return "one day ";
            } else {
                return "$days days ";
            }


        } else if ($weeks <= 4) {
            if ($weeks == 1) {
                return "one week ";
            } else {
                return "$weeks weeks ";
            }
        } else if ($months <= 12) {
            if ($months == 1) {
                return "one month ";
            } else {
                return "$months months ";
            }


        } else {
            if ($years == 1) {
                return "one year ";
            } else {
                return "$years years ";
            }


        }


    }


    function datedifference_days($target_date,$colorpos = 'green', $colorneg ='#CF4332')
    {

        $day = 60 * 60 * 24;
        $now = date("Y-m-d");
        $now = strtotime($now);
        $target = strtotime($target_date);
        $dayname = date('l', $target);
        $diff = round(($target - $now) / $day);


        if ($diff > 0) {
            $daystext = number_format(abs($diff));
            $class = "style='color:$colorpos'";
            if ($diff > 1) {
                $daystext .= " days left";
            } else {
                $daystext .= " day left";
            }
        } else {
            $daystext = number_format(abs($diff));
            $class = "style='color:$colorneg'";
            if (abs($diff) > 1) {
                $daystext .=  " days over";
            } else {
                $daystext .=  " day over";
            }
        }
        $outputstring = $diff."|-|".$dayname."|-|".$class."|-|".$daystext;


        return $outputstring;
    }



 function current_datedifference($target_date)
    {

        $day = 60 * 60 * 24;
        $now = date("Y-m-d");
        $now = strtotime($now);
        $target = strtotime($target_date);
        $dayname = date('l', $target);
        $diff = round(($target - $now) / $day);


         
            $daystext = number_format(abs($diff));
           
        $outputstring = $daystext;

        return $outputstring;

    }



           




}
