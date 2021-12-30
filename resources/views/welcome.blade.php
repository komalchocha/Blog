@extends('user.user_layout.masterblog')

@section('content')


<section class="tm-section">
    <div class="container-fluid">

        <div class="row">
            @foreach($blogs as $blog)
            <div class="col-lg-6 mb-4">
                <div class="card h-100">
                    <div class="card-header"><h5 class="card-title"><a href="{{route('viewblog',$blog->id)}}">{{$blog->name}}</a></div>
                                <img src="{{ asset(''. $blog->image) }}" class="card-img-top" alt="Image">
                                <div class="card-body">
                                    </h5>
                                    <button class="btn like">{{ $blog->like()->count() }}<i class="fa fa-heart-o"></i></button>
                                    <button class="btn comment">{{ $blog->comment()->count() }}<i class="fa fa-comment-o"></i></button><br />
                                    <p class="card-text" style="max-height: 45px; overflow: hidden;">{{$blog->description}}</p>
                                    <a href="{{route('viewblog',$blog->id)}}" class="btn btn-warning">{{__('messages.Detail')}}</a>    
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section> <!-- row -->

@include('blog.create_blog')
@include('blog.edit_user')

@endsection



<!-- load JS files -->