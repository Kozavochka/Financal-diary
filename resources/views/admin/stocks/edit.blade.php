@extends('layouts.admin')
@section('content')
    <form method="post" action="{{ route('admin.stocks.update', $stock) }}" >
        @csrf
        @method('patch')
        <div class="form-group mb-3">
                <div class="row justify-content-start">
                    <div class="col-3">
                        <label for="name" class="form-label">Название</label>
                        <input id="name" name="name"  class="form-control text-input" type="text" placeholder="Введите название"
                               value="{{ old('name', $stock->name) }}">
                    </div>
                    <div class="col-3">
                        <label for="ticker" class="form-label">Тикер</label>
                        <input id="ticker" name="ticker"  class="form-control ticker-input" type="text" placeholder="Введите название"
                               value="{{ old('ticker', $stock->ticker) }}">
                    </div>
                </div>
        </div>

        <div class="form-group mb-3">
            <div class="row justify-content-start">
                <div class="col-2">
                    <label for="price" class="form-label">Цена за лот</label>
                    <input id="price"  name="price" class="form-control numeric-input" type="number" step="0.01" placeholder="Введите число"
                         value="{{ old('price', $stock->price) }}">
                    </div>
                <div class="col-2">
                    <label for="lots" class="form-label">Количество лотов</label>
                    <input id="lots"  name="lots" class="form-control numeric-input" type="number" placeholder="Введите число"
                          value="{{ old('lots', $stock->lots) }}" >
                </div>
            </div>
        </div>

        <div class="form-group mb-3">
            <div>
                <label for="direction_id" class="form-label">Выбор отрасли</label>
                <select class="form-select text-input" aria-label="Default select example" id="industry_id" name="industry_id">
                    @if(isset($stock->industry->id))
                        <option selected value="{{$stock->industry->id}}" >{{$stock->industry->name}}</option>
                    @endif
                    @foreach($industries as $industry)
                        <option value="{{$industry->id}}">{{$industry->name}}</option>
                    @endforeach
                 </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
