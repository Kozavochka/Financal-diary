@extends('layouts.admin')
@section('content')
    <form method="post" action="{{ route('admin.currency.update', $currency) }}" >
        @csrf
        @method('patch')
        <div class="form-group">
            <div class="flex">
                 <div class="mr-2">
                    <label for="name" class="form-label">Имя валютного счёта</label>
                    <input id="name" name="name"  class="form-control text-input" type="text" placeholder="Введите название"
                   value="{{ old('name', $currency->name) }}">
                </div>
                <div class="mr-2">
                    <label for="name" class="form-label">Комментарий</label>
                    <input id="comment" name="comment"  class="form-control text-input" type="text" placeholder="Введите комментарий"
                           value=" {{ old('comment', $currency->comment) }}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="flex">
                 <div class="mr-2">
                  <label for="price" class="form-label">Сумма</label>
                    <input id="sum"  name="sum" class="form-control numeric-input" type="number" step="0.01" placeholder="Введите число"
                       value="{{ old('sum', $currency->sum) }}">
                 </div>
                 <div class="mr-2">
                     <label for="currency_type_id" class="form-label">Валюта</label>
                     <select class="form-select text-input" aria-label="Default select example" name="currency_type_id">
                         <option value="{{ old('currency_type_id', $currency->currency_type_id) }}" selected>{{ old('currency_type', $currency->currency_type->ticker) }}</option>
                         @foreach($currencyTypes as $type)
                                <option value="{{$type->id}}">{{$type->ticker}}</option>
                         @endforeach
                     </select>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
@endsection
