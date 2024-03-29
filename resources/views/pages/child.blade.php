@extends('template.layout')
@section('content')
    <section class="content">
        <!-- Default box -->
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Data Remaja</h3>
            </div>
            <div class="card-body">
                <div class="row" >
                    <div class="col-md-12">
                        {{-- <button ng-click="create()" type="button" class="btn btn-outline-primary mb-3"><i class="fa fa-plus"></i> Tambah Data Child</button> --}}
                        <table id="listdatatable" class="table table-bordered table-css-history table-hover dataTable no-footer"></table>
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
    $scope.data = [];
    $scope.update =false;

    
    var btnDel  =  "<a class='btn btn-outline-danger btn-nav' href='javascript:void(0)' title='Hapus' id='DeleteRow' ><i class='fa fa-trash-alt tip pointer posdel'></i></a>";
    var btnEdit =  " <a class='btn btn-outline-success btn-nav' href='javascript:void(0)' title='Ubah' id='EditRow' ><i class='fa fa-pen tip pointer posdel'></i></a>";
    var table =  $('#listdatatable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            columns: [
                { title:"Id" ,     "data":"id" ,     "width":"20px" },
                { title:"NISN",    "data": "nisn" },
                { title:"Nama",    "data": "nama" },
                { title:"Email",    "data": "email" },
                { title:"Jenis_Kelamin",    "data": "jenis_kelamin" },
                { title:"Tanggal_Lahir",    "data": "tanggal_lahir" },
                { title:"Alamat",    "data": "alamat" },
                { title:"Berat_Badan",    "data": "berat_badan" },
                { title:"Tinggi_Badan",    "data": "tinggi_badan" },
                { title:"lila",    "data": "lila_p" },
                { title:"Tinggal",    "data": "tinggal" },
                { title:"Uang_Saku",    "data": "uang_saku" },
                { title:"Pendidikan_Ayah",  "data": "pendidikan_ayah" },
                { title:"Pendidikan_Ibu",  "data": "pendidikan_ibu" },
                { title:"Pekerjaan_Ayah",  "data": "pekerjaan_ayah" },
                { title:"Pekerjaan_Ibu",  "data": "pekerjaan_ibu" },
                { title:"Jumlah_Anggota_Keluarga_Di_Rumah",  "data": "jumlah_anggota_keluarga_di_rumah" },
                { title:"Riwayat_Asi_Ekslusif",  "data": "riwayat_asi_eksekutif" }
                //{ title:"Action",      "defaultContent": btnDel + btnEdit, "width":"100px" },
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
        $http.get("{{ url('api/child') }}").then(function(res){
            table.rows.add(res.data.data).draw( );
            Swal.close();
        });
    }

    $scope.reloadlist();
});
</script>
@endsection