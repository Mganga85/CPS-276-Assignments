<?php

//sets $url to location of data
$url = "http://52.32.53.208/VendImage.php";

// sets $webContent to base 64 contents of file from url
$webContent = file_get_contents($url);

// Display base64 text as an image on a web page
echo '<img src="data:image/jpeg;base64,' . $webContent  .'"/>';




