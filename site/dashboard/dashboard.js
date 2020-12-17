feather.replace()

var pub_id = document.getElementById('pub_id').value;

var json_data = null;
$.ajax({
    url: '../api/booking.php',
    method: 'post',
    data: {pub_id: pub_id},
    dataType: 'json',      
    success:function(data) {
        draw_chart(data);
    }
});

function draw_chart(data) {

'use strict'
var ctx = document.getElementById('myChart')

var myChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: [
      'Monday',
      'Tuesday',
      'Wednesday',
      'Thursday',
      'Friday',
      'Saturday',
      'Sunday'
    ],
    datasets: [{
      data: [
        data.Mon,
        data.Tue,
        data.Wed,
        data.Thu,
        data.Fri,
        data.Sat,
        data.Sun,
      ],
      lineTension: 0,
      backgroundColor: 'transparent',
      borderColor: '#007bff',
      borderWidth: 4,
      pointBackgroundColor: '#007bff'
    }]
  },
  options: {
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: false
        }
      }]
    },
    legend: {
      display: false
    }
  }
})
}