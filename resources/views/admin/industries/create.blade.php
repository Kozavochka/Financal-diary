@extends('layouts.admin')
@section('content')
    <form method="post" action="{{ route('admin.industries.store') }}" >
        @csrf
        @include('admin.directions.form')
    </form>
@endsection
