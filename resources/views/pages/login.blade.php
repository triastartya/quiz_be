<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('/') }}/template/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ url('/') }}/template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('/') }}/template/dist/css/adminlte.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ url('/') }}/template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a  class="h1">Login</a>
    </div>
    <div class="card-body">
      <form id="forminput">
        <div class="input-group mb-3">
          <input type="text" class="form-control" id="username" name="username" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        {{-- <div class="pb-3">
          <div class="g-recaptcha" data-sitekey="6Ld3TQYcAAAAAEjWWwGCncbcX2AHDmuQoAwCkzm_" data-callback="verifyCaptcha"></div>
          <div id="g-recaptcha-error"></div>
        </div> --}}
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ url('/') }}/template/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('/') }}/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ url('/') }}/template/dist/js/adminlte.min.js"></script>
<!-- jQuery -->
  <script src="{{ url('/') }}/template/plugins/jquery/jquery.min.js"></script>
  <!-- jquery-validation -->
  <script src="{{ url('/') }}/template/plugins/jquery-validation/jquery.validate.min.js"></script>
  <script src="{{ url('/') }}/template/plugins/jquery-validation/additional-methods.min.js"></script>

  <script src="{{ url('/') }}/template/plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src='https://www.google.com/recaptcha/api.js'></script>

 <script>
  $( document ).ready(function() {
    var validator = $("#forminput").validate({
        rules: {
            username: {
                required: !0,
            },
            password: {
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
            {{-- if(recaptcha_response.length == 0) {
              document.getElementById('g-recaptcha-error').innerHTML = '<span style="color:red;">This field is required.</span>';
              return false;
            } --}}
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                url : "{{ url('api/login_admin') }}",
                type: "POST",
                data:$("#forminput").serialize(),
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status){
                        Swal.close();
                        window.location.href = "{{ url('dashboard') }}";
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
  });

  var recaptcha_response = '';

  function verifyCaptcha(token) {
    recaptcha_response = token;
    document.getElementById('g-recaptcha-error').innerHTML = '';
  }

  </script>

</body>
</html>
