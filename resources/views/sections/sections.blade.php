<!DOCTYPE html>
<html>

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width,initial-scale=1.0" />
     <link rel="stylesheet" href="{{asset('CSS/sections.css')}}" />
     {{-- <link rel="stylesheet" href="{{asset('CSS/slick.css')}}" /> --}}
     <link rel="stylesheet" href="{{asset('CSS/header.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/sidebar.css')}}" />
     <title>Sections</title>
</head>

<div style="display: none;">@section('page_type') {{$type = 'sections'}} @endsection</div>
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
     <article>
          <div class="title">Sections</div>
          <section class="sections slick-list" id="sections">
               @for ($i=0; $i<count($sections); $i++) 
                    <div class="card">
                         <a href="{{url('/services/'.$sections[$i]['id'])}}">
                              <img src="{{url('/')}}/{{$sections[$i]['image']}}" alt="error" />
                              <div class="card-name">{{$sections[$i]['section_name']}}</div>
                              <div class="stars">
                                   @for ($j=0; $j<floor($sections[$i]['total_rate']); $j++)
                                        <img src="{{asset('SVG/fill-star.svg')}}" />
                                   @endfor
                                   @for ($j=0; $j<5-floor($sections[$i]['total_rate']); $j++)
                                        <img src="{{asset('SVG/star.svg')}}" />
                                   @endfor
                                   <div>{{$sections[$i]['total_rate']}}</div>
                              </div>
                         </a>
                         @if (Auth::guard('user')->user()->account_type == 'regular user' || !Auth::guard('user')->user())
                              
                              @else
                              <a class="edit-btn" href="{{url('/sections/update/'.$sections[$i]['id'])}}"><img src="{{asset('SVG/edit.svg')}}" /></a>
                         @endif
                    </div>
               @endfor
          </section>
          @if ($sections != '[]')
               <div class="control-btns">
                    <button class="next-btn" id="next-btn">></button>
                    <button class="prev-btn" id="prev-btn">
                         < </button>
               </div>
          @endif
          @if ($user->account_type === 'service provider')
               <a href="{{url('/sections/add')}}" class="add-section">+</a> 
          @endif
     </article>

     <script src="{{asset('JS/jquery-3.6.1.min.js')}}"></script>
     <script src="{{asset('JS/slick.min.js')}}"></script>
     <script src="{{asset('JS/sections_slider.js')}}"></script>
     <script src="{{asset('JS/menu.js')}}"></script>
     <script src="{{asset('JS/sidebar.js')}}"></script>
     <script src="{{asset('JS/error_message.js')}}"></script>
</body>

</html>