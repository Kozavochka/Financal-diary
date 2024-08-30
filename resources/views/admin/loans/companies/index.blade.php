@extends('layouts.admin')
@section('content')

    <h1 class="mb-3">Юр лица</h1>

    <div class="btn-group mt-2" role="group">
        <form action="{{ route('admin.company.index') }}" method="get" class="form-inline">
            <div class="form-group mr-1">
                <input type="search" name="filter[search]" placeholder="" class="form-control">
            </div>
            <button type="submit" class="btn btn-blue-gray mr-1 ">Поиск</button>
            <a href="{{ route('admin.company.index') }}" class="btn mr-1">Сбросить</a>
        </form>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">№</th>
            <th scope="col">Наименование</th>
            <th scope="col">ИНН/ОГРН</th>
            <th scope="col">Количество займов</th>
            <th scope="col">Сумма займов</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($companies as $company)
            <tr>
                <th scope="row">{{$company->id}}</th>
                <td>{{$company->name}}</td>
                <td>@if(!is_null($company->inn) || !is_null($company->ogrn))
                        {{$company->inn}}/{{$company->ogrn}}
                @endif</td>
                <td>{{$company->loans_count}}</td>
                <td>{{$company->loans_sum_price}}</td>
                <td><a href="{{route('admin.company.edit', $company)}}"><i class="fa-solid fa-pen"></i></a>
                    <form action="{{ route('admin.company.destroy', $company) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger"
                                onclick="return confirm('Вы уверены, что хотите удалить? Также удалятся все займы');"
                                data-toggle="tooltip" data-placement="top" title="Удалить">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="{{route('admin.company.create')}}" class="btn btn-success me-2">+ Добавить</a>
    </div>

@endsection
