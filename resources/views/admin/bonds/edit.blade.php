@extends('layouts.admin')
@section('content')
    <form method="post" action="{{ route('admin.bonds.update', $bond) }}" >
        @csrf
        @method('patch')
        <div class="form-group">
            <div class="mb-3">
                <label for="name" class="form-label">Название</label>
                <input id="name" name="name"  class="form-control" type="text" placeholder="Введите название"
                       value="{{ old('name', $bond->name) }}">
            </div>
        </div>
        <div class="form-group">
            <div class="mb-3">
                <label for="ticker" class="form-label">Тикер</label>
                <input id="ticker" name="ticker"  class="form-control" type="text" placeholder="Введите название"
                       value="{{ old('ticker', $bond->ticker) }}">
            </div>
        </div>

        <div class="form-group">
            <div class="mb-3">
                <label for="price" class="form-label">Цена</label>
                <input id="price"  name="price" class="form-control" type="number" step="0.01" placeholder="Введите число" value="1000">
            </div>
        </div>
        <div class="form-group">
            <div class="mb-3">
                <label for="coupon" class="form-label">Купон</label>
                <input id="coupon"  name="coupon" class="form-control" type="number"  step="0.01" placeholder="Введите число"
                       value="{{ old('coupon', $bond->coupon) }}">
            </div>
        </div>
        <div class="form-group">
            <div class="mb-3">
                <label for="profit_percent" class="form-label">%</label>
                <input id="profit_percent"  name="profit_percent" class="form-control" type="number"  step="0.01" placeholder="Введите число"
                       value="{{ old('profit_percent', $bond->profit_percent) }}">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
