<h1 class="mb-3">Депозиты</h1>
<canvas class="default-chart-size" id="myDepositChart"></canvas>
<script>
    colors=[];
    for(let i=0;i<{{$assetsDataCollection['deposits']->count()}};i++){
        this.colors.push('#'+Math.floor(Math.random()*16777215).toString(16));
    }
    var ctx = document.getElementById('myDepositChart').getContext('2d');
    var myStockChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($assetsDataCollection['deposits']->pluck('bank.name')) !!},
            datasets: [{
                label: 'Депозиты',
                data: {!! json_encode($assetsDataCollection['deposits']->pluck('price')) !!},
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
