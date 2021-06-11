google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 2],
          ['gg',    7],
          ['ff',    7],
          ['ss',    7],
          ['dd',    7]
        ]);

        var options = {
          title: '記帳統計',
          titleTextStyle:{fontSize: 20},
          chartArea:{top:50,left: 20,width:'80%',height:'80%'},
          legend:{position: 'bottom'},
          pieHole: '0.6',
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }