@extends('layouts.admin')
@section('content')
    <form method="post" action="{{ route('admin.crypto.store') }}" >
        @csrf
        @include('admin.crypto.form')
    </form>
@endsection
