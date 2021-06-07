<?php

$pattern = "ab`><chi12345jklqrsEFGHIJtuv78wxyz69@0ABCDdefgKLMNOPQRSTUVWXYZ!#mnop%^&*?~";

$length = strlen($pattern)-1;

$i;
$password=[];
for($i=0;$i<8;$i++){
	$indexing_number = rand(0,$length);
	$password[] = $pattern[$indexing_number];
}

echo implode($password);
?>