@extends('layouts.admin')
@section('content')

    <h1 class="mb-3">Статистика</h1>
    <form method="post" action="{{ route('statistic.dynamic.create') }}" >
        @csrf
        <button type="submit" class="btn btn-success me-2">Закрепить результат</button>
    </form>
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <table class="table table-bordered">
    <thead>
    <tr>
        <th class="width-10">№</th>
        <th class="max-width-100">Дата</th>
        <th class="max-width-300">Общая сумма  RUB</th>
    </tr>
    </thead>
        <tbody>
        @foreach($statistics as $statistic)
            <tr>
                <td class="width-10">{{$statistic->id}}</td>
                <td class="max-width-100">{{$statistic->created_at}}</td>
                <td class="max-width-300">{{$statistic->total_sum}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @include('admin.statistic.charts.dynamic')
@endsection
