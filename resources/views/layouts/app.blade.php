@include('layouts.header')

<body class="hold-transition sidebar-mini" style="font-family: Inter">
    <!-- Site wrapper -->
    <div class="wrapper">

        @include('layouts.navbar')

        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>@yield('title')</h1>
                        </div>
                        {{-- breadcrumbs --}}
                        <div class="col-sm-6">

                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        @yield('card-title')
                    </div>
                    <div class="card-body">
                        {{ $slot }}
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; Ferdinand</strong> All rights
            reserved.
        </footer>

    </div>
    <!-- ./wrapper -->

    @include('layouts.footer')
