@extends('layouts.admin')
@section('content')
<h1 class="mb-3">Облигации</h1>

<div class="btn-group mt-2" role="group">
    <form action="{{ route('admin.bonds.index') }}" method="get" class="form-inline">
        <div class="form-group mr-1">
            <input type="search" name="filter[search]" placeholder="" class="form-control">
        </div>
        <button type="submit" class="btn btn-blue-gray mr-1 ">Поиск</button>
        <a href="{{ route('admin.bonds.index') }}" class="btn mr-1">Сбросить фильтр</a>
    </form>
</div>

<table class="table">
    <thead>
    <tr>
        <th scope="col">№</th>
        <th scope="col">Название</th>
        <th scope="col">Тикер</th>
        <th scope="col">Количество</th>
        <th scope="col">
            Стоимость, RUB
            <a class="active link-secondary" href="{{ url()->current() }}?sort=price"><i>▲</i></a>
            <a class="active link-secondary" href="{{ url()->current() }}?sort=-price"><i>▼</i></a>
        </th>
        <th scope="col">
            Купон,%
            <a class="active link-secondary" href="{{ url()->current() }}?sort=coupon_percent"><i>▲</i></a>
            <a class="active link-secondary" href="{{ url()->current() }}?sort=-coupon_percent"><i>▼</i></a>
        </th>
        <th scope="col">Купонный период, дни</th>
        <th scope="col">
            Дата погашения
            <a class="active link-secondary" href="{{ url()->current() }}?sort=expiration_date"><i>▲</i></a>
            <a class="active link-secondary" href="{{ url()->current() }}?sort=-expiration_date"><i>▼</i></a>
        </th>
        <th scope="col">Действие</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bonds as $bond)
        <tr>
            <th scope="row">{{$bond->id}}</th>
            <td>{{$bond->name}}</td>
            <td>{{$bond->ticker}}</td>
            <td>{{$bond->lots}}</td>
            <td>{{$bond->total_price}}</td>
            <td>{{$bond->coupon_percent}}</td>
            <td>{{$bond->coupon_day_period}}</td>
            <td>{{$bond->expiration_date}}</td>
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
<div>
    <span><b>Средний % купона:</b>{{bcdiv($bonds->avg('coupon_percent'), 1, 2)}} </span>
    <span><b>Средний купон:</b> {{bcdiv($bonds->avg('coupon'), 1, 2)}} RUB</span>
</div>
<div class="btn-group" role="group">
    <a href="{{route('admin.bonds.create')}}" class="btn btn-default me-2">+ Добавить облигацию</a>
</div>

@endsection
