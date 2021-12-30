<div class="modal fade" id="add_category" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-modal="true" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{__('messages.Add Category')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="category_add" action=""  method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>{{__('messages.Add Category')}}</label>
                        <input type="text" name="category"  id="category" class="form-control" placeholder="{{__('messages.Add Category')}}" onKeypress="return(event.charCode>64 && event.charCode<91)||(event.charCode>96 &&(event.charCode<123)||(event.charCode==15))">
                    </div>
                    <button type="submit" class="btn btn-primary" value="submit" name="submit">{{__('messages.submit')}}</button>

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
        $('#add_category').find('form').trigger('reset');
        $("#category_add").find('.is-invalid').removeClass("is-invalid");
        $('.error').html("");
    });
    $("#category_add").validate({
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
                url: "{{route('admin.blog.categories')}}",
                method: 'post',
                data: new FormData(form),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    swal("Done!", data.message, "success");
                    $('#add_category').modal('hide');
                    window.LaravelDataTables["category-table"].draw();
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
    $(document).on('click', '.delete_category', function() {
        var id = $(this).attr('data-id');
        var conf = confirm("Are you sure");

        if (conf == true) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                url: "{{route('admin.blog.destroyCategory')}}",
                method: 'POST',
                data: {
                    id: id,
                },
                dataType: 'json',
                success: function(data) {
                    alert(data.message);
                    $('#edit_category').modal('hide');
                    window.LaravelDataTables["category-table"].draw();

                }
            });
        }
    });
</script>