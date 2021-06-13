<?php
    $username = "woyudagg";
    $isSame = false;
    require_once("setting.inc");
    $sql = "SELECT u.UserName From userlogin as u";
    $result = mysqli_query($db_link, $sql);

    if(mysqli_num_rows($result) > 0){
        while($rows = mysqli_fetch_array($result, MYSQLI_NUM)){
            if($rows[0] == $username){
                $isSame = true;
                exit;
            }
        }        
    }
?>