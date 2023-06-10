@extends('layouts.admin')
@section('content')
    <form method="post" action="{{ route('admin.loans.store') }}" >
        @csrf
        @include('admin.loans.form')
    </form>
@endsection
