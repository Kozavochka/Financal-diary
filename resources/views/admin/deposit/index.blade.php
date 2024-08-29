@extends('layouts.admin')
@section('content')

    <h1 class="mb-1">Вклады</h1>

    <div class="mb-2">
        <a href="{{route('admin.bank.index')}}" class="btn btn-link">Перейти к банкам</a>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">№</th>
            <th scope="col">Банк</th>
            <th scope="col">Сумма, RUB</th>
            <th scope="col">Дата окончания</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($deposits as $deposit)
            <tr>
                <th scope="row">{{$deposit->id}}</th>
                <td>{{$deposit->bank->name}}</td>
                <td>{{$deposit->price}}</td>
                <td>{{$deposit->expiration_date}}</td>
                <td><a href="{{route('admin.deposits.edit', $deposit)}}"><i class="fa-solid fa-pen"></i></a>
                    <form action="{{ route('admin.deposits.destroy', $deposit) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger"
                                onclick="return confirm('Вы уверены, что хотите удалить?');"
                                data-toggle="tooltip" data-placement="top" title="Удалить">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="{{route('admin.deposits.create')}}" class="btn btn-success me-2">+ Добавить вклад</a>
    </div>

@endsection
