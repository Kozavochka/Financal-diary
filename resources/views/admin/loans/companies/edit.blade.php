@extends('layouts.admin')
@section('content')
    <form method="post" action="{{ route('admin.company.update', $company) }}" >
        @csrf
        @method('patch')
        @include('admin.loans.companies.form')
    </form>
@endsection
