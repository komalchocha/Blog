
<html lang="en">
<body class="hold-transition sidebar-mini layout-fixed">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
  </div>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('admin.dashboard')}}" class="nav-link">{{__('messages.home')}}</a>
      </li>
      
      <li class="nav-item dropdown pull-right">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" style="color: black;"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{Auth::user()->email}}
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('admin.logout') }}">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
        <li class="nav-item dropdown pull-right">
                           <select class="nav-link dropdown-toggle Langchange">
                                    <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>
                                    <option value="es" {{ session()->get('locale') == 'es' ? 'selected' : '' }}>spenis</option>
                                </select>
                           </li>
        <div class="clearfix"></div>
    </ul>

    <!-- Right navbar links -->
  
  </nav>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script>
        var url = "{{ route('language') }}";
    $(".Langchange").change(function(){
        a=$(this).val();
        window.location.href = url + "?lang="+ $(this).val();
    });  
    </script>
  