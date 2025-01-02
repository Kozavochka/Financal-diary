<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Акции портфеля</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <link  type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <link type="text/css"  rel="stylesheet" href="pdf.css">

</head>
<body>
<div class="container">
    <div class="col-md-8 mb-5">
        <div class="card-header">
            <p class="mb-3 h_text"><b>Акции</b></p>
            <p class="text-success">Общая стоимость: {{$totalStockSum}} RUB</p>
        </div>
        <div class="card">
            <table class="table" style="max-width: 500px">
                <thead>
                <tr>
                    <th scope="col">№</th>
                    <th scope="col">Название</th>
                    <th scope="col">Тикер</th>
                    <th scope="col">Отрасль</th>
                    <th scope="col">Стоимость, RUB</th>
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
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
