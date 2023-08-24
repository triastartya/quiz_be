@extends('template.layout')
@section('content')
    <section class="content">
        <!-- Default box -->
        <div class="card mt-3" ng-show="!detail">
            <div class="card-header">
                <h3 class="card-title">Data Hasil Penilaian</h3>
            </div>
            <div class="card-body">
                <div class="row" >
                    <div class="col-md-12">
                        <table id="listdatatable" class="table table-bordered table-css-history table-hover dataTable no-footer"></table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3" ng-show="detail">
            <div class="card-header">
                <h3 class="card-title">Jawaban</h3>
            </div>
            <div class="card-body">
            <button ng-click="kembali()" type="button" class="btn btn-outline btn-secondary mb-3"><i class="fa fa-arrow-left"></i> kembali</button>
                <div class="row" >
                    <div class="col-md-12" ng-repeat = "quis in active.quiz_submission">
                        <h4><% quis.answer.title %></h4>
                        <h6>Score : <% quis.score %></h6>
                        <h6>Status : <% quis.status %></h6>
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th style="width: 10px">#</th>
                              <th>Soal</th>
                              <th>Jawaban</th>
                              <th>Sekor</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr ng-repeat="soal in quis.answer.soal">
                              <td><% $index+1 %></td>
                              <td><% soal.question %></td>
                              <td><span ng-repeat="jawaban in soal.options | filter:{ jawaban: true }"><% jawaban.question %></span></td>
                              <td><span ng-repeat="jawaban in soal.options | filter:{ jawaban: true }"><% jawaban.score %></span></td>
                            </tr>
                          </tbody>
                          
                        </table>
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

    $scope.detail = false;
    $scope.active = null;
    
    var btnSoal =  " <a class='btn btn-outline-success btn-nav' href='javascript:void(0)' title='open soal' id='OpenSoal' >hasil</a>";
    var table =  $('#listdatatable').DataTable({
            dom: 'Bfrtip',
            sScrollX: true,
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            columns: [
                { title:"Action",      "defaultContent":btnSoal, "width":"100px" },
                { title:"Score",    "data": "score" },
                { title:"Status",    "data": "status" },
                { title:"Tanggal_input",    "data": "created_at" },
                { title:"NISN",    "data": "child.nisn" },
                { title:"Nama",    "data": "child.nama" },
                { title:"Email",    "data": "child.email" },
                { title:"Jenis_Kelamin",    "data": "child.jenis_kelamin" },
                { title:"Tanggal_Lahir",    "data": "child.tanggal_lahir" },
                { title:"Alamat",    "data": "child.alamat" },
                { title:"Berat_Badan",    "data": "child.berat_badan" },
                { title:"Tinggi_Badan",    "data": "child.tinggi_badan" },
                { title:"lila",    "data": "child.lila_p" },
                { title:"Tinggal",    "data": "child.tinggal" },
                { title:"Uang_Saku",    "data": "child.uang_saku" },
                { title:"Pendidikan_Ayah",  "data": "child.pendidikan_ayah" },
                { title:"Pendidikan_Ibu",  "data": "child.pendidikan_ibu" },
                { title:"Pekerjaan_Ayah",  "data": "child.pekerjaan_ayah" },
                { title:"Pekerjaan_Ibu",  "data": "child.pekerjaan_ibu" },
                { title:"Jumlah_Anggota_Keluarga_Di_Rumah",  "data": "child.jumlah_anggota_keluarga_di_rumah" },
                { title:"Riwayat_Asi_Ekslusif",  "data": "child.riwayat_asi_eksekutif" }
                //{ title:"Action",      "defaultContent": btnDel + btnEdit, "width":"100px" },
            ]
        });

        $('#listdatatable tbody').on('click', '#OpenSoal', function () {
            var tr = $(this).closest('tr');
            $scope.active = table.row(tr).data();
            console.log('active',$scope.active);
            $scope.detail = true;
            $("html, body").animate({ scrollTop: 0 }, "slow");
            $scope.$apply();
        });

        $('#listdatatable tbody').on('click', '#EditRow', function () {
            var tr = $(this).closest('tr');
            $scope.edit(table.row( tr ).data());
        });

    $scope.reloadlist = function(){
        Swal.fire({title: 'Loading..',onOpen: () => {Swal.showLoading()}})
        
        table.clear().draw();
        $http.get("{{ url('api/hasil') }}").then(function(res){
        console.log(res);
            table.rows.add(res.data.data).draw( );
            Swal.close();
        });
    }

    $scope.reloadlist();
    
    $scope.kembali = function(){
    $("html, body").animate({ scrollTop: 0 }, "slow");
        $scope.detail = false;
    }
});
</script>
@endsection