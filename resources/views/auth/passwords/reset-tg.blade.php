@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <form method="POST" action="{{ route('reset-pass') }}">
                @csrf
                <div class="row mb-3">
                    <label for="code" class="col-md-4 col-form-label text-md-end">Code</label>
                    <div class="col-md-6">
                        <input id="code" type="number" class="form-control" name="code">
                        <div class="form-text">Выполните /reset в телеграмм боте</div>
                    </div>

                </div>
                <div class="row mb-3">
                    <label for="pass" class="col-md-4 col-form-label text-md-end">Новый пароль</label>
                    <div class="col-md-6">
                        <input id="pass" type="password" class="form-control" name="pass">
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                           Обновить
                        </button>
                    </div>
                </div>
                <input id="email" type="hidden" class="form-control" name="email" value="{{$data['email']}}">
            </form>
        </div>
    </div>
@endsection
