<!DOCTYPE html>
<html>

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width,initial-scale=1.0" />
     <link rel="stylesheet" href="{{asset('CSS/forget_password.css')}}" />
     <meta name="csrf-token" content="{{csrf_token()}}" />
     <title>Forgot Password</title>
</head>

<body>
     <div id="error" class="error"></div>
     <img class="page-image" src="{{asset('IMAGES/forgot-password.jpg')}}" alt="error" />
     <form id="ajaxForm" method="POST">
          <div id="form-1" class="form-1">
               <div class="input-title">Email Address</div>
               <input type="text" name="email" />
               <button id="nextBtn" type="button">Next</button>
          </div>
          <div id="form-2" class="form-2">
               <h1 class="form-title">We Sent Verification Code To Your Email</h1>
               <div class="input-title">Verification Code</div>
               <input type="number" name="code" />
               <button id="checkBtn" type="button">Check</button>
          </div>
     </form>

     <script src="{{asset('JS/jquery-3.6.1.min.js')}}"></script>
     <script>
          var form1 = document.getElementById('form-1');
          var form2 = document.getElementById('form-2');
          var error = document.getElementById('error');
          function view(){
               form2.style.display = 'block'
          }
          function close(){
               form1.style.display = 'none';
          }
          function viewError(){
               error.style.display = 'block';
               setTimeout(function(){
                    error.style.display = 'none';
               },5000)
          }
          function closeError(){
               error.style.display = 'none';
          }

     
          $(document).ready(function(){
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
  
              var form = $('#ajaxForm')[0];
              $('#nextBtn').click(function (){
                  $('.error-messages').html('');
                  var formData = new FormData(form);
  
                  $.ajax({
                      url: '{{route("forgot.password")}}',
                      method: 'POST',
                      processData: false,
                      contentType: false,
                      data: formData,
  
                      success: function (response){
                         view();
                         close();
                      },
                      error: function (error){
                          if(error){
                              viewError()
                              $('#error').html(error.responseJSON.errors.email);
                          }
                      }
                  });
              });
              $('#checkBtn').click(function (){
                  $('.error-messages').html('');
                  var formData = new FormData(form);
  
                  $.ajax({
                      url: '{{route("check.verification")}}',
                      method: 'POST',
                      processData: false,
                      contentType: false,
                      data: formData,
  
                      success: function (response){
                         localStorage.setItem('email',response.success);
                         location.replace('{{url("reset-password")}}');
                      },
                      error: function (error){
                          if(error){
                              viewError();
                              if(error.responseJSON.error){
                                   $('#error').html(error.responseJSON.error);
                              }else{
                                   $('#error').html(error.responseJSON.errors.code);
                              }
                          }
                      }
                  });
              });
          });
      </script>
</body>

</html>