@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{__('messages.user data')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('messages.home')}}</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('admin.user.view_user_list')}}">{{__('messages.users')}}</a></li>
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

                                <div class="card-body">

                                    <!-- ajax form response -->
                                    <div class="ajax-msg"></div>

                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="user-table">
                                            <thead>
                                                <tr>
                                                    <th>{{__('messages.Id')}}</th>
                                                    <th>{{__('messages.Profile')}}</th>
                                                    <th>{{__('messages.User Name')}}</th>
                                                    <th>{{__('messages.Email')}}</th>
                                                    <th>{{__('messages.Mobile No')}}</th>
                                                    <th>{{__('messages.Gender')}}</th>
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
<link href="https://cdn.datatables.net/buttons/2.1.1/css/buttons.bootstrap4.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#user-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.user.view_user_list') }}",
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
                    data: 'image',
                    name: 'image'
                },
                {
                    data: 'name',
                    name: 'name'
                },
               
                {
                    data: 'email',
                    name: 'email'
                },
               
                {
                    data: 'mobile_number',
                    name: 'mobile_number'
                },
                {
                    data: 'gender',
                    name: 'gender'
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
    $(document).on('click', '.delete_user', function() {
        var id = $(this).attr('data-id');
        var conf = confirm("Are you sure");

        if (conf == true) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                url: '{{route("admin.user.destroyuser")}}',
                method: 'POST',
                data: {
                    id: id,
                },
                dataType: 'json',
                success: function(data) {
                    swal("Done!", data.message, "success");
                    $('#user-table').DataTable().ajax.reload();


                }
            });
        }
    });
</script>
@include('admin.user.edit_user')

@endsection

@push('page_scripts')
@endpush
