@extends('layouts.admin')
@section('content')
    <h1 class="mb-1">Займы</h1>

    <div class="mb-2">
        <a href="{{route('admin.company.index')}}" class="btn btn-link">Перейти к Юр лицам</a>
        <a href="{{route('admin.loans.frontiers')}}" class="btn btn-link">Перейти к данным Frontiers</a>
    </div>

    <div class="btn-group mt-2" role="group">
        <form action="{{ route('admin.loans.index') }}" method="get" class="form-inline">
            <div class="form-group mr-1">
                <input type="search" name="filter[search]" placeholder="" class="form-control">
            </div>
            <button type="submit" class="btn btn-blue-gray mr-1 ">Поиск</button>
            <a href="{{ route('admin.loans.index') }}" class="btn mr-1">Сбросить</a>
        </form>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">№</th>
            <th scope="col">Компания</th>
            <th scope="col">
                Стоимость, RUB
                <a class="active link-secondary" href="{{ url()->current() }}?sort=price"><i>▲</i></a>
                <a class="active link-secondary" href="{{ url()->current() }}?sort=-price"><i>▼</i></a>
            </th>
            <th scope="col">% годовых</th>
            <th scope="col">Тип погашения</th>
            <th scope="col">Тип платежа</th>
            <th scope="col">Число платежа</th>
            <th scope="col">Дата окончания</th>
            <th scope="col">Действие</th>
        </tr>
        </thead>
        <tbody>
        @foreach($loans as $loan)
            <tr>
                <th scope="row">{{$loan->id}}</th>
                <th>{{$loan->company->name}}</th>
                <td>{{$loan->price}}</td>
                <td>{{$loan->percent}}</td>
                <td>{{\App\Enums\LoanRepaymentScheduleTypeEnum::getTranslate($loan->repayment_schedule_type)}}</td>
                <td>{{\App\Enums\LoanPaymentTypeEnum::getTranslate($loan->payment_type)}}</td>
                <td>{{$loan->payment_day}}</td>
                <td>{{$loan->expiration_date}}</td>
                <td><a href="{{route('admin.loans.edit', $loan)}}"><i class="fa-solid fa-pen"></i></a>
                    <form action="{{ route('admin.loans.destroy', $loan) }}" method="POST" class="d-inline">
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

    {{$loans->withQueryString()->links('pagination::bootstrap-5')}}
    <div><a href="{{route('admin.loans.create')}}" class="btn btn-success">+ Добавить займ</a></div>

    <h3 class="mt-2">Календарь выплат на {{ $month }}/{{ $year }}</h3>
    <table class="loans_calendar_table">
        <tr>
            <th>Пн</th>
            <th>Вт</th>
            <th>Ср</th>
            <th>Чт</th>
            <th>Пт</th>
            <th>Сб</th>
            <th>Вс</th>
        </tr>
        @php
            $daysInMonth = \Illuminate\Support\Carbon::createFromDate($year, $month)->daysInMonth;
            $firstDayOfMonth = \Illuminate\Support\Carbon::createFromDate($year, $month)->startOfMonth()->dayOfWeekIso;
        @endphp
        @for ($i = 1; $i <= $daysInMonth + $firstDayOfMonth - 1; $i++)
            @if ($i % 7 == 1)
                <tr>
                    @endif
                    @if ($i < $firstDayOfMonth)
                        <td></td>
                    @else
                        @php
                            $day = $i - $firstDayOfMonth + 1;
                        @endphp
                        <td class="{{ in_array($day, $days) ? 'highlight' : '' }}">{{ $day }}</td>
                    @endif
                    @if ($i % 7 == 0)
                </tr>
            @endif
        @endfor
    </table>
@endsection
