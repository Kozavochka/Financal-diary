@extends('layouts.admin')
@section('content')
    <h1 class="mb-3">Раздел статистик</h1>
    <ol class="list-group list-group-numbered">
        <li class="list-group-item list-group-item-action list-group-item-primary d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
                <div class="fw-bold"><a href="{{route('statistic.dynamic')}}">Статистика динамики портфеля</a></div>
                Позволяет увидеть и рассчитать динамику изменения стоимости портфеля
            </div>
        </li>
        <li class="list-group-item list-group-item-action list-group-item-success d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
                <div class="fw-bold"><a class="link-success" href="{{route('statistic.total')}}">Общая статистика портфеля</a></div>
                Позволяет посмотреть информацию о стоимости текущих направлениях
            </div>
        </li>
        <li class="list-group-item list-group-item-action list-group-item-info d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
                <div class="fw-bold"><a class="link-info" href="{{route('statistic.assets')}}">Статистика активов</a></div>
                Позволяет посмотреть стоимость текущих активов в различных направлениях
            </div>
        </li>
    </ol>
@endsection
