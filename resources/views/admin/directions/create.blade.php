@extends('layouts.admin')
@section('content')
    <form method="post" action="{{ route('admin.directions.store') }}" >
        @csrf
        @include('admin.directions.form')
    </form>
@endsection
