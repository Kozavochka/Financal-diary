@extends('layouts.app')
@section('content')
    <div class="container">{{--????--}}

    <h1 class="mb-3">Акции</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Тикер</th>
            <th scope="col">Отрасль</th>
            <th scope="col">Стоимость</th>
        </tr>
        </thead>
        <tbody>
        @foreach($stocks as $stock)
            <tr>
                <th scope="row">{{$stock->id}}</th>
                <td><a href="{{route('stocks.show', $stock)}}">{{$stock->name}}</a> </td>
                <td>{{$stock->ticker}}</td>
                <td>{{$stock->industry->name}}</td>
                <td>{{$stock->total_price}} RUB</td>

            </tr>
        @endforeach
        </tbody>
    </table>
    {{$stocks->withQueryString()->links('pagination::bootstrap-5')}}

    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="{{ url()->current() }}?filter[asc_price]=true" class="btn btn-info me-2">Сортировка по стоимости</a>
        <div class="dropdown me-2">
            <a class="btn btn-secondary dropdown-toggle" href=" " role="button" id="dropdownMenuLink"
               data-bs-toggle="dropdown" aria-expanded="false">
                Фильтр отрасли
            </a>
            @include('filters.filter_industry')
        </div>
        <a href="{{ route('excel_export') }}?filter[asc_price]=true" class="btn btn-success me-2">
            <i class="fa-solid fa-file-excel"></i>Excel</a>
        <a class="nav-link active" aria-current="page"
           href="{{ url()->current() }}?{{ http_build_query(request()->except('filter')) }}">Сбросить
            фильтр</a>

    </div>
    <div class="col col-xl-4">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Отрасль</th>
                        <th scope="col">Кол-во</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($industries as $industry)
                        <tr>
                            <td>{{$industry->name}}</td>
                            <td>{{$industry->stocks_count}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
    </div>
    <canvas id="myChart"></canvas>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Стоимость компаний',
                    data: {!! json_encode($data_price) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(123, 229, 50, 0.2)',
                        'rgba(2, 123, 30, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(123, 229, 50, 0.2)',
                        'rgba(2, 123, 30, 0.2)'
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
