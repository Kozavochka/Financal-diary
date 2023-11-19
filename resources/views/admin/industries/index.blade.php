@extends('layouts.admin')
@section('content')

    <h1 class="mb-3">Отрасли</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Кол-во активов</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($industries as $industry)
            <tr>
                <th scope="row">{{$loop->index + 1}}</th>
                <td>{{$industry->name}}</td>
                <td>{{$industry->stocks_count}}</td>
                <td>
                    <form action="{{ route('admin.industries.destroy', $industry) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger"
                                onclick="return confirm('Вы уверены, что хотите удалить?');"
                                data-toggle="tooltip" data-placement="top" title="Удалить">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$industries->withQueryString()->links('pagination::bootstrap-5')}}
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="{{route('admin.industries.create')}}" class="btn btn-success me-2">+ Добавить отрасль</a>
    </div>
@endsection
