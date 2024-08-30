@extends('layouts.admin')
@section('content')
    <form method="post" action="{{ route('admin.bank.update', $bank) }}" >
        @csrf
        @method('patch')
        @include('admin.deposit.bank.form')
    </form>
@endsection
