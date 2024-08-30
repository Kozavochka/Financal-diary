<h1 class="mb-3">Отрасли</h1>
<canvas class="industry-chart" id="myIndustryChart"></canvas>
<script>
    colors=[];
    for(let i=0;i<{{$industries->pluck('name')->count()}};i++){
        this.colors.push('#'+Math.floor(Math.random()*16777215).toString(16));
    }
    var ctx = document.getElementById('myIndustryChart').getContext('2d');
    var myIndustryChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($industries->pluck('name')) !!},
            datasets: [{
                label: 'Количество',
                data: {!! json_encode($industries->pluck('stocks_count')) !!},
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
<canvas class="industry-chart" id="myIndustrySumChart"></canvas>
<script>
    colors=[];
    for(let i=0;i<{{$industries->pluck('name')->count()}};i++){
        this.colors.push('#'+Math.floor(Math.random()*16777215).toString(16));
    }
    var ctx = document.getElementById('myIndustrySumChart').getContext('2d');
    var myIndustryChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($industries->pluck('name')) !!},
            datasets: [{
                label: 'Стоимость',
                data: {!! json_encode($industries->pluck('total_price')) !!},
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
