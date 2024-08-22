@extends('layouts.admin')
@section('content')
    <form method="post" action="{{ route('admin.stocks.update', $stock) }}" >
        @csrf
        @method('patch')
        @include('admin.stocks.form')
    </form>
@endsection
