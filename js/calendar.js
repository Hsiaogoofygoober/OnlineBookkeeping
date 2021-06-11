let selectDate = "";
        $(document).ready(function(){
          $.ajax({
            url: '../webpage/add.php',              // 要傳送的頁面
            method: 'POST',               // 使用 POST 方法傳送請求
            dataType: 'json',             // 回傳資料會是 json 格式
            success: function(res){
              //alert(res.a+res.b+res.c);
            },
            error:function(res){
              alert("error")
            }
    });
    return false;  // 阻止瀏覽器跳轉到 form.php，因為已經用 ajax 送出去了
});

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
        url: '../webpage/add_data.php',              // 要傳送的頁面
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