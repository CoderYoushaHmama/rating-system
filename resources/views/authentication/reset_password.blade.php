<!DOCTYPE html>
<html>

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width,initial-scale=1.0" />
     <link rel="stylesheet" href="{{asset('CSS/reset_password.css')}}" />
     <title>Reset Password</title>
</head>

<body>
     @if (Session::has('error'))
          <div id="error" class="error" id="error">{{Session::get('error')}}</div>
     @endif
     <h1 class="title">Reset Your Password</h1>
     <form action="{{url('/reset-password')}}" method="POST">
          @csrf
          <input id="email" type="text" style="display: none;" name="email"/>
          @error('new_password')
               <div style="z-index: 2;" class="error">{{$message}}</div>
          @enderror
          <div>New Password</div>
          <input type="password" name="new_password" />
          @error('confirm_password')
               <div style="z-index: 1;" class="error">{{$message}}</div>
          @enderror
          <div>Confirmation Password</div>
          <input type="password" name="confirm_password" />
          <button type="submit">Set</button>
     </form>


     <script src="{{asset('JS/error_message.js')}}"></script>
     <script>
          document.getElementById('email').setAttribute('value',localStorage.getItem('email'));
     </script>
</body>
</html>