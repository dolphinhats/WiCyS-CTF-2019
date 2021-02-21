<?php
function decode_cookie($v){
	$r=base_convert($v,3,10);
	return $r;
}

function encode_cookie($v){
	
	return base_convert($v,10,3);
}


?>