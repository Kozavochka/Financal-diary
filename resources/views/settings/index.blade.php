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

    <div class="mt-4">
        <form method="post" action="{{ route('settings.update') }}" >
            @csrf
            <button class="btn btn-success me-2">
                Обновить настройки FRONTIERS
            </button>
            <div class="flex">
                <div class="mr-2">
                    <label for="login" class="form-label">Логин</label>
                    <input id="login"  name="settings[0][key]" class="form-control numeric-input" type="hidden" value="frontiers_login">
                    <input id="login"  name="settings[0][value]" class="form-control numeric-input" type="text" required>
                </div>
                <div class="mr-2">
                    <label for="password" class="form-label">Пароль</label>
                    <input id="login"  name="settings[1][key]" class="form-control numeric-input" type="hidden" value="frontiers_password">
                    <input id="password"  name="settings[1][value]" class="form-control numeric-input" type="text" required>
                </div>
            </div>
        </form>
    </div>
@endsection
