<h1 class="mb-3">Крипта</h1>
<canvas class="default-chart-size" id="myCryptoChart"></canvas>
<script>
    colors=[];
    for(let i=0;i<{{$crypto->pluck('name')->count()}};i++){
        this.colors.push('#'+Math.floor(Math.random()*16777215).toString(16));
    }
    var ctx = document.getElementById('myCryptoChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($crypto->pluck('name')) !!},
            datasets: [{
                label: 'Крипта $',
                data: {!! json_encode($crypto->pluck('price')) !!},
                backgroundColor: this.colors
            }],
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
        }
    });
</script>
