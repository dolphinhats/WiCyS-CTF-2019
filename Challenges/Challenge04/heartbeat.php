<?php

require_once "memory.php";

if(isset($_POST["word"]) && isset($_POST["length"]) && is_numeric($_POST["length"])){
	$word=$_POST["word"];
	$len=$_POST["length"];
	$actual_len=strlen($word);
	$mem_content=generate_mem();
	$len_mem_content=strlen($mem_content);
	$word_split=str_split($word);
	
	//write memory
	for ($i=0; $i<$actual_len; $i++){
		$mem_content[$i]=$word[$i];
	}
	
	// echo $mem_content;
	//read memory using user input length
	$return_str="";
	if($len > $len_mem_content){$len=$len_mem_content;}
	for ($i=0; $i<$len; $i++){
		$return_str=$return_str.$mem_content[$i];
		
	}
	echo $return_str;
}

// echo generate_mem();

?>

