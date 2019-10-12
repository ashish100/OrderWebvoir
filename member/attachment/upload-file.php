<?php
$storeFolder = '/memberpics/';
$ds = '';
if (isset($_POST["filepath"]))
{
	//echo " i am  ". $_POST["filepath"];

	//exit();

		$storeFolder = $_POST["filepath"];
		$filepath = realpath(__DIR__ . '/..');
		$targetPath =realpath(__DIR__ . '/..'). $ds. $storeFolder . $ds;  //4

}
   //2

if (!empty($_FILES)) 
{


	$filename = $_FILES["file"]["name"];
	$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
	$file_ext = substr($filename, strripos($filename, '.')); // get file name
	$filesize = $_FILES["file"]["size"];
	$notallowed_file_types = array('.js','.php','.asp');	


	if (in_array($file_ext,$notallowed_file_types))
	{	
	
	}else
	{
		// Rename file
		//$newfilename = md5($file_basename) . $file_ext;

		$tempFile = $_FILES['file']['tmp_name'];          //3             
if (empty($targetPath )){
		$targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds; 
		} //4

		$fileName = round(microtime(true))."_".$_FILES['file']['name'];
		$targetFile =  $targetPath.$fileName;  //5

		move_uploaded_file($tempFile,$targetFile); //6
		echo   $fileName ;
	}

}

?>  
