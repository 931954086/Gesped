<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../../https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../../plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="../../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60"
                width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{route('dashboard')}}" class="nav-link">Home</a>
                </li>
                <!--<li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>-->
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <!--  <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>-->



                <!-- =================== MENU PERFIL ===================-->
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('storage/users/perfil/' . Auth::user()->id . '/' . Auth::user()->image) }}"
                            class="user-image img-circle elevation-2" alt="User Image">
                        <span class="d-none d-md-inline">
                            <!--{{Auth::user()->name}}-->
                            <!-- <i class="fas fa-angle-down"></i>-->
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg  dropdown-menu-right">
                        <!--dropdown-menu-right-->
                        <!-- User image -->
                        <li class="user-header bg-dark">
                            <!-- dark-mode-->
                            <img src="{{ asset('storage/users/perfil/' . Auth::user()->id . '/' . Auth::user()->image) }}"
                                class="img-circle elevation-2" alt="User Image">
                            <p>
                                {{ Auth::user()->name }}
                                <small>
                                    @if (session('user_permission') == 'admin')
                                    Administrador
                                    @elseif (session('user_permission') == 'manage-user')
                                    Gestor de Usuário
                                    @elseif (session('user_permission') == 'user')
                                    Usuário Comum
                                    @else
                                    Permissão Desconhecida
                                    @endif
                                </small>
                            </p>

                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <!--  <div class="row">
                                <div class="col-4 text-center">
                                    <a href="#">Followers</a>
                                </div>
                                <div class="col-4 text-center">
                                    <a href="#">Sales</a>
                                </div>
                                <div class="col-4 text-center">
                                    <a href="#">Friends</a>
                                </div>
                            </div>-->
                            <!-- /.row -->
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <a href="{{ route('profile.index') }}" class="btn btn-default btn-flat btn-sm">Profile</a>

                            <a href="#" class="btn btn-default btn-flat float-right btn-sm">
                                <form action="{{ route('logout') }}" method="POST" class="dropdown-item">
                                    @csrf
                                    <button type="submit" class="btn btn-default btn-flat btn-sm"
                                        style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
                                        Logout
                                    </button>
                                </form>
                            </a>
                        </li>
                        <!-- ... -->
                    </ul>
                </li>
                <!-- ===================END MENU PERFIL ===================-->


                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="dist/img/user1-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="dist/img/user8-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="dist/img/user3-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i
                                                class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>



                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>


                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#"
                        role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{route('dashboard')}}" class="brand-link">
                <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Gesped</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('storage/users/perfil/' . Auth::user()->id . '/' . Auth::user()->image) }}"
                            class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{Auth::user()->name}}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <!--  <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>-->

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                          with font-awesome or any other icon font library -->




                        <!--- ========== ADMIN PANEL=============-->
                        @can('admin')
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('dashboard')}}" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Dashboard v1</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan
                        <!--- ====================================-->

                        @can('admin')
                        <li class="nav-header"> LOJA</li>
                        <!-- Menu para o recurso Produtos -->
                        <li class="nav-item categorias">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-list-alt"></i>
                                <p>
                                    Produtos
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('products.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Criar</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('products.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listar</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- Menu para o recurso Categorias -->
                        <li class="nav-item categorias">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-list-alt"></i>
                                <p>
                                    Categorias
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('categories.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Criar</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('categories.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listar</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- Menu para o recurso Pedidos -->
                        <li class="nav-item categorias">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-list-alt"></i>
                                <p>
                                    Pedidos
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('orders.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Criar</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('orders.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listar</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                         <!-- Menu para o recurso Pedidos -->
                         <!--  <li class="nav-item categorias">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-list-alt"></i>
                                <p>
                                    Parecer
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('opinion.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Criar</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('opinion.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listar</p>
                                    </a>
                                </li>
                            </ul>
                        </li>-->
                        <!-- Menu para o recurso Estoque -->
                        <li class="nav-item categorias">
                            <a href="{{ route('shop.index') }}" class="nav-link">
                                <i class="nav-icon far fa-list-alt"></i>
                                <p>
                                    Estoque
                                </p>
                            </a>
                        </li>
                        <li class="nav-item categorias">
                            <a href="{{ route('cart.index') }}" class="nav-link">
                                <i class="nav-icon far fa-list-alt"></i>
                                <p>
                                    Carrinho
                                </p>
                            </a>
                        </li>


                        <li class="nav-header"></li>
                        <li class="nav-header"> ADMINISTRAÇÃO</li>
                        <!-- Menu para o recurso Status -->
                        <li class="nav-item categorias">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-list-alt"></i>
                                <p>
                                    Empresa
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('companies.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Listar</p>
                            </a>
                        </li>
                    </ul>
                    </li>
                    <!-- Seu HTML com rotas  Usuários -->
                    <li class="nav-item" id="usuarios">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Usuários
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('users.create')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Criar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('users.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Listar Usuários</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Menu para o recurso  Clientes -->
                    <li class="nav-item categorias">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-list-alt"></i>
                            <p>
                                Clientes
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('customers.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Criar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('customers.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Listar</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Menu para o recurso Permissões -->
                    <li class="nav-item categorias">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-list-alt"></i>
                            <p>
                                Permissões
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <!---  <li class="nav-item">
                                    <a href="{{ route('permissions.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Criar</p>
                                    </a>
                                </li>-->
                            <li class="nav-item">
                                <a href="{{ route('permissions.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Listar</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Menu para o recurso Departamentos -->
                    <li class="nav-item categorias">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-list-alt"></i>
                            <p>
                                Departamentos
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('departments.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Criar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('departments.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Listar</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endcan




                    @can('manage-user')
                    <!-- Seu HTML com rotas  Usuários -->
                    <li class="nav-item" id="usuarios">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Usuários
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('users.create')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Criar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('users.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Listar Usuários</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endcan




                    @can('user')
                    <!-- Menu para o recurso Pedidos -->
                    <li class="nav-item categorias">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-list-alt"></i>
                            <p>
                                Pedidos
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <!--  <li class="nav-item">
                                    <a href="{{ route('orders.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Criar</p>
                                    </a>
                                </li>-->
                            <li class="nav-item">
                                <a href="{{ route('orders.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Listar</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Menu para o recurso Estoque -->
                    <li class="nav-item categorias">
                        <a href="{{ route('shop.index') }}" class="nav-link">
                            <i class="nav-icon far fa-list-alt"></i>
                            <p>
                                Estoque
                            </p>
                        </a>
                    </li>
                    <li class="nav-item categorias">
                        <a href="{{ route('cart.index') }}" class="nav-link">
                            <i class="nav-icon far fa-list-alt"></i>
                            <p>
                                Carrinho
                            </p>
                        </a>
                    </li>




                       <!-- Menu para o recurso Estoque -->
                       <li class="nav-item categorias">
                        <a href="{{ route('sinais.signals') }}" class="nav-link">
                            <i class="nav-icon far fa-list-alt"></i>
                            <p>
                                Sinais
                            </p>
                        </a>
                    </li>

                    @endcan


                    

                    <!--- ====================================-->
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <section class="content">
                <div class="container-fluid">


                    <!---==BADY DA APPLICATION==-->
                    @yield('content')
                    <!--- =====================-->


                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https:GesPed">GesPed</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="../../plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="../../plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="../../plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="../../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../../plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="../../plugins/moment/moment.min.js"></script>
    <script src="../../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="../../plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../../../dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../../dist/js/pages/dashboard.js"></script>


    <script src="../../dist/js/modal_of_status_and_type_user.js"></script>
    <script src="../../dist/js/preview_image_all.js"></script>
    <script src="../../dist/js/search_element_int_the_table.js"></script>
    <script src="../../dist/js/show_or_hide_message.js"></script>
    <script src="../../dist/js/search_element_int_the_table1.js"></script>
    <script src="../../dist/js/form_pedido_autom.js"></script>

</body>

</html>