<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <span class="brand-text font-weight-light">{{__('messages.adminlte_3')}}</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">

      <div class="info">

      </div>
    </div>
    <!-- Sidebar Menu -->

    <a href="{{route('admin.dashboard')}}" class="nav-link active">
      <p>
      {{__('messages.dashboard')}} 
      </p>
    </a>
    <a href="{{route('admin.user.view_user_list')}}" class="nav-link active">
      <p>
      {{__('messages.users')}} 
      </p>
    </a>
    <a href="{{route('admin.blog.blog_view_list')}}" class="nav-link active">
      <p>
      {{__('messages.blog_view')}} 
      </p>
    </a>
    <a href="{{route('admin.blog.categoreis_view_list')}}" class="nav-link active">
      <p>
      {{__('messages.categories')}}  
      </p>
    </a>
    <a href="{{route('admin.blog.comment_view_list')}}" class="nav-link active">
      <p>
      {{__('messages.comment_view')}}        
    </p>
    </a>
    <a href="{{route('admin.product.product_view_list')}}" class="nav-link active">
      <p>
      product      
    </p>
    </a>
  
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

