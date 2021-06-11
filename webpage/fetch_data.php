<?php
    $username = "woyudagg";
    $date = "2021-06-08";        
    require_once("setting.inc");
    $sql  = "SELECT u.CostDate From userdata as u Where u.CostDate = '{$date}' and u.UserName = '{$username}'";
    $sql1 = "SELECT u.CostType From userdata as u Where u.CostDate = '{$date}' and u.UserName = '{$username}'";
    $sql2 = "SELECT u.CostExtended From userdata as u Where u.CostDate = '{$date}' and u.UserName = '{$username}'";
    $sql3 = "SELECT u.CostAmount From userdata as u Where u.CostDate = '{$date}' and u.UserName = '{$username}'";
    $result  = mysqli_query($db_link, $sql);
    $result1 = mysqli_query($db_link, $sql1);
    $result2 = mysqli_query($db_link, $sql2);
    $result3 = mysqli_query($db_link, $sql3);

    if(mysqli_num_rows($result) > 0){
      while($rDate = mysqli_fetch_array($result, MYSQLI_NUM)){
        echo $rDate[0];
        echo $rDate[1];
        echo $rDate[2];
      }
    }

    if(mysqli_num_rows($result) > 0){
      while($rExtended = mysqli_fetch_array($result2, MYSQLI_NUM)){
        echo $rExtended[0]."<br />";       
      }
    }
    require_once("setting_close.inc");
?>