@extends('layouts.admin')
@section('content')
    <form method="post" action="{{ route('admin.deposits.store') }}" >
        @csrf
        @include('admin.deposit.form')
    </form>
@endsection
