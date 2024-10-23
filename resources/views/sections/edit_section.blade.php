<!DOCTYPE html>
<html>

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width,initial-scale=1.0" />
     <link rel="stylesheet" href="{{asset('CSS/edit_section.css')}}" />
     <title>Edit Section</title>
</head>

<body>
     <h1 class="title">Edit Section</h1>
     <form action="{{url('/sections/update/'.$section->id)}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="image-container">
               <img id="image" src="{{url('')}}/{{$section->image}}" alt="error" />
               <input name="image" id="file" class="input-image" type="file" accept=".png, .jpg, .jpeg" />
          </div>
          @error('section_name')
               <div class="error">{{$message}}</div>
          @enderror
          <input value="{{$section->section_name}}" placeholder="Section Name" class="section-name-input" type="text" name="section_name" />
          <div class="buttons-container">
               <button class="btn edit-btn" type="submit">Edit</button>
               <a class="btn delete-btn" href="{{url('/sections/delete/'.$section->id)}}">Delete</a>
          </div>
     </form>
     <a href="{{url('/sections')}}" class="back-btn">
          <img src="{{asset('SVG/back-square.svg')}}" />
     </a>
     <script src="{{asset('JS/selected_image_view.js')}}"></script>
</body>

</html>