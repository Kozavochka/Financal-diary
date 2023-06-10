@extends('layouts.admin')
@section('content')
    <form method="post" action="{{ route('admin.stocks.store') }}" >
        @csrf
        @include('admin.stocks.form')
    </form>
@endsection
