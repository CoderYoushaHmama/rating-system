<!DOCTYPE html>
<html>

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <link rel="stylesheet" href="{{asset('CSS/edit_service.css')}}" />
     <title>Edit Service</title>
</head>

<body>
     <div id="error" class="error"></div>
     <h1 class="title">Edit Service</h1>
     <form action="{{url('/services/update/'.$service->id)}}" method="POST" enctype="multipart/form-data">
          @csrf
          @error('service_name')
               <div class="error">{{$message}}</div>
          @enderror
          <div class="inputs-container">
               <div>Service Name</div>
               <input value="{{$service->service_name}}" type="text" name="service_name" />
          </div>
          @error('service_price')
               <div class="error">{{$message}}</div>
          @enderror
          <div class="inputs-container">
               <div>Service Price</div>
               <input value="{{$service->service_price}}" id="number" type="number" step="0.01" name="service_price" />
          </div>
          @error('service_type')
               <div class="error">{{$message}}</div>
          @enderror
          <div class="inputs-container">
               <div>Service Type</div>
               <select name="service_type">
                    @foreach ($service_types as $service_type)
                         <option value="{{$service_type->id}}" {{$service_type->id == $service->service_type_id? 'selected':''}}>{{$service_type->type}}</option>
                    @endforeach
               </select>
          </div>
          @error('images')
               <div class="error">{{$message}}</div>
          @enderror
          <div class="inputs-container">
               <div class="image-input-container">
                    <img src="{{asset('SVG/add-image.svg')}}" />
                    <input name="images[]" id="imageInput" type="file" multiple accept=".png, .jpg, .jpeg" />
               </div>
               <div id="imageContainer" class="images-container">

               </div>
          </div>
          <div class="buttons-container">
               <button class="create-btn" type="submit">Save</button>
               <a href="{{url('/services/delete/'.$service->id)}}">Delete</a>
          </div>
     </form>
     <section class="images-section">
          @foreach ($service->images as $image)
               <div class="image-container">
                    <img src="{{url('')}}/{{$image->image}}" alt="error" />
                    <a class="delete" id="{{$image->id}}">
                         <img src="{{asset('SVG/delete.svg')}}" />
                    </a>
               </div>
          @endforeach
     </section>

     <a class="back-btn" href="{{url('/services/'.$service->section_id)}}">
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
                                   url: '{{url("/services/update/delete")}}'+'/'+btns[i].getAttribute('id'),
                                   method: 'GET',
                                   processData: false,
                                   contentType: false,
               
                                   success: function (response){
                                        Remove(i);
                                   },
                                   error: function (error){
                                        if(error){
                                             viewError()
                                             alert(error.responseJSON.error)
                                        }
                                   }
                              });
                         })
                    });
               }
     </script>
</body>

</html>