<h1 class="mb-3">Фонды</h1>
<canvas class="default-chart-size" id="myFundsChart"></canvas>

<script>
    colors=[];
    for(let i=0;i<{{$assetsDataCollection['funds']->count()}};i++){
        this.colors.push('#'+Math.floor(Math.random()*16777215).toString(16));
    }
    var ctx = document.getElementById('myFundsChart').getContext('2d');
    var myStockChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($assetsDataCollection['funds']->pluck('name')) !!},
            datasets: [{
                label: 'Фонды',
                data: {!! json_encode($assetsDataCollection['funds']->pluck('total_price')) !!},
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
