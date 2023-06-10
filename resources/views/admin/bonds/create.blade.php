@extends('layouts.admin')
@section('content')
    <form method="post" action="{{ route('admin.bonds.store') }}" >
        @csrf
        @include('admin.bonds.form')
    </form>
@endsection
