<?php
$webContent = file_get_contents("http://52.32.53.208/VendArray.php");
// decodes url
 $data = urldecode($webContent);
 $jString = json_encode($data); // covert decoded data to json String

//converts decoded URL to json String
 $dataArray = json_decode($data,true);
echo"<html>";
echo"<style>";
echo"table,th,td,tr{border:5px solid black; border-collapse:collapse; background-color:lightblue;  margin:auto; "
. ""
        . "text-align:center}";

echo"</style>";
echo"<body style ='background-color:grey'>";
echo "<table style = 'width:50%' height = 70%;>";
echo "<th style = 'color:red'><i>First</i></th><th  style = 'color:red'><i>Last</i></th>";

foreach($dataArray as $first => $name)
{
 

 echo"<br>";
 echo "<tr>";
 echo "<td>";
 echo $name["first"];
 echo "</td>";
  echo "<td>";
 echo $name["last"];
 echo "</td>";
 echo"</tr>";
}


echo "</table>";

echo"</body>";

echo "</html>";
