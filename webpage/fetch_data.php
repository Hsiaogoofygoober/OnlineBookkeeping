<?php
    $username = "woyudagg";    
    $index = 0;
    require_once("setting.inc");
    $sql  = "SELECT u.CostDate, u.CostType, u.CostExtended, u.CostAmount From userdata as u Where u.UserName = '{$username}'";
    $result  = mysqli_query($db_link, $sql);

    if(mysqli_num_rows($result) > 0){
      while($para = mysqli_fetch_array($result, MYSQLI_NUM)){
        $index += 1;
      }
    }
    echo $index;
    $date_arr[$index] = null;

    $i = 0;
    if(mysqli_num_rows($result) > 0){
      while($rows = mysqli_fetch_array($result, MYSQLI_NUM)){
        $date_arr[$i] = $rows[0];
        $i += 1;
      }
    }
    else{
      echo "fail";
    }

    $j = 0;
    for($j; $j < $i; $j++){
      echo $date_arr[$j]."<br />";
    }
    require_once("setting_close.inc");
?>