<?php
    $error = '';
    $sql = '';
    if (isset($_REQUEST['error'])) {
        $error = $_REQUEST['error'];
    }
    if (isset($_REQUEST['sql'])) {
        $sql = $_REQUEST['sql'];
    }
?>

<html>
    <h3>Error!</h3>
    <?=$error?>
    <br>
    <?=$sql?>
</html>