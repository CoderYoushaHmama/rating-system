<!DOCTYPE html>
<html>

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width,initial-scale=1.0" />
     <link rel="stylesheet" href="{{asset('CSS/add_user.css')}}" />
     <title>Add User</title>
</head>

<body>
     <section class="add-user-section">
          <h1 class="title">Add User</h1>
          <div class="separator"></div>
          <form action="{{url('/users/add')}}" method="POST" enctype="multipart/form-data">
               @csrf
               <div class="header">
                    <div class="image-container">
                         <img id="image" src="{{asset('IMAGES/user.jpg')}}" alt="error">
                         <input id="file" type="file" name="image" accept=".png,.jpg,.jpeg" />
                    </div>
               </div>
               <div class="inputs-container first">
                    @error('email')
                         <div style="z-index: 8;" class="error">{{$message}}</div>
                    @enderror
                    @error('password')
                         <div style="z-index: 7;" class="error">{{$message}}</div>
                    @enderror
                    <div class="container">
                         <div>Email</div>
                         <input value="{{old('email')}}" placeholder="Email Address" type="text" name="email" />
                    </div>
                    <div class="container">
                         <div>Password</div>
                         <input type="password" name="password" placeholder="Password" />
                    </div>
               </div>
               @error('full_name')
                    <div style="z-index: 6;" class="error">{{$message}}</div>
               @enderror
               @error('birth_date')
                    <div style="z-index: 5;" class="error">{{$message}}</div>
               @enderror
               <div class="inputs-container">
                    <div class="container">
                         <div>Full Name</div>
                         <input value="{{old('full_name')}}" placeholder="Full Name" type="text" name="full_name" />
                    </div>
                    <div class="container">
                         <div>Birth Date</div>
                         <input value="{{old('birth_date')}}" type="date" name="birth_date" value="2024-08-07" />
                    </div>
               </div>
               @error('phone_number')
                    <div style="z-index: 4;" class="error">{{$message}}</div>
               @enderror
               @error('account_type')
                    <div style="z-index: 3;" class="error">{{$message}}</div>
               @enderror
               <div class="inputs-container">
                    <div class="container">
                         <div>Phone Number</div>
                         <input value="{{old('phone_number')}}" placeholder="Phone Number" type="number" name="phone_number" />
                    </div>
                    <div class="container">
                         <div>Account Type</div>
                         <select name="account_type">
                              <option value="regular user" {{old('account_type') == 'regular user'?'selected':''}}>Regular User</option>
                              <option value="service provider" {{old('account_type') == 'service provider'?'selected':''}}>Service Provider</option>
                         </select>
                    </div>
               </div>
               @error('gender')
                    <div style="z-index: 2;" class="error">{{$message}}</div>
               @enderror
               <div class="inputs-container">
                    <div class="container">
                         <div>Gender</div>
                         <select name="gender">
                              <option value="male" {{old('gender')=='male'?'selected':''}}>Male</option>
                              <option value="female" {{old('gender')=='female'?'selected':''}}>Female</option>
                         </select>
                    </div>
               </div>
               <button type="submit">Add</button>
          </form>
     </section>
     <a href="{{url('/users')}}" class="back-btn">
          <img src="{{asset('SVG/back-square.svg')}}" />
     </a>

     <script src="{{asset('JS/selected_image_view.js')}}"></script>
</body>

</html>