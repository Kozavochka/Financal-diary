<h1 class="mb-3">Криптовалюта</h1>
<canvas class="default-chart-size" id="myCryptoChart"></canvas>
<script>
    colors=[];
    for(let i=0;i<{{$assetsDataCollection['cryptos']->count()}};i++){
        this.colors.push('#'+Math.floor(Math.random()*16777215).toString(16));
    }
    var ctx = document.getElementById('myCryptoChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($assetsDataCollection['cryptos']->pluck('name')) !!},
            datasets: [{
                label: 'Криптовалюта $',
                data: {!! json_encode($assetsDataCollection['cryptos']->pluck('total_price')) !!},
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
