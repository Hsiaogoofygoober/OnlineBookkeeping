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
    <script src="../js/calendar.js"></script>
    <script src="../js/pieChart.js"></script>
  </head>

  <body id="body">
  <div id='calendar'></div>
  <div id='setForm'>
    <img src='../img/istockphoto-995480036-170667a.jpg' id='img' style="width: 100% ;display:block; margin:auto;">
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
<script>
      let selectElem = document.getElementById('type');
      selectElem.addEventListener('click', function(){
      let img = document.getElementById('img').src;
      let type = document.getElementById('type').value;
      
      switch(type){
        case '飲食':
          document.getElementById('img').src = '../img/istockphoto-995480036-170667a.jpg';
          break;
        case '交通':
          document.getElementById('img').src = '../img/istockphoto-1153404277-170667a.jpg';
          break;
        case '購物':
          document.getElementById('img').src = '../img/e326910502e1ddd65a45e36e1533ecb2_512_512.jpg';
          break;
        case '娛樂':
          document.getElementById('img').src = '../img/370ca3d01308e37e3e98afbc6e71ad38_512_512.jpg';
          break;
        case '居家':
          document.getElementById('img').src = '../img/house.png';
          break;
        case '醫療':
          document.getElementById('img').src = '../img/medical.png';
          break;
        case '其他':
          document.getElementById('img').src = '../img/another.png';
          break;
        case '收入':
          document.getElementById('img').src = '../img/money.jpg';
          break;
      }
      
      })
    </script>
