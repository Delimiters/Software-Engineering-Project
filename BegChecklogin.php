<?php  
    $username = $_POST["name"];
    $password = $_POST["pwd"];
    $filename = "accounts.txt";
    $fp = fopen($filename,'r');
    $data = fread($fp,  filesize("accounts.txt"));
    $temp = explode("\n", $data);
    // for loop to check too see if it finds it or not
    foreach ($temp as $user)
    {
        // finding the username and password
        $user = trim($user);
        $x = explode(",", $user);
        if($x[0] == $username and $x[1] == $password)
        {
            fclose($fp);
            header("Location:LoginFully_File.php");
            die();
        }
    }
      //if not found resend back to main page    
    fclose($fp);
    header("Location:LoginForWebsite.php?$username"); 
    die();
?>
