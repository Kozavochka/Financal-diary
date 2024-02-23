@extends('layouts.admin')
@section('content')
    <form method="post" action="{{ route('admin.crypto.update', $crypto) }}" >
        @csrf
        @method('patch')
        <div class="form-group mb-3">
            <div class="flex">
                <div class="mr-2">
                    <label for="name" class="form-label">Название</label>
                    <input id="name" name="name"  class="form-control text-input" type="text" placeholder="Введите название"
                       value="{{ old('name', $crypto->name) }}">
                </div>
                <div class="mr-2">
                    <label for="ticker" class="form-label">Тикер</label>
                    <input id="ticker" name="ticker"  class="form-control ticker-input" type="text" placeholder="Тикер"
                       value="{{ old('ticker', $crypto->ticker) }}">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="flex">
                <div class="mr-2">
                    <label for="price" class="form-label">Стоимость</label>
                    <input id="price"  name="price" class="form-control numeric-input" type="number" step="0.01"
                       value="{{ old('price', $crypto->price) }}">
                </div>
                <div class="mr-2">
                    <label for="lots" class="form-label">Количество лотов</label>
                    <input id="lots"  name="lots" class="form-control" type="number" step="0.00001"
                       value="{{ old('lots', $crypto->lots) }}" >
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
@endsection
