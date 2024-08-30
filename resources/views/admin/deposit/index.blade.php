@extends('layouts.admin')
@section('content')

    <h1 class="mb-1">Вклады</h1>

    <div class="mb-2">
        <a href="{{route('admin.bank.index')}}" class="btn btn-link">Перейти к банкам</a>
    </div>

    <div class="btn-group mt-2" role="group">
        <form action="{{ route('admin.deposits.index') }}" method="get" class="form-inline">
            <div class="form-group mr-1">
                <input type="search" name="filter[search]" placeholder="" class="form-control">
            </div>
            <button type="submit" class="btn btn-blue-gray mr-1 ">Поиск</button>
            <a href="{{ route('admin.deposits.index') }}" class="btn mr-1">Сбросить фильтр</a>
        </form>
    </div>


    <table class="table">
        <thead>
        <tr>
            <th scope="col">№</th>
            <th scope="col">Банк</th>
            <th scope="col">Тип</th>
            <th scope="col">
                Сумма, RUB
                <a class="active link-secondary" href="{{ url()->current() }}?sort=price"><i>▲</i></a>
                <a class="active link-secondary" href="{{ url()->current() }}?sort=-price"><i>▼</i></a>
            </th>
            <th scope="col">
                Процент годовых
                <a class="active link-secondary" href="{{ url()->current() }}?sort=percent"><i>▲</i></a>
                <a class="active link-secondary" href="{{ url()->current() }}?sort=-percent"><i>▼</i></a>
            </th>
            <th scope="col">
                Дата окончания
                <a class="active link-secondary" href="{{ url()->current() }}?sort=expiration_date"><i>▲</i></a>
                <a class="active link-secondary" href="{{ url()->current() }}?sort=-expiration_date"><i>▼</i></a>
            </th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($deposits as $deposit)
            <tr>
                <th scope="row">{{$deposit->id}}</th>
                <td>{{$deposit->bank->name}}</td>
                <td>{{\App\Enums\DepositTypeEnum::getTranslate($deposit->type)}}</td>
                <td>{{$deposit->price}}</td>
                <td>{{$deposit->percent}}</td>
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
