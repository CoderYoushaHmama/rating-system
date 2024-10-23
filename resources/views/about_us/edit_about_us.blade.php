<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{asset('CSS/edit_about_us.css')}}" />
    <title>Edit About Us</title>
</head>

<body>
    <h1 class="title">Edit About Us</h1>
    <form action="{{url('/about_us/edit')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="inputs-container">
            @error('details')
                <div class="error">{{$message}}</div>
            @enderror
            <div>Details</div>
            <textarea type="text" name="details">{{$about_us->details}}</textarea>
        </div>
        <div class="inputs-container images-input-container">
            <div class="image-input-container">
                <img src="{{asset('SVG/add-image.svg')}}" />
                <input id="imageInput" type="file" multiple accept=".png, .jpg, .jpeg" name="images[]" />
            </div>
            <div id="imageContainer" class="images-container">

            </div>
        </div>
        <button class="edit-btn" type="submit">Edit</button>
    </form>
    <section class="images-section">
        @foreach ($images as $image)
             <div class="image-container">
                  <img src="{{url('')}}/{{$image->image}}" alt="error" />
                  <a class="delete" id="{{$image->id}}">
                       <img src="{{asset('SVG/delete.svg')}}" />
                  </a>
             </div>
        @endforeach
   </section>

    <a class="back-btn" href="{{url('/about_us')}}">
        <img src="{{asset('SVG/back-square.svg')}}" />
    </a>

    <script src="{{asset('JS/show_selected_images.js')}}"></script>
    <script src="{{asset('JS/jquery-3.6.1.min.js')}}"></script>
    <script>
        var btns = document.querySelectorAll('.delete');
        var container = document.querySelectorAll('.image-container');
        function viewError(){
             document.getElementById('error').style.display = 'block';
        }
        function Remove(id){
             container[id].remove();
        }
             for(let i=0 ; i<btns.length; i++){
                  btns[i].addEventListener('click', ()=>{
                       
                       $(document).ready(function(){
                            $.ajax({
                                 url: '{{url("/about_us/delete")}}'+'/'+btns[i].getAttribute('id'),
                                 method: 'GET',
                                 processData: false,
                                 contentType: false,
             
                                 success: function (response){
                                      Remove(i);
                                 },
                                 error: function (error){
                                      if(error){
                                           alert('some thing went wrong')
                                      }
                                 }
                            });
                       })
                  });
             }
   </script>
</body>

</html>