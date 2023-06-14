@extends('layouts.admin')
@section('content')
<h1 class="mb-3">Остелижвание стоимости</h1>

<ul class="nav nav-pills nav-fill">
    <li class="nav-item">
        <a class="nav-link" href="{{route('stocks.record.create')}}">Акции</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Облиги</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">И тд</a>
    </li>
</ul>
@endsection
