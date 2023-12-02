@extends('layouts.admin')
@section('content')
    <h1 class="mb-3">Статистика</h1>
    <form method="post" action="{{ route('statistic.create') }}" >
        @csrf
        <button type="submit" class="btn btn-success me-2">Закрепить результат</button>
    </form>


        @foreach($statistics as $statistic)
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Дата</th>
                <th>Общая сумма</th>
            </tr>
            </thead>
            <tbody>
            <tr data-toggle="collapse" data-target="#row1" class="clickable">
                <td>{{$statistic->created_at}}</td>
                <td>{{$statistic->total_sum}}</td>
            </tr>
            @foreach($statistic->items as $item)
            <tr id="row1" class="collapse">
                <td colspan="3">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>{{$item->direction->name}}</td>
                            <td>{{$item->sum}}</td>
                            <td>{{$item->count}}</td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        @endforeach

@endsection
