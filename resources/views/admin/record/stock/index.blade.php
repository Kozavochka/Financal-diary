@extends('layouts.admin')
@section('content')
    <table class="table">
        <thead>
        <tr>

            <th scope="col">#</th>
            <th scope="col">Описание</th>
            @foreach($stocks_dist as $stock)
                <th scope="col">{{$stock->name}}</th>
                @endforeach

        </tr>
        </thead>
        <tbody>
        @foreach($records as $record)
            <tr>
                <th scope="row">{{$loop->index}}</th>
                <th scope="row">{{$record?->description}}</th>

            @foreach($record->stocks as $stock)
                    <td>{{$stock?->pivot?->price}} RUB</td>
            @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$records->withQueryString()->links('pagination::bootstrap-5')}}
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="{{route('stocks.record.create')}}" class="btn btn-success me-2">+ Добавить запись</a>
    </div>
@endsection
