
<!--In this class we will construct the objects according to user input and store them into an arrayed-->
<?php
include_once 'Performer.php';




$i = 0;
$tp = 0;
$tt = 0;
$tr = 0;
$index = 0;
$rate = 0;
$insurable = "";
$tcp = 0;





if (isset($_POST['submit'])) {
    $Circus = new Circus();
    if (isset($_POST['juggler'])) {

        $jugglers = $_REQUEST['juggler'];
        if ($jugglers != 0) {
            $Circus->createObjects(new Juggler(), $jugglers);
        }
    } else {
        $jugglers = 0;
    }


    if (isset($_POST['clown'])) {
        $clowns = $_POST['clown'];

        if ($clowns != 0) {
            $Circus->createObjects(new Clown(), $clowns); //passing in  the number of clowns to create
        }
    } else {
        $clowns = 0;
    }





    if (isset($_POST['lionTamer'])) {
        $lionTamers = $_REQUEST['lionTamer'];
        if ($lionTamers != 0) {
            $Circus->createObjects(new LionTamer(), $lionTamers);
        }
    } else {
        $lionTamers = 0;
    }


    if (isset($_POST['mime'])) {
        $mimes = $_REQUEST['mime'];
        if ($mimes != 0) {
            $Circus->createObjects(new Mime(), $mimes);
        }
    } else {
        $mimes = 0;
    }


    if (isset($_POST['cannonball'])) {
        $cannonBalls = $_REQUEST['cannonball'];
        if ($cannonBalls != 0) {
            $Circus->createObjects(new CannonBall(), $cannonBalls);
        }
    } else {
        $cannonBalls = 0;
    }


    if (isset($_POST['trapeze'])) {
        $trapeze = $_REQUEST["trapeze"];
        if ($trapeze != 0) {
            $Circus->createObjects(new TrapezeArtist(), $trapeze);
        }
    } else {
        $trapeze = 0;
    }
}

Class Circus {
    
        

    
   
    

    private static $myInstance = null;

    function createObjects($obj, $howmany) {
        $i = 0;
        $totalMimes = 0;
        $totalClowns = 0;
        $totalJugglers = 0;
        $totalLionTamers = 0;
        $totalTrapeze = 0;
        $totalCannonBalls = 0;
       

        global $tcp;
        $tcp+=$howmany;
        
        
        $classname = get_class($obj);
        $this->FiftyPercent($classname, $howmany);

       
        if ($classname == 'Juggler') {
            $totalJugglers = $howmany;
           
        }
        if ($classname == 'Clown') {
            $totalClowns = $howmany;
        } elseif ($classname == 'LionTamer') {
            $totalLionTamers = $howmany;
        } elseif ($classname == 'TrapezeArtist') {
            $totalTrapeze = $howmany;
        } elseif ($classname == 'Mime') {
            $totalMimes = $howmany;
        } elseif ($classname == 'CannonBall') {
            $totalCannonBalls = $howmany;
        }
      
        


  
        While ($i < $howmany) {
            $i++;
            global $performerArray;
            $performerArray[] = $obj;
            
        }
        
 
        global $tt;
        $terror = $obj->getTerror();
        $tt += $terror * $howmany;

        global $tr;
        $risk = $obj->getRisk();
        $tr += $risk * $howmany;

        global $tp;
        $profit = $obj->getProfit();
        $tp += $profit * $howmany;

        
        
        
       
        $this->Rules($tcp, $tp, $tr, $tt);
       
        
    }
 
     public function FiftyPercent($ClassName,$classTypeCount)
    {
        
        global $tcp;
        
       if($classTypeCount>($tcp/2)) 
       {
           $obj = new $ClassName();
           $obj->setRisk($obj->getRisk()*$obj->getRisk());    
           $obj->setProfit($obj->getProfit()*2);   
      
           
       }
    }
   
    
    
    

    public function Rules($tcp, $tp, $tr, $tt) {

        $profitAverage = $tp / $tcp;
        global $insurable;
        global $index;
        global $rate;





        if ($tp != 0) {
            $index = 100 - (($tt - $tr) / ($tp * 2) * 100);
        }
        
        
// if this circus in not insurable, due to lack of profit, a message will be displayed. (Rule #1)
        ///(checked and works)
        if ($profitAverage < 1||$index<=0) {

            $insurable = "This Circus is not profitable enough to insure, DO NOT INSURE!";
        }

//Rule #2  (checked and works)
        if ($tr > $tt) {
            $insurable = "This is a bad Investment,  DO NOT INSURE!";
        }



        $rate = (0.37 * $tcp * $index);
        
    }

    public static function getCircus() {
        if (self::$myInstance == null) {
            self::$myInstance = new Circus();
        }
        return self::$myInstance;
    }

    
}

$myCircus = Circus::getCircus(); // will return an instance of Circus.
?>




<html>
    <link rel ="stylesheet" href ="table.css"/>

    <h1 style = "text-align:center">Insurance</h1>
    <form action="Circus.php"  method="POST">
        <table style = "margin:auto; width:50%;">
            <tr><td>Clown</td><td>:&nbsp;<input type="number" min = "0" name ="clown" value ="<?= $clowns ?>"/></td></tr>
            <tr><td>Juggler</td><td>:&nbsp;<input type="number"  min = "0"  name ="juggler" value ="<?= $jugglers ?>"/></td></tr>
            <tr><td> Lion Tamer</td><td>:&nbsp;<input type="number"   min = "0"  name ="lionTamer" value ="<?= $lionTamers ?>"/></td></tr>
            <tr><td> Mime</td><td>:&nbsp;<input type="number"  min = "0"  name ="mime" value ="<?= $mimes ?>"/></td></tr>
            <tr><td> Human Cannonball</td><td>:&nbsp;<input type="number"   min = "0"  name ="cannonball" value ="<?= $cannonBalls ?>"/></td></tr>
            <tr><td> Trapeze Artist</td><td>:&nbsp;<input type="number"  min = "0"  name ="trapeze" value ="<?= $trapeze?>"/></td></tr>
            <tr><td>Insurable?</td><td><?= $insurable ?>


            <tr><td><input type="submit" value="Check Insurance" name="submit" /></td><td><?= "your index is: "
 . number_format($index, 2) . " Your rate is:  $" . number_format((float) $rate, 2)
?></td></tr>
        </table>
    </form>
</div>
<br>
<br>
</html>



