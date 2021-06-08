<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.css' rel='stylesheet' />
    <link href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css' rel='stylesheet'>
    <link href='../node_modules/fullcalendar/main.css' rel='stylesheet' />
    <script src='../node_modules/fullcalendar/main.js'></script>
    <link href="../css/bookkeeping.css" rel='stylesheet'/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </head>
  <body>
    <div id='calendar'>
      <script>
        var selectDate = "";
        document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        let preInfo = "";
        let currentColor = "";
        var calendar = new FullCalendar.Calendar(calendarEl, {
        
        themeSystem: 'bootstrap',

        dateClick: function(info){ 
        selectDate = info.dateStr;
        document.getElementById("selectDate").value= selectDate;
        
        if(preInfo === ""){
        info.dayEl.style.backgroundColor = '#c6d9eb';
        }
        else{
          currentColor = info.dayEl.style.backgroundColor;
        if(preInfo.dateStr !== info.dateStr){ 
          info.dayEl.style.backgroundColor = '#c6d9eb';
          preInfo.dayEl.style.backgroundColor = currentColor;
        }
        else{
          info.dayEl.style.backgroundColor = currentColor;
          preInfo.dayEl.style.backgroundColor = "#c6d9eb";
        }
        }
      preInfo = info;
   
    },  
    dayMaxEventRows: true, // for all non-TimeGrid views
 
  }, 
  
  );
  $('form').on('submit', function(){
    $.ajax({
        url: 'bookkeeping.php',              // 要傳送的頁面
        method: 'POST',               // 使用 POST 方法傳送請求
        dataType: 'json',             // 回傳資料會是 json 格式
        data: $('form').serialize(),  // 將表單資料用打包起來送出去
        success: function(res){       // 成功以後會執行這個方法
          console.log("success")
          console.log(res)
        /*calendar.addEvent(
        { 
          title: document.getElementById("varity").value, // a property!
          start: selectDate, // a property!
          allDay: true // a property! ** see important note below about 'end' **
        }) */                              
        },
        error: (res)=>{
          console.log("error")
          console.log(res)}
    });
    return false;  // 阻止瀏覽器跳轉到 send.php，因為已經用 ajax 送出去了
});

  /*function addRecord(){
      console.log("1")
      calendar.addEvent(
        { 
          title: document.getElementById("varity").value, // a property!
          start: selectDate, // a property!
          allDay: true // a property! ** see important note below about 'end' **
        })
  }  */
  
  calendar.render();
  
  console.log("render")
});
 
      </script>
    </div>
    <div id='setForm'>
    <form  action="bookkeeping.php" method="post" id="form">
    <div class="form-group">
      <input  class="form-control" id="selectDate">
    </div>
    <div class="form-group">
      <label for="varity">消費種類</label>
        <select class="form-control" id="varity">
          <option value="飲食">飲食</option>
          <option value="交通">交通</option>
          <option value="消費">消費</option>
          <option value="娛樂">娛樂</option>
          <option value="居家">居家</option>
          <option value="醫療">醫療</option>
          <option value="其他">其他</option>
          <option value="收入">收入</option>
        </select>
    </div>
    <div class="form-group">
      <label for="name">消費項目</label>
      <input type="text" class="form-control" name="type" id="name"> 
    </div>
    <div class="form-group">
      <label for="name">消費金額</label>
      <input type="number" class="form-control" name="amount" id="amount">
    </div>
    <input type="submit" class="btn btn-primary" id="submit" value="記帳"/>
   </form>
   </div>
  </body>
</html>