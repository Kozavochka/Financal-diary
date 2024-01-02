<h1 class="mb-3">Облигации</h1>
<canvas class="default-chart-size" id="myBondChart"></canvas>
<script>
    colors=[];
    for(let i=0;i<{{$bonds->pluck('name')->count()}};i++){
        this.colors.push('#'+Math.floor(Math.random()*16777215).toString(16));
    }
    var ctx = document.getElementById('myBondChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($bonds->pluck('name')) !!},
            datasets: [{
                label: 'Облигации %',
                data: {!! json_encode($bonds->pluck('profit_percent')) !!},
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
<span>Средний %: {{round($bonds->avg('profit_percent'))}} </span>
