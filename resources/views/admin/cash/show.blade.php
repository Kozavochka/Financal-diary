@extends('layouts.admin')
@section('content')

    <h1 class="mb-3">Денежные счёт {{$cash->name}}. Баланс: {{$cash->sum}}</h1>

    <div class="container">
        <h4>История изменений</h4>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Тип</th>
                <th scope="col">Сумма</th>

            </tr>
            </thead>
            <tbody>
            @foreach($cash->change_histroies as $change)
                <tr>
                    <th scope="row">{{$loop->index + 1}}</th>
                    <td>{{$change->change_reason->income_type->name}}</td>
                    <td>{{$change->change_reason->price}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
