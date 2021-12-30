<div class="modal fade" id="edit_category" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-modal="true" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{__('messages.Edit Category')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="category_edit" action=""  method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="hidden">

                    <div class="form-group">
                        <label>{{__('messages.Edit Category')}}</label>
                        <input type="text" name="category"  id="c_category" class="form-control" placeholder="{{__('messages.Category Name')}}" onKeypress="return(event.charCode>64 && event.charCode<91)||(event.charCode>96 &&(event.charCode<123)||(event.charCode==15))">
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">{{__('messages.Update')}}</button>

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
        $('#edit_category').find('form').trigger('reset');
        $("#category_edit").find('.is-invalid').removeClass("is-invalid");
        $('.error').html("");
    });
    $("#category_edit").validate({
        rules: {
            category: {
                required: true,
            }
        },
        messages: {
            category: {
                required: "{{__('messages.Categorie required')}}",
            }
        },
        submitHandler: function(form) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                url: "{{route('admin.blog.updateCategory')}}",
                method: 'post',
                data: new FormData(form),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    alert(data.message);
                    $('#edit_category').modal('hide');
                    window.LaravelDataTables["blogcategory-table"].draw();
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
    $(document).on('click', '.admin_category_edit', function() {
      
      var id = $(this).attr('data-id');
      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          },
          url: '{{route("admin.blog.edit_Category")}}',
          method: 'get',
          data: {
              id: id,
          },
          dataType: 'json',
          success: function(data) {
            $("#edit_category").modal('show');
              $('#hidden').val(data.blogcategory.id);
              $('#c_category').val(data.blogcategory.categories_name);
             

          }
      });
  });
    </script>