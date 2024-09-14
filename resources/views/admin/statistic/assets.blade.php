@extends('layouts.admin')
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <div class="statistic">
        <div class="row">
            <div class="col">
                @include('admin.statistic.charts.stock')
            </div>
        </div>
        <div class="row">
            <div class="col">
                @include('admin.statistic.charts.bond')
            </div>
        </div>
        <div class="row">
            <div class="col">
                @include('admin.statistic.charts.crypto')
            </div>
        </div>
        <div class="row">
            <div class="col">
                @include('admin.statistic.charts.funds')
            </div>
        </div>
        <div class="row">
            <div class="col">
                @include('admin.statistic.charts.deposits')
            </div>
            <div class="col">
                @include('admin.statistic.charts.loans')
            </div>
        </div>
    </div>
@endsection
