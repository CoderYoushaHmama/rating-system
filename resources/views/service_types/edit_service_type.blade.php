<!DOCTYPE html>
<html>

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width,initial-scale=1.0" />
     <link rel="stylesheet" href="{{asset('CSS/edit_service_type.css')}}" />
     <title>Edit Service Type</title>
</head>

<body>
     <h1 class="title">Edit Service Type</h1>
     <form action="{{url('/service_types/update/'.$serviceType->id)}}" method="POST">
          @csrf
          <input value="{{$serviceType->type}}" type="text" name="type" placeholder="Service Type" />
          <div class="buttons-container">
               <button type="submit">Edit</button>
               <a href="{{url('/service_types/delete/'.$serviceType->id)}}">Delete</a>
          </div>
     </form>
     <a class="back-btn" href="{{url('/service_types')}}">
          <img src="{{asset('SVG/back-square.svg')}}" />
     </a>
</body>

</html>