<div class="modal fade" id="edit_user" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-modal="true" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{__('messages.Edit User')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            @if(Auth::check())
            <form id="user_edit" action="" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="id" value="{{Auth::user()->id}}">

          <div class="form-group">
          <label>{{__('messages.Name')}}</label>

            <input type="text" id="name" class="form-control" value="{{Auth::user()->name }}" name="name" autocomplete="name"  autofocus placeholder="{{__('messages.Full Name')}}">
          
          </div>
          <div class="form-group">
          <label>{{__('messages.Email')}}</label>

            <input id="email" type="email" class="form-control" value="{{Auth::user()->email }}" name="email"  autocomplete="email" placeholder="{{__('messages.Email')}}">
           
          </div>
          <div class="form-group">
          <label>{{__('messages.Mobile No')}}</label>

            <input id="mobile_number" type="number" class="form-control" value="{{Auth::user()->mobile_number }}" name="mobile_number" autocomplete="mobile_number" placeholder="{{__('messages.Mobile No')}}">
         
          </div>
          <div class="form-group radio-group">
            <label class="d-block">{{__('messages.Select Gender')}}</label>
            <div class="custom-control custom-radio d-inline-block mr-2">
              <input type="radio" id="male"  value="male" {{Auth::user()->gender=="male" ? 'checked' : '' }} name="gender" name="gender" class="custom-control-input" />
              <label class="custom-control-label" for="male">{{__('messages.Male')}}</label>
            </div>
            <div class="custom-control custom-radio d-inline-block mr-2">
              <input type="radio" id="female"  value="female" {{Auth::user()->gender=="female" ? 'checked' : '' }}  name="gender" class="custom-control-input" />
              <label class="custom-control-label" for="female">{{__('messages.Female')}}</label>
            </div>
          </div>
      
          <div class="form-group">
                        <label class="d-block">{{__('messages.Profile')}}</label>
                        <input type="file" name="image" class="form-control"  id="image"/>
                        <img src="{{ Auth::user()->image }}" class="rounded" style="width:60px; height:60px; object-fit: cover; border-radius:0px;"/>
                    </div>
         
            <div class="col-4">
            <button type="submit" class="btn btn-primary update" name="submit">{{__('messages.Update')}}</button>
            </div>
           
        </form>
        @endif
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
        $('#edit_user').find('form').trigger('reset');
        $("#user_edit").find('.is-invalid').removeClass("is-invalid");
        $('.error').html("");
    });
    $("#user_edit").validate({
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
                url: '{{route("update")}}',
                method: 'POST',
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
               
            })
        }

    });
    </script>
