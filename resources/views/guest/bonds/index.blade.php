@extends('layouts.app')
@section('content')

    <div class="container">
        <h1>Облигации</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Название</th>
                <th scope="col">Тикер</th>
                <th scope="col">Купон</th>
                <th scope="col">%</th>
                <th scope="col">Дата погашения</th>
            </tr>
            </thead>
            <tbody>
            @foreach($bonds as $bond)
                <tr>
                    <th scope="row">{{$bond->id}}</th>
                    <td>{{$bond->name}}</td>
                    <td>{{$bond->ticker}}</td>
                    <td>{{$bond->coupon}} RUB</td>
                    <td>{{$bond->profit_percent}} %</td>
                    <td>{{$bond->expiration_date}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
            <span><b>Средний %:</b>{{bcdiv($bonds->avg('profit_percent'),1,0)}} </span>
            <span><b>Средний купон:</b> {{bcdiv($bonds->avg('coupon'),1,0)}} RUB</span>
        </div>
        <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{ url()->current() }}?filter[asc_percent]=true" class="btn btn-info me-2">Сортировка по %</a>
            <a href="{{ url()->current() }}?filter[asc_coupon]=true" class="btn btn-info me-2">Сортировка по купону</a>
            <a href="{{ url()->current() }}?filter[asc_date]=true" class="btn btn-info me-2">Сортировка по дате погашения</a>
            <a class="nav-link active" aria-current="page"
               href="{{ url()->current() }}?{{ http_build_query(request()->except('filter')) }}">Сбросить
                фильтр</a>
        </div>
    </div>
@endsection
