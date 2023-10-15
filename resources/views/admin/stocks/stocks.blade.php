@extends('layouts.admin')
@section('content')

    <h1 class="mb-3">Акции</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Тикер</th>
            <th scope="col">Отрасль</th>
            <th scope="col">Стоимость</th>
            <th scope="col">Действие</th>
        </tr>
        </thead>
        <tbody>
        @foreach($stocks as $stock)
            <tr>
                <th scope="row">{{$stock->id}}</th>
                <td>{{$stock->name}}</td>
                <td>{{$stock->ticker}}</td>
                <td>{{$stock->industry->name}}</td>
                <td>{{$stock->total_price}} RUB</td>

                <td><a href="{{route('admin.stocks.edit', $stock)}}"><i class="fa-solid fa-pen"></i></a>
                    <form action="{{ route('admin.stocks.destroy', $stock) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger"
                                onclick="return confirm('Вы уверены, что хотите удалить?');"
                                data-toggle="tooltip" data-placement="top" title="Удалить">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$stocks->withQueryString()->links('pagination::bootstrap-5')}}

    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="{{route('admin.stocks.create')}}" class="btn btn-success me-2">+ Добавить акцию</a>
        <a href="{{route('excel_export')}}" class="btn btn-success me-2">Excel</a>
        <a href="{{ url()->current() }}?filter[asc_price]=true" class="btn btn-info me-2">Сортировка по стоимости</a>
        <a class="nav-link active" aria-current="page"
           href="{{ url()->current() }}?{{ http_build_query(request()->except('filter')) }}">Сбросить
            фильтр</a>
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
                    data: {!! json_encode($data) !!},
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
