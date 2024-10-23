<!DOCTYPE html>
<html>

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width,initial-scale=1.0" />
     <link rel="stylesheet" href="{{asset('CSS/add_service_type.css')}}" />
     <title>Add Service Type</title>
</head>

<body>
     <h1 class="title">Add Service Type</h1>
     <form action="{{url('/service_types/add')}}" method="POST">
          @csrf
          @error('type')
               <div class="error">{{$message}}</div>
          @enderror
          <input name="type" type="text" name="#" placeholder="Service Type" />
          <button type="submit">Create</button>
     </form>
     <a href="{{url('/service_types')}}">
          <img src="{{asset('SVG/back-square.svg')}}" />
     </a>
</body>

</html>