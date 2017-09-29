
<pre>
    <?php
// Matthew Ganga
// CPS 276
// Cost of Living Calculator Homework #2
// 

    include'array.php';
    $currentWages = null;
    $incomeA = null;
    $incomeB = null;
    $wages_b = null;
    $wages = null;
    $stateA = null;
    $stateB = null;


// will check to see if wages value is null 
    if (!empty($_POST['wages'])) {
        ($currentWages = returnData($_POST['wages']));
    } else {
        $currentWages = "Wages Required";
    }


//checks if items are set, and then assigns variables to locations. 
// this block also assigns incomes to proper state selected.
    if (isset($_POST['locationA']) && $_POST['locationB']) {
        $stateA = returnData($_POST['locationA']);
        $cashIndexA = $locations_array[$stateA];
        $stateB = returnData($_POST['locationB']);
        $cashIndexB = $locations_array[$stateB];
    }

// will return data from
    function returnData($data) {
        return $data;
    }
    ?>
</pre>

<html>
    <head>
        <title>Cost of Living Calculator</title>
        <style>
            table,th,td{
                border:5px solid black;
                border-collapse:collapse;
                margin:auto;
            }
        </style>
    <h1  style = "text-align: center; color:white">Compare the cost of living between locations</h1>
</head>
<body style ="background-color:darkred">

    <form method = "POST" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
        <table style = "background-color:white">
            <tr><th colspan = "3" style = "text-align:center">Cost of Living</th></tr>  
            <tr>
                <td>Location A:&nbsp;</td>
                <td>
                    <select name = "locationA" id =" locationA" >  
<?php
//this will loop to create drop down options. 
foreach ($locations_array as $stateInArray => $incomeA) {


    if ($stateInArray == $stateA) {
        $selected = "selected";
    } else {
        $selected = "";
    }
    echo "<option value='$stateInArray' $selected  >$stateInArray</option>";
}
?>  
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    Wages in Location  A: &nbsp; 
                </td>  
                <td> <input type ="text"  name = "wages" style ="color:red" value = " <?php echo ($currentWages); ?> " </td>

            <tr>
                <td>Location B:&nbsp;</td>
                <td>
                    <select name = "locationB" >  
<?php
foreach ($locations_array as $stateInArrayB => $incomeA) {
    if ($stateInArrayB == $stateB) {
        $selected = "selected";
    } else {
        $selected = "";
    }

    echo "<option value='$stateInArrayB' $selected  >$stateInArrayB</option>";
}
?>                      
                    </select>
                </td>
            </tr>
            <br>
            <br>
            <tr><td colspan = "3"  > 
                    <input  style  =" width:100px; margin-left:149px"  type ="submit" value ="Submit"  /></td></tr>
            </select>
        </table>
    </form>
    <h3 style = "color:white; text-align:center;">
<?php
//will calculate compared incomes and output to user
if ($stateA != "Please choose a state" && $stateB != "Please choose a state" && $currentWages != 0 ) {
   
    $wages_b = number_format((($currentWages / $cashIndexA) * $cashIndexB), 2);
   
    echo "Making " . "$".$currentWages.".00"." in " . $stateA . " is the same as making " . "$" . $wages_b . " in " . $stateB;
}

else
{
    echo "<h1 style = 'color:yellow; text-align:center'>*Please fill in required fields to continue*</h1>";
}

?>


    </h3>
</body>
</html>
