<div class="modal fade" id="admin_edit_blog" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-modal="true" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{__('messages.Edit Blog')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="blog_edit" action=""  method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="hidden">
                        
                    <div class="form-group">
                        <label>{{__('messages.Blog Title')}}</label>
                        <input type="text" name="name" id="blog_name" class="form-control" placeholder="{{__('messages.Blog Title')}}" onKeypress="return(event.charCode>64 && event.charCode<91)||(event.charCode>96 &&(event.charCode<123)||(event.charCode==15))">
                    </div>

                    <div class="form-group">
                        <label class="d-block">{{__('messages.Blog Category')}}</label>
                        <select name="categorie_name" id="categorie" class="form-control">
                        <option value="">{{__('messages.Select blogcategorie')}}</option>
                            @foreach ($blogcategories as $blogcategorie)
                          <option value="{{$blogcategorie->id}}">{{"$blogcategorie->categories_name"}}</option>
                         @endforeach 
                        </select>
                    </div>
                    <div class="form-group">
                        <label>{{__('messages.Blog Description')}}</label>
                        <textarea name="description" id="description" class="form-control" value="" placeholder="{{__('messages.Blog Description')}}"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label class="d-block">{{__('messages.Choose Blog')}}</label>
                            <input type="file" name="image" class="form-control" id="image"/>

                        </div>
                        <div id=i_image></div>
                    </div>
                    <div class="text-right mb-0">

                    <button type="submit" class="btn btn-primary update" name="submit">{{__('messages.Update')}}</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .error {
        color: red;
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script>
     $('.close').click(function() {
        $('#admin_edit_blog').find('form').trigger('reset');
        $("#blog_edit").find('.is-invalid').removeClass("is-invalid");
        $('.error').html("");
    });
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
                url: "{{route('admin.blog.updateBlog')}}",
                method: 'POST',
                data: new FormData(form),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    alert(data.message);
                    $('#admin_edit_blog').modal('hide');
                    window.LaravelDataTables["blog-table"].draw();
                },
               
            })
        }

    });
    $(document).on('click', '.admin_blog_edit', function() {
      
      var id = $(this).attr('data-id');
      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          },
          url: '{{route("admin.blog.editBlog")}}',
          method: 'get',
          data: {
              id: id,
          },
          dataType: 'json',
          success: function(data) {
            $("#admin_edit_blog").modal('show');
              $('#hidden').val(data.blog.id);
              $('#blog_name').val(data.blog.name);
              $('#categorie').val(data.blog.categorie_id);
              $('#description').val(data.blog.description);
              $('#i_image').text("");
              $('#i_image').html('<img src="'  + data.blog.image +'" alt="" style="width:150px; height:auto;">');
          }
      });
  });
    </script>