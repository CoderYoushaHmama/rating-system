<img id="open-sidebar-btn" class="open-sidebar" src="../SVG/sidebar-right.svg" />
     <section id="sidebar" class="sidebar">
          <div class="main-container">
               <h1 class="title">Rating System <img id="close-sidebar-btn" src="../SVG/sidebar-left.svg" /></h1>
               <hr />
               <div class="rows-container">
                    <a href="{{url('/sections')}}" class="container" style="{{$type == 'sections'?' border-right: 10px solid blue': ''}}">
                         <img src="{{asset('SVG/sections.svg')}}" />
                         <span>Sections</span>
                    </a>
                    <a href="{{url('/services')}}" class="container" style="{{$type == 'services'?' border-right: 10px solid blue': ''}}">
                         <img src="{{asset('SVG/services.svg')}}" />
                         <span>Services</span>
                    </a>
                    <a href="{{url('/posts')}}" class="container" style="{{$type == 'posts'?' border-right: 10px solid blue': 'posts'}}">
                         <img src="{{asset('SVG/posts.svg')}}" />
                         <span>Posts</span>
                    </a>
                    <a href="{{url('/about_us')}}" class="container" style="{{$type == 'about_us'?' border-right: 10px solid blue': 'posts'}}">
                         <img src="{{asset('SVG/about-us.svg')}}" />
                         <span>About Us</span>
                    </a>
                    <a href="{{url('/logout')}}" class="container">
                         <img src="{{asset('SVG/logout.svg')}}" />
                         <span>Logout</span>
                    </a>
               </div>
          </div>
     </section>
     <header>
          <div class="top-section">
               <h1 class="header-title">Rating System</h1>
               <div class="links-container">
                    <a href="{{url('/sections')}}" style="{{$type == 'sections'?' background-color: gainsboro': ''}}">Sections</a>
                    <a href="{{url('/services')}}" style="{{$type == 'services'?' background-color: gainsboro': ''}}">Services</a>
                    <a href="{{url('/posts')}}" style="{{$type == 'posts'?' background-color: gainsboro': ''}}">Posts</a>
                    <a href="{{url('/about_us')}}" style="{{$type == 'about_us'?' background-color: gainsboro': ''}}">About Us</a>
                    <a href="{{url('/logout')}}">Logout</a>
               </div>
               <a href="{{url('/')}}" class="profile">
                    @if ($user->image)
                         <img src="{{url('')}}/{{$user->image}}" alt="error" />
                         @else
                         <img src="../IMAGES/user.jpg" alt="error" />
                    @endif
               </a>
          </div>
          @if ($type == 'sections')
               <form id="form-search" method="GET">
                    <input name="search" id="search-input" type="text" placeholder="sections">
                    <button type="submit">Search</button>
               </form>
               @elseif ($type == 'services')
               <form id="form-search" method="GET">
                    <input name="search" id="search-input" type="text" placeholder="services">
                    <button type="submit">Search</button>
               </form>
          @endif
</header>