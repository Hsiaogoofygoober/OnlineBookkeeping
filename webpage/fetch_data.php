<?php
    session_start();
    if($_SESSION["username"]){
        $date = $_POST["selectDate"];
        $username = $_SESSION["username"];
        
        require_once("setting.inc");
        $sql  = "SELECT u.CostDate From userdata as u Where u.CostDate = '{$date}' and u.UserName = '{$username}'";
        $sql1 = "SELECT u.CostType From userdata as u Where u.CostDate = '{$date}' and u.UserName = '{$username}'";
        $sql2 = "SELECT u.CostExtended From userdata as u Where u.CostDate = '{$date}' and u.UserName = '{$username}'";
        $sql3 = "SELECT u.CostAmount From userdata as u Where u.CostDate = '{$date}' and u.UserName = '{$username}'";
        $result  = mysqli_query($db_link, $sql);
        $result1 = mysqli_query($db_link, $sql1);
        $result2 = mysqli_query($db_link, $sql2);
        $result3 = mysqli_query($db_link, $sql3);

        $rows = mysqli_fetch_array($result, MYSQLI_NUM);
        $rows1 = mysqli_fetch_array($result1, MYSQLI_NUM);
        $rows2 = mysqli_fetch_array($result2, MYSQLI_NUM);
        $rows3 = mysqli_fetch_array($result3, MYSQLI_NUM); 
    }
    else{
        header("Location: ../bookkeeping-1/loginPage.php");
    }
?>