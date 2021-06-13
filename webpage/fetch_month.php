<?php
    $username = "woyudagg";
    $date = "06";        
    require_once("setting.inc");
    $sql = "SELECT u.CostAmount From userdata as u Where u.UserName = '{$username}' and date(CostDate) between"."'2021-".$date."-01' and '2021-".$date."-31'";
    $result  = mysqli_query($db_link, $sql);

    if(mysqli_num_rows($result) > 0){
      while($rows = mysqli_fetch_array($result, MYSQLI_NUM)){
        echo $rows[0]."<br />";
      }
    }

    require_once("setting_close.inc");
?>