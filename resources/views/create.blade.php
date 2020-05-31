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
              <ul id="errorMsg"></ul>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="formDetailId" role="form">
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
                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" value="{{ old('email') }}" onblur="checkEmail(this.value)">
                    {!! $errors->first('email', '<span class="text-danger"><i class="fa fa-times"></i> :message</span>') !!}
                    <span id="emailid"></span>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Phone </label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone" value="{{ old('phone') }}">
                    {!! $errors->first('phone', '<span class="text-danger"><i class="fa fa-times"></i> :message</span>') !!}
                  </div>
                  <div id="message2"></div>
                  <div id="subjectId" class="subjectRow">
                  <label>Subject </label>
                  <div class="input-group col-md-6">
                    <input type="text" class="form-control subject" id="subject" name="subject[]" placeholder="Enter subject" value="{{ old('subject') }}">
                    <div class="input-group-append">
                      <span id="addBtn" class="btn btn-success"> + </span>
                    </div>
                    {!! $errors->first('subject', '<span class="text-danger"><i class="fa fa-times"></i> :message</span>') !!}
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
            
<script type = "text/javascript" src = "{{ asset('js/jquery.min.js') }}"></script>
<script type = "text/javascript" src = "{{ asset('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
function checkEmail(email){ // check email id already exist
  $.ajax({
    url: "{{route('user.checkemail')}}",
    type: 'POST',
    headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    data:{email:email},
    success:function(response){
    if(response.status=='success'){
      $("#emailid").html("The email has already been taken.");
      $("#emailid").css('color', 'red');
    }else{
      $("#emailid").html("");
    }
    }
  });
}
$(document).ready(function(){
$("#submitBtnId").on('click', function(e){ //// Ajax call to the server.
  e.preventDefault();
  $("#formDetailId").valid();
  var name = $('#name').val();
  var email = $('#email').val();
  var phone = $('#phone').val();
  var subjects = $("input[name='subject[]']").map(function(){
    return $(this).val();
  }).get();
  if(name && email && phone && (subjects.length > 0)){
      $.ajax({
        url:"{{ route('user.store') }}",
        type:"post",
        dataType:"json",
        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data:{
          name : name,
          email : email,
          phone : phone,
          subject : subjects
        },
        success:function(response){
          if(response.status == "success"){
            $("#errorMsg").html('');
            $("#msg").html("Record added successfully.");
            $("#errorMsg").css('color', 'green');
          }else{
            $("#msg").html("Something went wrong!");
          }
        },
        error: function (response) {
          var errors = response.responseJSON.errors;
          $("#errorMsg").html('');
          $.each(errors,function(key,val){
            $("#errorMsg").append("<li>"+val+"</li>");
            $("#errorMsg").css('color', 'red');
          });
        }
    });
  }else{
    return false;
  }
});
//// Add more input box and delete.
var i = 1;
$("#addBtn").on("click", function(){
    if($("#formDetailId .subjectRow").length < 5){
      $("#formDetailId #subjectId").append('<div class="subjectRow" id="row'+i+'"><label>Subject </label><div class="input-group col-md-6"><input type="text" class="form-control subject" id="subject'+i+'" name="subject[]" placeholder="Enter subject" value=""><div class="input-group-append"><span id="'+i+'" class="btn btn-danger deleteBtn"> - </span></div></div></div>');
      i++;
    }else{
      $("#message2").html("You have crossed your limit!");
    }
});
$(document).on("click",".deleteBtn", function(){
  var id = $(this).attr("id");
    $("#row"+id+"").remove();
    $("#message2").html('');
});
////########################
$("#formDetailId").validate({
  rules: {
    name: 'required',
    phone: 'required',
    email: {
      required: true,
      email: true
    }
  },
  messages: {
    name: 'This field is required',
    phone: 'This field is required',
    email: {
      required : 'This field is required',
      email : 'Email address should be valid'
    }
  },
  submitHandler: function(form) {
      form.submit();
  }
});
});
</script>
    </body>
</html>
