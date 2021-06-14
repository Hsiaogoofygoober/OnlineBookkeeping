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

  let index = 0;
  $(document).ready(function () {
    $.ajax({
      url: '../webpage/fetch_data.php',              // 要傳送的頁面
      method: 'POST',               // 使用 POST 方法傳送請求
      dataType: 'json',             // 回傳資料會是 json 格式
      success: function (res) {
        while (1) {
          if (res.date_data[index] != null) {
            calendar.addEvent(
              {
                title: res.type_data[index] + " " + res.extended_data[index] + " NT$" + res.amount_data[index],
                start: res.date_data[index],
                allDay: true,
              }
            )
            index++;
          }
          else {
            break;
          }
        }
      },
      error: function (res) {
        console.log("error")
      }
    });
    return false;  // 阻止瀏覽器跳轉到 form.php，因為已經用 ajax 送出去了
  });


  let today = calendar.getDate();
  today = today.getFullYear() + "-" + (today.getMonth() + 1) + "-" + today.getDate();
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


  google.charts.load('current', { 'packages': ['corechart'] });
  google.charts.setOnLoadCallback(drawChart);

  let eat = 0;
  let traffic = 0;
  let shopping = 0;
  let play = 0;
  let home = 0;
  let medical = 0;
  let others = 0;

  $("document").ready(() => {

    //取得目前的月份日期
    let Day1 = new Date();
    let Day2 = new Date();
    Day1 = calendar.view.currentStart;
    Day2 = calendar.view.currentEnd;
    Day2 = Day2.setDate(Day2.getDate() - 1);
    Day2 = new Date(Day2)
    Day1 = Day1.getFullYear() + "-" + (Day1.getMonth() + 1) + "-" + Day1.getDate();
    Day2 = Day2.getFullYear() + "-" + (Day2.getMonth() + 1) + "-" + Day2.getDate();
    $(".fc-next-button, .fc-prev-button, .fc-today-button").click(() => {

      Day1 = calendar.view.currentStart;
      Day2 = calendar.view.currentEnd;
      Day2 = Day2.setDate(Day2.getDate() - 1);
      Day2 = new Date(Day2)
      Day1 = Day1.getFullYear() + "-" + (Day1.getMonth() + 1) + "-" + Day1.getDate();
      Day2 = Day2.getFullYear() + "-" + (Day2.getMonth() + 1) + "-" + Day2.getDate();
      console.log(Day1, Day2)
      $.ajax({
        url: '../webpage/fetch_month.php',              // 要傳送的頁面
        method: 'POST',               // 使用 POST 方法傳送請求
        dataType: 'json',             // 回傳資料會是 json 格式
        data: {
          "month_start": Day1,
          "month_end": Day2
        },  // 將表單資料用打包起來送出去
        success: function (res) {
          console.log(res)
          eat = res.eat;
          traffic = res.traffic;
          shopping = res.shopping;
          play = res.play;
          home = res.home;
          medical = res.medical;
          others = res.others;
          google.charts.setOnLoadCallback(drawChart);
        },
        error: function (res) {
          console.log("error")
          eat = res.eat;
          traffic = res.traffic;
          shopping = res.shopping;
          play = res.play;
          home = res.home;
          medical = res.medical;
          others = res.others;
          google.charts.setOnLoadCallback(drawChart);
        },
      });
      return false;
    })

    $.ajax({
      url: '../webpage/fetch_month.php',              // 要傳送的頁面
      method: 'POST',               // 使用 POST 方法傳送請求
      dataType: 'json',             // 回傳資料會是 json 格式
      data: {
        "month_start": Day1,
        "month_end": Day2
      },  // 將表單資料用打包起來送出去
      success: function (res) {
        eat = res.eat;
        traffic = res.traffic;
        shopping = res.shopping;
        play = res.play;
        home = res.home;
        medical = res.medical;
        others = res.others;
      },
      error: function (res) {
        console.log("error")
      },
    });
    return false;

  })
  function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['花費項目', '花費金錢'],
      ['飲食', eat],
      ['交通', traffic],
      ['購物', shopping],
      ['娛樂', play],
      ['居家', home],
      ['醫療', medical],
      ['其他', others],
    ]);

    var options = {
      title: '當月記帳統計',
      titleTextStyle: { fontSize: 20 },
      chartArea: { top: 50, left: 20, width: '80%', height: '80%' },
      legend: { position: 'bottom' },
      pieHole: '0.6',
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);
  }


  $('#formId').on('submit', function () {
    if ((document.getElementById("extended").value == "") || (document.getElementById("amount").value == 0)) {
      swal({
        title: "請輸入完整資訊",
        icon: "error",
        button: "確認",
      });
    }
    else {
      $.ajax({
        url: '../webpage/add_data.php',              // 要傳送的頁面
        method: 'POST',               // 使用 POST 方法傳送請求
        dataType: 'json',             // 回傳資料會是 json 格式
        data: $('#formId').serialize(),  // 將表單資料用打包起來送出去
        success: function (res) {
          console.log("success");
          calendar.addEvent(
            {
              title: document.getElementById("type").value + " " + document.getElementById("extended").value + " NT$" + document.getElementById("amount").value, // a property!
              start: document.getElementById("selectDate").value, // a property!
              allDay: true,
            })
          let current_day = document.getElementById("selectDate").value;
          document.getElementById("formId").reset();

          document.getElementById("selectDate").value = current_day;
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

