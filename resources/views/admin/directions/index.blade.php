@extends('layouts.admin')
@section('content')

    <h1 class="mb-3">Направления</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Кол-во активов</th>
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
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$directions->withQueryString()->links('pagination::bootstrap-5')}}
@endsection
