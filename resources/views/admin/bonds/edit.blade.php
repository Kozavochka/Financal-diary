@extends('layouts.admin')
@section('content')
    <form method="post" action="{{ route('admin.bonds.update', $bond) }}" >
        @csrf
        @method('patch')
        <div class="form-group mb-3">
            <div class="row justify-content-start">
                <div class="col-2">
                    <label for="name" class="form-label text-input">Название</label>
                    <input id="name" name="name"  class="form-control" type="text" placeholder="Введите название"
                       value="{{ old('name', $bond->name) }}">
                </div>
                <div class="col-2">
                  <label for="ticker" class="form-label ticker-input">Тикер</label>
                  <input id="ticker" name="ticker"  class="form-control" type="text" placeholder="Введите название"
                        value="{{ old('ticker', $bond->ticker) }}">
                </div>
            </div>
        </div>

        <div class="form-group mb-3">
            <div class="flex">
                <div class="mr-2">
                    <label for="price" class="form-label">Цена</label>
                    <input id="price"  name="price" class="form-control numeric-input" type="number" step="0.01" placeholder="Введите число"
                       value="{{ old('ticker', $bond->price) }}">
                </div>
                <div class="mr-2">
                    <label for="coupon" class="form-label">Купон</label>
                    <input id="coupon"  name="coupon" class="form-control numeric-input" type="number"  step="0.01" placeholder="Введите число"
                       value="{{ old('coupon', $bond->coupon) }}">
                </div>
                <div class="mr-2">
                    <label for="profit_percent" class="form-label">%</label>
                    <input id="profit_percent"  name="profit_percent" class="form-control numeric-input" type="number"  step="0.01" placeholder="Введите число"
                           value="{{ old('profit_percent', $bond->profit_percent) }}">
                </div>
            </div>
        </div>

        <div class="form-group mb-3">
            <div>
                <label for="expiration_date" class="form-label">Дата окончания</label>
                <input id="expiration_date"  name="expiration_date" class="form-control date-input" type="date" placeholder="Введите дату"
                       value="{{ old('expiration_date', $bond->expiration_date) }}" >
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
