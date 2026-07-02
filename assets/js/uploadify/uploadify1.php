<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';
        

$dh=opendir($targetPath);$c=0;
while (false!==($mfile=readdir($dh)))
{
	$f_mfile=$targetPath."/".$mfile;
	@unlink($f_mfile);
	
}


/*
Uploadify v2.1.4
Release Date: November 8, 2010

Copyright (c) 2010 Ronnie Garcia, Travis Nickels

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/

	
$File1_name=	$_FILES['Filedata']['name'];

$ctype= substr($File1_name,-4,1);print "<<<<<<<< $ctype >>>>>>>>>>>>>>>>>>";
		if ($ctype==".")	{	$type= substr($File1_name,-3);	$type=strtolower($type);$sname=substr($File1_name,0,strlen($File1_name)-4);}
	else{$ctype= substr($File1_name,-5,1);
		if ($ctype=="."){	$type= substr($File1_name,-4);	$type=strtolower($type);
		$sname=substr($File1_name,0,strlen($File1_name)-5);}
	}
$targetFilex =$targetFile = date('U')."_".rand(0,1000)."_$uid".".$type";

//$targetFile = $_FILES['Filedata']['name'];
$targetFile =  str_replace('//','/',$targetPath) . $targetFile;
$f=str_replace($root,"",$_REQUEST['folder']);

$w=$f."/".$targetFilex;
$x='/'.$namerootfolder.'/';
$w=str_replace($x,'',$w);
$f=str_replace($x,'',$f);

	
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
$targetFile =  str_replace('//','/',$targetPath) . $targetFile;

$filename = 'test.txt';
if (is_writable($filename)) {
echo 'The file is writable';
} else {
echo 'The file is not writable';
}
?> 