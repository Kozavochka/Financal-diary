@extends('layouts.admin')
@section('content')

    <h1 class="mb-3">Вклады</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Банк</th>
            <th scope="col">Сумма</th>
            <th scope="col">Дата окочания</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($deposits as $deposit)
            <tr>
                <th scope="row">{{$stock->id}}</th>
                <td>{{$deposit->bank_name}}</td>
                <td>{{$deposit->price}}</td>
                <td>{{$deposit->expiration_date}}</td>
                <td><a href="{{route('admin.stocks.edit', $deposit)}}"><i class="fa-solid fa-pen"></i></a>
                    <form action="{{ route('admin.stocks.destroy', $deposit) }}" method="POST" class="d-inline">
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
        <a href="{{route('admin.stocks.create')}}" class="btn btn-success me-2">+ Добавить вклад</a>
    </div>

@endsection
