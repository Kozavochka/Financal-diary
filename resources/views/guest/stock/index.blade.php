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
                <td><a class="href_style" href="{{route('stocks.show', $stock)}}">{{$stock->name}}</a> </td>
                <td>{{$stock->ticker}}</td>
                <td>{{$stock->industry?->name}}</td>
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

@endsection
