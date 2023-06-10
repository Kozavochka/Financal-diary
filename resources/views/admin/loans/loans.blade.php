@extends('layouts.admin')
@section('content')
    <h1 class="mb-3">Займы</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Стоимость</th>
            <th scope="col">Количество компаний</th>
            <th scope="col">Действие</th>
        </tr>
        </thead>
        <tbody>
        @foreach($loans as $loan)
            <tr>
                <th scope="row">{{$loan->id}}</th>
                <td>{{$loan->name}}</td>
                <td>{{$loan->price}} RUB</td>
                <td>{{$loan->count_bus}}</td>
                <td><a href="{{route('admin.loans.edit', $loan)}}"><i class="fa-solid fa-pen"></i></a>
                    <form action="{{ route('admin.loans.destroy', $loan) }}" method="POST" class="d-inline">
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

    {{$loans->withQueryString()->links('pagination::bootstrap-5')}}
    <div><a href="{{route('admin.loans.create')}}" class="btn btn-success">+ Добавить займ</a></div>
@endsection
