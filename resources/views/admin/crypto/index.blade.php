@extends('layouts.admin')
@section('content')
    <h1 class="mb-3">Криптовалюта</h1>

    <div class="mb-2">
        <form method="post" action="{{ route('admin.crypto.bybit_sync') }}" >
            @csrf
            <input id="ticker" name="sync" class="form-control ticker-input" type="hidden">
            <button type="submit" class="btn btn-light"><i class="fa-solid fa-file-pdf">
                </i> Синхронизировать ByBit</button>
        </form>
    </div>

    <div class="btn-group mt-2" role="group">
        <form action="{{ route('admin.crypto.index') }}" method="get" class="form-inline">
            <div class="form-group mr-1">
                <input type="search" name="filter[search]" placeholder="" class="form-control">
            </div>
            <button type="submit" class="btn btn-blue-gray mr-1 ">Поиск</button>
            <a href="{{ route('admin.crypto.index') }}" class="btn mr-1">Сбросить фильтр</a>
        </form>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">№</th>
            <th scope="col">Название</th>
            <th scope="col">Тикер</th>
            <th scope="col">
                Количество
                <a class="active link-secondary" href="{{ url()->current() }}?sort=lots"><i>▲</i></a>
                <a class="active link-secondary" href="{{ url()->current() }}?sort=-lots"><i>▼</i></a>
            </th>
            <th scope="col">
                Стоимость, USD
                <a class="active link-secondary" href="{{ url()->current() }}?sort=price"><i>▲</i></a>
                <a class="active link-secondary" href="{{ url()->current() }}?sort=-price"><i>▼</i></a>
            </th>
            <th scope="col">Действие</th>
        </tr>
        </thead>
        <tbody>
        @foreach($cryptos as $crypto)
            <tr>
                <th scope="row">{{$crypto->id}}</th>
                <td>{{$crypto->name}}</td>
                <td>{{$crypto->ticker}}</td>
                <td>{{$crypto->lots}}</td>
                <td>{{$crypto->total_price}}</td>
                <td><a href="{{route('admin.crypto.edit', $crypto)}}"><i class="fa-solid fa-pen"></i></a>
                    <form action="{{ route('admin.crypto.destroy', $crypto) }}" method="POST" class="d-inline">
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

    {{$cryptos->withQueryString()->links('pagination::bootstrap-5')}}
    <div><a href="{{route('admin.crypto.create')}}" class="btn btn-default">+ Добавить</a></div>
@endsection
