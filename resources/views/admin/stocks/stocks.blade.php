@extends('layouts.admin')
@section('content')
    <h1 class="mb-3">Акции</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Тикер</th>
            <th scope="col">Стоимость</th>
            <th scope="col">Действие</th>
        </tr>
        </thead>
        <tbody>
        @foreach($stocks as $stock)
            <tr>
                <th scope="row">{{$stock->id}}</th>
                <td>{{$stock->name}}</td>
                <td>{{$stock->ticker}}</td>
                <td>{{$stock->total_price}} RUB</td>
                <td><a href="{{route('admin.stocks.edit', $stock)}}"><i class="fa-solid fa-pen"></i></a>
                    <form action="{{ route('admin.stocks.destroy', $stock) }}" method="POST" class="d-inline">
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
    {{$stocks->withQueryString()->links('pagination::bootstrap-5')}}
    <div><a href="{{route('admin.stocks.create')}}" class="btn btn-success">+ Добавить акцию</a></div>
@endsection
