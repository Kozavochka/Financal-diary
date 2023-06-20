@extends('layouts.admin')
@section('content')
<form method="post" action="{{ route('stocks.record.store') }}" >
@csrf

<div class="form-group">
    <div class="mb-3">
        <label for="description" class="form-label">Описание</label>
        <input id="description" name="description"  class="form-control" type="text" placeholder="Введите описание" >
    </div>
</div>

<div class="container">
    <div class="row">
        @foreach($stocks as $stock)
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5>{{$stock->name}}</h5>
                        <input type="hidden" name="stocks[{{$loop->index}}][stock_id]" value="{{$stock->id}}">

                        <label for="prices" class="form-label">Цена</label>
                        <input id="prices"  name="stocks[{{$loop->index}}][price]" class="form-control card-text"
                               type="number" step="0.01" placeholder="Введите число">
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
