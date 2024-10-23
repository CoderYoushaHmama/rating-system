<!DOCTYPE html>
<html>

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width,initial-scale=1.0" />
     <link rel="stylesheet" href="{{asset('CSS/posts.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/header.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/sidebar.css')}}" />
     <title>Posts</title>
</head>

<div style="display: none;">@section('page_type') {{$type = 'posts'}} @endsection</div>
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
     <section class="posts-section">
          @if ($user->account_type == 'service provider')
               <div class="filter-container">
                    <a href="?filter=yours">Your Posts</a>
                    <a href="?filter=all">All Posts</a>
               </div>
               <button id="create-post-btn" class="create-post-btn">Create Post</button>
          @endif
          @foreach ($posts as $post)
               <div class="post-container">
                    <div class="user-container">
                         <a href="#">
                              @if (!$post->user->image)
                                   <img src="{{asset('IMAGES/user.jpg')}}" alt="error">
                                   @else
                                   <img src="{{url('')}}/{{$post->user->image}}" alt="error">
                              @endif
                         </a>
                         <div class="username">{{$post->user->full_name}} <div style="font-size: 15px; color: gray;">{{$post->created_at->format('Y-m-d ,h:m')}}</div></div>
                         @if ($post->user_id == $user->id || $user->account_type == 'admin')
                              <img onclick="setAction('{{url('posts').'/'.$post->id}}','{{url('posts/delete').'/'.$post->id}}')" class="edit-btn" src="{{asset('SVG/edit.svg')}}" />     
                         @endif
                    </div>
                    <div class="contents-container">
                         <div class="text post-text">{{$post->description}}</div>
                         <img class="post-image" src="{{url('')}}/{{$post->image}}" alt="error" />
                    </div>
               </div>
               <hr>
          @endforeach
     </section>
     <div id="background" class="background"></div>
     <section id="create-post-section" class="create-post-section">
          <img src="{{asset('SVG/close.svg')}}" class="close-btn" id="close-post-section-btn" />
          <form action="{{url('/posts')}}" method="POST" enctype="multipart/form-data">
               @csrf
               <textarea id="add-comment" name="description" placeholder="Write Your Contetn"></textarea>
               <div class="image-container">
                    <img id="image" src="{{asset('SVG/add-image.svg')}}" />
                    <input id="file" type="file" accept=".png, .jpg, .jpeg" name="image" />
               </div>
               <button disabled id="create-btn">Create</button>
          </form>
     </section>
     <section id="edit-post-section" class="create-post-section">
          <img src="{{asset('SVG/close.svg')}}" class="close-btn" id="close-edit-post-section-btn" />
          <form id="form-edit" action="{{url('/')}}" method="POST" enctype="multipart/form-data">
               @csrf
               <textarea id="textarea" name="description" placeholder="Write Your Contetn"></textarea>
               <div class="image-container">
                    <img id="image2" src="{{asset('SVG/add-image.svg')}}" />
                    <input id="file2" type="file" accept=".png, .jpg, .jpeg" name="image" />
               </div>
               <div class="buttons-container">
                    <button id="edit-btn">Edit</button>
                    <a id="delete-btn" href="#">Delete</a>
               </div>
          </form>
     </section>
     <script src="{{asset('JS/menu.js')}}"></script>
     <script src="{{asset('JS/posts.js')}}"></script>
     <script src="{{asset('JS/selected_image_view.js')}}"></script>
     <script src="{{asset('JS/sidebar.js')}}"></script>
     <script src="{{asset('JS/error_message.js')}}"></script>
</body>

</html>