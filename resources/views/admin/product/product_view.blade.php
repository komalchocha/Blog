@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Product Data</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">User</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-header">
                            <div class="card-header-actions">
                                <div class="card-header-actions">
                                    <form action="{{ route('admin.product.import') }}" id="import" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group mb-4">
                                            <div class="custom-file text-left">
                                                <input type="file" name="file" class="custom-file-input" id="customFile">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" type="submit">Import Products</button>
                                        <a class="btn btn-success" href="{{ route('admin.product.export-products') }}">Export Products</a>
                                    </form>

                                    <button class="btn btn-primary btn-save float-right product" title="Add Category" data-toggle="modal" data-target="#product_add">Add Product</button>
                                </div>
                                <div class="card-body">

                                    <!-- ajax form response -->
                                    <div class="ajax-msg"></div>

                                    <div class="table-responsive">
                                        {!! $dataTable->table(['class' => 'table table-bordered dt-responsive nowrap']) !!}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </section>
</div>

@include('admin.product.create_product')

@endsection

@push('page_scripts')
{!! $dataTable->scripts() !!}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script>
    $("#import").validate({
        rules: {
            file: {
                required: true,
            }
        },
        messages: {
            file: {
                required: "File required",
            }
        },

    });
    $(document).on('click', '.delete_product', function() {
        var id = $(this).attr('data-id');
        var conf = confirm("Are you sure");

        if (conf == true) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                url: "{{route('admin.product.destroy_Product')}}",
                method: 'POST',
                data: {
                    id: id,
                },
                dataType: 'json',
                success: function(data) {
                    alert(data.message);
                    window.LaravelDataTables["product-table"].draw();


                }
            });
        }
    });
</script>
@endpush