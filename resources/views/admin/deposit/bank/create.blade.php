@extends('layouts.admin')
@section('content')
    <form method="post" action="{{ route('admin.bank.store') }}" >
        @csrf
        @include('admin.deposit.bank.form')
    </form>
@endsection
