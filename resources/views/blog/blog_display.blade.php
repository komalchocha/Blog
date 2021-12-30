@extends('user.user_layout.masterblog')

@section('content')
@push('css')
<style>
    .red {
        color: red;
        text-shadow: 1px 1px 1px red;
    }
</style>
@endpush
<section class="tm-section">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{$viewblog->name}}</h4>
                    </div>
                    <input type="hidden" id="blog_id" value="{{$viewblog->id}}">
                    <img src="{{$viewblog->image}}" class="card-img-top" alt="Image">
                    <div class="card-body">
                        <p class="card-text">{{$viewblog->description}}</p>
                        @if(Auth::check())
                        <button class="btn like {{islike($viewblog->id) ? 'red':''}}" id="{{$viewblog->id}}">{{ $viewblog->like()->count() }}<i class="fa fa-heart-o"></i></button>
                        <button class="btn comment">{{ $viewblog->comment()->count() }}<i class="fa fa-comment-o"></i></button><br />
                        <div id="abc"></div>
                        @else
                        <a href="{{ route('login') }}" id="{{$viewblog->id}}"><i class="fa fa-heart-o"></i></a>
                        <a href="{{ route('login') }}" id="{{$viewblog->id}}"><i class="fa fa-comment-o"></i></button><br /></a>
                        @endif
                    </div>
                    @foreach($comments as $comment)
                    <div class="display-comment" @if($comment->parent_id != null) style="margin-left:40px;" @endif>
                        <form method="post" action="{{route('replyStore')}}">
                            @csrf
                            
                            <div>
                                <span id="display_comment"></span>
                            </div>
                          
                        </form>

                    </div>
                    @endforeach

                </div>
                @if(Auth::check())

                <form action="{{route('comment')}}" id="comment_blog" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>{{__('messages.comment')}}</label>
                        <textarea name="comment" id="comment" value="" class="form-control" placeholder="{{__('messages.Add comment')}}"></textarea>
                    </div>
                    <input type="hidden" name="blog_id" value="{{$viewblog->id}}">

                    <button type="submit" name="submit" class="btn btn-primary">{{__('messages.submit')}}</button>
                </form>
                @endif

            </div>
        </div>
    </div>
</section> <!-- row -->
<style type="text/css">
    .error {
        color: red;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script>
    $("#comment_blog").validate({
        rules: {
            comment: {
                required: true,
            }
        },
        messages: {
            comment: {
                required: "{{__('messages.comment required')}}",
            }
        },
    });
    $('body').on('click', '.like', function() {
        var blog_id = $('.like').attr('id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            url: "{{ route('like') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: blog_id
            },
            success: function(data) {
                if (data.status == true) {
                    $(".like").addClass('red');
                    location.href = "{{route('viewblog',$viewblog->id)}}";

                } else {
                    $(".like").removeClass("red");
                    location.href = "{{route('viewblog',$viewblog->id)}}";

                }
            },
        })
    })
    $('body').on('submit', '#comment_blog', function() {
        var comment = $('#comment').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            url: "{{ route('comment') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: blog_id,
                comment: comment,
            },
            success: function(data) {

            },
        })
    })

    load_comment();

    function load_comment() {
        blog_id = "{{ $viewblog->id }}"
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            url: "{{ route('fetchComment') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                blog_id: blog_id
            },
            success: function(data) {
                console.log(data.data);
                if (data.status == true) {
                    $('#display_comment').html(data.data);
                }
            }
        })
    }
    $('body').on('click', '.reply', function() {
        $('.reply').toggle();
        blog_id = "{{ $viewblog->id }}"
        var comment_id = $(this).attr('data-id');
        var route = "{{route('replyStore')}}"
        var messages="{{__('messages.comment')}}"
        var add_comment="{{__('messages.Add comment')}}"
        var submit="{{__('messages.submit')}}"
        html = '<form action="' + route + '"  id="reply_submit" method="POST"> @csrf<div class="form-group"><label>'+ messages +'</label><textarea name="comment" id="comment" value="" class="form-control" placeholder="'+ add_comment +'"></textarea></div><input type="hidden" name="blog_id" value="' + blog_id + '"><input type="hidden" name="comment_id" value="' + comment_id + '"><button type="submit" name="submit" id="comment_id" class="btn btn-danger">'+ submit +'</button></form>';
        $(this).after(html);
    });
    $('body').on('click', '#reply_submit', function() {
        var comment = $('#comment').val();
        var comment_id = $(this).attr('data-id');
        var blog_id = "{{$viewblog->id}}"
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            url: "{{ route('replyStore') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: blog_id,
                comment: comment,
                perant_id: comment_id,
            },
            success: function(data) {},
            error: function(response) {
                    $('.text-strong').text('');
                    $.each(response.responseJSON.errors, function(field_name, error) {
                        $('[name=' + field_name + ']').after('<span class="text-strong" style="color:red">' + error + '</span>')
                    })
                }
        })
    })
    $(document).on('click', '.delete', function() {
        var id = $(this).attr('data-id');
        var conf = confirm("Are you sure");

        if (conf == true) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                url: '{{route("destroy")}}',
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                },
                dataType: 'json',
                success: function(data) {
                    swal("Done!", data.message, "success");
                    location.href = "{{route('viewblog',$viewblog->id)}}";
                }
            });
        }
    });
</script>

@endsection