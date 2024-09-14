<h1 class="mb-3">Займы</h1>
<canvas class="default-chart-size" id="myLoanChart"></canvas>
<script>
    colors=[];
    for(let i=0;i<{{$assetsDataCollection['loans']->count()}};i++){
        this.colors.push('#'+Math.floor(Math.random()*16777215).toString(16));
    }
    var ctx = document.getElementById('myLoanChart').getContext('2d');
    var myStockChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($assetsDataCollection['loans']->pluck('company.name')) !!},
            datasets: [{
                label: 'Займы',
                data: {!! json_encode($assetsDataCollection['loans']->pluck('price')) !!},
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
