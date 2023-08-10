<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('/') }}/template/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('/') }}/template/dist/css/adminlte.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ url('/') }}/template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ url('/') }}/template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ url('/') }}/template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/template/plugins/datatables-select/css/select.bootstrap4.css">
    <link rel="stylesheet" href="{{ url('/') }}/template/plugins/datatables-keytable/css/keyTable.bootstrap4.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ url('/') }}/template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- jQuery -->
  <script src="{{ url('/') }}/template/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ url('/') }}/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>


  <script src="{{ url('/') }}/template/angularJS/angular.min.js"></script>
  <script src="{{ url('/') }}/template/angularJS/app.js"></script>

  <!-- jquery-validation -->
  <script src="{{ url('/') }}/template/plugins/jquery-validation/jquery.validate.min.js"></script>
  <script src="{{ url('/') }}/template/plugins/jquery-validation/additional-methods.min.js"></script>
 <!-- DataTables  & Plugins -->
    <script src="{{ url('/') }}/template/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ url('/') }}/template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ url('/') }}/template/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ url('/') }}/template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ url('/') }}/template/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ url('/') }}/template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ url('/') }}/template/plugins/jszip/jszip.min.js"></script>
    <script src="{{ url('/') }}/template/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ url('/') }}/template/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ url('/') }}/template/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ url('/') }}/template/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ url('/') }}/template/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="{{ url('/') }}/template/plugins/datatables-select/js/dataTables.select.min.js"></script>
    <script src="{{ url('/') }}/template/plugins/datatables-keytable/js/dataTables.keyTable.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="{{ url('/') }}/template/plugins/sweetalert2/sweetalert2.min.js"></script>
  @yield('ctrl')
  <style>
    .btn-nav{
         border-radius: 20px; 
    }
    .hidden{
      display:none;
    }
    [class*=sidebar-dark-] .sidebar a {
        color: #f4f6f9;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini" ng-app="app"  ng-controller="myCtrl">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-fuchsia navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('/') }}/template/index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> --}}
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      {{-- <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
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
      </li> --}}

      <!-- Messages Dropdown Menu -->
      {{-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ url('/') }}/template/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
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
              <img src="{{ url('/') }}/template/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
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
              <img src="{{ url('/') }}/template/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
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
      </li> --}}
      <!-- Notifications Dropdown Menu -->
      {{-- <li class="nav-item dropdown">
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
      </li> --}}
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-blue sidebar-blue elevation-4" style="background-color: #007bff;">
    <!-- Brand Logo -->
    <a  class="brand-link">
      {{-- <img src="{{ url('/') }}/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8;background-color: white;"> --}}
      <span class="brand-text font-weight-light">Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('/') }}/template/dist/img/blank.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          {{-- <a href="#" class="d-block">{{ var_dump(Session::get('data')) }}</a> --}}
          {{-- <a href="#" class="d-block">{{ Session::get('data')->nama }}</a> --}}
        </div>
      </div>

      <!-- SidebarSearch Form -->
      {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
          {{-- <li class="nav-item">
            <a href="{{ url('/') }}/user" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                User
              </p>
            </a>
          </li> <i class="fas fa-id-badge"></i> --}}
          {{-- <li class="nav-item">
            <a href="{{ url('/') }}/pengguna" class="nav-link">
              <i class="nav-icon fas fa-id-badge"></i>
              <p>
                Pengguna Aplikasi --}}
                {{-- <span class="right badge badge-danger">New</span> --}}
              {{-- </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/') }}/child" class="nav-link">
              <i class="nav-icon fas fa-child"></i>
              <p>
                Remaja --}}
                {{-- <span class="right badge badge-danger">New</span> --}}
              {{-- </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/') }}/guru" class="nav-link">
              <i class="nav-icon fas fa-chalkboard-teacher"></i>
              <p>
                Guru --}}
                {{-- <span class="right badge badge-danger">New</span> --}}
              {{-- </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/') }}/z_score" class="nav-link">
              <i class="nav-icon fas fa-heart"></i>
              <p>
                Status Gizi --}}
                {{-- <span class="right badge badge-danger">New</span> --}}
              {{-- </p>
            </a>
          </li> --}}
          <li class="nav-item">
            <a href="{{ url('/') }}/quiz_praktek_gizi" class="nav-link">
              <i class="nav-icon fas fa-id-badge"></i>
              <p>
                Soal kuesioner
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>
          {{-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Perilaku Gizi --}}
                {{-- <span class="right badge badge-danger">New</span> --}}
                {{-- <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview"> --}}
              {{-- <li class="nav-item">
                <a href="{{ url('/') }}/quiz_pengetahuan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengetahuan</p>
                </a>
              </li> --}}
              {{-- <li class="nav-item">
                <a href="{{ url('/') }}/quiz_praktek_gizi" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dengan gaya hidup</p>
                </a>
              </li>
            </ul>
          </li> --}}
          {{-- <li class="nav-item">
            <a href="{{ url('/') }}/quiz_makanan" class="nav-link">
              <i class="nav-icon fas fa-utensils"></i>
              <p>
                Paparan junk food  --}}
                {{-- <span class="right badge badge-danger">New</span> --}}
              {{-- </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/') }}/belajar" class="nav-link">
              <i class="nav-icon fas fa-book-open"></i>
              <p>
                Edukasi --}}
                {{-- <span class="right badge badge-danger">New</span> --}}
              {{-- </p>
            </a>
          </li> --}}
          {{-- <li class="nav-item">
            <a href="{{ url('/') }}/quiz_submition" class="nav-link">
              <i class="nav-icon fas fa-star-half-alt"></i>
              <p>
                Quiz submission
              </p>
            </a>
          </li> --}}
          {{-- <li class="nav-item">
            <a href="{{ url('/') }}/simpang_baku" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                TB Simpang Baku --}}
                {{-- <span class="right badge badge-danger">New</span> --}}
              {{-- </p>
            </a>
          </li> --}}
          <li class="nav-item">
            <a href="{{ url('/') }}/user" class="nav-link">
              <i class="nav-icon fas fa-user-lock"></i>
              <p>
                Management User
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/') }}/logout" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
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
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    @yield('content')
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  {{-- <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer> --}}

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

  <!-- AdminLTE App -->
  <script src="{{ url('/') }}/template/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ url('/') }}/template/dist/js/demo.js"></script>

</body>
</html>
