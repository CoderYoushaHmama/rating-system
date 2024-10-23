<!DOCTYPE html>
<html>

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width,initial-scale=1.0" />
     <link rel="stylesheet" href="{{asset('CSS/login.css')}}" />
     <title>Login</title>
</head>

<body>
     @if (Session::has('error'))
          <div class="error" id="error">{{Session::get('error')}}</div>
     @endif
     <h1 class="title titlee">Login Page</h1>
     <section class="login-section">
          <div class="container">
               <div class="image-container">
                    <img src="{{asset('IMAGES/login.png')}}" alt="error" />
               </div>
               <div class="form-container">
                    <div class="welcome">Welcome to</div>
                    <h1 class="container-title">Rating System</h1>
                    <form method="POST" action="{{url('/login')}}">
                         @csrf
                         @error('email')
                              <div style="z-index: 2;" class="error">{{$message}}</div>
                         @enderror
                         <div class="input-container">
                              <img src="{{asset('IMAGES/email.png')}}" />
                              <input placeholder="Enter Your Email" value="{{old('email')}}" type="text" name="email">
                         </div>
                         @error('password')
                         <div style="z-index: 1;" class="error">{{$message}}</div>
                         @enderror
                         <div class="input-container">
                              <img src="{{asset('IMAGES/password.png')}}" />
                              <input placeholder="Enter Your Password" type="password" name="password">
                         </div>
                         <a href="{{url('/forgot-password')}}" class="forgot-btn">Forgot Password?</a>
                         <button type="submit">Login</button>
                         <div class="create-account-container">
                              Don't have an account? <a href="{{url('/register')}}">Register</a>
                         </div>
                    </form>
               </div>
          </div>
     </section>

     <script src="{{asset('JS/error_message.js')}}"></script>
</body>

</html>