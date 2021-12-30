@extends('layouts.master')

@section('content')
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{__('messages.dashboard')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('messages.home')}}</a></li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
              <h2><div class="inner">{{$user}}</div></h2>

                <h4><div class="">{{__('messages.users')}} </div></h4>
              
              <div class="icon">
              <i class="ion ion-person-add"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
            <h2><div class="inner">{{$blog}}</div></h2>
            <h4><div class="">Blogs</div></h4>
              <div class="icon">
              <i class="fas fa-blog"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-6">
            <div class="small-box bg-warning">
             <h2><div class="inner">{{$category}}</div></h2>
            <h4><div class="">Blog {{__('messages.categories')}}</div></h4>
              <div class="icon">
              <i class="fa fa-list-alt" aria-hidden="true"></i>
              </div>
            </div>
          </div>
       
        </div>
</section>
       
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js"></script>
  <script>
  $(".inner").counterUp({time:3000});
</script>
@endsection
