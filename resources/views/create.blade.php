<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        
    </head>
    <body>
     <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add detail</h3>
              </div>
              <span id="msg"></span>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="frmid" role="form">
              <!-- CSRF Token -->
              {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Name </label>
                    <input type="text" class="form-control {{ $errors->has('product_name') ? ' ' : '' }}" id="name" name="name" value="{{ old('name') }}" placeholder="Enter name">
                    {!! $errors->first('name', '<span class="text-danger"><i class="fa fa-times"></i> :message</span>') !!}
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Email </label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" value="{{ old('email') }}">
                    {!! $errors->first('email', '<span class="text-danger"><i class="fa fa-times"></i> :message</span>') !!}
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Phone </label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone" value="{{ old('phone') }}">
                    {!! $errors->first('phone', '<span class="text-danger"><i class="fa fa-times"></i> :message</span>') !!}
                  </div>

                  <div id="subjectid">
                  <label>Subject </label>
                  <div class="input-group col-md-6">
                    <input type="text" class="form-control subject" id="subject" name="subject[]" placeholder="Enter subject" value="{{ old('subject') }}">
                    <div class="input-group-append">
                      <button id="addmore" class="btn btn-success"> + </button>
                    </div>
                    {!! $errors->first('subject', '<span class="text-danger"><i class="fa fa-times"></i> :message</span>') !!}
                  </div>
                  </div>

                   <div id="subjectid">
                  <label>Subject </label>
                  <div class="input-group col-md-6">
                    <input type="text" class="form-control subject" id="subject" name="subject[]" placeholder="Enter subject" value="{{ old('subject') }}">

                  </div>
                  </div>

                   <div id="subjectid">
                  <label>Subject </label>
                  <div class="input-group col-md-6">
                    <input type="text" class="form-control subject" id="subject" name="subject[]" placeholder="Enter subject" value="{{ old('subject') }}">
              
                  </div>
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button id="submitBtnId" type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->



<script type = "text/javascript" src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $("#submitBtnId").on('click', function(e) {
  e.preventDefault();
  var subjects = $("input[name='subject[]']")
              .map(function(){return $(this).val();}).get();
  var data = {
      name : $('#name').val(),
      email : $('#email').val(),
      phone : $('#phone').val(),
      subject : subjects
    }
  if(data){
    $.ajax({
    url:"{{ route('user.store') }}",
    type:"post",
    dataType:"json",
    headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
    data: data,
    success:function(response){
      console.log();
      if(response.isSuccess == true){
        $("#msg").html("Record added successfully.");
      }else{
        $("#msg").html("Something went wrong!");
      }
    },
    error:function(){
    }
  });
  }else{
    return false;
  }
});
});

// - jQuery Validation Plugin
$("#frmid").validate({
  rules: {
    name: "required",
    phone: {
      required: true,
      minlength: 10
    },
    email: {
      required: true,
      email:true
    },
    subject: "required",
  },
  messages: {
    name: "Please enter name",
    phone: "Please enter phone",
    email: {
      required: "Please provide a email id",
      email: "Please provide a valid email id",
    },
    subject: "Please enter name",
  }
});

  // $("#addmore").on("click", function(){
  //   $("#frmid #subjectid").append('<div><label>Subject </label><div class="input-group col-md-6"><input type="text" class="form-control" id="subject" name="subject" placeholder="Enter subject" value="{{ old("subject") }}"><div class="input-group-append"><button class="btn btn-danger"> + </button></div></div></div>');
  // })
</script>


    </body>
</html>
