<!DOCTYPE html>
<html>

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width,initial-scale=1.0" />
     <link rel="stylesheet" href="{{asset('CSS/users.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/header.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/sidebar.css')}}" />
     <title>Users</title>
</head>

<div style="display: none;">@section('page_type') {{$type = 'users'}} @endsection</div>
<body id="body">
     @include('constants.admin-header')

     @if (Session::has('success'))
          <div class="success" id="error">{{Session::get('success')}}</div>
     @endif
     <h1 class="main-title">Users</h1>
     <section class="users-section">
          @foreach ($users as $u)
               @if ($u->id != $user->id)
                    <div class="card">
                         @if ($u->image)
                              <img class="profile-image" src="{{url('')}}/{{$u->image}}" alt="error" />
                              @else
                              <img class="profile-image" src="{{asset('IMAGES/user.jpg')}}" alt="error" />
                         @endif
                         <div class="username">{{$u->full_name}}</div>
                         <div class="registeration-date">{{$u->created_at->format('Y-m-d')}}</div>
                         <div class="buttons-container">
                              <a href="{{url('/users/update/'.$u->id)}}"><img class="btn" src="{{asset('SVG/edit.svg')}}" /></a>
                              <a class="delete-btns"><img class="btn" src="{{asset('SVG/delete.svg')}}" /></a>
                         </div>
                    </div>
                    <section class="delete-confirmation-section">
                         <div class="text">Are you sure that you want to delete {{$u->full_name}}?</div>
                         <div class="buttons-container">
                              <a href="{{url('/users/delete/'.$u->id)}}" class="btn delete-btn">Delete</a>
                              <button class="btn cancel-btn">Cancel</button>
                         </div>
                    </section>
               @endif
          @endforeach
     </section>
     <div class="add-user-btn">
          <a href="{{url('/users/add')}}">
               <img src="{{asset('SVG/add-user.svg')}}" />
          </a>
     </div>
     <div id="background" class="background"></div>

     <script src="{{asset('JS/menu.js')}}"></script>
     <script src="{{asset('JS/delete_window.js')}}"></script>
     <script src="{{asset('JS/sidebar.js')}}"></script>
     <script src="{{asset('JS/error_message.js')}}"></script>
</body>

</html>