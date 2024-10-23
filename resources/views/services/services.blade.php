<!DOCTYPE html>
<html>

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width,initial-scale=1.0" />
     <link rel="stylesheet" href="{{asset('CSS/services.css')}}" />
     {{-- <link rel="stylesheet" href="{{asset('CSS/slick.css')}}" /> --}}
     <link rel="stylesheet" href="{{asset('CSS/header.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/sidebar.css')}}" />
     <title>Services</title>
</head>

<body>
     @if (Session::has('success'))
          <div class="success" id="error">{{Session::get('success')}}</div>
     @endif
     <div style="display: none;">@section('page_type') {{$type = 'services'}} @endsection</div>
     @if ($user->account_type === 'admin')
          @include('constants.admin-header')
          @elseif ($user->account_type === 'service provider')
          @include('constants.service-provider-header')
          @elseif ($user->account_type == 'regular user')
          @include('constants.regular-user-header')
     @endif
     <article>
          <div class="title">Services</div>
          <section class="sections slick-list" id="services">
               @for ($i=0; $i<count($services); $i++)
                    <div class="card">
                         <a href="{{url('/services/details/'.$services[$i]['id'])}}">
                              <img src="{{url('')}}/{{$services[$i]['images'][0]['image']}}" alt="error" />
                              <div class="card-name">{{$services[$i]['service_name']}}</div>
                              <div class="price">Price: <span>{{$services[$i]['service_price']}}$</span></div>
                              <div class="stars">
                                   @for ($j=0; $j<floor($services[$i]['total_rate']); $j++)
                                        <img src="{{asset('SVG/fill-star.svg')}}" />
                                   @endfor
                                   @for ($j=0; $j<5-floor($services[$i]['total_rate']); $j++)
                                        <img src="{{asset('SVG/star.svg')}}" />
                                   @endfor
                                   <div>{{$services[$i]['total_rate']}}</div>
                              </div>
                         </a>
                         @if (Auth::guard('user')->user()->account_type == 'regular user' || !Auth::guard('user')->user())
                              
                         @else
                         <a class="edit-btn" href="{{url('/services/update/'.$services[$i]['id'])}}"><img src="{{asset('SVG/edit.svg')}}" /></a>
                    @endif
                    </div>
               @endfor
          </section>
          
          @if ($services != '[]')
               <div class="control-btns">
                    <button class="next-btn" id="next-btn2">></button>
                    <button class="prev-btn" id="prev-btn2">
                         < </button>
               </div>
          @endif
          @if ($user->account_type === 'service provider' && $in_section)
               <a href="{{url('/services/add/'.$section->id)}}" class="add-section">+</a> 
          @endif
     </article>

     <script src="{{asset('JS/jquery-3.6.1.min.js')}}"></script>
     <script src="{{asset('JS/slick.min.js')}}"></script>
     <script src="{{asset('JS/services_slider.js')}}"></script>
     <script src="{{asset('JS/menu.js')}}"></script>
     <script src="{{asset('JS/sidebar.js')}}"></script>
     <script src="{{asset('JS/error_message.js')}}"></script>
</body>

</html>