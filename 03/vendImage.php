<?php

$data = file_get_contents("vendImage.jpg"); 


$base64Str = base64_encode($data);
echo $base64Str;



