@extends('layouts.admin')
@section('content')

    <h1 class="mb-3">Валюта</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Название счёта</th>
            <th scope="col">Тикер валюты</th>
            <th scope="col">Количество</th>
            <th scope="col">Комментарий</th>
            <th scope="col">Действие</th>
        </tr>
        </thead>
        <tbody>
        @foreach($currencies as $currency)
            <tr>
                <th scope="row">{{$loop->index}}</th>
                <td>{{$currency->name}}</td>
                <td>{{$currency->currency_type->ticker}}</td>
                <td>{{$currency->sum}}</td>
                <td>{{$currency->comment}} </td>

                <td><a href="{{route('admin.currency.edit', $currency)}}"><i class="fa-solid fa-pen"></i></a>
                    <form action="{{ route('admin.currency.destroy', $currency) }}" method="POST" class="d-inline">
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
        <a href="{{route('admin.currency.create')}}" class="btn btn-success me-2">+ Добавить акцию</a>
    </div>

@endsection
