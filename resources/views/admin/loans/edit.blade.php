@extends('layouts.admin')
@section('content')
    <form method="post" action="{{ route('admin.loans.update', $loan) }}" >
        @csrf
        @method('patch')
        <div class="form-group">
        <div class="flex">
                <div class="mr-2">
                    <label for="name" class="form-label">Название</label>
                    <input id="name" name="name"  class="form-control text-input" type="text" placeholder="Введите название"
                       value="{{ old('name', $loan->name) }}">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="flex">
                <div class="mr-2">
                    <label for="price" class="form-label">Цена</label>
                    <input id="price"  name="price" class="form-control numeric-input" type="number" step="0.01"
                       value="{{ old('price', $loan->price) }}">
                </div>
                <div class="mr-2">
                    <label for="count_bus" class="form-label">Количество компаний</label>
                    <input id="count_bus"  name="count_bus" class="form-control numeric-input" type="number" step="0.01"
                       value="{{ old('count_bus', $loan->price) }}">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
@endsection
