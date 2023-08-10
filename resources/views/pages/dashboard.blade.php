@extends('template.layout')
@section('content')
    <section class="content">
        <!-- Default box -->
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Dashboard</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Selamat Datang Di Dashbord SMA Laboratorium UPGRIS</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
@endsection

@section('ctrl')
<script>
    app.controller("myCtrl", function($scope,$http) {

    });
</script>
@endsection