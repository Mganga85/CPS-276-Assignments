<html><title>Separation of Concerns</title> 
 
    <form action="main.php" method="post"> 
      
        <table border='0' cellspacing='0' cellpadding='0'> 
            <tr> 
                <td><input type="submit" name="search" value="Search" /></td> 
                
                <td width="3" /> 
                <td><input type="text" value="<?= stripslashes($name)?>" name="name" placeholder="Name is Like" size="40"></td> 
            </tr> 
        </table> 
    </form> 
    <?php if (!is_null($data)) { ?> 
        <table border='1' cellspacing='0' cellpadding='3'> 
            <tr> 
                <th>Player1</th> 
                <th>Player2</th> 
                <th /> 
                <th /> 
                <th /> 
            </tr> 
            <?php foreach ($data as $dat) { ?> 
                <tr> 
                    
                    <td><?=$dat['player1']?></td> 
                    <td><?=$dat['player2']?></td> 
                    <td><a href="main.php?deleteid= <?=$dat["id"]?>" onclick="return confirm('Really delete?');"><font size = "2">Delete</font></a></td> 
                    <td><a href="main.php?viewid=<?=$dat["id"]?>"><font size = "2">View Details</font></a></td> 
                    <td><a href="main.php?editid=<?=$dat["id"]?>"><font size = "2">Edit</font></a></td> 
               </tr> 
            <?php  }?> 
        </table>     
    <?php }?> 
</html>
