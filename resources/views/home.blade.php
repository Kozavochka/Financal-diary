@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1>Вы авторизованы</h1>
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                   {{-- <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>--}}
                </div>
            </div>
            <div class="col-md-8">
                <h2>Доступные разделы</h2>
                <div class="list-group">
                    <a href="{{route('stocks.index')}}" class="list-group-item list-group-item-action">Акции</a>
                    <a href="#" class="list-group-item list-group-item-action">Облиги</a>
                    <a href="#" class="list-group-item list-group-item-action">и тд</a>
                </div>
            </div>
        </div>
    </div>
@endsection
