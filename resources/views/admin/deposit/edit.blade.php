@extends('layouts.admin')
@section('content')
    <form method="post" action="{{ route('admin.deposits.update',$deposit) }}" >
        @csrf
        @method('patch')
        @include('admin.deposit.form')
    </form>
@endsection
