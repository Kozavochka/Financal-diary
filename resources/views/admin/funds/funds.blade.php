@extends('layouts.admin')
@section('content')
    <h1 class="mb-3">Фонды</h1>
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
        @foreach($funds as $fund)
            <tr>
                <th scope="row">{{$fund->id}}</th>
                <td>{{$fund->name}}</td>
                <td>{{$fund->ticker}}</td>
                <td>{{$fund->price}} RUB</td>
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
