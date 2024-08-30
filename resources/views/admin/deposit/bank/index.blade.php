@extends('layouts.admin')
@section('content')

    <h1 class="mb-3">Банки</h1>

    <div class="mb-2">
        <a href="{{route('admin.deposits.index')}}" class="btn btn-link">Перейти к вкладам</a>
    </div>

    <div class="btn-group mt-2" role="group">
        <form action="{{ route('admin.bank.index') }}" method="get" class="form-inline">
            <div class="form-group mr-1">
                <input type="search" name="filter[name]" placeholder="" class="form-control">
            </div>
            <button type="submit" class="btn btn-blue-gray mr-1 ">Поиск</button>
            <a href="{{ route('admin.bank.index') }}" class="btn mr-1">Сбросить</a>
        </form>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">№</th>
            <th scope="col">Наименование</th>
            <th scope="col">Количество вкладов</th>
            <th scope="col">Сумма вкладов</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($banks as $bank)
            <tr>
                <th scope="row">{{$bank->id}}</th>
                <td>{{$bank->name}}</td>
                <td>{{$bank->deposits_count}}</td>
                <td>{{$bank->deposits_sum_price}}</td>
                <td><a href="{{route('admin.bank.edit', $bank)}}"><i class="fa-solid fa-pen"></i></a>
                    <form action="{{ route('admin.bank.destroy', $bank) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger"
                                onclick="return confirm('Вы уверены, что хотите удалить? Также удалятся все вклады');"
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
        <a href="{{route('admin.bank.create')}}" class="btn btn-success me-2">+ Добавить банк</a>
    </div>

@endsection
