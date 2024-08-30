@extends('layouts.admin')
@section('content')
    <form method="post" action="{{ route('admin.company.store') }}" >
        @csrf
        @include('admin.loans.companies.form')
    </form>
@endsection
