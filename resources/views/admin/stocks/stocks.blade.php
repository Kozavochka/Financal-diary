@extends('layouts.admin')
@section('content')

    <h1 class="mb-3">Акции</h1>

    <div class="btn-group mt-2" role="group">
        <form action="{{ route('admin.stocks.index') }}" method="get" class="form-inline">
            <div class="form-group mr-1">
                <input type="search" name="filter[search]" placeholder="" class="form-control">
            </div>
            <button type="submit" class="btn btn-blue-gray mr-1 ">Поиск</button>
            <a href="{{ route('admin.stocks.index') }}" class="btn mr-1">Сбросить фильтр</a>
        </form>
    </div>


    <table class="table">
        <thead>
        <tr>
            <th scope="col">№</th>
            <th scope="col">
                Название
            </th>
            <th scope="col">Тикер</th>
            <th scope="col">Отрасль</th>
            <th scope="col">
                Стоимость, RUB
                <a class="active link-secondary" href="{{ url()->current() }}?sort=price"><i>▲</i></a>
                <a class="active link-secondary" href="{{ url()->current() }}?sort=-price"><i>▼</i></a>
            </th>
            <th scope="col">Действие</th>
        </tr>
        </thead>
        <tbody>
        @foreach($stocks as $stock)
            <tr>
                <th scope="row">{{$stock->id}}</th>
                <td>{{$stock->name}}</td>
                <td>{{$stock->ticker}}</td>
                <td>{{$stock->industry->name}}</td>
                <td>{{$stock->total_price}}</td>

                <td><a href="{{route('admin.stocks.edit', $stock)}}"><i class="fa-solid fa-pen"></i></a>
                    <form action="{{ route('admin.stocks.destroy', $stock) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger"
                                onclick="return confirm('Вы уверены, что хотите удалить?');"
                                data-toggle="tooltip" data-placement="top" title="Удалить">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$stocks->withQueryString()->links('pagination::bootstrap-5')}}

    <div class="btn-group" role="group">
        <a href="{{route('admin.stocks.create')}}" class="btn btn-default me-2">+ Добавить акцию</a>
        <a href="{{route('excel_export')}}" class="btn btn-success me-2">Excel</a>
        <form method="post" action="{{ route('pdf_export') }}" >
            @csrf
            <button class="btn btn-link me-2">Создать файл экспорта PDF</button>
            <input id="action"  name="action" class="form-control numeric-input" type="hidden" value="">
        </form>
        @if($isPdfExportExist)
            <a href="{{route('download__stock_pdf_export')}}" class="btn btn-success me-2">Скачать PDF экспорт</a>
        @endif
    </div>

@endsection
