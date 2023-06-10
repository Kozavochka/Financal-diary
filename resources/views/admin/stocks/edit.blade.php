@extends('layouts.admin')
@section('content')
    <form method="post" action="{{ route('admin.stocks.update', $stock) }}" >
        @csrf
        @method('patch')
        <div class="form-group">
            <div class="mb-3">
                <label for="name" class="form-label">Название</label>
                <input id="name" name="name"  class="form-control" type="text" placeholder="Введите название"
                       value="{{ old('name', $stock->name) }}">
            </div>
        </div>
        <div class="form-group">
            <div class="mb-3">
                <label for="ticker" class="form-label">Тикер</label>
                <input id="ticker" name="ticker"  class="form-control" type="text" placeholder="Введите название"
                       value="{{ old('ticker', $stock->ticker) }}">
            </div>
        </div>

        <div class="form-group">
            <div class="mb-3">
                <label for="price" class="form-label">Цена за лот</label>
                <input id="price"  name="price" class="form-control" type="number" step="0.01" placeholder="Введите число"
                       value="{{ old('price', $stock->price) }}">
            </div>
        </div>
        <div class="form-group">
            <div class="mb-3">
                <label for="lots" class="form-label">Количество лотов</label>
                <input id="lots"  name="lots" class="form-control" type="number" placeholder="Введите число"
                       value="{{ old('lots', $stock->lots) }}" >
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
