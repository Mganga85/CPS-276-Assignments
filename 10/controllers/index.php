<?php
    date_default_timezone_set("America/New_York");

if (!isset($_POST["name"])) {
    $name = "";
    echo"";
    echo " ";
    echo"Please Enter username before entering";
} else if (isset($_POST["name"]) && login($_POST["name"]) > 0) {

    session_start();
    $_SESSION["IE"] = 0;
    $_SESSION["SN"] = 0;
    $_SESSION["FT"] = 0;
    $_SESSION["JP"] = 0;
    $name = $_POST["name"];
    $_SESSION["name"] = $name;
    $_SESSION["j"] = 0;
   
    $_SESSION["startTime"] = date("Y-m-d H:i:s");


    echo "Logged in!";
} else {
    $name = "";
    $_SESSION["j"] = 0;
    echo "username cannot be blank";
}

function login($namePass) {
    $length = strlen($namePass);
    return $length;
}
?>


<html>
    <form action="index.php" method="POST">
        <table border="0" cellpadding="3" cellspacing="0">
            <tr>
                <td>User Name</td>
                <td width=3" />
                <td><input type="text" name="name" value="<?= $name ?>"/></td>
            </tr>

            <tr>
                <td colspan="3"><input type="submit" value="LOGIN" name="submit"></td>
            </tr>


            <tr><td><a href = "../views/test.php"><?php
if (!isset($_SESSION["name"])) {
    echo "";
} else {
    echo "Click Here to enter Test";
}
?></a><td</tr>
        </table>
        <br>
        </html>