<?php
if(isset($_GET['id'])){
	if(!is_numeric($_GET['id'])){die("Invalid id!");}
	$found=false;
	$id=$_GET['id'];
	
	if(!$fileString=file_get_contents('./files.config')){
	die("could not read files.txt");
	}
	$fileArray=explode('|',$fileString);
	
	foreach ($fileArray as $file){
		
		$thisFile=explode(',',$file);
		if($thisFile[0]===$id){
			$found=true;
			//send file
			$filename = "./files/".$thisFile[1];
			if(!$handle=fopen($filename,'r')){die("File Not Found!");}
			$contents=fread($handle,filesize($filename));
			fclose($handle);
			
			$mime=mime_content_type($filename);
			header('Content-Type:'.$mime);
			header('Content-Disposition: attachment; filename="'.$thisFile[1].'"');
			echo $contents;
			
		}
	
	}
	if(!$found) echo "No file specified or file does not exist!";
	
}
else{
	echo "No file specified or file does not exist!";
}
?>