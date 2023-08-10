@extends('template.layout')
@section('content')
    <section class="content">
        <!-- Default box -->
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Data User</h3>
            </div>
            <div class="card-body">
                <div class="row" >
                    <div class="col-md-12">
                        <button ng-click="create()" type="button" class="btn btn-outline-primary mb-3"><i class="fa fa-plus"></i> Tambah Data User</button>
                        <table id="listdatatable" class="table table-bordered table-css-history table-hover dataTable no-footer"></table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <div class="modal fade" id="modalform">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="forminput">
                    <input type="text" class="form-control hidden" ng-model="id" name="id" id="id">
                    <div class="modal-header">
                        <h4 class="modal-title">User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" ng-model="nama" name="nama" id="nama">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" ng-model="email" name="email" id="email">
                            </div>
                        </div>
                        <div class="form-group row" ng-hide="update">
                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" ng-model="password" name="password" id="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">No Hp</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" ng-model="no_hp" name="no_hp" id="no_hp">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" ng-model="alamat" name="alamat" id="alamat"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection

@section('ctrl')
<script>
app.controller("myCtrl", function($scope,$http) {
    $scope.data = [];
    $scope.update =false;

    var validator = $("#forminput").validate({
        rules: {
            nama: {
                required: !0,
            },
            email: {
                required: !0,
            },
            password: {
                required: !0,
            },
            no_hp: {
                required: !0,
            },
            alamat: {
                required: !0,
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group .col-sm-10').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        invalidHandler: function(e, r){

        },
        submitHandler: function(e){

            if($scope.update){
                vurl = "{{ url('api/editUser') }}";
            }else{
                vurl = "{{ url('api/postUser') }}";
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                url : vurl,
                type: "POST",
                data:$("#forminput").serialize()+'&faskes='+$("#idFaskes option:selected").text(),
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status){
                        Swal.close();
                        $('#modalform').modal('hide');
                        $scope.reloadlist();
                    }else{
                        Swal.fire({icon: 'error',title: 'Oops...',text: data.message,})
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    Swal.fire({icon: 'error',title: 'Oops...',text: 'Something went wrong!',})
                },
                beforeSend: function(){
                    Swal.fire({title: 'Loading..',onOpen: () => {Swal.showLoading()}})
                }
            });
            return false;
        }
    });

    var btnDel  =  "<a class='btn btn-outline-danger btn-nav' href='javascript:void(0)' title='Hapus' id='DeleteRow' ><i class='fa fa-trash-alt tip pointer posdel'></i></a>";
    var btnEdit =  " <a class='btn btn-outline-success btn-nav' href='javascript:void(0)' title='Ubah' id='EditRow' ><i class='fa fa-pen tip pointer posdel'></i></a>";
    var table =  $('#listdatatable').DataTable({
            columns: [
                { title:"Id" ,         "data":"id" ,     "width":"20px" },
                { title:"nama",        "data": "name" },
                { title:"email",    "data": "email" },
                { title:"alamat",   "data": "alamat" },
                { title:"no_hp",      "data": "no_hp" },
                { title:"Action",      "defaultContent": btnDel + btnEdit, "width":"100px" },
            ]
        });

        $('#listdatatable tbody').on('click', '#DeleteRow', function () {
            var tr = $(this).closest('tr');
            var id = table.row(tr).data().id;
            $scope.delete(id);
        });

        $('#listdatatable tbody').on('click', '#EditRow', function () {
            var tr = $(this).closest('tr');
            $scope.edit(table.row( tr ).data());
        });

    $scope.reloadlist = function(){
        Swal.fire({title: 'Loading..',onOpen: () => {Swal.showLoading()}})
        
        table.clear().draw();
        $http.get("{{ url('api/getAllUser') }}").then(function(res){
            table.rows.add(res.data).draw( );
            Swal.close();
        });
    }

    $scope.reloadlist();

    $scope.create = function(){
        $scope.update    = false;
        $scope.id        = '';
        $scope.nama      = '';
        $scope.email  = '';
        $scope.password  = '';
        $scope.no_hp = '';
        $scope.alamat = '';
        $('#modalform').modal('show');
    }

    $scope.edit = function(x){
        $scope.update    = true;
        $scope.nama      = x.name;
        $scope.email  = x.email;
        $scope.password  = x.password;
        $scope.no_hp = x.no_hp;
        $scope.alamat = x.alamat;
        $scope.id = x.id;
        validator.resetForm();
        $('#modalform').modal('show');
        $scope.$apply();
    }

    $scope.delete = function(x){
        Swal.fire({
            title: 'Apa kamu yakin?',
            text: "ingin menghapus data ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({title: 'Loading..',onOpen: () => {Swal.showLoading()}})
                var parm = {'id': x} ;
                $http.post("{{ url('api/deleteUser') }}",parm).then(function(res){
                    if(res.data.status){
                        $scope.reloadlist();
                        Swal.close();
                    }else{
                        Swal.fire({icon: 'error',title: 'Oops...',text: res.data.message,})
                    }
                });
            }
        })
    }
});
</script>
@endsection