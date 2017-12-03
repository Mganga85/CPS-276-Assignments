<?php
session_start();

if(!isset($_SESSION["name"]))
{
  header('Location:LoginIndex.php
', true);  
 echo"";
echo " ";
echo"Please Enter username before entering";
}


?>

<?php
// variables
    $matchArray ="";
    $provider = "";
    $lat ="";
    $log = "";
    $person = "";
    $city = "";
    $state = "";
    $zipCode = "";
    $numberOfProviders = 0;
    
  

   
     //grabs miles value after submition
if(isset($_POST['miles']))
{
    $miles = $_POST['miles'];
  
}else{
    $miles = "";
}

//if submit is pressed
if (isset($_POST['submit'])) {
    
    if (is_numeric($_REQUEST['zipcode'])) {
        $zip = $_REQUEST['zipcode'];
        
    } else {

        echo "<h1>";
        echo 'Input not Valid please go back and try again';
        echo "<h1>";
        die();
    }

    //if submit is not pressed 
} else {
    $zip = "";
}

//create connection to database
try {
    $db = new PDO('mysql:host=localhost;port=3306;dbname=mganga','mganga','jG8Aw3Zf66BW');
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e2) {
    echo ( "<h1 style = 'color:red'>" . "Error Connecting to the DataBase! Please check Password,UserName or DataBase Name" . "<h1>");
    die();
}

 


//////////////creates a statement to be passed into the DB 
$query = $db->query("SELECT * FROM a6_locations  WHERE zipcode ='$zip';");
/////////////

// start of html output for city,state,location, and range
echo "<!DOCTYPE html>";
echo "<html>";
echo"<meta charset ='UTF-8'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo"<link rel='stylesheet' href='MatchesStyle.css'>";
echo "<head>";
echo " <title>Database Output</title>";
echo"</head>";
echo" <body>";
echo"<h2>"."Location"."</h2>";

echo"<table>"; //start of table outside of while loop
echo " <tr><th>City</th><th>State</th><th>Zip Code</th><th>Members in Range</th></tr>";

// will populate table
while ($rows = $query->fetch(PDO::FETCH_ASSOC)) {
  
    $matchArray = $rows;
    $lat = $matchArray['latitude'];
    $log = $matchArray['longitude'];
    $person = $matchArray["location_name"];
    $city = $matchArray['location_name'];
    $state = $matchArray['state'];
    $zipCode = $matchArray['zipcode'];
}
if($matchArray == ""&& !empty($_POST['submit']))
    {
    echo "<h1 style = 'text-align:middle'>".'There are no providers in this location, Try a new Zip'."</h1>";
    }

echo"<tr><td>";
echo $person;
echo "</td><td>";
echo $state;
echo "</td><td>";
echo $zipCode;    
echo "</td><td>";
//// will be used to pull out number of providers could be simplified if method used. 
$query2 = $db->query("select p.provider_number,p.person_name,l.state,l.zipcode,l.location_name,l.zipcode,69*(sqrt(pow($lat-l.latitude,2) + pow($log-l.longitude,2))) AS distance " .
"FROM a6_people as p " .
"JOIN a6_locations as l ON p.locationID=l.locationID " .
"WHERE 69*(sqrt(pow($lat-l.latitude,2) + pow($log-l.longitude,2))) < '$miles' ORDER BY distance;");
/////////////

while ($providerCount = $query2->fetch(PDO::FETCH_ASSOC)) {
    
  $numberOfProviders++;
    
  
} 
echo $numberOfProviders;
echo "</td></tr>";
echo"</table>";//end of table outside of wile loop. 

echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";


// start of html output for city,state,location, and range
echo"<h2>"."Results"."</h2>";

echo"<table>"; //start of table outside of while loop
echo " <tr><th>Person</th><th>Provider Number</th><th>City</th><th>State</th><th>Zip</th><th>Distance (miles) </th></tr>";

//////////////creates 2nd statement to be passed into the DB 
$query = $db->query("select p.provider_number,p.person_name,l.state,l.zipcode,l.location_name,l.zipcode,69*(sqrt(pow($lat-l.latitude,2) + pow($log-l.longitude,2))) AS distance " .
"FROM a6_people as p " .
"JOIN a6_locations as l ON p.locationID=l.locationID " .
"WHERE 69*(sqrt(pow($lat-l.latitude,2) + pow($log-l.longitude,2))) < '$miles' ORDER BY distance;");
/////////////

while ($rows = $query->fetch(PDO::FETCH_ASSOC)) {
    
    
    $numberOfProviders++;//counts number of providers
    $matchArray = $rows;
    echo"<tr><td>";
    echo $matchArray['person_name'];
    echo "</td><td>";
    echo $matchArray['provider_number'];
    echo "</td><td>";
    echo $matchArray['location_name'];
    echo "</td><td>";
    echo $matchArray['state'];
    echo "</td><td>";
    echo $matchArray['zipcode'];
    echo"</td><td>";
    echo number_format($matchArray['distance'],2);
   echo "</td></tr>";
} 
//end of table outside of wile loop. 
echo"</table>";
echo "</body>";
echo "</html>";
echo "<br>";
echo "<br>";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Search for Lessons near you</title>
    </head>
    <body>
        <div class = "fixed">
        <form method = "post"  action = "ProviderSearch.php">
            <p>Zip Code</p><input type ="text" name ="zipcode" value ="<?PHP echo ($zip); ?>" 
                   placeholder = "Enter 5 digit Zip Code" minlength="5"  maxlength="5" required  ></input>
          <p>Range</p>  <input type ="number" name ="miles" value = "<?PHP echo $miles;?>"placeholder ="Range in miles"/>
            
            <br>
            <input type ="submit" name ="submit" value ="Search Providers"/>
        </form>
        </div>
    </body>
</html>
