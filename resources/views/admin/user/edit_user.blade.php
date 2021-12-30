<div class="modal fade" id="admin_edit_user" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-modal="true" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{__('messages.Edit User')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="admin_user_edit" action="" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="id" id="hidden">

          <div class="form-group">
          <label>{{__('messages.Name')}}</label>
            <input type="text" id="name" class="form-control"  name="name" autocomplete="name"  autofocus placeholder="{{__('messages.Full Name')}}">
          
          </div>
          <div class="form-group">
          <label>{{__('messages.Email')}}</label>

            <input id="e_email" type="email" class="form-control" name="email"  autocomplete="email" placeholder="{{__('messages.Email')}}">
           
          </div>
          <div class="form-group">
          <label>{{__('messages.Mobile No')}}</label>

            <input id="m_number" type="number" class="form-control"  name="mobile_number" autocomplete="mobile_number" placeholder="{{__('messages.Mobile No')}}">
         
          </div>
          <div class="form-group radio-group">
            <label class="d-block">{{__('messages.Select Gender')}}</label>
            <div class="custom-control custom-radio d-inline-block mr-2">
                            <input type="radio" id="u_male" value="male" name="gender" class="custom-control-input" />
                            <label class="custom-control-label" for="u_male">{{__('messages.Male')}}</label>
                        </div>
                        <div class="custom-control custom-radio d-inline-block mr-2">
                            <input type="radio" id="u_female" value="female" name="gender" class="custom-control-input" />
                            <label class="custom-control-label" for="u_female">{{__('messages.Female')}}</label>
                        </div>
          </div>
      
          <div class="form-group">
                        <label class="d-block">{{__('messages.Profile')}}</label>
                        <input type="file" name="image" class="form-control" />
                    

                    </div>
                    <span id="i_image"></span>
            <div class="col-4">
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
        $('#admin_edit_user').find('form').trigger('reset');
        $("#admin_user_edit").find('.is-invalid').removeClass("is-invalid");
        $('.error').html("");
    });
    $("#admin_user_edit").validate({
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
            },
            mobile_number: {
                required: true,
                minlength: 10,
                maxlength: 10,

            },
            gender: {
                required: true,
            }

        },
        messages: {
            name: {
                required: "{{__('messages.First Name required')}}",
            },

            email: {
                required: "{{__('messages.Email required')}}",

            },

            mobile_number: {
                required: "{{__('messages.Mobile Number required')}}",
                maxlength: "{{__('messages.please enter the only 10 character')}}",
            },
            gender: {
                required: "{{__('messages.Gender required')}}",
          
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
                url: '{{route("admin.user.updateUser")}}',
                method: 'POST',
                data: new FormData(form),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    alert(data.message);
                    $('#admin_edit_user').modal('hide');
                    window.LaravelDataTables["user-table"].draw();

                },
               
            })
        }

    });
    $(document).on('click', '.user_edit_modal', function() {

        var id = $(this).attr('data-id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            url: '{{route("admin.user.user_edit")}}',
            method: 'get',
            data: {
                id: id,
            },
            dataType: 'json',
            success: function(data) {
                $("#admin_edit_user").modal('show');
                $('#hidden').val(data.user.id);
                $('#name').val(data.user.name);
                $('#e_email').val(data.user.email);
                $('#m_number').val(data.user.mobile_number);
                if (data.user.gender == 'male') {
                    $('#u_male').attr("checked", "checked");
                } else{
                    $('#u_female').attr("checked", "checked");
                } 
                $('#i_image').text("");
                $('#i_image').html('<img src="'  + data.user.image +'" alt="" style="width:150px; height:auto;">');
               
             
            
            }
        });
    });
    </script>
