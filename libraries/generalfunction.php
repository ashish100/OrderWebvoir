<?php

include_once($_SERVER['DOCUMENT_ROOT'] . FOLDER_PATH . DATABASE_PATH);

class objGeneral


{


    function sortArray( $data, $field ) {
    $field = (array) $field;
    uasort( $data, function($a, $b) use($field) {
        $retval = 0;
        foreach( $field as $fieldname ) {
            if( $retval == 0 ) $retval = strnatcmp( $a[$fieldname], $b[$fieldname] );
        }
        return $retval;
    } );
    return $data;
}

 //usort($data, make_comparer(['number', SORT_DESC], ['name', SORT_DESC]));
function make_comparer() {
    // Normalize criteria up front so that the comparer finds everything tidy
    $criteria = func_get_args();
    foreach ($criteria as $index => $criterion) {
        $criteria[$index] = is_array($criterion)
            ? array_pad($criterion, 3, null)
            : array($criterion, SORT_ASC, null);
    }

    return function($first, $second) use (&$criteria) {
        foreach ($criteria as $criterion) {
            // How will we compare this round?
            list($column, $sortOrder, $projection) = $criterion;
            $sortOrder = $sortOrder === SORT_DESC ? -1 : 1;

            // If a projection was defined project the values now
            if ($projection) {
                $lhs = call_user_func($projection, $first[$column]);
                $rhs = call_user_func($projection, $second[$column]);
            }
            else {
                $lhs = $first[$column];
                $rhs = $second[$column];
            }

            // Do the actual comparison; do not return if equal
            if ($lhs < $rhs) {
                return -1 * $sortOrder;
            }
            else if ($lhs > $rhs) {
                return 1 * $sortOrder;
            }
        }

        return 0; // tiebreakers exhausted, so $first == $second
    };
}


function checkempty($param1, $param2)
{
     //$param2 = true;
    if (!empty(trim($param2)))
    {
        return $param1;
    }else{
       return ""; 
    }
    
}

 


    function interpolateQuery($query, $params) {
    $keys = array();

    # build a regular expression for each parameter
    foreach ($params as $key => $value) {
        if (is_string($key)) {
            $keys[] = '/:'.$key.'/';
        } else {
            $keys[] = '/[?]/';
        }
    }

    $query = preg_replace($keys, $params, $query, 1, $count);

    #trigger_error('replaced '.$count.' keys');

    return $query;
}





    function ismobile_view( )
    {

                $status = false; 

            $iphone = strpos($_SERVER['HTTP_USER_AGENT'], "iPhone");
            $android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");
            $palmpre = strpos($_SERVER['HTTP_USER_AGENT'], "webOS");
            $berry = strpos($_SERVER['HTTP_USER_AGENT'], "BB");
            $ipod = strpos($_SERVER['HTTP_USER_AGENT'], "iPod");
            $windows = strpos($_SERVER['HTTP_USER_AGENT'], "Windows Phone");
            $nokia = strpos($_SERVER['HTTP_USER_AGENT'], "Nokia");
            $pocket = strpos($_SERVER['HTTP_USER_AGENT'], "Pocket");
//http://w3webtools.com/php-mobile-detect-and-redirect-to-mobile-site/
//Opera Mini|Windows CE|Nokia|SonyEricsson|webOS|PalmO
            if ($iphone || $android || $palmpre || $ipod || $windows || $nokia || $pocket || $berry == true) {
               $status = true; 
            }


            if ($version != "desktop") {
                $useragent = $_SERVER['HTTP_USER_AGENT'];
                if (preg_match('/android|avantgo|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\\/|plucker|pocket|psp|symbian|treo|up\\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\\-(n|u)|c55\\/|capi|ccwa|cdm\\-|cell|chtm|cldc|cmd\\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\\-s|devi|dica|dmob|do(c|p)o|ds(12|\\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\\-|_)|g1 u|g560|gene|gf\\-5|g\\-mo|go(\\.w|od)|gr(ad|un)|haie|hcit|hd\\-(m|p|t)|hei\\-|hi(pt|ta)|hp( i|ip)|hs\\-c|ht(c(\\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\\-(20|go|ma)|i230|iac( |\\-|\\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\\/)|klon|kpt |kwc\\-|kyo(c|k)|le(no|xi)|lg( g|\\/(k|l|u)|50|54|e\\-|e\\/|\\-[a-w])|libw|lynx|m1\\-w|m3ga|m50\\/|ma(te|ui|xo)|mc(01|21|ca)|m\\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\\-2|po(ck|rt|se)|prox|psio|pt\\-g|qa\\-a|qc(07|12|21|32|60|\\-[2-7]|i\\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\\-|oo|p\\-)|sdk\\/|se(c(\\-|0|1)|47|mc|nd|ri)|sgh\\-|shar|sie(\\-|m)|sk\\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\\-|v\\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\\-|tdg\\-|tel(i|m)|tim\\-|t\\-mo|to(pl|sh)|ts(70|m\\-|m3|m5)|tx\\-9|up(\\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\\-|2|g)|yas\\-|your|zeto|zte\\-/i', substr($useragent, 0, 4))) {
                     $status = true; 
                }

            }

return $status;
        }





    function MakeUrls($str)
    {

        if ($str != ""){
          $str = str_replace('http://', '', $str);
            
        $find=array('`((?:https?|ftp)://\S+[[:alnum:]]/?)`si','`((?<!//)(www\.\S+[[:alnum:]]/?))`si');

        $replace=array('<a href="$1" target="_blank">$1</a>','<a href="http://$1"    target="_blank">$1</a>');

        return preg_replace($find,$replace,$str);
    }
    else
    {
        return "";
    }
    }




    function MakeEmail($str)
    {
        $str =  "<a href='mailto:$str'>$str</a>" ;

        return $str;
    }



    function MakePhone($str)
    {
       $str =  "<a href='tel:$str'>$str</a>" ;

        return $str;
    }

    function set_mobile_view($mobileurl, $currentpage)
    {


        $mobilepages = array('company-info.php', 'company.php', 'contact.php', 'contact-info.php', 'project.php', 'project-info.php', 'activity.php', 'activity-info.php', 'collections.php', 'activity_report.php', 'collection-payment.php' );
        $qrystring = $_SERVER["QUERY_STRING"];
        $currentpage = basename($_SERVER['PHP_SELF']);
        $servername = $_SERVER['SERVER_NAME'];
        $check = false;


        if (in_array($currentpage, $mobilepages)) {
            $check = true;

            $mobilepagename = str_replace('.php', '', $currentpage);

            $newurl = $mobilepagename."-mobile.php";

            if ($qrystring != NULL) {
                $newurl .= '?' . $qrystring;
            }
        }

        if ($check) {

            $iphone = strpos($_SERVER['HTTP_USER_AGENT'], "iPhone");
            $android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");
            $palmpre = strpos($_SERVER['HTTP_USER_AGENT'], "webOS");
            $berry = strpos($_SERVER['HTTP_USER_AGENT'], "BB");
            $ipod = strpos($_SERVER['HTTP_USER_AGENT'], "iPod");
            $windows = strpos($_SERVER['HTTP_USER_AGENT'], "Windows Phone");
            $nokia = strpos($_SERVER['HTTP_USER_AGENT'], "Nokia");
            $pocket = strpos($_SERVER['HTTP_USER_AGENT'], "Pocket");
//http://w3webtools.com/php-mobile-detect-and-redirect-to-mobile-site/
//Opera Mini|Windows CE|Nokia|SonyEricsson|webOS|PalmO
            if ($iphone || $android || $palmpre || $ipod || $windows || $nokia || $pocket || $berry == true) {
                header('Location: ' . $newurl);

            }


            if ($version != "desktop") {
                $useragent = $_SERVER['HTTP_USER_AGENT'];
                if (preg_match('/android|avantgo|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\\/|plucker|pocket|psp|symbian|treo|up\\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\\-(n|u)|c55\\/|capi|ccwa|cdm\\-|cell|chtm|cldc|cmd\\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\\-s|devi|dica|dmob|do(c|p)o|ds(12|\\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\\-|_)|g1 u|g560|gene|gf\\-5|g\\-mo|go(\\.w|od)|gr(ad|un)|haie|hcit|hd\\-(m|p|t)|hei\\-|hi(pt|ta)|hp( i|ip)|hs\\-c|ht(c(\\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\\-(20|go|ma)|i230|iac( |\\-|\\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\\/)|klon|kpt |kwc\\-|kyo(c|k)|le(no|xi)|lg( g|\\/(k|l|u)|50|54|e\\-|e\\/|\\-[a-w])|libw|lynx|m1\\-w|m3ga|m50\\/|ma(te|ui|xo)|mc(01|21|ca)|m\\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\\-2|po(ck|rt|se)|prox|psio|pt\\-g|qa\\-a|qc(07|12|21|32|60|\\-[2-7]|i\\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\\-|oo|p\\-)|sdk\\/|se(c(\\-|0|1)|47|mc|nd|ri)|sgh\\-|shar|sie(\\-|m)|sk\\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\\-|v\\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\\-|tdg\\-|tel(i|m)|tim\\-|t\\-mo|to(pl|sh)|ts(70|m\\-|m3|m5)|tx\\-9|up(\\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\\-|2|g)|yas\\-|your|zeto|zte\\-/i', substr($useragent, 0, 4))) {
                    header('Location: ' . $newurl);
                }

            }


        }


    }





    function show_mobile_filter_link()
    {


        $mobilepages = array('company-mobile.php', 'contact-mobile.php', 'activity-mobile.php', 'collection-mobile.php', 'project-mobile.php', 'collections-mobile.php', 'activity_report-mobile.php', 'opportunity-dashboard.php');
        $qrystring = $_SERVER["QUERY_STRING"];
        $currentpage = basename($_SERVER['PHP_SELF']);
        $servername = $_SERVER['SERVER_NAME'];
        $check = false;


        if (in_array($currentpage, $mobilepages)) {
         return true;
 
        }

        return false;

         

           


        

    }



    function getPaging($page, $total_pages, $limit = 10, $optionalquery)
    {


//echo $page ."---total pages-". $total_pages  ."--limit--".  $limit ."--3--". $optionalquery;
        $adjacents = 3;
        if ($page == 0) {
            $page = 1;
        }                    //if no page var is given, default to 1.
        $prev = $page - 1;                            //previous page is page - 1
        $next = $page + 1;                            //next page is page + 1
        $lastpage = ceil($total_pages / $limit);        //lastpage is = total pages / items per page, rounded up.
        $lpm1 = $lastpage - 1;

        $pagination = "";
        if ($lastpage > 1) {
            $pagination .= "<nav><ul class='pagination'>";
            //previous button
            if ($page > 1) {
                $pagination .= "<li><a href=\"$targetpage?page=$prev$optionalquery\"><<</a></li>";
            } else {
                $pagination .= "<li class='disabled'><a   ><<</a></li>";
            }

            //pages
            if ($lastpage < 7 + ($adjacents * 2))    //not enough pages to bother breaking it up
            {
                for ($counter = 1; $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination .= "<li class='active' ><a > $counter </a></li>";
                    else
                        $pagination .= "<li><a href=\"$targetpage?page=$counter$optionalquery\">$counter</a></li>";
                }
            } elseif ($lastpage > 5 + ($adjacents * 2))    //enough pages to hide some
            {
                //close to beginning; only hide later pages
                if ($page < 1 + ($adjacents * 2)) {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                        if ($counter == $page)
                            $pagination .= "<li  class='active'><a> $counter </a></li>";
                        else
                            $pagination .= "<li><a href=\"$targetpage?page=$counter$optionalquery\">$counter</a></li>";
                    }
                    //$pagination.= "...";
                    $pagination .= "<li><a href=\"$targetpage?page=$lpm1$optionalquery\">$lpm1</a></li>";
                    $pagination .= "<li><a href=\"$targetpage?page=$lastpage$optionalquery\">$lastpage</a></li>";
                } //in middle; hide some front and some back
                elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                    $pagination .= "<li><a href=\"$targetpage?page=1\">1</a></li>";
                    //$pagination.= "<li><a href=\"$targetpage?page=2\">2</a></li>";
                    //$pagination.= "...";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page)
                            $pagination .= "<li  class='active'><a  > $counter </a></li>";
                        else
                            $pagination .= "<li><a href=\"$targetpage?page=$counter$optionalquery\">$counter</a></li>";
                    }
                    //$pagination.= "...";
                    $pagination .= "<li><a href=\"$targetpage?page=$lpm1\">$lpm1</a></li>";
                    $pagination .= "<li><a href=\"$targetpage?page=$lastpage$optionalquery\">$lastpage</a></li>";
                } //close to end; only hide early pages
                else {
                    $pagination .= "<li><a href=\"$targetpage?page=1\">1</a></li>";
                    $pagination .= "<li><a href=\"$targetpage?page=2\">2</a></li>";
                    //$pagination.= "...";
                    for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                        if ($counter == $page)
                            $pagination .= "<li  class='active' ><a> $counter </a></li>";
                        else
                            $pagination .= "<li><a href=\"$targetpage?page=$counter$optionalquery\">$counter</a></li>";
                    }
                }
            }

            //next button
            if ($page < $counter - 1)
                $pagination .= "<li><a href=\"$targetpage?page=$next$optionalquery\">>> </a></li>";
            else
                $pagination .= "<li class='disabled'><a ><span class=\"disabled\">>> </span></a></li>";
            $pagination .= "</ul>\n";
        }
        return $pagination;
    }




    function getMobilePaging($page, $total_pages, $limit = 10, $optionalquery)
    {

        if ($page == 0) {
            $page = 1;
        }                    //if no page var is given, default to 1.
        $prev = $page - 1;                            //previous page is page - 1
        $next = $page + 1;                            //next page is page + 1
        $lastpage = ceil($total_pages / $limit);  


$formaction = ltrim($optionalquery, '&');
$arrformaction = explode( '&' , $formaction);
 
        $pagingMobile = "<div class='col-xs-12'><form method='get' action=''>
      <ul class='mobilepaging' style='float:left;list-style:none'>
       <li> <a href='$targetpage?page=$prev$optionalquery' ><i class='fa fa-arrow-circle-o-left' aria-hidden='true'   ></i></a></li>
         <li><a href='$targetpage?page=$next$optionalquery' ><i class='fa fa-arrow-circle-o-right' aria-hidden='true'  ></i></a></li>
         
         <li><input type='text' name='page' id='txtPageNumber' value='$page'  class='pull-left'></li><li><span>/ $lastpage</span></li><li><input type='submit'  class='btn btn-sm btn-success'  type='submit' value='Go' /></li>";
        foreach ($arrformaction as $key => $value) {
            $arrformactionString = explode( '=' , $value);
$keyField = $arrformactionString[0];
$valueField = $arrformactionString[1];
       $pagingMobile  .= "<input type='hidden' name='$keyField' value='$valueField'/>" ;
}
       
 $pagingMobile  .= "</ul></form></div>";

        return   $pagingMobile;
        
    }



    function selected_list($queryvalue)
    {

        $finalstring = basename($_SERVER['PHP_SELF']);
        //echo $queryvalue ."| ". $finalstring." |value here is fine";
        $a = explode(",", $queryvalue);

        $output = "";
        if (count($a) > 0) {
            for ($jloop = 0; $jloop < count($a); $jloop++) {
                // echo "|" .$a[$jloop].  "|" ;
                if ($finalstring == $a[$jloop]) {
                    $output = "class='active'";
                    break;
                }

            }
        }

        if (count($a) == 0) {
            $pos = strpos($finalstring, $queryvalue);
            if ($pos) {
                $output = "class='active'";
               // break;
                //  echo "class='SelectedList'";
            }

        }

        echo $output;
    }





    function selected_query_list($queryvalue)
    {

        $finalstring = basename($_SERVER['PHP_SELF']);
        $querystring =$_SERVER['QUERY_STRING'] ;
        //echo $queryvalue ."| ". $finalstring." |value here is fine";
        $a = explode(",", $queryvalue);
        $fullurl =   $finalstring."?".$querystring;

        $output = "";
        if (count($a) > 0) {
            for ($jloop = 0; $jloop < count($a); $jloop++) {
                // echo "|" .$a[$jloop].  "|" ;
                if ($fullurl == $a[$jloop]) {
                    $output = "class='active'";
                    break;
                }

            }
        }

        if (count($a) == 0) {
            $pos = strpos($finalstring, $queryvalue);
            if ($pos) {
                $output = "class='active'";
             //   break;
                //  echo "class='SelectedList'";
            }

        }

        echo $output;
    }


    function selected_sub_list($queryvalue)
    {
        $finalstring = $_SERVER['QUERY_STRING'];

        $a = explode(",", $queryvalue);

        $output = "";
        if (count($a) > 0) {
            for ($jloop = 0; $jloop < count($a); $jloop++) {
                // echo "|" .$a[$jloop].  "|" ;
                if ($_GET["link_type"] == $a[$jloop] || $_GET["forecasttype"] == $a[$jloop]) {
                    $output = "<i class='icon-hand-left selectedsublist'  ></i>";
                    break;
                }
                $pos = strpos($finalstring, $a[$jloop]);
                if ($pos) {


                }
            }
        }

        if (count($a) == 0) {
            $pos = strpos($finalstring, $queryvalue);
            if ($pos) {
            //    break;
                //  echo "class='SelectedList'";
            }

        }

        echo $output;
    }


    function show_selectlist($queryvalue)
    {
        $finalstring = $_SERVER['QUERY_STRING'];

        $a = explode(",", $queryvalue);

        $output = "<i class='icon-angle-right angle-right-position' ></i>";
        if (count($a) > 0) {
            for ($jloop = 0; $jloop < count($a); $jloop++) {
                // echo "|" .$a[$jloop].  "|" ;
                if ($_GET["link_type"] == $a[$jloop]) {
                    $output = " <i class='icon-caret-left angle-inside-arrow' ></i><i class='icon-angle-down angle-right-position' ></i>";
                    break;
                }
                $pos = strpos($finalstring, $a[$jloop]);
                if ($pos) {


                }
            }
        }

        if (count($a) == 0) {
            $pos = strpos($finalstring, $queryvalue);
            if ($pos) {
              //  break;
                //  echo "class='SelectedList'";
            }

        }

        echo $output;
    }


    function show_sublist($queryvalue)
    {
        $finalstring = $_SERVER['QUERY_STRING'];

        $a = explode(",", $queryvalue);

        $output = false;
        if (count($a) > 0) {
            for ($jloop = 0; $jloop < count($a); $jloop++) {
                // echo "|" .$a[$jloop].  "|" ;
                if ($_GET["link_type"] == $a[$jloop]) {
                    $output = true;
                    break;
                }
                $pos = strpos($finalstring, $a[$jloop]);
                if ($pos) {


                }
            }
        }

        if (count($a) == 0) {
            $pos = strpos($finalstring, $queryvalue);
            if ($pos) {
               // break;
                //  echo "class='SelectedList'";
            }

        }

        return $output;
    }


    function getTime()
    {
        $a = explode(' ', microtime());
        return (double)$a[0] + $a[1];
    }


    function filter($data)
    {
        $data = trim(htmlentities(strip_tags($data)));

        if (get_magic_quotes_gpc())
            $data = stripslashes($data);
        $data = mysql_real_escape_string($data);
        return $data;
    }

    function filter_separator($data)
    {
        return str_replace("|%|", " ", $data);
    }


    function sanitiseData($string)
    {
        global $mysqli;
        if (is_string($string)) {
            $string = strip_tags($string); // Remove HTML
            $string = htmlspecialchars($string); // Convert characters
            $string = trim(rtrim(ltrim($string))); // Remove spaces
            $string = mysqli_real_escape_string($mysqli, $string); // Prevent SQL Injection
        }
        return $string;
    }


    function clean($string)
    {
        global $mysqli;
        if (get_magic_quotes_gpc())  // prevents duplicate backslashes
        {
            $string = stripslashes($string);
        }
        if (phpversion() >= '4.3.0') {
            $string = mysqli_real_escape_string($mysqli, $string);
        } else {
            $string = mysqli_real_escape_string($mysqli, $string);
        }
        return $string;

    }


    function check_empty($stringdata, $completestring)
    {
        if (!empty($stringdata)) {

            $updatedstring = str_replace("_REPLACE_", $stringdata, $completestring);
            echo $updatedstring;
        }
    }

    function getUniqueID()
    {
        $c = uniqid(rand(), true);
        $md5c = md5($c);
        return $md5c;


        // return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        ////mt_rand(0, 0x0fff) | 0x4000,
        //  mt_rand(0, 0x3fff) | 0x8000,
        // mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff));
    }

    function create_guid()
    {
        if (function_exists('com_create_guid')) {
            return com_create_guid();
        } else {
            mt_srand((double)microtime() * 10000);//optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);// "-"
            $uuid = substr($charid, 0, 8) . $hyphen
                . substr($charid, 8, 4) . $hyphen
                . substr($charid, 12, 4) . $hyphen
                . substr($charid, 16, 4) . $hyphen
                . substr($charid, 20, 12);

            return $uuid;

            //chr(123)// "{".chr(125);// "}"

        }
    }


    function getSelectedText($string1, $string2, $outtext)
    {
        if ($string1 == $string2) {
            $output = $outtext;
        } else {
            $output = NULL;
        }
        return $output;
    }

    function getfilledData($label, $value)
    {
        if ($value != NULL) {
            echo "<strong>" . $label . "</strong>: " . $value . "<br/>";
        }
    }


    function checkData($value, $blanksubsitute = "n/a")
    {
        $output = $value;
        if ($value == NULL) {
            $output = "<strong>$blanksubsitute</strong> ";
        }
        return $output;

    }

    function getLinkData($label, $value)
    {
        if ($value != NULL) {
            echo "<strong>" . $label . "</strong>: <a href='" . $value . "' target='_blank' >" . $value . "</a><br/>";
        }
    }


    function getDropdownData($drparray, $drpvalue, $drptext, $selecttext)
    {
        $str = "";
        for ($iloop = 0; $iloop < count($drparray); $iloop++) {

            $selectedtext = "";
            $text = $drparray[$iloop][$drptext];
            $value = $drparray[$iloop][$drpvalue];
            if ($value == $selecttext) {
                $selectedtext = "selected='selected'";
            }
            $str .= "<option value='$value'  $selectedtext > $text</option>";

        }

        return $str;
    }

    function getArrayString($arrstr)
    {
        $N = count($arrstr);

        if ($N > 0) {
            $StringFileName = NULL;

            for ($iloop = 0; $iloop < $N; $iloop++) {
                $StringFileName = $StringFileName . $arrstr[$iloop] . "%";
            }

            $StringFileName = substr($StringFileName, 0, -1);
        } else {
            $StringFileName = "";
        }

        return $StringFileName;
    }


    function get_error_msgs($phrase)
    {
        static $lang = array(
            '101' => 'Client is added succesfully',
            '102' => 'Client is updated succesfully',
            '201' => 'Company is added succesfully',
            '202' => 'Company is updated succesfully',
            '301' => 'Follow up added succesfully',
            '302' => 'Follow up updated succesfully',
            '401' => 'Forecast added succesfully',
            '402' => 'Forecast updated succesfully',
            '501' => 'Brand added succesfully',
            '502' => 'Brand updated succesfully',
            '601' => 'Brand Member added succesfully',
            '602' => 'Brand Member updated succesfully',
            '701' => 'Group added succesfully',
            '702' => 'Group updated succesfully'
        );
        return $lang[$phrase];
    }


    function get_selectoptions($optvalue, $optname, $optarray, $shownone, $shownonelabel)
    {

        $arrDisplay = explode(",", $optname);

        $stringop = NULL;
        if ($shownone == 1) {
            $stringop .= " <option value='-1'>" . $shownonelabel . "</option>";
        }
        while ($row = mysqli_fetch_array($optarray, MYSQLI_ASSOC)) {
            if (is_array($arrDisplay)) {
                $displayoption = $row[$arrDisplay[0]] . " " . $row[$arrDisplay[1]];
            } else {
                $displayoption = $row[$optname];
            }
            $stringop .= " <option value='" . $row[$optvalue] . "'>" . $displayoption . "</option>";
        }
        echo $stringop;
    }


    public function check_int($intnumber)
    {

        $intnumber = (int)$intnumber;
        if ($intnumber == "-1" || $intnumber == "-20")
        {
            return true;
        }else {
            if (filter_var($intnumber, FILTER_VALIDATE_INT) === false) {
                exit();
            }
        }
    }


    public function get_year_dropdown()
    {

        $stringop = NULL;
        $currentyear = date("Y");
        $lastyear = $currentyear - 15;
        for ($yearloop = $currentyear; $yearloop > $lastyear; $yearloop--) {


            $stringop .= " <option value=" . $yearloop . ">" . $yearloop . "</option>";
        }

        echo $stringop;

    }


    public function get_month_dropdown($INYear)
    {


        if ($INYear > 0) {
            $stringop = NULL;
            $currentyear = date("Y");
            $lastyear = $currentyear - 15;
            for ($monthloop = 1; $monthloop <= 12; $monthloop++) {
                $monthName = date("F", mktime(0, 0, 0, $monthloop, 10));

                $stringop .= " <option value=" . $monthloop . ">" . $monthName . "</option>";
            }

            echo $stringop;
        }


    }


    function plural( $amount, $singular = '', $plural = 's' ) {
        if ( $amount == 1 )
            return $singular;
        else
            return $plural;
    }



function rand_string( $length ) {

    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    return substr(str_shuffle($chars),0,$length);

}



 function numberTowords($num)
            { 
            $ones = array( 
            1 => "one", 
            2 => "two", 
            3 => "three", 
            4 => "four", 
            5 => "five", 
            6 => "six", 
            7 => "seven", 
            8 => "eight", 
            9 => "nine", 
            10 => "ten", 
            11 => "eleven", 
            12 => "twelve", 
            13 => "thirteen", 
            14 => "fourteen", 
            15 => "fifteen", 
            16 => "sixteen", 
            17 => "seventeen", 
            18 => "eighteen", 
            19 => "nineteen" 
            ); 
            $tens = array( 
            1 => "ten",
            2 => "twenty", 
            3 => "thirty", 
            4 => "forty", 
            5 => "fifty", 
            6 => "sixty", 
            7 => "seventy", 
            8 => "eighty", 
            9 => "ninety" 
            ); 
            $hundreds = array( 
            "hundred", 
            "thousand", 
            "million", 
            "billion", 
            "trillion", 
            "quadrillion" 
            ); //limit t quadrillion 
            $num = number_format($num,2,".",","); 
            $num_arr = explode(".",$num); 
            $wholenum = $num_arr[0]; 
            $decnum = $num_arr[1]; 
            $whole_arr = array_reverse(explode(",",$wholenum)); 
            krsort($whole_arr); 
            $rettxt = ""; 
            foreach($whole_arr as $key => $i){ 
            if($i < 20){ 
            $rettxt .= $ones[$i]; 
            }elseif($i < 100){ 
            $rettxt .= $tens[substr($i,0,1)]; 
            $rettxt .= " ".$ones[substr($i,1,1)]; 
            }else{ 
            $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
            $rettxt .= " ".$tens[substr($i,1,1)]; 
            $rettxt .= " ".$ones[substr($i,2,1)]; 
            } 
            if($key > 0){ 
            $rettxt .= " ".$hundreds[$key]." "; 
            } 
            } 
            if($decnum > 0){ 
            $rettxt .= " and "; 
            if($decnum < 20){ 
            $rettxt .= $ones[$decnum]; 
            }elseif($decnum < 100){ 
            $rettxt .= $tens[substr($decnum,0,1)]; 
            $rettxt .= " ".$ones[substr($decnum,1,1)]; 
            } 
            } 
            return $rettxt; 
            
            } 

            // extract($_POST);
            // if(isset($convert))
            // {
            // echo "<p align='center' style='color:blue'>".numberTowords("$num")."</p>";
            // }




function getPrevUrl()
{
    $LastUrl = basename($_SERVER['HTTP_REFERER']);
    $LastUrlName = explode('?',$LastUrl);
    return $LastUrlName[0];
}




function getStatusType($typeid)
 {
     $key = -1;
     $arr = array("New" => "1" , "Active" => "2", "InActive" => "3","Pending" => "4" );

    $key = array_search($typeid, $arr);

    if($key == -1)
    {
      $key = "--"; 
    }
  
  return $key;

}




}                                     //  end of class

?>