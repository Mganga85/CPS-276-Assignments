<?php
session_start();

include_once '../models/generateQuestions.php'; 

if(!isset($_SESSION["name"]))
{
  header('Location:../controllers/index.php
', true);  
 echo"";
echo " ";
echo"Please Enter username before entering";
}
if($_SESSION["j"] <=0)
{
    include_once '../models/generateQuestions.php'; 
}
if (isset($_SESSION)) {
    
if($_SESSION["j"]<23)
{  $_SESSION["j"]+=1; } //increment to step through shuffle arrays and stored in session to pull questions. 
else{$_SESSION["j"] = 0;  



header('Location:testCompleted.php', true);

}    
    if (!isset($_SESSION["name"])) {
        header('Location:index.php
', true);
    }
    
    if(isset($_POST["answer"]))
    {
      $_SESSION["answer"] = $_POST["answer"] ;
       
    }
        
}
?>

<html>
    <header> 
    
    </header>   
    <body>
        <title>Personality Assessment</title>  
        
        <h1>Welcome to your personalty assessment <?php print_r($_SESSION['name']);?></h1>
        <br>
        <br>
        <h3>Take your time and answer the questions truthfully for best results:</h3>
       <!--include the generate questions file here -->
       
       <form type =" submit" method ="POST" action ="test.php">
       
           <table>
               <tr><td><?php echo "question &nbsp;#".$_SESSION["j"]."<br>".$_SESSION["questionArray"][$_SESSION["j"]];?></td></tr>
               <tr><td><?=$_SESSION["answerAArray"][$_SESSION["j"]]?></td><td><input style = "float:right;"type ="radio" name ="answer" value="a" required /></td></tr>
               <tr><td><?=$_SESSION["answerBArray"][$_SESSION["j"]]?></td><td><input style = "float:right;" type ="radio" name ="answer" value ="b" required/></td></tr>
                 <?php
       if($_SESSION["j"]<23)
       {
       echo "<tr><td><input type ='submit' name ='submit' value ='next'/></td></tr>";
       
       }else 
       {
           echo "<tr><td><input type ='submit' name ='submit' value ='Submit Test'/></td></tr>";
       }
       
        ?>
                          
           </table>

       </form>
     
     </body>
        
        
  
    
    
   
</html>

