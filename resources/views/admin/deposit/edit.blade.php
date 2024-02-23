@extends('layouts.admin')
@section('content')
    <form method="post" action="{{ route('admin.deposits.update',$deposit) }}" >
        @csrf
        <div class="form-group mb-3">
            <div class="flex">
                <div class="mr-2">
                    <label for="bank_name" class="form-label">Банк</label>
                    <input id="bank_name" name="bank_name"  class="form-control text-input" type="text" placeholder="Введите название"
                       value="{{ old('bank_name', $deposit->bank_name) }}">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="flex">
                <div class="mr-2">
                    <label for="price" class="form-label">Сумма</label>
                    <input id="price"  name="price" class="form-control numeric-input" type="number" step="0.01"
                       value="{{ old('price', $deposit->price) }}">
                </div>
                <div class="mr-2">
                    <label for="percent" class="form-label">Процент годовых</label>
                    <input id="percent"  name="percent" class="form-control numeric-input" type="number" step="0.01"
                       value="{{ old('percent', $deposit->percent) }}">
                </div>
            </div>
        </div>

        <div class="form-group mb-3">
            <div>
                <label for="expiration_date" class="form-label">Дата окончания</label>
                <input id="expiration_date"  name="expiration_date" class="form-control date-input" type="date" placeholder="Введите дату"
                       value="{{ old('expiration_date', $deposit->expiration_date) }}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
@endsection
