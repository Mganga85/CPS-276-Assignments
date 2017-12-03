<?php

session_start();

if (!isset($_SESSION["name"])) {
    header('Location:LoginIndex.php
', true);
    echo"";
    echo " ";
    echo"Please Enter username before entering";
}
?>

<?php

//will pull if variable set in hyperlink to this page from SearchProccess.php
if (!empty($_GET['id'])) {
    $idForRow = $_GET['id'];
} else {
    $idForRow = 0;
}


//will try to make connection to DataBase
try {
    $db = new PDO('mysql:host=localhost;port=3306;dbname=mganga', 'mganga', 'jG8Aw3Zf66BW');
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e2) {
    echo ( $e2->getMessage());
    die();
}


$query = $db->query("SELECT  player1,player2,MATCHdate,EVENT,moves,site,round,result,eco,opening FROM matches WHERE id=$idForRow;");

// converts to mm/dd/yyyy from yyyy-mm-dd
function convertDate2($d1) {
    date_default_timezone_set('America/New_York');
    $test_arr = explode('-', $d1);
    if (sizeof($test_arr) != 3) {
        return '';
    }
    if (!checkdate($test_arr[1], $test_arr[2], $test_arr[0])) {
        return '';
    }
    $t = mktime(12, 0, 0, $test_arr[1], $test_arr[2], $test_arr[0]);
    return date('m/d/Y', $t);
}

// displays winner or draw. 
function convertResult($dat) {
    if (!isset($dat['result'])) {
        return '';
    }
    if ($dat['result'] == '1') {
        return 'Player One';
    } elseif ($dat['result'] == '2') {
        return 'Player Two';
    } elseif ($dat['result'] == 'D') {
        return 'Draw';
    } else {
        return '';
    }
}

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
echo "<hr>";
echo"<h1>";
echo "Match Details";
echo"</h1>";
echo"<table>"; //start of table outside of while loop


while ($rows = $query->fetch(PDO::FETCH_ASSOC)) {
    $dateOfMatch = convertDate2($rows['MATCHdate']);
    $result = convertResult($rows);

//output rows for details table. 
    echo "<tr><th>";
    echo "Event Name";
    echo" </th><td>";
    echo $rows['EVENT'];
    echo "</td></tr>";
    echo "<tr><th>";
    echo "Event Site";
    echo" </th><td>";
    echo $rows['site'];
    echo "</td></tr>";
    echo "<tr><th>";
    echo "Date";
    echo" </th><td>";
    echo $dateOfMatch;
    echo "</td></tr>";
    echo "<tr><th>";
    echo "Round Number";
    echo" </th><td>";
    echo $rows['round'];
    echo "</td></tr>";
    echo "<tr><th>";
    echo "Player One";
    echo" </th><td>";
    echo $rows['player1'];
    echo "</td></tr>";
    echo "<tr><th>";
    echo "Player Two";
    echo" </th><td>";
    echo $rows['player2'];
    echo "</td></tr>";
    echo "<tr><th>";
    echo "Result";
    echo" </th><td>";
    echo $result;
    echo "</td></tr>";
    echo "<tr><th>";
    echo "Eco and Opening";
    echo" </th><td>";
    echo $rows['eco'] . ", " . $rows['opening'];
    echo "</td></tr>";
    echo "<tr><th style = 'text-align:center'>";
    echo "Moves";
    echo "<img src= ";
    echo "'chessPiece.jpg' alt='' border='3' height='65' width='57'";
    echo "/>";
    echo" </th><td>";
    echo $rows['moves'];
    echo "</td></tr>";
}
//end of table outside of while loop. 
echo"</table>";
echo"<hr>";
echo "</body>";
echo "</html>";



