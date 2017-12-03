  <?php
 
function getPDO() {
    try {
        $db = new PDO('mysql:host=localhost;port=3306;dbname=mganga','mganga','jG8Aw3Zf66BW');
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false); 
        return $db;
    }
    catch (Exception $e2) {
        header("Location:error.php?error=An error occured.<br>" . $e2->getMessage());
        exit();
    }
}

function execute($db,$sql,$returnResults=true) {
    try {
        $statement = $db->prepare($sql);
        if (!$statement) {
            header("Location: error.php?error=Invalid statement&sql=$sql");
        }
        $statement->execute();
        $results = array();
        if ($returnResults) {
            $results = $statement->fetchAll();
        }
        $statement->closeCursor();
        return $results;
    }
    catch (Exception $e2) {
        header("Location: error.php?sql=$sql&error=An error occured.<br>" . $e2->getMessage());
        exit();
    }
}

// converts from mm/dd/yyyy to yyyy-mm-dd
function convertDate1($d1) {
    date_default_timezone_set('America/New_York');
    $test_arr  = explode('/', $d1);
    if (sizeof($test_arr) != 3) {
        return '';
    }
    if (!checkdate($test_arr[0], $test_arr[1], $test_arr[2])) {
        return '';
    }    
    $t = mktime(12,0,0,$test_arr[0], $test_arr[1], $test_arr[2]);
    return date('Y-m-d',$t);
}

// converts to mm/dd/yyyy from yyyy-mm-dd
function convertDate2($d1) {
    date_default_timezone_set('America/New_York');
    $test_arr  = explode('-', $d1);
    if (sizeof($test_arr) != 3) {
        return '';
    }
    if (!checkdate($test_arr[1], $test_arr[2], $test_arr[0])) {
        return '';
    }    
    $t = mktime(12,0,0,$test_arr[1], $test_arr[2], $test_arr[0]);
    return date('m/d/Y',$t);
}

function convertResult($dat) {
    if (!isset($dat['result'])) {
        return '';
    }
    if ($dat['result'] == '1') {
        return 'Player One';
    }
    elseif ($dat['result'] == '2') {
        return 'Player Two';
    }
    elseif ($dat['result'] == 'D') {
        return 'Draw';
    }
    return '';
}


