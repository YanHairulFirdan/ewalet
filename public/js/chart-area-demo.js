// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

function drawAreaChart(months, data, max) {
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: months,
    datasets: [{
      label: "Berat",
      lineTension: 0.3,
      backgroundColor: "rgba(2,117,216,0.2)",
      borderColor: "rgba(2,117,216,1)",
      pointRadius: 5,
      pointBackgroundColor: "rgba(2,117,216,1)",
      pointBorderColor: "rgba(255,255,255,0.8)",
      pointHoverRadius: 5,
      pointHoverBackgroundColor: "rgba(2,117,216,1)",
      pointHitRadius: 50,
      pointBorderWidth: 2,
      data,
    }],
  },
  options: {
     // String - Template string for single tooltips
    tooltipTemplate: "<%if (label){%><%=label %>: <%}%><%= 'Rp.' + value %>",
    // String - Template string for multiple tooltips
    multiTooltipTemplate: "<%= 'Rp.' + value %>",
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: max+100,
          maxTicksLimit: 5,
          callback : function(value) {
              return new Intl.NumberFormat('pt-PT', { style: 'unit', unit: 'kilogram' }).format(value)
          },
        gridLines: {
          color: "rgba(0, 0, 0, .125)",
        }
      }
      }],
    },
    legend: {
      display: false
    },
    tooltips : {
          callbacks : {
            label: function(tooltipItem, data) {
              return new Intl.NumberFormat('pt-PT', { style: 'unit', unit: 'kilogram' }).format(data['datasets'][0]['data'][tooltipItem['index']])
            },
          }
        }
  }
});
  
}
// Area Chart Example
