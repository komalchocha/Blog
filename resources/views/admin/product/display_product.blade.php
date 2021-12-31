<!doctype html>
<html>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Snippet - GoSNippets</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.0/nouislider.min.css" integrity="sha512-qveKnGrvOChbSzAdtSs8p69eoLegyh+1hwOMbmpCViIwj7rn4oJjdmMvWOuyQlTOZgTlZA0N2PXA7iA8/2TUYA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style></style>
    <script type='text/javascript' src=''></script>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
    <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js'></script>
</head>

<body oncontextmenu='return false' class='snippet-body'>
    <section class="bg-light pt-5 pb-5 shadow-sm">
        <div class="container">
            <div class="row pt-5">
                <div class="col-12">
                    <h3 class="text-uppercase border-bottom mb-4">Welcome</h3>
                </div>
            </div>
            <div class="card" style="width: 18rem;">

                <div class="card-body">

                    <h5 class="card-title ">Products</h5><br />
                    <h5 class="card-subtitle border-bottom mb-2">Select Category</h5>
                    @foreach ($productcategory as $category)
                    <div>
                        <input type="checkbox" name="{{($category->id)}}" class="custom-control-input category_chechbox" value="{{$category->id}}">
                        <label class="custom-control-label">{{($category->categories_name)}}</label>
                    </div></br>
                    @endforeach
                    
                    <div class="widget mercado-widget filter-widget price-filter">
                        <input type="hidden" id="min_price" name="min_price" value=1>      
                        <input type="hidden" id="max_price" name="max_price" value=5000>                                        
                        <h6 class="widget-title">Price<span class="text-info" id="price"></span></h6>
                        <div class="widget-content" style="padding:10px 5px 40px 5px;">
                            <div id="slider"  wire:ignore></div>
                        </div>
                    </div>
                    <br/>
                    <h6 class="card-subtitle border-bottom mb-2">Shorting</h6>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="address_type" id="home" value="1" required>
                        <label class="form-check-label" for="home">largest price</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="address_type" id="office" value="2">
                        <label class="form-check-label" for="office">Lowest price</label>
                    </div>
                    <div class="text-right mb-0">
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-12 col-sm-12 mb-30">
                <div class="card rightSide h-100 mb-0 causes_div">
                    <div class="row m-0 "></div>
                </div>
            </div>
            <div class="row">
                @foreach($products as $product)
                <div class="col-lg-6 mb-4 product">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="card-title">{{$product->getcategory->categories_name}}
                        </div>
                        <img src="{{ asset(''. $product->image) }}" class="card-img-top" alt="Image">
                        <div class="card-body">
                            </h5>
                            <h5 class="card-title">{{$product->name}}</h5>
                            <p class="card-text" style="max-height: 45px; overflow: hidden;">{{$product->description}}</p>
                            <a href="#" class="btn btn-primary text-white mt-auto align-self-start">${{$product->price}}</a>
                        </div>
                    </div>
                </div>
                <!--Item One -->

                <!--Item two -->
                @endforeach
                <!-- Item Three -->
            </div>
        </div>
    </section>
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.0/nouislider.min.js" integrity="sha512-ZKqmaRVpwWCw7S7mEjC89jDdWRD/oMS0mlfH96mO0u3wrPYoN+lXmqvyptH4P9mY6zkoPTSy5U2SwKVXRY5tYQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).on('click', '.category_chechbox', function() {
        $('.product').empty();
        Filter();
    
        // if ($(this).prop('checked') == true) {
      
        // } else {
        //     var id = $(this).val();
        //     $('#' + id).html('');
        //     $('#' + id).remove();
        // }
    });

    var slider = document.getElementById('slider');
    noUiSlider.create(slider, {
        start: [1, 50000],
        connect: true,
        range: {
            'min': 1,
            'max': 50000
            
        },
        pips: {
            mode: 'steps',
            stepped: true,
            density: 4
        }
    });
    slider.noUiSlider.on('update',function(value){  
        $('#price').html(parseInt(value[0])+' - '+parseInt(value[1]));
        var value1 = value[0];
        var value2 = value[1];
        $('#min_price').val(value1);
        $('#max_price').val(value2);
        Filter();
    });

    function  Filter(){
        var id = [];
                   $(".category_chechbox:checked").each(function() {
                       id.push($(this).val());
                   })
        var min_price = $("#min_price" ).val();
        var max_price = $("#max_price" ).val();

        $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                url: "{{route('getCategory')}}",
                method: 'POST',
                data: {min_price:min_price,
                    max_price:max_price,
                    id: id,

                },
                dataType: 'json',

                success: function(data) {
                    console.log(data);
                    var htm = "";
                    $.each(data.data, function(key, value) {

                        htm += '<div class="img_thumb" id="' + value.category_id + '" ><div class="h-causeIMG"><img src="' + value.image + '" alt="" /></div></div>'

                    });
                    $('.causes_div').html(htm);
                }
            });
    }
</script>