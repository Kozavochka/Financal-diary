<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Админ панель</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="{{asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback')}}">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css ')}}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="{{asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css ')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css ')}}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/a1a14b61d0.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{asset('css/admin.css')}}">

</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{url()->previous()}}" class="nav-link">Назад</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{route('home')}}" class="nav-link">На главную</a>
            </li>

        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->

        <a href="{{route('admin.index')}}" class="brand-link href_style">
            <span class="brand-text font-weight-light">Админ панель</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->

            <div class="user-panel mt-3 pb-3 mb-3 d-flex flex-column">

                <div class="info">
                    <a href="#" class="d-block href_style">{{auth()->user()->name}}</a>
                </div>
                <div class="info">
                    <a href="{{route('set-tg')}}" class="d-block href_style"><i class="fa-brands fa-telegram fa-xl" style="color: #346cda;"></i>
                    Обновить бота</a>

                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{route('admin.directions.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>Направления</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.industries.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>Отрасли</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a  class="nav-link" data-bs-toggle="dropdown" aria-expanded="false">
                           <i class="fa-solid fa-business-time"></i>
                            Активы
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                          <li>
                              <a href="{{route('admin.stocks.index')}}" class="nav-link">
                                  <i class="nav-icon fa-solid fa-arrow-trend-up"></i>
                                  <p>Акции</p>
                              </a>
                          </li>
                          <li>
                              <a href="{{route('admin.bonds.index')}}" class="nav-link">
                                  <i class="nav-icon fa-solid fa-money-check-dollar"></i>
                                  <p>Облигации</p>
                              </a>
                          </li>
                          <li>
                              <a href="{{route('admin.funds.index')}}" class="nav-link">
                                  <i class="nav-icon fa-solid fa-building-columns"></i>
                                  <p>Фонды</p>
                              </a>
                          </li>
                          <li>
                              <a href="{{route('admin.crypto.index')}}" class="nav-link">
                                  <i class="nav-icon fa-brands fa-bitcoin"></i>
                                  <p>Криптовалюта</p>
                              </a>
                          </li>
                            <li>
                                <a href="{{route('admin.deposits.index')}}" class="nav-link">
                                    <i class="nav-icon fa-solid fa-vault"></i>
                                    <p>Вклады</p>
                                </a>
                            </li>
{{--                            <li>--}}
{{--                                <a href="{{route('admin.currency.index')}}" class="nav-link">--}}
{{--                                    <i class="nav-icon fa-solid fa-dollar-sign"></i>--}}
{{--                                    <p>Валюта</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
                          <li>
                              <a href="{{route('admin.loans.index')}}" class="nav-link">
                                  <i class="nav-icon fas fa-th"></i>
                                  <p>Займы</p>
                              </a>
                          </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.incomes.index')}}" class="nav-link">
                            <i class="fa-solid fa-sack-dollar"></i>
                            <p>Поступления</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.cash.index')}}" class="nav-link">
                            <i class="fa-solid fa-money-bill-wave"></i>
                            <p>Денежные счета</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('statistic.index')}}" class="nav-link">
                            <i class="fa-solid fa-chart-pie"></i>
                            <p>Статистика</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('settings.index')}}" class="nav-link">
                            <i class="fa-solid fa-gear"></i>
                            <p>Настройки</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
{{--                <div class="row">--}}
                    @yield('content')
{{--                </div>--}}
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <strong>Админ панель представлена <a class="href_style" href="https://adminlte.io">AdminLTE.io</a>.</strong>
        <div class="float-right d-none d-sm-inline-block cont">
            <b>Версия приложения</b> demo
        </div>
    </footer>
</div>
<!-- ./wrapper -->

<!-- AdminLTE -->
<script src="{{asset('/dist/js/adminlte.js')}}"></script>

@livewireScripts

</body>
</html>
