$(document).ready(function () {
  $.ajax({
    url: '../webpage/add.php',              // 要傳送的頁面
    method: 'POST',               // 使用 POST 方法傳送請求
    dataType: 'json',             // 回傳資料會是 json 格式
    success: function (res) {
      for (var i = 0; i < res.a.length; i++) {
        console.log(res.a[i])
      }
      for (var i = 0; i < res.b.length; i++) {
        console.log(res.b[i])
      }
      for (var i = 0; i < res.c.length; i++) {
        console.log(res.c[i])
      }
    },
    error: function (res) {
      alert("error")
    }
  });
  return false;  // 阻止瀏覽器跳轉到 form.php，因為已經用 ajax 送出去了
});
let selectDate = "";
document.addEventListener('DOMContentLoaded', function () {
  let calendarEl = document.getElementById('calendar');
  let preInfo = "";
  let currentColor = "";
  let calendar = new FullCalendar.Calendar(calendarEl, {

    themeSystem: 'bootstrap',

    dateClick: function (info) {
      selectDate = info.dateStr;
      document.getElementById("selectDate").value = selectDate;

      if (preInfo === "") {
        info.dayEl.style.backgroundColor = '#c6d9eb';
      }
      else {
        currentColor = info.dayEl.style.backgroundColor;
        if (preInfo.dateStr !== info.dateStr) {
          info.dayEl.style.backgroundColor = '#c6d9eb';
          preInfo.dayEl.style.backgroundColor = currentColor;
        }
        else {
          info.dayEl.style.backgroundColor = currentColor;
          preInfo.dayEl.style.backgroundColor = "#c6d9eb";
        }
      }
      preInfo = info;
      $("document").ready(() => {
        $.ajax({
          url: '../webpage/total_cost.php',              // 要傳送的頁面
          method: 'POST',               // 使用 POST 方法傳送請求
          dataType: 'json',             // 回傳資料會是 json 格式
          data: {
            "date": selectDate
          },  // 將表單資料用打包起來送出去
          success: function (res) {
            document.getElementById('cost').value = "今日花費: " + res.sum + "元"
          },
          error: () => {
            alert("error")
          }
        });
        return false;
      })
    },

    eventClick: function (info) {
      swal({
        title: info.event.title,
      });
    },
    dayMaxEventRows: true, // for all non-TimeGrid views

  });
  let today = calendar.getDate();
  today = today.getFullYear() + "-0" + (today.getMonth() + 1) + "-" + today.getDate();
  document.getElementById("selectDate").value = today;
  //顯示今日花費
  $("document").ready(() => {
    $.ajax({
      url: '../webpage/total_cost.php',              // 要傳送的頁面
      method: 'POST',               // 使用 POST 方法傳送請求
      dataType: 'json',             // 回傳資料會是 json 格式
      data: {
        "date": today
      },  // 將表單資料用打包起來送出去
      success: function (res) {
        document.getElementById('cost').value = "今日花費: " + res.sum + "元"
      },
      error: () => {
        alert("error")
      }
    });
    return false;
  })



  //取得目前的月份日期
  let Day1 = new Date();
  let Day2 = new Date();
  Day1 = calendar.view.currentStart;
  Day2 = calendar.view.currentEnd;
  Day2 = Day2.setDate(Day2.getDate() - 1);
  Day2 = new Date(Day2)
  Day1 = Day1.getFullYear() + "-0" + (Day1.getMonth() + 1) + "-" + Day1.getDate();
  Day2 = Day2.getFullYear() + "-0" + (Day2.getMonth() + 1) + "-" + Day2.getDate();
  console.log(Day1, Day2);
  $("document").ready(() => {
    $("button").click(() => {
      let Day1 = new Date();
      let Day2 = new Date();
      Day1 = calendar.view.currentStart;
      Day2 = calendar.view.currentEnd;
      Day2 = Day2.setDate(Day2.getDate() - 1);
      Day2 = new Date(Day2)
      Day1 = Day1.getFullYear() + "-0" + (Day1.getMonth() + 1) + "-" + Day1.getDate();
      Day2 = Day2.getFullYear() + "-0" + (Day2.getMonth() + 1) + "-" + Day2.getDate();
      console.log(Day1, Day2);
    })
  })

  $('#formId').on('submit', function () {
    if((document.getElementById("extended").value == "") || (document.getElementById("amount").value == 0)){
      swal({
        title: "請輸入完整資訊",
        icon: "error",
        button: "確認",
      });
    }
    else{
      $.ajax({
        url: '../webpage/add_data.php',              // 要傳送的頁面
        method: 'POST',               // 使用 POST 方法傳送請求
        dataType: 'json',             // 回傳資料會是 json 格式
        data: $('#formId').serialize(),  // 將表單資料用打包起來送出去
        success: function (res) {
          
          calendar.addEvent(
            {
              title: document.getElementById("type").value+" "+document.getElementById("extended").value+" NT$"+document.getElementById("amount").value, // a property!
              start: document.getElementById("selectDate").value, // a property!
              allDay: true, // a property! ** see important note below about 'end' **
              // extendedProps: {
              //   extended: document.getElementById("extended").value,
              //   amount: document.getElementById("amount").value
              // }
            })
          console.log(document.getElementById("extended").value);
          document.getElementById("formId").reset();
          
          document.getElementById("selectDate").value = today;
          if (res.success === true) {
            swal({
              title: "傳送成功",
              icon: "success",
              button: "確認",
            });
          } else {
            swal({
              title: "傳送失敗",
              icon: "error",
              button: "確認",
            });
          }
        },
      });
    }
    return false;  // 阻止瀏覽器跳轉到 form.php，因為已經用 ajax 送出去了
  });


  calendar.render();

  console.log("render")
});

