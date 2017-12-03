<?php
if(!isset($_SESSION))
{
    session_start();
  
}



date_default_timezone_set("America/New_York");
$IE=0;
$SN=0;
$FT=0;
$JP=0;
 
 
// this php  file will access the database and create test variables
$questionArray = array();
$answerAArray = array();
$answerBArray = array();
$IE_Possible_array = array();
$SNPossible_array = array();
$FT_Possible_array = array();
$JP_Possible_array = array();
$usedIndexArray = array();




     


try {
    $db = new PDO('mysql:host=localhost;port=3306;dbname=mganga', 'mganga', 'jG8Aw3Zf66BW');
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
} catch (PDOException $e2) {
    echo ( $e2->getMessage());
    die();
}


//now we will pull the random question to ask and  display in our view
$query = $db->query("select * from a9_questions");

//send data to our database 
$name = $_SESSION["name"];
$startTime = $_SESSION['startTime'];
$resultValues = "IE= $IE "."SN= $SN "."FT= $FT "."JP= $JP";



$result = ""; 
?>
<?php
$_SESSION["arrayIndex"]=0;
    




 
  while ($rows = $query->fetch(PDO::FETCH_ASSOC)) {

     $question = $rows['question'];
     $answerA = $rows['answer_a'];
     $answerB = $rows['answer_b'];
     $IE_Possible = $rows["IE"];// will allow us to determine points for each correct answer
     $SN_Possible = $rows["SN"];
     $FT_Possible = $rows["FT"];
     $JP_Possible = $rows["JP"];
     
     //store question and answers into array in sessions
     $questionArray[] = $question; //Stored questions/answers in order
     $answerAArray[]  = $answerA;
     $answerBArray[]  = $answerB;
     
     $IE_Possible_array[$_SESSION["arrayIndex"]] =$IE_Possible;//storing score values into arrays
     $SN_Possible_array[$_SESSION["arrayIndex"]] =$SN_Possible;
     $FT_Possible_array[$_SESSION["arrayIndex"]] =$FT_Possible;
     $JP_Possible_array[$_SESSION["arrayIndex"]] =$JP_Possible;
    

     
     $_SESSION["arrayIndex"]++;
     
  }  
 

///after array is shuffled we will increment $j in test when next is pressed to pull out new question from 
//$_SESSION
$_SESSION["questionArray"] = $questionArray;//now there is a randomly shuffled array to be 
//pulled from in our test page. 
$_SESSION["answerAArray"] = $answerAArray;
$_SESSION["answerBArray"] = $answerBArray;
date_default_timezone_set("America/New_York");

   



//find out what answer was stored in session a or b.
if(isset($_SESSION["answer"]))
{
   $answer = $_SESSION["answer"];
   
   if($answer=='a')
   {
       
$IE= $_SESSION["IE"] += $IE_Possible_array[$_SESSION["j"]];
$SN= $_SESSION["SN"] += $SN_Possible_array[$_SESSION["j"]];
$FT= $_SESSION["FT"] += $FT_Possible_array[$_SESSION["j"]];
$JP= $_SESSION["JP"] += $JP_Possible_array[$_SESSION["j"]];

    
  
    
       
   }if($answer=="b") 
   {
          // we will need to take our points and subtract them up when the wrong answer "b" is answered. 
       
$IE= $_SESSION["IE"] -= $IE_Possible_array[$_SESSION["j"]];
$SN= $_SESSION["SN"] -= $SN_Possible_array[$_SESSION["j"]];
$FT= $_SESSION["FT"] -= $FT_Possible_array[$_SESSION["j"]];
$JP= $_SESSION["JP"] -= $JP_Possible_array[$_SESSION["j"]];
   }
 


}
  
$resultValues = "IE= $IE "."SN= $SN "."FT= $FT "."JP= $JP";
  if($_SESSION["j"]==23)
      
  {// now we will determine the personality type based on score. 
      $endTime= date("Y-m-d H:i:s");
   if($IE<0)
{
    $result.="I"; 
    
}if($IE>=0)
{
    $result.="E";
}

if($SN<0)
{
    $result.="S"; 
    
} if($SN>=0)
{
    $result.="N";
}

if($FT<0)
{
    $result.="F"; 
    
}if($FT>=0)
{
    $result.="T";
}


if($JP<0)
{
    $result.="J"; 
    
}if($JP>=0)
{
    $result.="P";
}
$_SESSION["result"] = $result;


$query2 = $db->query("insert into a9_tests(name,started_at,finished_at,results,result_type) values('$name','$startTime','$endTime','$resultValues','$result')");
$db = null;

  }
  





