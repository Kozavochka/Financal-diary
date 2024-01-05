<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Отчёт портфеля</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <link  type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <link type="text/css"  rel="stylesheet" href="pdf.css">

</head>
<body>
<div class="container">
    <div class="col-md-8 mb-5">
        <div class="card-header">
            <p class="mb-3 h_text"><b>Портфель</b></p>
            <p class="text-success">Общая стоимость: {{$total}} RUB</p>
        </div>
        <div class="card">
            <table class="table" style="max-width: 500px">
                <thead>
                <tr>
                    <th scope="col">Направление</th>
                    <th scope="col">Стоимость RUB</th>
                    <th scope="col">%</th>
                </tr>
                </thead>
                <tbody>
                @foreach($dataSum as $key => $value)
                    <tr>
                        <td>{{$key}}</td>
                        <td>{{$dataSum[$key]}}</td>
                        <td>{{bcdiv($dataSum[$key] / $total * 100,1,0)}}</td>
                    </tr>
                @endforeach
                <tr>
                    <td>Наличные</td>
                    <td>{{$cashSum}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-8 mb-5">
        <p class="mb-3 h_text"><b>Акции</b></p>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Название</th>
                <th scope="col">Тикер</th>
                <th scope="col">Отрасль</th>
                <th scope="col">Стоимость</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data['stocks'] as $stock)
                <tr>
                    <th scope="row">{{$loop->index + 1}}</th>
                    <td>{{$stock->name}}</td>
                    <td>{{$stock->ticker}}</td>
                    <td>{{$stock->industry->name}}</td>
                    <td>{{$stock->total_price}} RUB</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="col col-xl-4">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Отрасль</th>
                    <th scope="col">Кол-во</th>
                </tr>
                </thead>
                <tbody>
                @foreach($industries as $industry)
                    <tr>
                        <td>{{$industry->name}}</td>
                        <td>{{$industry->stocks_count}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-8 mb-5">
        <p class="mb-3 h_text"><b>Облигации</b></p>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Название</th>
                <th scope="col">Тикер</th>
                <th scope="col">Купон <br> RUB</th>
                <th scope="col">%</th>
                <th scope="col">Дата погашения</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data['bonds'] as $bond)
                <tr>
                    <th scope="row">{{$loop->index +1}}</th>
                    <td>{{$bond->name}}</td>
                    <td>{{$bond->ticker}}</td>
                    <td>{{$bond->coupon}}</td>
                    <td>{{$bond->profit_percent}}</td>
                    <td>{{$bond->expiration_date}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-8 mb-5">
        <p class="mb-3 h_text"><b>Фонды</b></p>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Название</th>
                <th scope="col">Тикер</th>
                <th scope="col">Цена <br> RUB</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data['funds'] as $fund)
                <tr>
                    <th scope="row">{{$loop->index +1}}</th>
                    <td>{{$fund->name}}</td>
                    <td>{{$fund->ticker}}</td>
                    <td>{{$fund->price}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-8 mb-5">
        <p class="mb-3 h_text"><b>Крипта</b></p>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Название</th>
                <th scope="col">Тикер</th>
                <th scope="col">Стоимость <br> USD</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data['crypto'] as $crypto)
                <tr>
                    <th scope="row">{{$loop->index +1}}</th>
                    <td>{{$crypto->name}}</td>
                    <td>{{$crypto->ticker}}</td>
                    <td>{{$crypto->price}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-8 mb-5">
        <p class="mb-3 h_text"><b>Займы</b></p>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Название</th>
                <th scope="col">Стоимость</th>
                <th scope="col">Количество компаний</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data['loans'] as $loan)
                <tr>
                    <th scope="row">{{$loop->index +1}}</th>
                    <td>{{$loan->name}}</td>
                    <td>{{$loan->price}}</td>
                    <td>{{$loan->count_bus}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
