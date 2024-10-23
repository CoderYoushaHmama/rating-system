<!DOCTYPE html>
<html>

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width,initial-scale=1.0" />
     <link rel="stylesheet" href="{{asset('CSS/profile.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/sidebar.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/header.css')}}" />
     <title>Profile</title>
</head>

<body>
     <div style="display: none;">@section('page_type') {{$type = 'profile'}} @endsection</div>

     @if ($user->account_type === 'admin')
          @include('constants.admin-header')
          @elseif ($user->account_type === 'service provider')
          @include('constants.service-provider-header')
          @elseif ($user->account_type == 'regular user')
          @include('constants.regular-user-header')
     @endif
     @if (Session::has('success'))
          <div class="success" id="error">{{Session::get('success')}}</div>
     @endif
     <section class="profile-section">
          <h1 class="title">Welcome, {{$user->full_name}}</h1>
          <div class="register-date">{{$user->created_at->format('Y-m-d')}}</div>
          <div class="separator"></div>
          <form action="{{url('/')}}" method="POST" enctype="multipart/form-data">
               @csrf
               <div class="header">
                    <div class="image-container">
                         @if ($user->image)
                              <img id="image" src="{{url('')}}/{{$user->image}}" alt="error">
                              @else
                              <img id="image" src="../IMAGES/user.jpg" alt="error">
                         @endif
                         <input id="file" type="file" name="image" accept=".png,.jpg,.jpeg" />
                    </div>
                    <div class="username">{{$user->full_name}}</div>
                    <div class="email">{{$user->email}}</div>
               </div>
               @error('full_name')
                    <div style="z-index: 4;" class="error">{{$message}}</div>
               @enderror
               @error('birth_date')
                    <div style="z-index: 3;" class="error">{{$message}}</div>
               @enderror
               <div class="inputs-container">
                    <div class="container">
                         <div>Full Name</div>
                         <input placeholder="Your Full Name" type="text" name="full_name" value="{{$user->full_name}}" />
                    </div>
                    <div class="container">
                         <div>Birth Date</div>
                         <input type="date" name="birth_date" value="{{$user->birth_date}}" />
                    </div>
               </div>
               @error('phone_number')
                    <div style="z-index: 2;" class="error">{{$message}}</div>
               @enderror
               <div class="inputs-container">
                    <div class="container">
                         <div>Phone Number</div>
                         <input placeholder="Your Phone Number" type="number" name="phone_number" value="{{$user->phone_number}}" />
                    </div>
                    <div class="container">
                         <div>Account Type</div>
                         <select name="#" disabled>
                              @if ($user->account_type === 'admin')
                                   <option value="'admin" selected>Admin</option>
                                   @else
                                   <option value="service provider" {{$user->account_type == 'service provider'? 'selected' : ''}}>Service Provider</option>
                                   <option value="regular user" {{$user->account_type == 'regular user'? 'selected' : ''}}>Regular User</option>
                              @endif
                         </select>
                    </div>
               </div>
               @error('gender')
                    <div style="z-index: 1;" class="error">{{$message}}</div>
               @enderror
               <div class="inputs-container">
                    <div class="container">
                         <div>Gender</div>
                         <select name="gender">
                              <option value="male" {{$user->gender == 'male'?'selected':''}}>Male</option>
                              <option value="female" {{$user->gender == 'female'?'selected':''}}>Female</option>
                         </select>
                    </div>
               </div>
               <div class="email-container">
                    <div class="title">My Email Address</div>
                    <div class="container">
                         <img src="../SVG/email.svg" />
                         <span>{{$user->email}}</span>
                    </div>
               </div>
               <button type="submit">Edit</button>
          </form>
          <a class="reset-password" href="{{url('/edit-password')}}">Reset password</a>
     </section>

     <script src="{{asset('JS/selected_image_view.js')}}"></script>
     <script src="{{asset('JS/sidebar.js')}}"></script>
     <script src="{{asset('JS/error_message.js')}}"></script>
</body>

</html>