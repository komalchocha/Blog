<div class="modal fade" id="product_add" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-modal="true" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <form id="product" action=""  method="POST" >
                    @csrf

                    <div class="form-group">

                        <label>Product Title</label>
                        <input type="text" name="name" id="product_name" class="form-control" placeholder="Product Title" onKeypress="return(event.charCode>64 && event.charCode<91)||(event.charCode>96 &&(event.charCode<123)||(event.charCode==15))">
                    </div>
                   
                    <div class="form-group">
                        <label class="d-block">Product Category</label>
                        <select name="categorie_name" id="categorie" class="form-control">
                            <option value="">Select Product Category</option>
                            @foreach ($productcategories as $productcategory)
                            <option value="{{$productcategory->id}}">
                                {{$productcategory->categories_name}}
                            </option>
                            
                            @endforeach
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" id="blog_description" class="form-control" placeholder="Description"></textarea>
                    </div>
                    <div class="form-group">

<label>Product Price</label>
<input type="number" name="price" id="product_price" class="form-control" placeholder="Product Title">
</div>
                    <div class="form-group">
                        <div class="form-group">
                            <label class="d-block">Choose Product</label>
                            <input type="file" name="image" class="form-control" id="image" />
                        </div>
                    </div>
                    <div class="text-right mb-0">
                
                        <button type="submit"  class="btn btn-primary" value="submit" name="submit">submit</button>
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
        $('#product_add').find('form').trigger('reset');
        $("#product").find('.is-invalid').removeClass("is-invalid");
    });
    $("#product").validate({
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
            price:{
                 required: true,
            },
            image:{
                required: true,
            }
        },
        messages: {
            name: {
                required:"Product title required",
            },

            categorie_name: {
                required:"Categorie required",

            },
            description:{
                required:"Description required",
            },
            price:{
                 required:"Price required",
            },
            image:{
                required:"Image required",
            }
        },
        submitHandler: function(form) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                url: '{{route("admin.product.products")}}',
                method: 'post',
                data: new FormData(form),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    alert(data.message);
                    $('#product_add').modal('hide');
                    window.LaravelDataTables["product-table"].draw();
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