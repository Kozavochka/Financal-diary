@extends('layouts.admin')
@section('content')
<h1>Облигации</h1>


<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Название</th>
        <th scope="col">Тикер</th>
        <th scope="col">Купон</th>
        <th scope="col">%</th>
        <th scope="col">Действие</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bonds as $bond)
        <tr>
            <th scope="row">{{$bond->id}}</th>
            <td>{{$bond->name}}</td>
            <td>{{$bond->ticker}}</td>
            <td>{{$bond->coupon}} RUB</td>
            <td>{{$bond->profit_percent}} %</td>
            <td><a href="{{route('admin.bonds.edit', $bond)}}"><i class="fa-solid fa-pen"></i></a>
                <form action="{{ route('admin.bonds.destroy', $bond) }}" method="POST" class="d-inline">
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
{{$bonds->withQueryString()->links('pagination::bootstrap-5')}}

<div class="btn-group" role="group" aria-label="Basic example">
    <a href="{{route('admin.bonds.create')}}" class="btn btn-success me-2">+ Добавить облигацию</a>

    <a href="{{ url()->current() }}?filter[desc_percent]=true" class="btn btn-info me-2">Сортировка по %</a>
    <a href="{{ url()->current() }}?filter[desc_coupon]=true" class="btn btn-info me-2">Сортировка по купону</a>
    <a class="nav-link active" aria-current="page"
       href="{{ url()->current() }}?{{ http_build_query(request()->except('filter')) }}">Сбросить
        фильтр</a>
</div>

@endsection
