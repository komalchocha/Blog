       <div class="tm-header">

           <!-- navbar -->
           <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-4 mb-5">
               <div class="container-fluid">
                   <a class="navbar-brand" href="#">
                       <h4>{{__('messages.claasic')}}</h4>
                   </a>
                   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                       <span class="navbar-toggler-icon"></span>
                   </button>

                   <div class="collapse navbar-collapse" id="navbarSupportedContent">
                       <ul class="navbar-nav ml-auto">
                           <li class="nav-item active">
                               <a href="/" class="nav-link">{{__('messages.home')}}</a>
                           </li>
                           @if(!Auth()->check())
                           <li class="nav-item">
                               <a href="{{ route('login') }}" class="nav-link">{{__('messages.login')}}</a>
                           </li>
                           @endif
                           @if(Auth::user())
                           <li class="nav-item">
                               <a data-toggle="modal" data-target="#blog_modal" class="nav-link">{{__('messages.create_blog')}}</a>
                           </li>
                           @else
                           <li class="nav-item">
                               <a href="{{ route('login') }}" class="nav-link">{{__('messages.create_blog')}}</a>
                           </li>
                           @endif
                           @if(Auth()->check())
                           <li class="nav-item dropdown">
                               <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                                   {{Auth::user()->email}}
                               </a>
                               <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                   <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                       {{ __('messages.Logout') }}
                                   </a>
                                   <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                       @csrf
                                   </form>
                                   <a class="dropdown-item" data-toggle="modal" data-target="#edit_user">
                                       {{ __('messages.Edit Profile') }}
                                   </a>
                                   @if(count(Auth::user()->blogs)>0)
                                   <a class="dropdown-item" href="{{route('blogEdit',Auth::user()->id)}}">
                                       {{ __('messages.Edit Blog') }}
                                   </a>
                                   @endif
                               </div>
                           </li>
                           @endif

                           <li class="nav-item dropdown">
                           <select class="form-control Langchange">
                                    <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>
                                    <option value="es" {{ session()->get('locale') == 'es' ? 'selected' : '' }}>spenis</option>
                                </select>
                           </li>

                       </ul>
                   </div>
               </div>
           </nav>
       </div>
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script>
        var url = "{{ route('language') }}";
    $(".Langchange").change(function(){
        window.location.href = url + "?lang="+ $(this).val();
    });  
    </script>