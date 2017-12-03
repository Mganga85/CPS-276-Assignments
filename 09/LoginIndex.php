<?php
if (!isset($_POST["name"])) {
    $name = "";
    echo"";
     echo " ";
    echo"Please Enter username before entering";
} else if (isset($_POST["name"]) && login($_POST["name"]) > 0) {

    session_start();
date_default_timezone_set("America/New_York");
    $name = $_POST["name"];
    $_Session["time"]  = "  Login Date and Time: ".date("Y-m-d @ h:i:s");
    $_SESSION["name"] = $name;
    echo "Logged in!";


    $name = ($_SESSION["name"]);
    $file = fopen("./Session_data.txt", "w") or die("Unable to open file!");
    chmod("Session_data.txt", 0777);
    
    
    fwrite($file, "User Name = ".$name.";");
    fwrite($file, $_Session["time"]);
    fclose($file);
} else {
    $name = "";
    echo "username cannot be blank";
}

function login($namePass) {
    $length = strlen($namePass);
    return $length;
}
?>


<html>
    <form action="LoginIndex.php" method="POST">
        <table border="0" cellpadding="3" cellspacing="0">
            <tr>
                <td>User Name</td>
                <td width=3" />
                <td><input type="text" name="name" value="<?= $name ?>"/></td>
            </tr>

            <tr>
                <td colspan="3"><input type="submit" value="LOGIN" name="submit"></td>
            </tr>

            <tr><td><a href = "Search.php">Search Database<a></td></tr>
                            <tr><td><a href = "Search.php">Search Process<a></td></tr>
                                            <tr><td><a href = "Search.php">Search Database<a></td></tr>

                                                            <tr><td</tr>
                                                            </table>
                                                            <br>

                                                            </form>






