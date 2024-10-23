<!DOCTYPE html>
<html>

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width,initial-scale=1.0" />
     <link rel="stylesheet" href="{{asset('CSS/service_types.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/sidebar.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/header.css')}}" />
     <title>Service Types</title>
</head>

<body>
     <div style="display: none;">@section('page_type') {{$type = 'service_types'}} @endsection</div>
     @if (Session::has('success'))
          <div class="success" id="error">{{Session::get('success')}}</div>
     @endif
     @include('constants.admin-header')
     <h1 class="title">Service Type</h1>
     <section class="service-types-section">
          @foreach ($service_types as $service_type)
               <div class="card">
                    <div class="type-name">{{$service_type->type}}</div>
                    <a href="{{url('/service_types/update/'.$service_type->id)}}" class="edit-btn">Edit Type</a>
               </div>
          @endforeach
     </section>
     <div class="add-type-btn">
          <a href="{{url('/service_types/add')}}">+</a>
     </div>

     <script src="{{asset('JS/sidebar.js')}}"></script>
     <script src="{{asset('JS/error_message.js')}}"></script>
</body>

</html>