<?php
  header('Content-Type: application/json; charset=UTF-8'); //設定資料類型為 json，編碼 utf-8 
   session_start();
   if($_SESSION["username"]){
    
      $date = $_POST["selectDate"];
      $type = $_POST["type"];
      $extended = $_POST["extended"];
      $amount = $_POST["amount"];
      $username = $_SESSION["username"];
      
        if($date != "" && $type != "" && $extended != "" && $amount != ""){
          require_once("setting.inc");
          $sql = "INSERT INTO userdata (UserName, CostDate, CostType, CostAmount, CostExtended) Values ('$username', '$date', '$type','$amount','$extended')";
          mysqli_query($db_link, $sql);
          mysqli_close($db_link);   
          echo json_encode(array('success' => true )); 
        }
        else{
            echo json_encode(array('success' => false ));
        }
        
      
      
    }
  else{
    header("Location: ../webpage/loginPage.php");
  }

   ?>