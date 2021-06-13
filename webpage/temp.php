<?php
  $db_link = @mysqli_connect("localhost", "root", "rootroot", "final_project");
  $email = $_POST["email"];
  $username = $_POST["username"];
  $password = $_POST["password"];
  $success = false;
  $isSame = false;

  if($email == "" ||$username == ""||$password == ""){
    $success = false;
  }
  else{    
    $sql1 = "SELECT u.UserName From userlogin as u";
    $result = mysqli_query($db_link, $sql1);

    if(mysqli_num_rows($result) > 0){
      while($rows = mysqli_fetch_array($result, MYSQLI_NUM)){
          if($rows[0] == $username){
              $isSame = true;
              break;
          }
        }       
      }

    if($isSame == false){
    $sql = "INSERT INTO userlogin (UserName, UserPassword, UserEmail, UserApproved) VALUES ('$username','$password','$email','N')";

    mysqli_query($db_link, $sql);    
    }
    $success = true;
  }

  mysqli_close($db_link);
  echo json_encode(array(
    'success' => $success,
    'isSame' => $isSame,
  ));
