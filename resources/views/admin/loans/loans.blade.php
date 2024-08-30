@extends('layouts.admin')
@section('content')
    <h1 class="mb-1">Займы</h1>

    <div class="mb-2">
        <a href="{{route('admin.company.index')}}" class="btn btn-link">Перейти к Юр лицам</a>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Стоимость, RUB</th>
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
                <td>{{$loan->name}}</td>
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
@endsection
