<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.css' rel='stylesheet' />
    <link href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css' rel='stylesheet'>
    <link href='../node_modules/fullcalendar/main.css' rel='stylesheet' />
    <script src='../node_modules/fullcalendar/main.js'></script>
    <link href="../css/bookkeeping.css" rel='stylesheet'/>
    <link href="../css/Css.css" rel='stylesheet'/>
    <link href="../css/pieChart.css" rel='stylesheet'/>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="http://static.pureexample.com/js/flot/excanvas.min.js"></script>
    <script src="http://static.pureexample.com/js/flot/jquery.flot.min.js"></script>
    <script src="http://static.pureexample.com/js/flot/jquery.flot.pie.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </head>
  <body id="body">
  <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #d8e5ed;">
  <a class="navbar-brand" disabled>記記帳帳</a>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"></a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" id="navForm">
    <input type="text" id="cost" disabled style="size: 10px;position: relative;right: 450px; 
    float: right;border: 1px solid #008eb3;padding: 7px 0px;text-align: center;font-family: 'Microsoft soft';
    border-radius: 5px">
    <span class="navbar-text" id="username" style="position: relative;right: 20%;float: right;">
    目前使用者:
    <?php
      session_start();
      echo $_SESSION["username"];
    ?>
    </span>
      <button class="btn btn-outline-success my-2 my-sm-0" type="button" style="color: white" id="logout">登出</button>
    </form>
  </div>
</nav>
<div id='content'>
  <div id='calendar'></div>
  <div id='setForm'>
    <form id="formId" >
    <div class="form-group">
      <input  class="form-control" id="selectDate" name="selectDate" readonly>
    </div>
    <div class="form-group">
      <label for="type">消費項目</label>
        <select class="form-control" name="type" id="type">
          <option value="飲食">飲食</option>
          <option value="交通">交通</option>
          <option value="購物">購物</option>
          <option value="娛樂">娛樂</option>
          <option value="居家">居家</option>
          <option value="醫療">醫療</option>
          <option value="其他">其他</option>
        </select>
    </div>
    <div class="form-group">
      <label for="extended">消費說明</label>
      <input type="text" class="form-control" name="extended" id="extended">
    </div>
    <div class="form-group">
      <label for="amount">消費金額</label>
      <input type="number" class="form-control" name="amount" id="amount">
    </div>
    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
   </form>
   </div>
</div>
   <div id="piechart"></div> 
   
  </body>

<script src="../js/calendar.js"></script>
<script>
  const logout = document.getElementById('logout');
  
  logout.addEventListener('click',()=>{
    swal({
  title: "確定登出嗎?",
  icon: "warning",
  buttons: ["否","是"],
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    window.location.href = "./index.php"
  } 
});
  })
</script>
</html>


