

<?php

session_start();
include_once '../models/generateQuestions.php'; 
?>


<html>
    <head>
        <title>Score Results</title>
    </head>
    
    <body>
        <h1>Thank you for taking the test!</h1>
        <br>
        <br>
        <h2>Based on your answers,here are your results:</h2>
        
        <h3>Your personality type is: &nbsp;<a href = "http://en.wikipedia.org/wiki/<?=$_SESSION["result"]?>"><?=$_SESSION["result"]?></a></h3>
        <br>
        <br>
        <br>
        <h3>
            <?php session_destroy();?>
            <form action = "../controllers/index.php"/>
                <input type = "submit" name ="restart" value ="Take quiz again"/>
            </form>
        
        
        
    </body>
</html>
