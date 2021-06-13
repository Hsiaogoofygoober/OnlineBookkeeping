<!DOCTYPE html>
<html>

<head>
  <link href="../css/Css.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="../js/JavaScript.js"></script>
  <meta charset="utf-8">
  <title>Sign_up</title>
</head>

<body class="background">

  <div class="card" style="width: 22rem; text-align: center; margin:auto; position: relative; top: 50px;">
    <img src="../img/09160089cbb14941dd08d0f2be9b6a47.jpg" class="card-img-top" alt="error">
    <div class="card-body">
      <form method="POST" action="./temp.php" id="signupForm">
        <h3 style="color: #546270;">Sign up</h3><br />
        <div class="form-group">
          <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Email">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" name="username" id="username" placeholder="Username">
        </div>
        <div class="form-group">
          <input type="password" class="form-control" name="password" id="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary " style="background-color: #778899; border-color:#778899;">註冊</button>
      </form>
    </div>
  </div>
</body>
<script>
  $('#signupForm').on('submit', function() {
    if ((document.getElementById("username").value == "") || (document.getElementById("password").value == "") || (document.getElementById("email").value == "")) {
      swal({
        title: "請輸入完整資訊",
        icon: "error",
        button: "確認",
      });
    } else {
      console.log("gg")
      $.ajax({
        url: './temp.php', // 要傳送的頁面
        method: 'POST', // 使用 POST 方法傳送請求
        dataType: 'json', // 回傳資料會是 json 格式
        data: $('#signupForm').serialize(), // 將表單資料用打包起來送出去
        success: function(res) {
          if (res.success === true && res.isSame === false) {
            swal({
              title: "創建帳號成功",
              icon: "success",
              button: "確認",
            });
            document.addEventListener('click', () => {
              window.location.href = "../webpage/index.php";
            })
          } else if (res.isSame === true) {
            swal({
              title: "帳號重複",
              icon: "error",
              button: "確認",
            });
          } else {
            swal({
              title: "請填寫正確資訊",
              icon: "error",
              button: "確認",
            });
          }
        },
        error: () => {
          console.log('error')
        }
      });
    }
    return false; // 阻止瀏覽器跳轉到 form.php，因為已經用 ajax 送出去了
  });
</script>

</html>