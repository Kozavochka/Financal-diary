@extends('layouts.admin')
@section('content')
    <form method="post" action="{{ route('admin.funds.store') }}" >
        @csrf
        @include('admin.funds.form')
    </form>
@endsection
