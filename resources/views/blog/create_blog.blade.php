<div class="modal fade" id="blog_modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-modal="true" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{__('messages.Add Blog')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <form id="blog" action=""  method="POST">
                    @csrf

                    <div class="form-group">

                        <label>{{__('messages.Blog Title')}}</label>
                        <input type="text" name="name" id="blog_name" class="form-control" placeholder="Blog Title" onKeypress="return(event.charCode>64 && event.charCode<91)||(event.charCode>96 &&(event.charCode<123)||(event.charCode==15))">
                    </div>
                   
                    <div class="form-group">
                        <label class="d-block">{{__('messages.Blog Category')}}</label>
                        <select name="categorie_name" id="categorie" class="form-control">
                            <option value="">{{__('messages.Select blogcategorie')}}</option>
                            @foreach ($blogcategories as $blogcategorie)
                            <option value="{{$blogcategorie->id}}">
                                {{$blogcategorie->categories_name}}
                            </option>
                            
                            @endforeach
                            </option>
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label>{{__('messages.Blog Description')}}</label>
                        <textarea name="description" id="blog_description" class="form-control" placeholder="Description"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label class="d-block">{{__('messages.Choose Blog')}}</label>
                            <input type="file" name="image" class="form-control" id="image" />
                        </div>
                    </div>
                    <div class="text-right mb-0">
                    @if(Auth()->check())
                    <input type="hidden"  value="{{Auth::user()->id}}" >

                       <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <button type="submit"  class="btn btn-primary" value="submit" name="submit">{{__('messages.submit')}}</button>
                    @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script>
    
    $('.close').click(function() {
        $('#blog_modal').find('form').trigger('reset');
        $("#blog").find('.is-invalid').removeClass("is-invalid");

        $('.error').html("");
    });
    $("#blog").validate({
        rules: {
            name: {
                required: true,
            },
            categorie_name:{
                required: true,
            
            },
            description:{
                 required: true,
            },
            image:{
                required: true,
            }
        },
        messages: {
            name: {
                required:"{{__('messages.Blog required')}}",
            },

            categorie_name: {
                required:"{{__('messages.Categorie required')}}",

            },
            description:{
                required:"{{__('messages.Description required')}}",
            },
            image:{
                required:"{{__('messages.Image required')}}",
            }
        },
        submitHandler: function(form) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                url: '{{route("store")}}',
                method: 'post',
                data: new FormData(form),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    alert(data.message);
                    $('#edit_user').modal('hide');
                    location.href ="/"
                },
                error: function(response) {
                    $('.text-strong').text('');
                    $.each(response.responseJSON.errors, function(field_name, error) {
                        $('[name=' + field_name + ']').after('<span class="text-strong" style="color:red">' + error + '</span>')
                    })
                }
            })
        }

    });
         

   
    
</script>