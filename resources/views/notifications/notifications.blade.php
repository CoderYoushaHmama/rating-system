<!DOCTYPE html>
<html>

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width,initial-scale=1.0" />
     <link rel="stylesheet" href="{{asset('CSS/notifications.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/header.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/sidebar.css')}}" />
     <title>Notifications</title>
</head>

<div style="display: none;">@section('page_type') {{$type = 'notifications'}} @endsection</div>
<body>
     @if (Session::has('success'))
          <div class="success" id="error">{{Session::get('success')}}</div>
     @endif
     @include('constants.admin-header')
     <h1 class="main-title">Notifications</h1>
     <table>
          <tr>
               <td>User Name</td>
               <td>Account Type</td>
               <td colspan="2">Description</td>
               <td>Type</td>
               <td>Date</td>
          </tr>
          @foreach ($notifications as $notification)
               <tr>
                    <td>{{$notification->user->full_name}}</td>
                    <td>{{$notification->user->account_type}}</td>
                    <td colspan="2">{{$notification->description}}</td>
                    @if ($notification->type == 'insert')
                         <td><img src="{{asset('SVG/insert.svg')}}" /></td>
                         @elseif ($notification->type == 'update')
                         <td><img src="{{asset('SVG/edit.svg')}}" /></td>
                         @elseif ($notification->type == 'delete')
                         <td><img src="{{asset('SVG/delete.svg')}}" /></td>
                         @elseif ($notification->type == 'notify')
                         <td><img src="{{asset('SVG/notification.svg')}}" class="notification"/></td>
                    @endif
                    <td>{{$notification->created_at}}</td>
               </tr>
          @endforeach
     </table>
     <div id="background" class="background"></div>
     @foreach ($notifications as $notification)
          @if ($notification->type == 'notify')
               <section class="delete-comment-section">
                    <img class="close-btn" src="{{asset('SVG/close.svg')}}" />
                    <div class="header">
                         <a href="{{url('/users/update/'.$notification->rate->user->id)}}">
                              @if ($notification->rate->user->image)
                                   <img class="profile-image" src="{{url('')}}/{{$notification->rate->user->image}}" alt="error" />
                                   @else
                                   <img class="profile-image" src="{{asset('IMAGES/user.jpg')}}" alt="error" />
                              @endif
                         </a>
                         <div class="username">{{$notification->rate->user->full_name}}</div>
                         <div class="stars-container">
                              @for ($i=0; $i<floor($notification->rate->stars); $i++)
                                   <img src="{{asset('SVG/fill-star.svg')}}" />
                              @endfor
                              @for ($i=0; $i<5-floor($notification->rate->stars); $i++)
                                   <img src="{{asset('SVG/star.svg')}}" />
                              @endfor
                              
                         </div>
                    </div>
                    <hr />
                    <div class="comment">{{$notification->rate->comment}}</div>
                    <div class="buttons-container">
                         <a class="btn delete-btn" href="{{url('/rating/delete/'.$notification->rate->id)}}">Delete</a>
                         <a class="btn cancel-btn" href="{{url('/notifications/delete/'.$notification->id)}}">Reject</a>
                    </div>
               </section>
          @endif
          
     @endforeach

     <script src="{{asset('JS/notification.js')}}"></script>
     <script src="{{asset('JS/sidebar.js')}}"></script>
     <script src="{{asset('JS/error_message.js')}}"></script>
</body>

</html>