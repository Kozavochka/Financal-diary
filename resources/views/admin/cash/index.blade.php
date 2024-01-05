@extends('layouts.admin')
@section('content')

    <h1 class="mb-3">Денежные счета</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Остаток</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($cashes as $cash)
            <tr>
                <th scope="row">{{$loop->index + 1}}</th>
                <td>{{$cash->name}}</td>
                <td>{{$cash->sum}}</td>
                <td>
                    <form action="{{ route('admin.cash.destroy', $cash) }}" method="POST" class="d-inline">
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

    <div><a href="{{route('admin.cash.create')}}" class="btn btn-success">+ Добавить денежный счёт</a></div>
@endsection
