
<!-- Matthew Ganga
     CPS 276
     Homework # 7
     Extracting specific data for a client from old files obtained by user uploading them. 
     Client willing to pay $450

-->

<!--this is the html form user to upload the file-->
<html>
    <h3 style = "position:fixed;">Upload file for Program to extract data:</h3>

    <link rel ="stylesheet" href ="DataOutputStyle.css"/>

    <div class ="fixed2">
        <form action="uploadFiles.php" enctype="multipart/form-data" method="post">
            <input type="submit" value="Upload File" name="upload" />&nbsp;
            <input type="file" name="myfile"/>
        </form>
    </div>
    <br>
    <br>
</html>

<?php


$internalFileName = null;
$rawData = null;
$phoneNumber = null;
$accountNumber = null;
$money = null;
$money2 = null;
$total = 0;
$recordsInFile = 0;

$i = 0;

setlocale(LC_MONETARY, 'en_US');

  

// grabs the user 
if (isset($_REQUEST['upload']) && isset($_FILES['myfile'])) {

    // copy file to local directory
    if (!file_exists('uploads')) {

        mkdir('uploads');
        chmod('uploads', 0777);
    }


    $internalFileName = $_FILES['myfile']['name'];

    if (!move_uploaded_file($_FILES['myfile']['tmp_name'], $internalFileName)) {
        echo('error');
        exit();
    }

    // converts to String to write to internal file  
    $contents = file_get_contents($internalFileName);

    // swap acsii 13 with acsii 10
    $contents = str_replace("\r", "\n", $contents);


    // change the file permission
    chmod($internalFileName, 0777);

    // writes $contents Strring to the file. 
    file_put_contents($internalFileName, $contents);



    // creates the array of data read from the file name passed into it. 
    $rawData = file($internalFileName);



// this block is used to pull out the number of files and amount to print out total in search results table

    $moneyPattern1 = '/\$\d{0,}\.\d{2}/';
    $accountMatch1 = '/[a-zA-Z]{2}((\d{8})|(\d{4}))/'; // will use this to determine real file size. 

    $j = 0;
    while ($j < sizeof($rawData)) {


        $c = preg_match($moneyPattern1, $rawData[$j], $matches0);

        if ($c == 1) {

            $money2 = ($matches0[0] . '<br>');
            $trimmed = trim($money2, "$");

            $total += $trimmed;
        } else {

            $money2 = 0;
        }
        $k = preg_match($accountMatch1, $rawData[$j], $matches0);
        // if this is found to be true, add one to  the record count variable $recoredsInFile below.

        if ($k == 1) {
            $recordsInFile += 1;
        }


        $j++;
    }
    $recordsInFile += 1;
    //
    ?>
    <html>


        <div class ="fixed">
            <!-- this is the table that will display file information -->
            <table class = "file">
                <tr class = "file"><th class = "file">File Name</th><th class ="file">Records</th><th class = "file">Total</th></tr>
                <tr><td class = "file"><?= $internalFileName ?></td><td class = "file"><?= $recordsInFile ?></td><td class = "money"><?= money_format('%(#10n', $total); ?></td></tr>  
            </table>

        </div>

    </html> 


    <!-- restart the php to extract the dat from the file and output to the table -->

    <?php
    $phonePattern = '/(\({0,1}\d{3}\){0,1}){0,1}\s{0,1}\d{3}[\s\-]{0,1}\d{4}/';
    $accountMatch = '/[a-zA-Z]{2}((\d{8})|(\d{4}))/';
    $moneyPattern = '/\$\d{0,}\.\d{2}/';

    echo "<div class ='outputTable'>";
    echo"<h1 style = 'text-align:center;color:teal;'>Requested Data</h1>";
    echo" <table class = 'out'>";
    echo "<tr class = 'out'><th class = 'out'>Account</th><th class = 'out'>Phone</th><th class = 'out'>Amount</th></tr>";
    while ($i < sizeof($rawData)) {

        $x = preg_match($phonePattern, $rawData[$i], $matches1);
        $y = preg_match($accountMatch, $rawData[$i], $matches2);
        $z = preg_match($moneyPattern, $rawData[$i], $matches3);


        if ($x == 1) {
            $phoneNumber = ($matches1[0] . '<br>');
        } else {
            $phoneNumber = null;
        }

        if ($y == 1) {
            $accountNumber = ($matches2[0] . '<br>');
        } else {
            $accountNumber = null;
        }
        if ($z == 1) {
            $money = ($matches3[0] . '<br>');
        } else {
            $money = null;
        }

        $i++;

        echo "<tr class = 'out'><td class = 'out'>";
        echo$accountNumber;
        echo "</td><td class = 'out'>";
        echo $phoneNumber;
        echo"</td><td class = 'money'>";
        echo $money;
        echo"</td></tr>";
    }


    echo" </table>";
    echo"</div>";
}
?>




















