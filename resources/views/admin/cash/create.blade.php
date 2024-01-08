@extends('layouts.admin')
@section('content')
    <form method="post" action="{{ route('admin.cash.store') }}" >
        @csrf
        <div class="form-group">
            <div class="mb-3">
                <label for="name" class="form-label">Название</label>
                <input id="name" name="name"  class="form-control" type="text" placeholder="Введите название" >
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
