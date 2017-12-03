<?php
session_start();
?>
<?php
if (isset($_SESSION)) {

    if (!isset($_SESSION["name"])) {
        header('Location:LoginIndex.php
', true);
    }
}
?>
<?php
if (!isset($_SESSION["name"])) {
    header('Location:LoginIndex.php
', true);
    echo"";
    echo " ";
    echo"Please Enter username before entering";
}
?>
<!DOCTYPE html>
<html>
    <head>

        <title>Search DB</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="formStyle.css">

    </head>
    <body>

        <form  method = "POST" action = "SearchProccess.php">
            <label></label>
            <input type ="text" name ="firstDate"  id = "firstDate" placeholder ="mm/dd/YYYY" required/> 
            <input type ="text" name ="secondDate"  id = "secondDate" placeholder ="mm/dd/YYYY" required/>
            <input type ="text" name ="nameContains" id ="nameContains" placeholder ="Name Contains" required/>
            <input type ="submit" name ="submit" id ="submit" value ="SEARCH"/>
        </form>

    </body>
</html>
