<?php
    //session_start();
    require_once("setting.inc");
    if(!$db_link){
        echo "failed";
    }
    else{
        $username = "woyudagg";
        $date = "2021-06-08"; 
        $sql3 = "SELECT u.CostAmount From userdata as u Where u.CostDate = '{$date}' and u.UserName = '{$username}'";
        $result3 = mysqli_query($db_link, $sql3);
       
        $sum = 0;
        if(mysqli_num_rows($result3) > 0){
            while($rAmount = mysqli_fetch_array($result3, MYSQLI_NUM)){
              $sum += $rAmount[0];     
            }
            echo $sum; 
        }
        else{
            echo "幹你娘";
        }
        require_once("setting_close.inc");
    }
?>