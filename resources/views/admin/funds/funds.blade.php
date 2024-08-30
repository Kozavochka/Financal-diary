@extends('layouts.admin')
@section('content')
    <h1 class="mb-3">Фонды</h1>


    <div class="btn-group mb-2" role="group">
        <form action="{{ route('admin.funds.index') }}" method="get" class="form-inline">
            <div class="form-group mr-1">
                <input type="search" name="filter[search]" placeholder="" class="form-control">
            </div>
            <button type="submit" class="btn btn-blue-gray mr-1 ">Поиск</button>
            <a href="{{ route('admin.funds.index') }}" class="btn mr-1">Сбросить фильтр</a>
        </form>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">№</th>
            <th scope="col">Название</th>
            <th scope="col">Тикер</th>
            <th scope="col">
                Стоимость, RUB
                <a class="active link-secondary" href="{{ url()->current() }}?sort=price"><i>▲</i></a>
                <a class="active link-secondary" href="{{ url()->current() }}?sort=-price"><i>▼</i></a>
            </th>
            <th scope="col">Действие</th>
        </tr>
        </thead>
        <tbody>
        @foreach($funds as $fund)
            <tr>
                <th scope="row">{{$fund->id}}</th>
                <td>{{$fund->name}}</td>
                <td>{{$fund->ticker}}</td>
                <td>{{$fund->total_price}}</td>
                <td><a href="{{route('admin.funds.edit', $fund)}}"><i class="fa-solid fa-pen"></i></a>
                    <form action="{{ route('admin.funds.destroy', $fund) }}" method="POST" class="d-inline">
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

    {{$funds->withQueryString()->links('pagination::bootstrap-5')}}
    <div><a href="{{route('admin.funds.create')}}" class="btn btn-success">+ Добавить фонд</a></div>
@endsection
