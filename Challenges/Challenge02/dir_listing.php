<?php
$x=print_r(scandir('.'),true);
echo "<div style='display:none'>";
echo "DEBUG<br/>";
echo preg_replace("/\r|\n/","<br/>",$x);
echo "</div>";
// var_dump(file_get_contents('./flag2.txt', FILE_USE_INCLUDE_PATH));
?>