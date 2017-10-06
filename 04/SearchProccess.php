<?php

$dataArray;
$linkName = "Details";


if (!empty($_POST['firstDate']) && ($_POST['secondDate'])) {
    $date1 = $_REQUEST['firstDate'];
    $date2 = $_REQUEST['secondDate'];
} else {
    $date1 = "";
    $date2 = "";
}


$date2 = $_REQUEST['secondDate'];
$nameContains = $_REQUEST['nameContains'];

// converts from mm/dd/yyyy to yyyy-mm-dd to pull form dataBase
//by exploding, and putting it back together in the same format found in the DB. 
function convertDate1($d1) {
    date_default_timezone_set('America/New_York');
    $test_arr = explode('/', $d1);
    if (sizeof($test_arr) != 3) {
        return '';
    }
    if (!checkdate($test_arr[0], $test_arr[1], $test_arr[2])) {
        return '';
    }
    $t = mktime(12, 0, 0, $test_arr[0], $test_arr[1], $test_arr[2]);
    return date('Y-m-d', $t);
}


// converts to mm/dd/yyyy from yyyy-mm-dd
// use this to convert back for display in main results page
function convertDate2($d1) {
    date_default_timezone_set('America/New_York');
    $test_arr  = explode('-', $d1);
    if (sizeof($test_arr) != 3) {
        return '';
    }
    if (!checkdate($test_arr[1], $test_arr[2], $test_arr[0])) {
        return '';
    }    
    $t = mktime(12,0,0,$test_arr[1], $test_arr[2], $test_arr[0]);
    return date('m/d/Y',$t);
}

//sets dates to proper fromat to pass into statement. 
$date1 = convertDate1($date1);
$date2 = convertDate1($date2);

try {
    $db = new PDO('mysql:host=localhost;port=3306;dbname=mganga', 'mganga', 'jG8Aw3Zf66BW');
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "You have connected to the dataBase";
} catch (PDOException $e2) {
    echo ( $e2->getMessage());
    die();
}


//////////////creates a statement to be passed into the DB 
$query = $db->query("SELECT  player1,player2,MATCHdate,EVENT,moves,id "
        . "FROM matches WHERE (player1 LIKE '%$nameContains%' OR "
        . "player2 LIKE '%$nameContains%') AND matchdate >= '$date1' AND matchdate <= '$date2' LIMIT 25;");
/////////////


// start of html output
echo "<!DOCTYPE html>";
echo "<html>";
echo"<meta charset ='UTF-8'>";

echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo"<link rel='stylesheet' href='formStyle.css'>";
echo "<head>";

echo " <title>Database Output</title>";
echo"</head>  ";
echo" <body>";
echo"<table>"; //start of table outside of while loop
echo " <tr><th>Event</th><th>Player 1</th><th>Player 2</th><th>Match Date</th><th>Details</th></tr>";

//will print each piece of data in table locations until asocciative array is empty
while ($rows = $query->fetch(PDO::FETCH_ASSOC)) {

    $dataArray = $rows;
    
    $formattedDate = convertDate2($rows['MATCHdate']);
    
    $id = $dataArray['id'];

    echo"'<tr><td>";
    echo $dataArray["EVENT"];
    echo "</td><td>";
    echo $dataArray["player1"];
    echo "</td><td>";
    echo $dataArray["player2"];
    echo "</td><td>";
    echo $formattedDate;
    echo "</td><td>";
    echo "<a href = 'Details.php?id=$id'>";
    echo $linkName;
    echo"</a>";
    echo "</td></tr>";
}

//end of table outside of wile loop. 
echo"</table>";

echo "</body>";

echo "</html>";
?>
 