<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @php
      $dataAplikasi = App\Models\AplikasiModel::detailData();
      $dataPeriode  = App\Models\PeriodeModel::getPeriodeAktif();
      $periode = is_null($dataPeriode) ?  'xxxx': $dataPeriode;
    @endphp
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ $dataAplikasi->nama }}  </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('template')}}/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('template')}}/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('template')}}/bower_components/Ionicons/css/ionicons.min.css">
   <!-- fullCalendar -->
   <link rel="stylesheet" href="{{asset('template')}}/bower_components/fullcalendar/dist/fullcalendar.min.css">
   <link rel="stylesheet" href="{{asset('template')}}/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{asset('template')}}/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('template')}}/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('template')}}/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style>
    .m-b { margin-bottom: 15px; }
    .mt-2 { margin-top: 15px; }
    .m-l16 {  margin-left: 16px; }
    .pt0 {  padding-top: 0px !important; }
    .pt14 {  padding-top: 14px !important; }
    .pl14 {  padding-left: 14px !important; }
    .pr14 {  padding-right: 14px !important; }
    .judul{
        color: beige;
        background-color: #374850;
    }
    .btn-space {
        margin-right: 5px;
    }
    table.fixed {
    table-layout: fixed;
    width: 100%;
    }
    .modal-header{
     background-color:#3c8dbc;
     color: #fff;
     border-top-left-radius: 6px !important;
     border-top-right-radius: 6px !important;

}
.modal-content  {
    -webkit-border-radius: 0px !important;
    -moz-border-radius: 0px !important;
    border-radius: 6px !important;
}


li.current {
    background: #060652;
}

tr.biru {
  color: white;
  background-color:#3c8dbc;
}

  </style>


  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
@stack('styles')
@livewireStyles
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="/" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>S</b>IM</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>{{ $dataAplikasi->nama }} </b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                {{-- Status Aktif Periode di sini --}}
                <li>
                    <a href="/periode/setAktif" >
                        <?php
                        if(is_null($dataPeriode)){
                            $periode = 'xxxx';
                        } else{
                            $periode = $dataPeriode;
                        }
                        ?>
                    <span class="hidden-xs">Periode Aktif : {{ $periode }}</span>
                    </a>
                </li>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{asset('template')}}/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                    <span class="hidden-xs"> {{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{asset('template')}}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                            <p>
                                {{ Auth::user()->name }} <br>{{ Auth::user()->email }}
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            Aplikasi siMapan Kerja
                            <!-- /.row -->
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                            <a href="/pemakai/selfReset" class="btn btn-default btn-flat">Reset Password</a>
                            </div>
                            <div class="pull-right">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                    <button type="submit" class="btn btn-default btn-flat">Log out</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        </nav>
    </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
            <img src="{{asset('template')}}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p> {{ Auth::user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i>
                    @if (auth()->user()->level==1)
                        Admin
                    @elseif (auth()->user()->level==2)
                        User
                    @elseif (auth()->user()->level==3)
                        Pelanggan
                    @endif
                </a>
            </div>
        </div>
        <br>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
                <li class="headerx judul"><b class="m-l16">Jenis Layanan</b></li>
                @include('layouts.v_nav')

                {{-- <li class="headerx judul"><b class="m-l16">Konfigurasi</b></li>
                @include('layouts.v_rekomnav') --}}


                <li class="headerx judul"><b class="m-l16">Settings</b></li>
                <li class="{{ request()->is('penetapan_libur') ? 'active':'' }}"><a href="/penetapan_libur"><i class="fa fa-cog text-green"></i> <span>Penetapan Libur</span></a></li>
                <li class="{{ request()->is('slot_layanan') ? 'active':'' }}"><a href="/slot_layanan"><i class="fa fa-cog text-red"></i> <span>Penetapan Slot Layanan</span></a></li>
                {{-- <li class="{{ request()->is('wa_gateway') ? 'active':'' }}"><a href="/wa_gateway"><i class="fa fa-cog text-blue"></i> <span>Whatsapp Gateway</span></a></li> --}}

{{--
                <li class="{{ request()->is('settingaplikasi') ? 'active':'' }}"><a href="/settingaplikasi"><i class="fa fa-cog text-red"></i> <span>Setting Aplikasi</span></a></li>
                <li class="{{ request()->is('departemen') ? 'active':'' }}"><a href="/departemen"><i class="fa fa-cog text-blue"></i> <span>Bidang dan Seksi</span></a></li>
                <li class="{{ request()->is('pemakai') ? 'active':'' }}"><a href="/pemakai"><i class="fa fa-cog text-yellow"></i> <span>User Aplikasi</span></a></li>
                <li class="{{ request()->is('opd') ? 'active':'' }}"><a href="/opd"><i class="fa fa-home text-green"></i> <span>Managemen OPD</span></a></li> --}}
        </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            @yield('title')
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">@yield('breadcrumb')</li>
        </ol>
        </section>
        <!-- Main content -->
        <section class="content">
                @yield('content')
        </section>
        <!-- /.content -->
</div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> {{ $dataAplikasi->versi }}
    </div>
    <strong>Copyright &copy; 2022 <a href="https://adminlte.io">{{ $dataAplikasi->nama }}</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
  </aside>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('template')}}/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('template')}}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('template')}}/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- SlimScroll -->
<script src="{{asset('template')}}/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="{{asset('template')}}/bower_components/fastclick/lib/fastclick.js"></script>
<!-- bootstrap datepicker -->
<script src="{{asset('template')}}/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('template')}}/dist/js/adminlte.min.js"></script>

<!-- Alpine JS -->
<script src="{{asset('template')}}/dist/js/alpine.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('template')}}/dist/js/demo.js"></script>
<!-- fullCalendar -->
<script src="{{asset('template')}}/bower_components/moment/moment.js"></script>
<script src="{{asset('template')}}/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@stack('scripts')
@livewireScripts
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })


  $('#datepicker').datepicker({
    format: 'dd-mm-yyyy',

      autoclose: true
    })

</script>
<script type="text/javascript">
    window.setTimeout(function() {
        $(".alert").fadeTo(600, 0).slideUp(600, function() {
            $(this).hide();
        });
    }, 1000);
</script>
<script type="text/javascript">
    window.livewire.on('postUpdated', () => {
        document.getElementById("form_isi").reset();
        $('#addWawancara').modal('hide');

    });

</script>

<!-- AdminLTE for demo purposes -->


</body>
</html>
