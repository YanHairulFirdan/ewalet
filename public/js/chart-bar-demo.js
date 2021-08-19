// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Bar Chart Example
function drawBarChart(months, data, max) {
  var ctx = document.getElementById("myBarChart");
  var myLineChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: months,
      datasets: [{
        label: "Pendapatan",
        backgroundColor: "rgba(2,117,216,1)",
        borderColor: "rgba(2,117,216,1)",
        data,
      }],
    },
    options: {
      // String - Template string for single tooltips
      tooltipTemplate: "<%if (label){%><%=label %>: <%}%><%= 'Rp.'+value %>",
    // String - Template string for multiple tooltips
      multiTooltipTemplate: "<%= value + ' %' %>",
      scales: {
        xAxes: [{
          time: {
            unit: 'month'
          },
          gridLines: {
            display: false
          },
          ticks: {
            maxTicksLimit: 6
          }
        }],
        yAxes: [{
          ticks: {
            min: 0,
            max: max+100,
            maxTicksLimit: 5,
            callback : function (value) {
              return new Intl.NumberFormat('INA', { style: 'currency', currency: 'IDR' }).format(value)
            }
          },
          gridLines: {
            display: true
          }
        }],
      },
      legend: {
        display: false
      },
      tooltips : {
          callbacks : {
            label: function(tooltipItem, data) {
              return new Intl.NumberFormat('INA', { style: 'currency', currency: 'IDR' }).format(data['datasets'][0]['data'][tooltipItem['index']])
            },
          }
        }
    }
  });
}

