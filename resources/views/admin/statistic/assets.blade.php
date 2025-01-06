@extends('layouts.admin')
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <div class="btn-group" role="group">
        <form method="post" action="{{ route('total_pdf_export') }}" >
            @csrf
            <button class="btn btn-link me-2">Создать файл экспорта PDF</button>
            <input id="action"  name="action" class="form-control numeric-input" type="hidden" value="">
        </form>
        @if($isPdfExportExist)
            <a href="{{route('download_total_pdf_export')}}" class="btn btn-success me-2">Скачать PDF экспорт</a>
        @endif
    </div>
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
