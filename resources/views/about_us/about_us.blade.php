<!DOCTYPE html>
<html>

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width,initial-scale=1.0" />
     <link rel="stylesheet" href="{{asset('CSS/about_us.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/slick.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/sidebar.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/header.css')}}" />
     <title>About Us</title>
</head>

<div style="display: none;">@section('page_type') {{$type = 'about_us'}} @endsection</div>
<body>
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

     <div class="stars-container">
          <img id="s1" class="star2" src="{{asset('SVG/fill-star.svg')}}" />
          <img id="s2" src="{{asset('SVG/fill-star.svg')}}" />
          <img id="s3" class="star" src="{{asset('SVG/fill-star.svg')}}" />
          <img id="s4" src="{{asset('SVG/fill-star.svg')}}" />
          <img id="s5" class="star2" src="{{asset('SVG/fill-star.svg')}}" />
     </div>

     <section id="image-container" class="image-container">
          @foreach ($images as $image)
               <img src="{{url('')}}/{{$image->image}}" alt="error" />
          @endforeach
     </section>

     <section class="text-container">
          <div>{{$about_us->details}}</div>
     </section>
     @if ($user->account_type == 'admin')
          <a href="{{url('/about_us/edit')}}" class="edit-btn">Edit</a>
     @endif

     <script src="{{asset('JS/about_us.js')}}"></script>
     <script src="{{asset('JS/jquery-3.6.1.min.js')}}"></script>
     <script src="{{asset('JS/slick.min.js')}}"></script>
     <script src="{{asset('JS/sidebar.js')}}"></script>
     <script src="{{asset('JS/about_us_slider.js')}}"></script>
     <script src="{{asset('JS/error_message.js')}}"></script>
</body>

</html>