<?php
session_start();
    $username = $_SESSION["username"];
    $month_start = $_POST["month_start"];
    $month_end = $_POST["month_end"];
    require_once("setting.inc");
    $sql = "SELECT u.CostAmount, u.CostType From userdata as u Where u.UserName = '{$username}' and date(CostDate) between"."'".$month_start."' and '".$month_end."'";
    $result  = mysqli_query($db_link, $sql);
    $num_row = mysqli_num_rows($result);
    $type_data[$num_row] = null;
    $amount_data[$num_row] = null;
    $index = 0;
    $index_2 = 0;
    $total_cost = array(0,0,0,0,0,0,0);

    if(mysqli_num_rows($result) > 0){
      while($rows = mysqli_fetch_array($result, MYSQLI_NUM)){
        $amount_data[$index] = $rows[0];
        $type_data[$index] = urlencode($rows[1]);
        $index++;    
      }
      
      while($index_2<$num_row){
        switch (urldecode($type_data[$index_2])){
          case "飲食":
            $total_cost[0] += $amount_data[$index_2];
            break;
          case "交通":
            $total_cost[1] += $amount_data[$index_2];
            break;
          case "購物":
            $total_cost[2] += $amount_data[$index_2];
            break;
          case "娛樂":
            $total_cost[3] += $amount_data[$index_2];
            break;
          case "居家":
            $total_cost[4] += $amount_data[$index_2];
            break;
          case "醫療":
            $total_cost[5] += $amount_data[$index_2];
            break;
          case "其他":
            $total_cost[6] += $amount_data[$index_2];
            break;
        }
        $index_2++;
      }
      

      $url_data = array(
        'eat' => $total_cost[0],
        'traffic' => $total_cost[1],
        'shopping' => $total_cost[2],
        'play' => $total_cost[3],
        'home' => $total_cost[4],
        'medical' => $total_cost[5],
        'others' => $total_cost[6],
      );   
      $data = urldecode(json_encode($url_data));    
      echo $data;
    }

    require_once("setting_close.inc");
