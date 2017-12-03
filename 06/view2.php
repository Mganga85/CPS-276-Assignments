<html><title></title> 
    <form action="main.php" method="post"> 

        <input type="submit" name="back" value="Go Back" /> 
    </form> 
    <table border = "0" cellspacing = "1" cellpadding = "4"> 
        <tr> 
            <td bgcolor = "#dedede" valign="top"><font color = "blue">Player1</font></td> 
            <td bgcolor = "#dedede"  valign="top"><?=$rec['player1']?></td> 
        </tr> 
        <tr> 
            <td bgcolor = "#dedede" valign="top"><font color = "blue">Player2</font></td> 
            <td bgcolor = "#dedede"  valign="top"><?=$rec['player2']?></td> 
        </tr> 
    </table> 
</html>     