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
  <div id='calendar'></div>
    <div id='setForm'>
    <form id="formId" >
    <div class="form-group">
      <input  class="form-control" id="selectDate" name="selectDate">
    </div>
    <div class="form-group">
      <label for="type">消費種類</label>
        <select class="form-control" name="type" id="type">
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
      <label for="extended">消費項目</label>
      <input type="text" class="form-control" name="extended" id="extended">
    </div>
    <div class="form-group">
      <label for="amount">消費金額</label>
      <input type="number" class="form-control" name="amount" id="amount">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
   </form>
   </div>
  </body>
</html>

      <script>
        let selectDate = "";
        document.addEventListener('DOMContentLoaded', function() {
          let calendarEl = document.getElementById('calendar');
          let preInfo = "";
          let currentColor = "";
          let calendar = new FullCalendar.Calendar(calendarEl, {
          
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
 
  });

  $('#formId').on('submit', function(){
    $.ajax({
        url: 'form.php',              // 要傳送的頁面
        method: 'POST',               // 使用 POST 方法傳送請求
        dataType: 'json',             // 回傳資料會是 json 格式
        data: $('#formId').serialize(),  // 將表單資料用打包起來送出去
        success: function(res){
           calendar.addEvent(
           { 
             title: document.getElementById("type").value, // a property!
             start: selectDate, // a property!
             allDay: true // a property! ** see important note below about 'end' **
           })
          if(res.success === true){
              console.log('傳送成功');
          }else{
              console.log('傳送失敗');
          }
},
    });
    return false;  // 阻止瀏覽器跳轉到 form.php，因為已經用 ajax 送出去了
});

   
  calendar.render();
  
  console.log("render")
});
 
</script>