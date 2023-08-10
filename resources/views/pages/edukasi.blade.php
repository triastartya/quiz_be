


@extends('template.layout')
@section('content')
<style>
    .pdf{
        height: 70vh;
        width: 100%;
    }
</style>
    <section class="content">
        <!-- Default box -->
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Edukasi -> <% keterangan[edukasi-1] %></h3>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <button ng-click="clickEdu(1)" type="button" class="btn btn-success btn-sm">Stunting?</button>
                    <button ng-click="clickEdu(2)" type="button" class="btn btn-success btn-sm">Dampak stunting</button>
                    <button ng-click="clickEdu(3)" type="button" class="btn btn-success btn-sm">Mencegah stunting</button>
                    <button ng-click="clickEdu(4)" type="button" class="btn btn-success btn-sm">Interfensi untuk remaja stunting</button>
                    <button ng-click="clickEdu(5)" type="button" class="btn btn-success btn-sm">Menu bergizi seimbang untuk remaja</button>
                </div>
                <span>
                    <form id='formedukasi' enctype="multipart/form-data" >
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>File PDF <% keterangan[edukasi-1] %></label>
                                    <input type="file" name ='file' id="file">
                                </div>
                            </div>
                        </div>
                        <div style="margin-bottom:20px">
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                    <div class="row" ng-show="edukasi==1">
                        <div class="col-12">
                            <object data="{{ url('/') }}/edukasi/1.pdf" type="application/pdf" class="pdf" >
                            <p>Alternative text - include a link <a href="{{ url('/') }}edukasi/1.pdf">to the PDF!</a></p>
                            </object>
                        </div>
                    </div>
                    <div class="row" ng-show="edukasi==2">
                        <div class="col-12">
                            <object data="{{ url('/') }}/edukasi/2.pdf" type="application/pdf" class="pdf" >
                            <p>Alternative text - include a link <a href="{{ url('/') }}edukasi/2.pdf">to the PDF!</a></p>
                            </object>
                        </div>
                    </div>
                    <div class="row" ng-show="edukasi==3">
                        <div class="col-12">
                            <object data="{{ url('/') }}/edukasi/3.pdf" type="application/pdf" class="pdf" >
                            <p>Alternative text - include a link <a href="{{ url('/') }}edukasi/3.pdf">to the PDF!</a></p>
                            </object>
                        </div>
                    </div>
                    <div class="row" ng-show="edukasi==4">
                        <div class="col-12">
                            <object data="{{ url('/') }}/edukasi/4.pdf" type="application/pdf" class="pdf" >
                            <p>Alternative text - include a link <a href="{{ url('/') }}edukasi/4.pdf">to the PDF!</a></p>
                            </object>
                        </div>
                    </div>
                    <div class="row" ng-show="edukasi==5">
                        <div class="col-12">
                            <object data="{{ url('/') }}/edukasi/5.pdf" type="application/pdf" class="pdf" >
                            <p>Alternative text - include a link <a href="{{ url('/') }}edukasi/5.pdf">to the PDF!</a></p>
                            </object>
                        </div>
                    </div>
                </span>
            </div>
        </div>
        <!-- /.card -->
    </section>


      <!-- /.modal -->
@endsection

@section('ctrl')
<script>
app.controller("myCtrl", function($scope,$http) {
    $scope.edukasi = 1;
    $scope.pdf = "{{ url('/') }}/edukasi/edukasi.pdf";
    $scope.keterangan = ['Stunting?','Dampak stunting','Mencegah stunting','Interfensi untuk remaja stunting','Menu bergizi seimbang untuk remaja']
    var formedukasi = $("#formedukasi").validate({
            submitHandler: function(e) {
                var mydata = new FormData($('#formedukasi')[0]);
                    mydata.append('edukasi',$scope.edukasi);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                    url : "{{ url('api/uploadEdukasi') }}",
                    type: "POST",
                    data: mydata,
                    mimeType: "multipart/form-data",
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "JSON",
                    success: function(data)
                    {
                        $('#formedukasi')[0].reset();
                        Swal.close();
                        location.reload();

                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        Swal.fire({type: 'error',title: 'Oops...',text: 'Something went wrong!',})
                    },
                    beforeSend: function(){
                        Swal.fire({title: 'Loading..',onOpen: () => {Swal.showLoading()}})
                    }
                });
                return false;
            }
        });
    
    $scope.clickEdu = function(edu){
        $scope.edukasi = edu;
    }

});
</script>
@endsection