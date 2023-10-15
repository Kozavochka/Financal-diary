@extends('layouts.admin')
@section('content')
    <h1>Поступления</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Тип</th>
            <th scope="col">Сумма</th>
            <th scope="col">Описание</th>
        </tr>
        </thead>
        <tbody>
        @foreach($incomes as $income)
            <tr>
                <th scope="row">{{$income->id}}</th>
                <td>{{$income->income_type->name}}</td>
                <td>{{$income->price}}</td>
                <td>{{$income->description}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="{{route('admin.incomes.create')}}" class="btn btn-success me-2">+ Новое поступление</a>
    </div>
@endsection
