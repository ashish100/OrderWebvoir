<?php

function lang($phrase)
{
	
static $lang = array(
 	'OPPORTUNITY' => 'Opportunity', 
 	 'ERROR1' => 'Error',
 	 'JOBINFO' =>'Job',
 	  'DOINVOICE' => 'Delivery Note',
 	  'PL' => 'P & L' );

 	 return $lang[$phrase];

}


?>