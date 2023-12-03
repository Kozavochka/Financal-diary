@extends('layouts.admin')
@section('content')
    {{-- NEED REFACTORING --}}
    <h1 class="mb-3">Статистика</h1>
    <form method="post" action="{{ route('statistic.create') }}" >
        @csrf
        <button type="submit" class="btn btn-success me-2">Закрепить результат</button>
    </form>
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <table class="table table-bordered">
    <thead>
    <tr>
        <th>Дата</th>
        <th>Общая сумма</th>
    </tr>
    </thead>
    </table>
        @foreach($statistics as $statistic)
        <table class="table table-bordered">
            <tbody>
            <tr data-toggle="collapse" data-target="#row{{$statistic->id}}" class="clickable">
                <td>{{$statistic->created_at}}</td>
                <td>{{$statistic->total_sum}} RUB</td>
            </tr>
            @foreach($statistic->items as $item)
            <tr id="row{{$statistic->id}}" class="collapse">
                <td>
                        <div >{{$item->direction->name}}</div>
                </td>
                <td>
                    <div class="container" style="display: flex; justify-content: space-around">
                        <div>{{$item->sum}} RUB</div>
                        <div>N: {{$item->count}}</div>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        @endforeach

@endsection
