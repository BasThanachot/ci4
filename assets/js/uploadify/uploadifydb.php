<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$loc="../../";
//include($loc."../MisCode/c084.php");
include_once ($loc.'../MisCode/c084.php');
include_once ($loc.'system/a_function.php');
include_once ($loc.'system/db_function.php');
include_once ($loc.'system/dfunction.php');
include_once ($loc.'system/web_constant.php');



if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';
	
$File1_name=	$_FILES['Filedata']['name'];

$ctype= substr($File1_name,-4,1);//print "<<<<<<<< $ctype >>>>>>>>>>>>>>>>>>";
		if ($ctype==".")	{	$type= substr($File1_name,-3);	$type=strtolower($type);$sname=substr($File1_name,0,strlen($File1_name)-4);}
	else{$ctype= substr($File1_name,-5,1);
		if ($ctype=="."){	$type= substr($File1_name,-4);	$type=strtolower($type);
		$sname=substr($File1_name,0,strlen($File1_name)-5);}
	}
$rnd100=rand(100, 999);
$targetFilex = date("U")."_x_".$rnd100."_".$_SESSION[uid].".$type";
//$targetFile = $_FILES['Filedata']['name'];
$targetFile =  str_replace('//','/',$targetPath) . $targetFilex;

$f=str_replace($root,"",$_REQUEST['folder']);
$w=$f."/".$targetFilex;
$w=str_replace('/store/','store/',$w);
$f=str_replace('/store/','store/',$f);
	$sql="
	INSERT INTO `$mdb`.`web_file_info` (`locate` ,`name`  ,`owner`,`remark1`,`remark2` ,`update`)
	VALUES (  '$w','$sname',  '$uHRid', '$type', '$f','$today');";
	$notic= $sql."<hr>$notic";
		if($db_conn1->query($sql))print " Insert Complete"; else print " Error DB";
                print $notic;

	
	// $fileTypes  = str_replace('*.','',$_REQUEST['fileext']);
	// $fileTypes  = str_replace(';','|',$fileTypes);
	// $typesArray = split('\|',$fileTypes);
	// $fileParts  = pathinfo($_FILES['Filedata']['name']);
	
	// if (in_array($fileParts['extension'],$typesArray)) {
		// Uncomment the following line if you want to make the directory if it doesn't exist
		// mkdir(str_replace('//','/',$targetPath), 0755, true);
		
		move_uploaded_file($tempFile,$targetFile);
		echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
		
	// } else {
	// 	echo 'Invalid file type.';
	// }
}
		//if($db_conn1->query($sql))print " Insert Complete"; else print " Error DB";                print $notic;
?> 
