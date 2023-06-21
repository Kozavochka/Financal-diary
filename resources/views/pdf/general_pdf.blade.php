<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Отчёт портфеля</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body {
            font-family: DejaVu Sans, 'sans-serif';
        }
    </style>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css ')}}">
{{--    <link rel="stylesheet" href="{{asset('css/app.css ')}}">--}}
    <link   type="text/css"  rel="stylesheet" href="app.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://kit.fontawesome.com/a1a14b61d0.js" crossorigin="anonymous"></script>

</head>
<body>
<div class="container">
    <div class="col-md-8 mb-5">
        <div class="card-header">
            <h2>Состав портфеля</h2>
            <p class="text-success">Общая стоимость: {{$total}} RUB</p>
        </div>
        <div class="card">
            <table class="table" style="max-width: 500px">
                <thead>
                <tr>
                    <th scope="col">Направление</th>
                    <th scope="col">Стоимость</th>
                    <th scope="col">%</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $key => $value)
                    <tr>
                        <td>{{$key}}</td>
                        <td>{{$data[$key]}} RUB</td>
                        <td>{{bcdiv($data[$key] / $total * 100,1,0)}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-8 mb-5">
        <h2 class="mb-3">Акции</h2>

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
            @foreach($stocks as $stock)
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
    </div>
</div>
</body>
</html>
