
<?php 
    session_start(); 
    require_once('db.php'); 
    $name = ''; 
    $data = null;     
    $rec = null; 
    
    // these are set as td create in view 1. 
    $viewid = isset($_REQUEST['viewid']) ? $_REQUEST['viewid'] : 0; 
    $editid = isset($_REQUEST['editid']) ? $_REQUEST['editid'] : 0; 
    $deleteid = isset($_REQUEST['deleteid']) ? $_REQUEST['deleteid'] : 0; 
    
    
    $pressedSave = isset($_REQUEST['save']); 
    $pressedBack = isset($_REQUEST['back']); 
    $pressedSearch = isset($_REQUEST['search']); 
     
    // clicked view 
    if ($viewid > 0) { 
        $db = getPDO(); 
        $data = execute($db,"SELECT * FROM matches WHERE id = $viewid"); 
        if (!isset($data) || sizeof($data) < 1) { 
            header("Location: error.php?error=Record not found."); 
        } 
        $rec = $data[0]; 
        require_once("view2.php"); 
        exit(); 
    } 
    // clicked edit 
    elseif ($editid > 0) { 
        $db = getPDO(); 
        $data = execute($db,"SELECT * FROM matches WHERE id = $editid",true); 
        if (!isset($data) || sizeof($data) < 1) { 
            header("Location: error.php?error=Record not found."); 
        } 
        $rec = $data[0]; 
        require_once("view3.php"); 
        exit(); 
    } 
    // clicked delete 
    elseif ($deleteid > 0) { 
        $db = getPDO(); 
        execute($db,"DELETE FROM matches WHERE id = $deleteid",false); 
    } 
    // pressed save from edit page 
    elseif ($pressedSave) { 
        $playerID = isset($_REQUEST['playerID']) ? $_REQUEST['playerID'] : 0; 
        
        $player1 = addslashes(isset($_REQUEST['player1']) ? $_REQUEST['player1'] : ''); 
        $player2 = addslashes(isset($_REQUEST['player2']) ? $_REQUEST['player2'] : ''); 
        $sql = "UPDATE matches SET player1='$player1', player2='$player2' WHERE id= $playerID"; 
        $db = getPDO(); 
        //echo($sql); 
        execute($db,$sql,false); 
    } 
    // pressed search 
    elseif ($pressedSearch) { 
         $name = addslashes(isset($_REQUEST['name']) ? $_REQUEST['name'] : ''); 
        $_SESSION['name'] = $name; 
        
       $db = getPDO();
       $sql  = ("SELECT  player1,player2,id FROM matches WHERE (player1 LIKE '%$name%' OR  player2 LIKE '%$name%') ; ");
       $data = execute($db,$sql,true); 
       require_once('view1.php');
     
    } 
     
    // Search if user pressed search, or pressed save from edit page, or clicked delete 
    // or pressed BACK from view or edit pages. 
    if ($deleteid > 0 || $pressedSearch || $pressedSave || $pressedBack) { 
                   $name = $_SESSION['name'];  

               $db = getPDO(); 
               $sql  = ("SELECT * FROM matches WHERE (player1 LIKE '%$name%' OR player2 LIKE '%$name%');");
               $data = execute($db,$sql,true);
               
               
          } 
     require_once("view1.php"); 
        
    ?>