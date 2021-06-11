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
  <?php
  ?>
  <body id="body">
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
          <option value="收入">收入</option>
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
   <div id="piechart"></div> 
  </body>
</html>
<script src="../js/calendar.js"></script>
<script src="../js/pieChart.js"></script>

