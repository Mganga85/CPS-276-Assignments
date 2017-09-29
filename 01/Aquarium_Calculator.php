<?php
///  Author:  Matthew Ganga 
///   Class:  CPS 276
///     Sec:  01   
///  day(s):  Saturdays
//  Homewor:  #01  Aquarium Calculator


// global Variables
$width = null;      $height = null;      $depth = null;
$waterVolume = 0;   $surfaceArea = 0;    $glassCost = 0;
$waterCost = 0;     $totalCost = 0;
$glassPrice = 0.03;  $waterPrice = 0.001;
$widthError = "";   $heightError = "";   $depthError = "";

// this block will handle if blank width field occurs
// it will not post unless field is filled in. 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["width"])) {
        $widthError = "width is required";
    } else {
        $width = return_data($_POST["width"]);
    }
}

// this block will handle if blank height field occurs
// it will not post unless field is filled in. 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["height"])) {
        $heightError = "Height is required";
    } else {
        $height = return_data($_POST["height"]);
    }
}

// this block will handle if blank height field occurs, 
// it will not post unless field is filled in.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["depth"])) {
        $depthError = "Depth is required";
    } else {
        $depth = return_data($_POST["depth"]);
    }
}

// will return posted data 
function return_data($data) {
    return $data;
}

//calculations
$surfaceArea = (($width * $height) * 2) + (($width * $depth) * 2) + (($height * $depth) * 2);
$glassCost = $surfaceArea * $glassPrice;
$waterVolume = $width * $height * $depth;
$waterCost = $waterVolume * $waterPrice;
$totalCost = $glassCost + $waterCost;
?> 

<!--Start of HTML-->
<html>
    <title>Aquarium Cost Calculator</title> 
    <head>
        <style>
            .error {color: #FF0000;} 
        </style>
    </head>

    <body style = "background-color:lightgrey">
        <h1 style = "color:blue" font-color = "blue" align ="center" >Looking for a new aquarium?</h1>
        <h2 style = "color:red" font-color = "blue" align = "center">Enter your 
            desired dimensions (inches) for an estimate</h2>

        <form style = "margin-top:50px;"action="Aquarium_Calculator.php"  method="POST" align = "center" >

            <p><span class="error">* required fields.</span></p>  
            Width: 
            <input type="text" name="width" value="<? echo($width); ?>"size = 30 maxlength=10 placeholder = "width"/> 
            <span class="error">* <?php echo $widthError; ?></span>
            
            <br/> <br/>
            
            Height:
            <input type="text" name="height" value="<? echo($height); ?>" size = 30 maxlength=10 placeholder = "height"/> 
            <span class="error">* <?php echo $heightError; ?></span>

            <br/> <br/>

            Depth:
            <input type="text" name="depth" value="<? echo($depth); ?>" size = 30 maxlength=10 placeholder = "depth"/> 
            <span class="error">* <?php echo $depthError; ?></span>

            <br/>
            <br/>
            <input  type="submit" name="button" value="Calculate"/>&nbsp;
            <hr size ="5"  color =" blue" /> 

            <!--Displays Output of dimensions-->
            <h3 align="left">Your tank will be:&nbsp;<?php echo $surfaceArea . "  in<sup>2</sup>" ?></h3>
            <h3 align="left">Amount of water to fill:&nbsp;<?php echo $waterVolume . " in<sup>3</sup>" ?></h3>

            <!--Displays Output of costs-->
            <h3 align="left">Cost of glass:&nbsp;<?php echo "$" . $glassCost ?></h3>
            <h3 align="left">Cost of water:&nbsp;<?php echo "$" . $waterCost ?></h3>

            <!--Displays total cost-->
            <h3 align="left" style  = "color:red">Your total is:&nbsp;<?php echo "$" . round($totalCost, 2); ?></h3>
            <br/>
            <hr size ="5" color ="blue" /> 

        </form>
    </body>

</html>