@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{__('messages.comment data')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('messages.home')}}</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('admin.blog.comment_view_list')}}">{{__('messages.comment')}}</a></li>
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
                                    <table class="table table-bordered" id="comment-table">
                                            <thead>
                                                <tr>
                                                    <th>{{__('messages.Id')}}</th>
                                                    <th>{{__('messages.Blog Title')}}</th>                                                    
                                                    <th>{{__('messages.User Name')}}</th>
                                                    <th>{{__('messages.comment')}}</th>
                                                    <th>{{__('messages.created_at')}}</th>
                                                    <th>{{__('messages.Action')}}</th>

                                                </tr>
                                            </thead>
                                        </table>                                          </div>

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
        $('#comment-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.blog.comment_view_list') }}",
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
                    data: 'blog_id',
                    name: 'blog_id'
                },
                {
                    data: 'user_id',
                    name: 'user_id'
                },
               
                {
                    data: 'comment',
                    name: 'comment'
                },
               
                {
                    data: 'created_at',
                    name: 'created_at'
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
    

$(document).on('click', '.delete_comment', function() {
        var id = $(this).attr('data-id');
        var conf = confirm("Are you sure");

        if (conf == true) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                url: "{{route('admin.blog.destroy_Comment')}}",
                method: 'POST',
                data: {
                    id: id,
                },
                dataType: 'json',
                success: function(data) {
                    swal("Done!", data.message, "success");                    
                    window.LaravelDataTables["comment-table"].draw();
                }
            });
        }
    });
</script>
@endsection

@push('page_scripts')
@endpush