@extends('layouts.admin')
@section('content')

    <h1 class="mb-3">Денежные счета</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Остаток</th>
        </tr>
        </thead>
        <tbody>
        @foreach($cashes as $cash)
            <tr>
                <th scope="row">{{$loop->index + 1}}</th>
                <td>{{$cash->name}}</td>
                <td>{{$cash->sum}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div><a href="{{route('admin.cash.create')}}" class="btn btn-success">+ Добавить денежный счёт</a></div>
@endsection
