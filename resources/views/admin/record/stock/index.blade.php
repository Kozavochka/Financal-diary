@extends('layouts.admin')
@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Акция</th>
            <th scope="col">Цена</th>
            <th scope="col">Описание</th>
        </tr>
        </thead>
        <tbody>
        @foreach($records as $record)
            @foreach($record->stocks as $stock)
                <tr>
                    <th scope="row">{{$record->id}}</th>
                    <td>{{$stock->name}}</td>
                    <td>{{$stock->price}}</td>
                    <td>{{$record->description}}</td>
                </tr>
            @endforeach

        @endforeach
        </tbody>
    </table>
    {{$records->withQueryString()->links('pagination::bootstrap-5')}}
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="{{route('stocks.record.create')}}" class="btn btn-success me-2">+ Добавить запись</a>
    </div>
@endsection
