<?php

abstract class Performer{

   private $risk = 0;
   private $profit = 0;
   private $terror = 0; // now that we have set these to private, we must use our setters and getters
   // in our other CLASSES to change our variables;
   public static $numberOfPerformers = 0;

    //set risk for any performer 
   public function setRisk($r) {
        $this->risk = $r;
    }

// get risk for any performer
   public function getRisk() {
        return $this->risk;
    }

    //set profit for any performer 
   public function setProfit($p) {
        $this->profit = $p;
    }

// get profit for any performer
    public function getProfit() {
        return $this->profit;
    }
    
        //set profit for any performer 
    public function setTerror($t) {
         $this->terror = $t;
    }

// get profit for any performer
   public function getTerror() {
        return $this->terror;
    }

    public function OBJtoString() {
        echo "<p>The risk of this performer is: </p>" . $this->risk;
        echo "<p>The Profit of this artist is: <p>" . $this->profit;
        echo "<p>The Terror of this artist is: </p>" . $this->terror;
    }

    

}

class Clown extends Performer {

    function __construct() {
        $this->setRisk(0);
        $this->setProfit(2);
        $this->setTerror(4);
        
    }

}

class Juggler extends Performer {

    function __construct() {
         $this->setRisk(0);
        $this->setProfit(1);
        $this->setTerror(1);

    }

}

class LionTamer extends Performer {

    function __construct() {
        $this->setRisk(3);
        $this->setProfit(2);
        $this->setTerror(2);

    }

}

class Mime extends Performer {

    function __construct() {
    $this->setRisk(0);
        $this->setProfit(0);
        $this->setTerror(0.5);

    }

}

class CannonBall extends Performer {

    function __construct() {
         $this->setRisk(5);
        $this->setProfit(2);
        $this->setTerror(3);
  
    }

}

class TrapezeArtist extends Performer {

    function __construct() {
        $this->setRisk(1.5);
        $this->setProfit(2);
        $this->setTerror(3);

    }

}

//$clown = new Clown();

//$clown->OBJtoString();
//echo Performer::$numberOfPerformers;


?>