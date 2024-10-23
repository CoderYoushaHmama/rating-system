<!DOCTYPE html>
<html>

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width,initial-scale=1.0" />
     <link rel="stylesheet" href="{{asset('CSS/regular_user_home.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/header.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/sidebar.css')}}" />
     <title>Home</title>
</head>

<div style="display: none;">@section('page_type') {{$type = 'home'}} @endsection</div>
<body>
     @include('constants.regular-user-header')
     <header>
          <h1 id="search-title" class="search-title">Search All</h1>
          <div class="search-types">
               <div class="type-container">
                    <img src="{{asset('SVG/home.svg')}}" />
                    Search All
               </div>
               <div class="type-container">
                    <img src="{{asset('SVG/sections.svg')}}" />
                    Sections
               </div>
               <div class="type-container">
                    <img src="{{asset('SVG/services.svg')}}" />
                    Services
               </div>
          </div>
          <form id="form-search" method="GET">
               <input id="search-input" type="text" name="all" placeholder="sections, services">
               <button type="submit">Search</button>
          </form>
     </header>
     <section class="image-section">
          <img src="{{asset('IMAGES/image.jpg')}}" alt="error" />
          <div class="details">
               <h1>Rating System</h1>
               <div>{{$about_us->details}}</div>
          </div>
     </section>
     <article>
          <div class="title">Sections</div>
          <section class="sections slick-list" id="sections">
               @for ($i=0;$i<count($sections);$i++)
                    <div class="card">
                         <a href="{{url('/services/'.$sections[$i]['id'])}}">
                              <img src="{{url('')}}/{{$sections[$i]['image']}}" alt="error" />
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
                    </div>
               @endfor
          </section>
     </article>
          <div class="control-btns">
               <button class="next-btn" id="next-btn">></button>
               <button class="prev-btn" id="prev-btn">
                    < </button>
          </div>
          <div class="title">Services</div>
          <article>
               <section class="sections slick-list" id="services">
                    @for ($i=0;$i<count($services);$i++)
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
                         </div>
                    @endfor
               </section>
          </article>
          <div class="control-btns">
               <button class="next-btn" id="next-btn2">></button>
               <button class="prev-btn" id="prev-btn2">
                    < </button>
          </div>

     <script src="{{asset('JS/jquery-3.6.1.min.js')}}"></script>
     <script src="{{asset('JS/slick.min.js')}}"></script>
     <script src="{{asset('JS/slider.js')}}"></script>
     <script src="{{asset('JS/menu.js')}}"></script>
     <script src="{{asset('JS/sidebar.js')}}"></script>
     <script src="{{asset('JS/header.js')}}"></script>
</body>

</html>