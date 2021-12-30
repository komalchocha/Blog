@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{__('messages.category data')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('messages.home')}}</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('admin.blog.categoreis_view_list')}}">{{__('messages.categories')}}</a></li>
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
                                <button class="btn btn-primary btn-save float-right user" title="Add Category" data-toggle="modal" data-target="#add_category" data-id="'.$data->id.'">{{__('messages.Add Category')}}</button>
                            </div>
                                <div class="card-body">

                                    <!-- ajax form response -->
                                    <div class="ajax-msg"></div>

                                    <div class="table-responsive">
                                    <table class="table table-bordered" id="category-table">
                                            <thead>
                                                <tr>
                                                    <th>{{__('messages.Id')}}</th>
                                                    <th>{{__('messages.categories')}}</th>                                                    
                                                    <th>{{__('messages.Action')}}</th>
                                                </tr>
                                            </thead>
                                        </table>                                    
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </section>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>


<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#category-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.blog.categoreis_view_list') }}",
            language:{
                sProcessing:"{{__('messages.sProcessing')}}",
                sLengthMenu:"{{__('messages.sLengthMenu')}}",
        sZeroRecords:   "{{__('messages.sZeroRecords')}}",
        sEmptyTable:    "{{__('messages.sEmptyTable')}}",
        sInfo:         "{{__('messages.sInfo')}}",
        sInfoEmpty:  "{{__('messages.sInfoEmpty')}}",
        sInfoFiltered: "{{__('messages.sInfoFiltered')}}",
        sInfoPostFix:   "",
        sSearch:        "{{__('messages.sSearch')}}",
        sUrl:    "",
        sInfoThousands: "{{__('messages.sInfoThousands')}}",
        sLoadingRecords:"{{__('messages.sLoadingRecords')}}",
        oPaginate: {         
            sFirst:   "{{__('messages.oPaginate.sFirst')}}",
            sLast:    "{{__('messages.oPaginate.sLast')}}",
            sNext:   "{{__('messages.oPaginate.sNext')}}",
            sPrevious: "{{__('messages.oPaginate.sPrevious')}}",
        }
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                
                {
                    data: 'categories_name',
                    name: 'categories_name'
                },
               
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                },
            ],
            order: [
                [0, 'desc']
            ]
        });
    });
    
</script>
@include('admin.blog.add_category')
@include('admin.blog.edit_category')

@endsection

@push('page_scripts')
@endpush