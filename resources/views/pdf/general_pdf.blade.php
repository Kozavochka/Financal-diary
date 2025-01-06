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
    <style>
        @font-face {
            font-family: "DejaVu Sans";
            font-style: normal;
            font-weight: 400;
            src: url("/fonts/dejavu-sans/DejaVuSans.ttf");
            /* IE9 Compat Modes */
            src:
                local("DejaVu Sans"),
                local("DejaVu Sans"),
                url("/fonts/dejavu-sans/DejaVuSans.ttf") format("truetype");
        }
        body {
            font-family: "DejaVu Sans";
            font-size: 12px;
        }
    </style>
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
                        <td>{{bcdiv($dataSum[$key] / ($total == 0 ? 1 : $total) * 100,2)}}</td>
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
                <th scope="col">Лоты</th>
                <th scope="col">Стоимость</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data['stocks'] as $stockDTO)
                <tr>
                    <th scope="row">{{$loop->index + 1}}</th>
                    <td>{{$stockDTO->getStockName()}}</td>
                    <td>{{$stockDTO->getStockTicker()}}</td>
                    <td>{{$stockDTO->getStockIndustryName()}}</td>
                    <td>{{$stockDTO->getStockLots()}}</td>
                    <td>{{$stockDTO->getStockTotalPrice()}}</td>
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
                <th scope="col">Лотов</th>
                <th scope="col">Стоимость <br> RUB</th>
                <th scope="col">Купон %</th>
                <th scope="col">Дата погашения</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data['bonds'] as $bondDTO)
                <tr>
                    <th scope="row">{{$loop->index +1}}</th>
                    <td>{{$bondDTO->getName()}}</td>
                    <td>{{$bondDTO->getTicker()}}</td>
                    <td>{{$bondDTO->getLots()}}</td>
                    <td>{{$bondDTO->getTotalPrice()}}</td>
                    <td>{{$bondDTO->getCouponPercent()}}</td>
                    <td>{{$bondDTO->getExpirationDate()}}</td>
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
            @foreach($data['funds'] as $fundDTO)
                <tr>
                    <th scope="row">{{$loop->index +1}}</th>
                    <td>{{$fundDTO->getName()}}</td>
                    <td>{{$fundDTO->getTicker()}}</td>
                    <td>{{$fundDTO->getTotalPrice()}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-8 mb-5">
        <p class="mb-3 h_text"><b>Криптовалюта</b></p>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Название</th>
                <th scope="col">Тикер</th>
                <th scope="col">Стоимость <br> USD</th>
                <th scope="col">Лоты</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data['crypto'] as $cryptoDTO)
                <tr>
                    <th scope="row">{{$loop->index +1}}</th>
                    <td>{{$cryptoDTO->getName()}}</td>
                    <td>{{$cryptoDTO->getTicker()}}</td>
                    <td>{{$cryptoDTO->getTotalPrice()}}</td>
                    <td>{{$cryptoDTO->getLots()}}</td>
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
                <th scope="col">Компания</th>
                <th scope="col">Стоимость</th>
                <th scope="col">% годовых</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data['loans'] as $loanDTO)
                <tr>
                    <th scope="row">{{$loop->index +1}}</th>
                    <td>{{$loanDTO->getCompanyName()}}</td>
                    <td>{{$loanDTO->getPrice()}}</td>
                    <td>{{$loanDTO->getPercent()}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
