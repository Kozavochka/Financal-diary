@extends('layouts.admin')
@section('content')
    <form method="post" action="{{ route('admin.currency.store') }}" >
        @csrf
        <div class="form-group">
            <div class="mb-3">
                <label for="name" class="form-label">Имя валютного счёта</label>
                <input id="name" name="name"  class="form-control text-input" type="text" placeholder="Введите название" >
            </div>
        </div>
        <div class="form-group">
            <div class="mb-3">
                <label for="price" class="form-label">Сумма</label>
                <input id="sum"  name="sum" class="form-control numeric-input" type="number" step="0.01" placeholder="Введите число">
            </div>
        </div>
        <div class="form-group">
            <div class="mb-3">
                <label for="name" class="form-label">Комментарий</label>
                <input id="comment" name="comment"  class="form-control text-input" type="text" placeholder="Введите комментарий" >
            </div>
        </div>
        <div class="form-group">
            <div class="mb-3">
                <select class="form-select text-input" aria-label="Default select example" name="currency_type_id">
                    <option selected>Выбор валюты</option>
                    @foreach($currencyTypes as $type)
                        <option value="{{$type->id}}">{{$type->ticker}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
