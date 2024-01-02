<h1 class="mb-3">Акции</h1>
<canvas style="max-height: 1000px; max-width: 1000px;" id="myStockChart"></canvas>
<script>
    colors=[];
    for(let i=0;i<{{$stocks->count()}};i++){
        this.colors.push('#'+Math.floor(Math.random()*16777215).toString(16));
    }
    var ctx = document.getElementById('myStockChart').getContext('2d');
    var myStockChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($stocks->pluck('name')) !!},
            datasets: [{
                label: 'Акции',
                data: {!! json_encode($stocks->pluck('total_price')) !!},
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
