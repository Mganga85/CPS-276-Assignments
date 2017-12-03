<html><title></title> 
    <form action="main.php" method="post"> 
        <input type="hidden" name="playerID" value="<?=$editid?>"> 
        
        <input type="submit" name="back" value="Go Back" />&nbsp;<input type="submit" name="save" value="Save" /> 
        <table border = "0" cellspacing = "1" cellpadding = "4"> 
            <tr> 
                <td bgcolor = "#dedede" valign="top"><font color = "blue">Player1</font></td> 
                <td bgcolor = "#dedede"  valign="top"><input type="text" value="<?=$rec['player1']?>" name="player1" maxlength=32 size=50/></td> 
            </tr> 
            <tr> 
                <td bgcolor = "#dedede" valign="top"><font color = "blue">Player2</font></td> 
                <td bgcolor = "#dedede"  valign="top"><input type="text" value="<?=$rec['player2']?>" name="player2" maxlength=32 size=50/></td> 
            </tr> 
        </table> 
    </form> 
</html>     