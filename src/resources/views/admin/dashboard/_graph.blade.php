<canvas id="GraphDataForCustomerCountArea" class="chartjs-render-monitor" style="display: block;"></canvas>
<script>
  var GraphDataForCustomerCountArea = document.getElementById("GraphDataForCustomerCountArea");
  $(function () {
    updateGraphDataForCustomerCount();
  })
  function updateGraphDataForCustomerCount () {
    var params = {
      type: $("#customer_count_conditions [name=type]").val(),
      start: $("#customer_count_conditions [name=start]").val(),
      end: $("#customer_count_conditions [name=end]").val(),
    };
    $("#GraphDataForCustomerCountArea").css({'opacity' : 0.5, 'cursor': 'wait'});
    $.ajax({
      url: "{{ route('admin._getGraphDataForCustomerCount') }}",
      type: "GET",
      cache: false,
      data: params,
      success: function(data) {
        $("#GraphDataForCustomerCountArea").css({'opacity': 1, 'cursor': 'default'});
        makeGraphDataForCustomerCount(data.labels, data.data);
      },
      error: function(data) {
        //
      }
    });
  }

  function makeGraphDataForCustomerCount (labels, data) {
    if (typeof GraphDataForCustomerCount !== 'undefined' && GraphDataForCustomerCount) {
      GraphDataForCustomerCount.destroy();
    }
    window.GraphDataForCustomerCount = new Chart(GraphDataForCustomerCountArea, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          type: 'bar',
          label: '会員数',
          data: data,
          backgroundColor: '#47172D',
          borderColor: "#fff",
          hoverBackgroundColor: "#E33F62",
          // バーの境界線の太さ(ピクセル単位)
          borderWidth: 0,
          // データセットが属するグループのID
          stack: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          position: "bottom",
          labels: {
            fontSize: 10,
            fontFamily: "'Roboto,noto sans japanese',sans-serif",
            fontColor: '#333',
            fontStyle: '600',
          }
        },
        scales: {
          xAxes: [{
            categoryPercentage: 0.3,
            scaleLabel: {
              display: true,
              labelString: '月',
              fontSize: 11,
              fontColor: '#C1C5D3'
            },
            barPercentage: 0.6,
            gridLines: {
              display: false,
              drawBorder: false,
            },
            ticks: {
              fontSize: 11,
              fontFamily: "'Roboto',sans-serif",
              fontColor: '#C1C5D3',
              fontStyle: '300'
            },
            stacked: true
          }],
          yAxes: [{
            scaleLabel: {
              display: true,
              labelString: '人',
              fontSize: 11,
              fontColor: '#C1C5D3'
            },
            stacked: true,
            ticks: {
              suggestedMax: 100,
              suggestedMin: 0,
              stepSize: 1000,
              fontSize: 12,
              fontFamily: "'Roboto',sans-serif",
              fontColor: '#C1C5D3',
              fontStyle: '300'
            },
            gridLines: {
              drawBorder: false,
              color: '#ECEDF2'
            }
          }]
        }
      }
    });
  }
</script>
