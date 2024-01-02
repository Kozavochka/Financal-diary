<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<canvas style="max-height: 1000px; max-width: 500px;" id="myDynamicChart"></canvas>
<script>
    colors=[];
    for(let i=0;i<{{$statistics->pluck('created_at')->count()}};i++){
        this.colors.push('#'+Math.floor(Math.random()*16777215).toString(16));
    }
    var ctx = document.getElementById('myDynamicChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($statistics->pluck('id')) !!},
            datasets: [{
                label: 'Total sum',
                data: {!! json_encode($statistics->pluck('total_sum')) !!},
                backgroundColor: this.colors,
                fill:false
            }],
        },

    });
</script>
