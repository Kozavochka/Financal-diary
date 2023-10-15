@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card text-center">
            <div class="card-header">
                Доля от всего портфеля: {{ bcdiv($stock->total_price/$total,3 ,4)*100  }} %
            </div>
            <div class="card-body">
                <h5 class="card-title">{{$stock->name}}</h5>
                <p class="card-text">Цена акции на момент последнего отслеживания ({{$stock->updated_at}}):
                    <br>{{$stock->price}} RUB, количество лотов: {{$stock->lots}}</p>
                <p class="card-text">Тикер {{$stock->ticker}}, отрасль: {{$stock->industry->name}}</p>

                <a href="{{url()->previous()}}" class="btn btn-primary">Назад</a>
            </div>
        </div>
    </div>

@endsection
