@extends('layouts.admin')
@section('content')

    <h1>Общая стоимость портфеля: {{$dataChart['total']}} RUB</h1>

    <table class="table" style="max-width: 500px">
        <thead>
        <tr>
            <th scope="col">Направление</th>
            <th scope="col">Стоимость RUB</th>
            <th scope="col">%</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $key => $value)
            <tr>
                <td>{{$key}}</td>
                <td>{{$value}}</td>
                <td>
                    @if($dataChart['total'] == 0) 0
                    @else {{round($value / $dataChart['total'] * 100, 2)}} @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <canvas id="myTotalChart"></canvas>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

    <script>
        var ctx = document.getElementById('myTotalChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($dataChart['labels']) !!},
                datasets: [{
                    label: 'Состав',
                    data: {!! json_encode($dataChart['numeric']) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(22, 185, 71, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(22, 185, 71, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>

@endsection
