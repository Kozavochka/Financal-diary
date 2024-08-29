@extends('layouts.admin')
@section('content')
    <form method="post" action="{{ route('admin.funds.update', $fund) }}" >
        @csrf
        @method('patch')
        @include('admin.funds.form')
@endsection
