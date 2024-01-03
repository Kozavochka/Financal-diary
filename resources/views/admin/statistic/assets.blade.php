@extends('layouts.admin')
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <div class="statistic">
        <div class="row mb-5">
            <div class="col">
                @include('admin.statistic.charts.stock')
            </div>
            <div class="col">
                @include('admin.statistic.charts.industries')
            </div>
        </div>
        <div class="row">
            <div class="col">
                @include('admin.statistic.charts.bond')
            </div>
            <div class="col">
                @include('admin.statistic.charts.crypto')
            </div>
        </div>
    </div>
@endsection
