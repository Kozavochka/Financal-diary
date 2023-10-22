@extends('layouts.admin')
@section('content')

    <h1 class="mb-3">Направления</h1>

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
        @foreach($directions as $direction)
            <tr>
                <th scope="row">{{$loop->index + 1}}</th>
                <td>{{$direction->name}}</td>
                @if($direction->stocks_count != 0 )
                    <td>{{$direction->stocks_count}}</td>
                @elseif($direction->bonds_count != 0 )
                    <td>{{$direction->bonds_count}}</td>
                @elseif( $direction->funds_count !=0)
                    <td>{{$direction->funds_count}}</td>
                @elseif( $direction->cryptos_count !=0)
                    <td>{{$direction->cryptos_count}}</td>
                @elseif( $direction->loans_count !=0)
                    <td>{{$direction->loans_count}}</td>
                @endif
                <td>
                    <form action="{{ route('admin.directions.destroy', $direction) }}" method="POST" class="d-inline">
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
    {{$directions->withQueryString()->links('pagination::bootstrap-5')}}
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="{{route('admin.directions.create')}}" class="btn btn-success me-2">+ Добавить направление</a>
    </div>
@endsection
