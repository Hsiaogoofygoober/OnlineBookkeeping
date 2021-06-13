<?php
    $username = "woyudagg";
    $date = "2021-06-08";        
    require_once("setting.inc");
    $sql  = "SELECT u.CostDate, u.CostType, u.CostExtended, u.CostAmount From userdata as u Where u.CostDate = '{$date}' and u.UserName = '{$username}'";
    $result  = mysqli_query($db_link, $sql);

    if(mysqli_num_rows($result) > 0){
      while($rows = mysqli_fetch_array($result, MYSQLI_NUM)){
        echo $rows[0]."<br / >";
        echo $rows[1];
        echo $rows[2];
        echo $rows[3];
      }
    }

    require_once("setting_close.inc");
?>