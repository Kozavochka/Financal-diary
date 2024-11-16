@extends('layouts.admin')
@section('content')
    <h1 class="mb-5">FRONTIERS</h1>

    <div>
       <p>Всего на платформе: {{$frontiersData['total']}}</p>
       <p>Зарезервировано: {{$frontiersData['reserved']}}</p>
       <p>Инвестировано: {{$frontiersData['invested']}}</p>
       <p>Свободно: {{$frontiersData['free']}}</p>
    </div>

    <div>
        <div class="col-md-8">
            <form method="post" action="{{ route('admin.loans.frontiers_sync') }}" >
                @csrf
                <input id="ticker" name="sync" class="form-control ticker-input" type="hidden">
                <button type="submit" class="btn btn-light"><i class="fa-solid fa-file-pdf">
                        </i> Синхронизировать данные по займам</button>
            </form>
        </div>
    </div>
@endsection
