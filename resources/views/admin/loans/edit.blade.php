@extends('layouts.admin')
@section('content')
    <form method="post" action="{{ route('admin.loans.update', $loan) }}" >
        @csrf
        @method('patch')
        @include('admin.loans.form')
    </form>
@endsection
