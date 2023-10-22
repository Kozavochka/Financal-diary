@extends('layouts.admin')
@section('content')
    <form method="post" action="{{ route('admin.incomes.store') }}" >
        @csrf
        <div class="form-group">
            <div class="mb-3">
                <select class="form-select" aria-label="Default select example" id="industry_id" name="income_type_id">
                    <option selected>Выбор типа поступления</option>
                    @foreach($income_types as $type)
                        <option value="{{$type->id}}">{{$type->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="mb-3">
                <label for="price" class="form-label">Сумма</label>
                <input id="price"  name="price" class="form-control" type="number" step="0.01" placeholder="Введите число">
            </div>
        </div>
        <div class="form-group">
            <div class="mb-3">
                <label for="description" class="form-label">Описание</label>
                <input id="description" name="description"  class="form-control" type="text" placeholder="Введите название" >
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>

    </form>
@endsection
