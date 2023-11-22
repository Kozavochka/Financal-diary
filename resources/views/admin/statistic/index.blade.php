@extends('layouts.admin')
@section('content')
    <h1 class="mb-3">Статистика</h1>
    <a href="{{route('statistic.create')}}" class="btn btn-success me-2">Закрепить результат</a>
{{--    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Дата</th>
            <th scope="col">Общая сумма</th>

        </tr>
        </thead>
        <tbody>
        @foreach($statistics as $statistic)
            <tr>
                <th scope="row">1</th>
                <td>1</td>
                <td>1</td>
            </tr>
        @endforeach
        </tbody>
    </table>--}}

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Заголовок 1</th>
                <th>Заголовок 2</th>
                <th>Заголовок 3</th>
            </tr>
            </thead>
            <tbody>
            <tr data-toggle="collapse" data-target="#row1" class="clickable">
                <td>Строка 1</td>
                <td>Данные 1</td>
                <td>Данные 2</td>
            </tr>
            <tr id="row1" class="collapse">
                <td colspan="3">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>Вложенная строка 2</td>
                            <td>Данные 3</td>
                            <td>Данные 4</td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>

            <tbody>
            <tr data-toggle="collapse" data-target="#row2" class="clickable">
                <td>Строка 1</td>
                <td>Данные 1</td>
                <td>Данные 2</td>
            </tr>
            <tr id="row2" class="collapse">
                <td colspan="3">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>Вложенная строка 2</td>
                            <td>Данные 3</td>
                            <td>Данные 4</td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>

@endsection
