@extends('template.layout')
@section('content')
    <link rel="stylesheet" href="{{ url('/') }}/template/dragula/dragula.min.css">
    <style>
        .form-check-input:disabled~.form-check-label, .form-check-input[disabled]~.form-check-label {
            color: #000000;
        }
        input:disabled {
            color: #000000;
        }
    </style>
    <section class="content">
        <!-- Default box -->
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Soal <% data.title %></h3>
            </div>
            <div class="card-body">
                <div class="row" >
                    <div class="col-md-12">
                        <div id="list">
                            <div class="soal border-bottom mb-3 p-2 row" uuid="<% soal.id %>" ng-repeat="soal in data.soal">
                                <div class="col-sm-12">
                                <img src="{{ url('/') }}/kuis/<% soal.gambar %>" height="200"><br/>
                                <strong><% soal.no_urut %>. <% soal.question %></strong> |
                                <a ng-click="edit( soal.id )" class="text-success" href='javascript:void(0)' title='Setting'><i class='fa fa-edit tip pointer posdel'></i></a> | 
                                <a ng-click="delete( soal.id )" class="text-danger" href='javascript:void(0)' title='Setting'><i class='fa fa-trash-alt tip pointer posdel'></i></a>
                                <div class="form-group">
                                    <div class="form-check" ng-repeat="options in soal.options">
                                        {{-- <input class="form-check-input" data-ng-model="options.answer" data-ng-value="1"  type="radio" disabled> --}}
                                        <label class="form-check-label"><% options.question %></label>
                                        <label class="form-check-label">(score : <% options.score %>)</label>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <button ng-click="create_question()" type="button" class="btn btn-outline-primary mb-3"><i class="fa fa-plus"></i> Tambah Soal</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card -->
        <div class="modal fade" id="modalformquestion">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="formqustion" enctype="multipart/form-data">
                    <input type="text" class="form-control hidden" ng-model="id_question" name="id_question" id="id_question">
                    <input type="number" class="form-control hidden" ng-model="score_soal" name="score_soal" id="score_soal" >
                    <input type="number" class="form-control hidden" ng-model="answer" name="answer" id="answer" >
                    <div class="modal-header">
                        <h4 class="modal-title">Question</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-sm-12 mb-2" style="text-align: center;!important">
                                <input type="file" id="gambar" name="gambar" onchange="angular.element(this).scope().SelectFile(event)" />
                                <hr />
                                <img ng-src="<% PreviewImage %>" ng-show="PreviewImage != null" alt="" style="height:200px" />
                            </div>
                            {{-- <label for="nama" class="col-sm-2 col-form-label">Question</label> --}}
                            <div class="col-sm-12">
                                <textarea type="text" class="form-control" ng-model="question" name="question" id="question"></textarea>
                            </div>
                            <div class="col-sm-12 m-2">
                                <h5>Score Dan Jawaban</h5>
                            </div>
                            <span id="list_jawaban" style="width:100%">
                                <div class="col-sm-12 mb-2 jawaban_soal" uuid="<% jawaban.id %>" ng-repeat="jawaban in options">
                                    <div class="input-group row">
                                        {{-- <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <input type="radio" name="answer" ng-checked="jawaban.answer" data-ng-model="jawaban.answer" data-ng-value="true">
                                            </span>
                                        </div> --}}
                                        {{-- <div class="row"> --}}
                                            <div class="col-sm-2">
                                                <input type="number" class="form-control" ng-model="jawaban.score">
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" ng-model="jawaban.option">
                                            </div>
                                        {{-- </div> --}}
                                        <div class="input-group-append col-sm-1">
                                            <button type="button" ng-click="del_jawaban($index)" class="btn btn-danger"><i class='fa fa-trash-alt tip pointer posdel'></i></button>
                                        </div>
                                    </div>
                                </div>
                            </span>
                            <div class="col-sm-12 m-2">
                                <button ng-click="add_jawaban()" type="button" class="btn btn-outline-primary mb-3"><i class="fa fa-plus"></i> Tambah Jawaban</button>
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
    </section>

@endsection

@section('ctrl')
<script src='{{ url('/') }}/template/dragula/dragula.min.js'></script>
<script>
app.controller("myCtrl", function($scope,$http) {

    $scope.SelectFile = function (e) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $scope.PreviewImage = e.target.result;
            $scope.$apply();
        };
        reader.readAsDataURL(e.target.files[0]);
    };

    $scope.urut = [];
    $scope.urut_jawaban = [];
    $scope.options = [];
    $scope.id = 0;
    $scope.score_soal = 100;
    $scope.answer = 1;
    $scope.add_jawaban = function(){
        $scope.options.push({'option':'','answer':false,'score':0});
    }
    $scope.del_jawaban = function(index){
	   $scope.options.splice(index,1);
	}

    dragula([document.getElementById('list')])
    .on('out', function (el, container) {
        var nodeList=  document.querySelectorAll(".soal");
        $scope.urut = []
        for(i=0;i<nodeList.length;i++ ){
            $scope.urut.push(nodeList[i].getAttribute('uuid'));
        }
        
        console.log($scope.urut);
    });

    dragula([document.getElementById('list_jawaban')])
    .on('out', function (el, container) {
        var nodeList=  document.querySelectorAll(".jawaban_soal");
        $scope.urut_jawaban = []
        for(i=0;i<nodeList.length;i++ ){
            $scope.urut_jawaban.push(nodeList[i].getAttribute('uuid'));
        }
        
        console.log($scope.urut_jawaban);
    });
    
    $scope.data = [];
    
    $scope.setting = false;

    var btnSetting =  " <a class='btn btn-outline-success btn-nav' href='javascript:void(0)' title='Setting' id='SettingRow' ><i class='fa fa-edit tip pointer posdel'></i></a>";
    
    var table =  $('#listdatatable').DataTable({
            columns: [
                { title:"Id" ,     "data":"id" ,     "width":"20px" },
                { title:"jenis_quiz",    "data": "jenis_quiz" },
                { title:"title",  "data": "title" },
                { title:"minimal_score",   "data": "minimal_score" },
                { title:"Action",      "defaultContent": btnSetting, "width":"100px" },
            ]
    });

    $('#listdatatable tbody').on('click', '#SettingRow', function () {
        $scope.setting = true;
        $scope.data = table.row( tr ).data();
    });

    $scope.reload = function(){
        Swal.fire({title: 'Loading..',onOpen: () => {Swal.showLoading()}})
        
        //table.clear().draw();
        $http.get("{{ url('api/quizbyjenis/1') }}").then(function(res){
            //table.rows.add(res.data.data).draw( );
            $scope.data = res.data.data;
            Swal.close();
        });
    }

    $scope.reload();

    $scope.create_question = function(){
        $scope.update       = false;
        $scope.question     = '';
         $('#gambar').val('');
        $scope.PreviewImage = "zz";
        $scope.options = [
            {'option':'','answer':false,'score':0}
        ];
        $('#modalformquestion').modal('show');
    }

    var validator_question = $("#formqustion").validate({
        rules: {
            question: {
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
            urutan = 1;
            if($scope.data){
                urutan = $scope.data.soal.length+1;
            }
            option = JSON.stringify($scope.options);
            if($scope.update){
                type_method = "POST"
                vurl = "{{ url('api/editQuis') }}";
                //param = $("#formqustion").serialize()+'&id_quiz='+$scope.data.id+'&option='+option
                param = new FormData($('#formqustion')[0]);
                param.append('id_quiz',$scope.data.id);
                param.append('option',option);
                param.append('id',$scope.id);
            }else{
                type_method = "POST"
                vurl = "{{ url('api/tambahQuis') }}";
                //param = $("#formqustion").serialize()+'&id_quiz='+$scope.data.id+'&no_urut='+urutan+'&option='+option
                param = new FormData($('#formqustion')[0]);
                param.append('id_quiz',$scope.data.id);
                param.append('option',option);
                param.append('no_urut',urutan);
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                url : vurl,
                type: type_method,
                data: param,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status){
                        Swal.close();
                        $('#modalformquestion').modal('hide');
                        $scope.reload();
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


    $scope.edit = function(x){
        $scope.id = x;
        $scope.update       = true;
        var current = $scope.data.soal.find(function(el){
            return el.id == x
        })
        console.log(current);
        $scope.question = current.question;
        $scope.options = [];
        for(i=0;i<current.options.length;i++){
            $scope.options.push({
                'option':current.options[i].question,
                'answer': (current.options[i].answer==1)?true:false,
                'score' :current.options[i].score,
            })
        }
                
        validator_question.resetForm();
        $('#gambar').val('');
        $scope.PreviewImage = "{{ url('/') }}/kuis/"+current.gambar;
        $('#modalformquestion').modal('show');
        {{-- $scope.$apply(); --}}

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
                $http.delete("{{ url('api/quiz_soal') }}"+"/"+x).then(function(res){
                    if(res.data.status){
                        $scope.reload();
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