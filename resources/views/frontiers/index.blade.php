@extends('layouts.admin')
@section('content')
    <h1 class="mb-5">FRONTIERS</h1>

    <div>
       <p>Всего на платформе: {{$frontiersData['total']}}</p>
       <p>Зарезервировано: {{$frontiersData['reserved']}}</p>
       <p>Инвестировано: {{$frontiersData['invested']}}</p>
       <p>Свободно: {{$frontiersData['free']}}</p>
    </div>
@endsection
