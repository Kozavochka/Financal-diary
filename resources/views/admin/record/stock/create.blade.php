@extends('layouts.admin')
@section('content')
    <form method="post" action="{{ route('stocks.record.store') }}" >
        @csrf

        <div class="form-group">
            <div class="mb-3">
                <label for="description" class="form-label">Описание</label>
                <input id="description" name="description"  class="form-control" type="text" placeholder="Введите название" >
            </div>
        </div>

        <div class="form-group">
            <div class="mb-3">
                <label for="stocks" class="form-label">id компании</label>
                <input id="stocks"  name="stocks[0][stock_id]" class="form-control" type="number" placeholder="Введите число">
            </div>
        </div>
        <div class="form-group">
            <div class="mb-3">
                <label for="prices" class="form-label">Цена</label>
                <input id="prices"  name="stocks[0][price]" class="form-control" type="number" placeholder="Введите число">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
