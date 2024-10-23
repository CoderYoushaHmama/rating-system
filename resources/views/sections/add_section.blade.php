<!DOCTYPE html>
<html>

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width,initial-scale=1.0" />
     <link rel="stylesheet" href="{{asset('CSS/add_section.css')}}" />
     <title>Add Section</title>
</head>

<body>
     <h1 class="title">Add Section</h1>
     <form action="{{url('sections/add')}}" method="POST" enctype="multipart/form-data">
          @csrf
          @error('image')
               <div class="error">{{$message}}</div>
          @enderror
          <div class="image-container">
               <img id="image" src="{{asset('SVG/add-image.svg')}}" alt="error" />
               <input name="image" id="file" class="input-image" type="file" accept=".png, .jpg, .jpeg" />
          </div>
          @error('section_name')
               <div class="error">{{$message}}</div>
          @enderror
          <input placeholder="Section Name" class="section-name-input" type="text" name="section_name" />
          <div class="buttons-container">
               <button class="btn" type="submit">Add</button>
          </div>
     </form>
     <a href="{{url('/sections')}}" class="back-btn">
          <img src="{{asset('SVG/back-square.svg')}}" />
     </a>
     <script src="{{asset('JS/selected_image_view.js')}}"></script>
</body>

</html>