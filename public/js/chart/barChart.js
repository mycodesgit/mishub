$(function () {
    var ticksStyle = {
        fontColor: '#495057',
        fontStyle: 'bold'
    }

    var mode = 'index';
    var intersect = true;

    var $salesChart = $('#sales-chart');
    // eslint-disable-next-line no-unused-vars
    var salesChart = new Chart($salesChart, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [
                {
                    backgroundColor: '#00a65a',
                    borderColor: '#ced4da',
                    data: [
                        $salesChart.data('january'),
                        $salesChart.data('february'),
                        $salesChart.data('march'),
                        $salesChart.data('april'),
                        $salesChart.data('may'),
                        $salesChart.data('june'),
                        $salesChart.data('july'),
                        $salesChart.data('august'),
                        $salesChart.data('september'),
                        $salesChart.data('october'),
                        $salesChart.data('november'),
                        $salesChart.data('december'),
                    ],
                },
            ]
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                mode: mode,
                intersect: intersect,
                callbacks: {
                    title: function (tooltipItem, data) {
                        return data.labels[tooltipItem[0].index];
                    },
                    label: function (tooltipItem, data) {
                        return 'Count: ' + tooltipItem.value;
                    }
                }
            },
            hover: {
                mode: mode,
                intersect: intersect
            },
            legend: {
                display: false
            },
            scales: {
                // yAxes: [{
                //     display: true,
                //     gridLines: {
                //         display: true,
                //         lineWidth: '4px',
                //         color: 'rgba(0, 0, 0, .2)',
                //         zeroLineColor: 'transparent'
                //     },
                //     ticks: $.extend({
                //         beginAtZero: false,
                //         min: 1,
                //         // stepSize: 50 
                //     }, ticksStyle)
                // }],
                xAxes: [{
                    display: true,
                    gridLines: {
                        display: true
                    },
                    ticks: ticksStyle
                }]
            }
        }
    });
});