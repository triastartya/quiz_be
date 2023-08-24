@extends('template.layout')
@section('content')
    <section class="content">
        <!-- Default box -->
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Data Jawaban</h3>
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

    var table =  $('#listdatatable').DataTable({
            dom: 'Bfrtip',
            sScrollX: true,
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            columns: [
                { title:"Anak" ,     "data":"anak","width":"200px" },
                { title:"Tangal Input" ,     "data":"tangal_input","width":"200px" },
                { title:"quiz" ,     "data":"quiz" ,"width":"500px"},
                { title:"soal" ,     "data":"soal" ,"width":"800px"},
                { title:"is_isian" ,     "data":"is_isian","width":"50px" },
                { title:"jawaban" ,     "data":"jawaban","width":"200px" },
                { title:"isian" ,     "data":"isian" ,"width":"100px"},
                { title:"score" ,     "data":"score" ,"width":"50px"},
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
        $http.get("{{ url('api/jawaban') }}").then(function(res){
            table.rows.add(res.data.data).draw( );
            Swal.close();
        });
    }

    $scope.reloadlist();
});
</script>
@endsection