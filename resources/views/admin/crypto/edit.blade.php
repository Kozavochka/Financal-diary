@extends('layouts.admin')
@section('content')
    <form method="post" action="{{ route('admin.crypto.update', $crypto) }}" >
        @csrf
        @method('patch')
        @include('admin.crypto.form')
    </form>
@endsection
