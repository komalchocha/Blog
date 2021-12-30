@extends('user.user_layout.masterblog')

@section('content')


<section class="tm-section">
    <div class="container-fluid">

        <div class="row">
            @foreach($blogs as $blog)
            <div class="col-lg-6 mb-4">
                <div class="card h-100">

                    <div class="card-header"><h5 class="card-title"><a href="{{route('viewblog',$blog->id)}}">{{$blog->name}}</a></div>
                                <div class="card-body">
                                    </h5>
                                    <img src="{{$blog->image}}" class="card-img-top" alt="Image">
        
                    </div>
                    <form id="blog_edit" action=""  method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$blog->id}}">

                    <div class="form-group">
                        <label>{{__('messages.Blog Title')}}</label>
                        <input type="text" name="name" value="{{$blog->name}}" id="blog_name" class="form-control" placeholder="{{__('messages.Blog Title')}}" onKeypress="return(event.charCode>64 && event.charCode<91)||(event.charCode>96 &&(event.charCode<123)||(event.charCode==15))">
                    </div>

                    <div class="form-group">
                        <label class="d-block">{{__('messages.Blog Category')}}</label>
                        <select name="categorie_name" id="categorie" class="form-control">
                        <option value="">{{__('messages.Select blogcategorie')}}</option>
                            @foreach ($blogcategories as $blogcategorie)
                          <option value="{{$blogcategorie->id}}" {{$blogcategorie->id == $blog->categorie_id ? 'selected':''}}>{{"$blogcategorie->categories_name"}}</option>
                         @endforeach 

                        </select>
                    </div>
                    <div class="form-group">
                        <label>{{__('messages.Blog Description')}}</label>
                        <textarea name="description" id="description" class="form-control" value="" placeholder="{{__('messages.Blog Description')}}">{{$blog->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label class="d-block">{{__('messages.Choose Blog')}}</label>
                            <input type="file" name="image" class="form-control" id="image"/>

                        </div>
                    </div>
                    <div class="text-right mb-0">
                    <input type="hidden" name="id" id="blog_id" value="{{$blog->id}}">

                    <button type="submit" class="btn btn-primary update" name="submit">{{__('messages.Update')}}</button>
                        <button type="button"  class="btn btn-danger deleteblog">{{__('messages.Delete')}}</button>

                    </div>
                </form>

                </div>
            </div>
            @endforeach
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
     
    $("#blog_edit").validate({
        rules: {
            name: {
                required: true,
            },
            categorie_name: {
                required: true,
            },
        
            description: {
                required: true,
            }

        },
        messages: {
            name: {
                required: "{{__('messages.Blog required')}}",
            },

            categorie_name: {
                required: "{{__('messages.Categorie required')}}",

            },

          
            description: {
                required: "{{__('messages.Description required')}}",
          
             }
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
            $(element).parents("div.form-control").addClass(errorClass).removeClass(validClass);
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
            $(element).parents(".error").removeClass(errorClass).addClass(validClass);
        },
        submitHandler: function(form) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                url: "{{route('updateBlog')}}",
                method: 'POST',
                data: new FormData(form),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    alert(data.message);
                    location.href ="{{route('blogEdit',Auth::user()->id)}}";
                },
               
            })
        }

    });
    $(document).on('click', '.deleteblog', function() {
        var id = $('#blog_id').val();

        var conf = confirm("Are you sure");

        if (conf == true) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                url: '{{route("destroyblog")}}',
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                },
                dataType: 'json',
                success: function(data) {
                    alert(data.message);
                    location.href ="{{route('blogEdit',Auth::user()->id)}}";
                }
            });
        }
    });
    </script>
@endsection


