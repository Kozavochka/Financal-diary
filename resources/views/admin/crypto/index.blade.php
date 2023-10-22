@extends('layouts.admin')
@section('content')
    <h1 class="mb-3">Крипта</h1>

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
        @foreach($crypto as $monetka)
            <tr>
                <th scope="row">{{$monetka->id}}</th>
                <td>{{$monetka->name}}</td>
                <td>{{$monetka->ticker}}</td>
                <td>{{$monetka->price}} USD</td>
                <td><a href="{{route('admin.crypto.edit', $monetka)}}"><i class="fa-solid fa-pen"></i></a>
                    <form action="{{ route('admin.crypto.destroy', $monetka) }}" method="POST" class="d-inline">
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

    {{$crypto->withQueryString()->links('pagination::bootstrap-5')}}
    <div><a href="{{route('admin.crypto.create')}}" class="btn btn-success">+ Добавить крипту</a></div>
@endsection
