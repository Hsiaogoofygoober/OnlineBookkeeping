<?php
    session_start();
    $username = $_SESSION["username"];        
    require_once("setting.inc");
    $sql  = "SELECT u.CostDate, u.CostType, u.CostExtended, u.CostAmount From userdata as u Where u.UserName = '{$username}'";
    $result  = mysqli_query($db_link, $sql);
    $num_row = mysqli_num_rows($result);
    $total_fields=mysqli_num_fields($result);
    $date_data[$num_row] = null;
    $type_data[$num_row] = null;
    $extended_data[$num_row] = null;
    $amount_data[$num_row] = null;  
    $index = 0;

    if(mysqli_num_rows($result) > 0){
      
      while($rows = mysqli_fetch_array($result, MYSQLI_NUM)){
        $date_data[$index] = $rows[0];
        $type_data[$index] = urlencode($rows[1]);
        $extended_data[$index] = urlencode($rows[2]);
        $amount_data[$index] = $rows[3];
        $index++;
        
      }
      
      $url_data = array(
        'date_data' => $date_data,
        'type_data' => $type_data,
        'extended_data' => $extended_data,
        'amount_data' => $amount_data
      );

      $data = urldecode(json_encode($url_data));
      
      echo $data;
    }
    else{
      echo "fail";
    }

    require_once("setting_close.inc");
?>