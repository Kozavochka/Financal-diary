@extends('layouts.admin')
@section('content')
    <h1 class="mb-5">Настройки</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Значение</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($settings as $setting)
            <tr>
                <th scope="row">{{$loop->index + 1}}</th>
                <td>{{$setting->getKey()}}</td>
                <td>{{$setting->getValuePrice()}}</td>
                <td></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="btn-group" role="group" aria-label="Basic example">
        <form method="post" action="{{ route('settings.usd_update') }}" >
            @csrf
            <button class="btn btn-success me-2">
                <i class="fa-solid fa-dollar-sign"></i>
                Обновить USD
            </button>
        </form>
        <form method="post" action="{{ route('settings.total_price_update') }}" >
            @csrf
            <button class="btn btn-success me-2">
                <i class="fa-solid fa-money-bill-wave"></i>
                Обновить общую сумму
            </button>
        </form>
    </div>
@endsection
