@extends('layouts.admin')
@section('content')
    <form method="post" action="{{ route('admin.bonds.update', $bond) }}" >
        @csrf
        @method('patch')
        @include('admin.bonds.form')
    </form>
@endsection
