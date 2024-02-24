@extends('layouts.admin')
@section('content')
    <form method="post" action="{{ route('admin.funds.update', $fund) }}" >
        @csrf
        @method('patch')
        <div class="form-group mb-3">
            <div class="flex">
                <div class="mr-2">
                    <label for="name" class="form-label">Название</label>
                    <input id="name" name="name"  class="form-control" type="text" placeholder="Введите название"
                       value="{{ old('name', $fund->name) }}">
                </div>
                <div class="mr-2">
                    <label for="ticker" class="form-label">Тикер</label>
                    <input id="ticker" name="ticker"  class="form-control ticker-input" type="text" placeholder="Введите название"
                       value="{{ old('ticker', $fund->ticker) }}">
                </div>
            </div>
        </div>

        <div class="form-group mb-3">
            <div>
                <label for="price" class="form-label">Цена</label>
                <input id="price"  name="price" class="form-control numeric-input" type="number" step="0.01" placeholder="Введите число"
                       value="{{ old('price', $fund->price) }}">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
@endsection
