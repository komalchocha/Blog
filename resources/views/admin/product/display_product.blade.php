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
    <link rel="stylesheet" href="{{ asset('plugins/price/price.css') }}">

    <style></style>
    <script type='text/javascript' src=''></script>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
    <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.0/nouislider.js" integrity="sha512-7i2V4phHspcYYpLujbQU0Ur1NjN6h0oWic1YVo8V1gLtBzOziltT3XX/5XaAmhbvtx3QjyANL/MIyuTpXh/Ndw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                    <fieldset class="filter-price">
   
    <div class="price-field">
      <input type="range"  min="100" max="500" value="100" id="lower">
      <input type="range" min="100" max="1000000" value="1000000" id="upper">
    </div>
     <div class="price-wrap">
      <span class="price-title"></span>
      <div class="price-wrap-1">
        <input id="one">
        <label for="one">$</label>
      </div>
      <div class="price-wrap_line">-</div>
      <div class="price-wrap-2">
        <input id="two">
        <label for="two">$</label>
      </div>
    </div>
  </fieldset> 
                    <br />

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
                        <button type="submit" href="{{route('getCategory')}}" class="btn btn-primary" value="submit" name="submit">Filter</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-12 col-sm-12 mb-30">
                <div class="card rightSide h-100 mb-0">
                    <div class="row m-0 causes_div"></div>
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
<script>
    $(document).on('click', '.category_chechbox', function() {
        $('.product').empty();
        // var id = $(this).val();
        var id = $(this).val();

        if ($(this).prop('checked') == true) {


            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                url: "{{route('getCategory')}}",
                method: 'POST',
                data: {
                    id: id,
                },
                dataType: 'json',

                success: function(data) {



                    var htm = "";
                    $.each(data.data, function(key, value) {

                        htm += '<div class="img_thumb" id="' + value.category_id + '" ><div class="h-causeIMG"><img src="' + value.image + '" alt="" /></div></div>'

                    });
                    $('.causes_div').append(htm);
                }
            });
        } else {
            var id = $(this).val();
            $('#' + id).html('');
            $('#' + id).remove();
        }
    });

    var lowerSlider = document.querySelector("#lower");
var upperSlider = document.querySelector("#upper");

document.querySelector("#two").value = upperSlider.value;
document.querySelector("#one").value = lowerSlider.value;

var lowerVal = parseInt(lowerSlider.value);
var upperVal = parseInt(upperSlider.value);

upperSlider.oninput = function () {
  lowerVal = parseInt(lowerSlider.value);
  upperVal = parseInt(upperSlider.value);

  if (upperVal < lowerVal + 4) {
    lowerSlider.value = upperVal - 4;
    if (lowerVal == lowerSlider.min) {
      upperSlider.value = 4;
    }
  }
  document.querySelector("#two").value = this.value;
};

lowerSlider.oninput = function () {
  lowerVal = parseInt(lowerSlider.value);
  upperVal = parseInt(upperSlider.value);
  if (lowerVal > upperVal - 4) {
    upperSlider.value = lowerVal + 4;
    if (upperVal == upperSlider.max) {
      lowerSlider.value = parseInt(upperSlider.max) - 4;
    }
  }
  document.querySelector("#one").value = this.value;
};

</script>