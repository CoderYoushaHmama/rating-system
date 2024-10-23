<!DOCTYPE html>
<html>

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width,initial-scale=1.0" />
     <link rel="stylesheet" href="{{asset('CSS/edit_password.css')}}" />
     <title>Edit Password</title>
</head>

<body>
     @if (Session::has('error'))
          <div class="error" id="error">{{Session::get('error')}}</div>
     @endif
     <h1 class="title">Edit Your Password</h1>
     <form action="{{url('/edit-password')}}" method="POST">
          @csrf
          @error('password')
               <div style="z-index: 3;" class="error">{{$message}}</div>
          @enderror
          <div>Password</div>
          <input type="password" name="password" />
          @error('new_password')
               <div style="z-index: 2;" class="error">{{$message}}</div>
          @enderror
          <div>New Password</div>
          <input type="password" name="new_password" />
          @error('confirm_password')
               <div class="error">{{$message}}</div>
          @enderror
          <div>Confirmation Password</div>
          <input style="z-index: 1;" type="password" name="confirm_password" />
          <button type="submit">Edit</button>
     </form>

     <script src="{{asset('JS/error_message.js')}}"></script>
</body>

</html>