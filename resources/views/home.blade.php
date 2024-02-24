@extends('layouts.app')

@section('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-5">
                        <h1>Вы авторизованы</h1>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
            </div>
            <div class="col-md-8 mb-5">
                <div class="card-header">
                    <h2>Состав портфеля</h2>
                    <p class="text-success">Общая стоимость: {{$dataChart['total']}} RUB</p>
                </div>
                <div class="card">
                    <table class="table" style="max-width: 500px">
                        <thead>
                        <tr>
                            <th scope="col">Направление</th>
                            <th scope="col">Стоимость</th>
                            <th scope="col">%</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $key => $value)
                            <tr>
                                <td>{{$key}}</td>
                                <td>{{$data[$key]}} RUB</td>
                                <td>{{bcdiv($data[$key] / $dataChart['total'] * 100,1,0)}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>Наличные</td>
                            <td>{{$cashSum}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <canvas id="myChart"></canvas>
                </div>
                <script>
                    var ctx = document.getElementById('myChart').getContext('2d');
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
                                    'rgba(22, 185, 71, 0.2)',
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
            </div>
            <div class="col-md-8">
                <button type="button" class="btn btn-light"><a href="{{route('general_pdf')}}"><i class="fa-solid fa-file-pdf">
                        </i> Скачать PDF</a></button>
            </div>
        </div>
    </div>
@endsection
