<!DOCTYPE html>
<html>

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width,initial-scale=1.0" />
     <link rel="stylesheet" href="{{asset('CSS/register.css')}}" />
     <title>Register</title>
</head>

<body>
     @if (Session::has('error'))
          <div class="error" id="error">{{Session::get('error')}}</div>
     @endif
     <h1 class="title">Sign Up</h1>
     <section class="register-section">
          <img src="{{asset('IMAGES/register.png')}}" alt="error">
          <form action="{{url('/register')}}" method="POST" enctype="multipart/form-data">
               @csrf
               <div class="container">
                    <div class="input-container">
                         <div class="input-file">
                              <img id="image" src="{{asset('IMAGES/user.jpg')}}" />
                              <input id="file" type="file" accept=".png,.jpg,.jpeg" name="image" />
                         </div>
                    </div>
               </div>
               @error('full_name')
                    <div style="z-index: 8;" class="error">{{$message}}</div>
               @enderror
               @error('birth_date')
                    <div style="z-index: 7;" class="error">{{$message}}</div>
               @enderror
               <div class="container">
                    <div class="input-container">
                         <div>Name</div>
                         <input value="{{old('full_name')}}" type="text" name="full_name" />
                    </div>
                    <div class="input-container">
                         <div>Birth Date</div>
                         <input value="{{old('birth_date')}}" type="date" name="birth_date" value="2024-11-07" />
                    </div>
               </div>
               @error('phone_number')
                    <div style="z-index: 6;" class="error">{{$message}}</div>
               @enderror
               @error('account_type')
                    <div style="z-index: 5;" class="error">{{$message}}</div>
               @enderror
               <div class="container">
                    <div class="input-container">
                         <div>Phone Number</div>
                         <input value="{{old('phone_number')}}" type="number" name="phone_number" />
                    </div>
                    <div class="input-container">
                         <div>Account Type</div>
                         <select name="account_type">
                              <option value="regular user" {{old('account_type') == 'regular user'? 'selected':''}}>Regular User</option>
                              <option value="service provider" {{old('account_type') == 'service provider'? 'selected':''}}>Service Provider</option>
                         </select>
                    </div>
               </div>
               @error('email')
                    <div style="z-index: 4;" class="error">{{$message}}</div>
               @enderror
               @error('password')
                    <div style="z-index: 3;" class="error">{{$message}}</div>
               @enderror
               <div class="container">
                    <div class="input-container">
                         <div>Email</div>
                         <input type="text" name="email" value="{{old('email')}}" />
                    </div>
                    <div class="input-container">
                         <div>Password</div>
                         <input type="password" name="password" />
                    </div>
               </div>
               @error('confirm_password')
                    <div style="z-index: 2;" class="error">{{$message}}</div>
               @enderror
               @error('gender')
                    <div style="z-index: 1;" class="error">{{$message}}</div>
               @enderror
               <div class="container">
                    <div class="input-container">
                         <div>Confirm Password</div>
                         <input type="password" name="confirm_password" />
                    </div>
                    <div class="input-container">
                         <div>Gender</div>
                         <select name="gender">
                              <option value="male" {{old('gender') == 'male'? 'selected':''}}>Male</option>
                              <option value="female" {{old('gender') == 'female'? 'selected':''}}>Female</option>
                         </select>
                    </div>
               </div>
               <button type="submit"></button>
          </form>
          <div class="login-div">
               Already have an account? <a href="{{url('/login')}}">Sign in</a>
          </div>
     </section>

     <script src="{{asset('JS/selected_image_view.js')}}"></script>
     <script src="{{asset('JS/error_message.js')}}"></script>
</body>

</html>