@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1>Вы авторизованы</h1>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <p>Доступные страницы</p>
                        <div class="href_pages">
                            <a href="{{route('admin.index')}}">Админка</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
