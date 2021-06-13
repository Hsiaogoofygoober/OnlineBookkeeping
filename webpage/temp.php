<?php
  $db_link = @mysqli_connect("localhost", "root", "rootroot", "final_project");
  $email = $_POST["email"];
  $username = $_POST["username"];
  $password = $_POST["password"];
  $success = "";

  if($email == "" ||$username == ""||$password == ""){
    $success = false;
    //header("Location:signUpPage.php");
  }
  else{
    $sql = "INSERT INTO userlogin (UserName, UserPassword, UserEmail, UserApproved) VALUES ('$username','$password','$email','N')";
    mysqli_query($db_link, $sql); 
    mysqli_close($db_link);
    $success = true;
    //header("Location:loginPage.php");
  }

  echo json_encode(array(
    'success' => $success,
  ))
  ?>