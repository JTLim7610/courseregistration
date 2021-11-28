@extends('pages.admin.layout.index')

@section('section')
<link href="/css/prod/component/table.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
<script defer type="text/javascript" src="/js/prod/component/table.js{{ config('app.link_version') }}"></script>
<script type="text/javascript" src="/js/prod/component/tinymce.min.js{{ config('app.link_version') }}"></script>
@endsection 

@section('content')
<a href='/admin/account'><button class='btn circle-btn back-btn'><p style="font-size: 10px; padding-top:11px;">Back</p><span>Back</span></button></a>
<a href='/admin/account/staff/add_staff' class='btn circle-btn global-form-btn ml-3'>
    <p style="font-size: 30px; padding-top:11px;">+</p>
    <span>Create</span>
</a>

<div class='table-section'>
    <div class='inline-table-form-section'>
        <h5 class='title' style="margin-bottom: 20px; font-weight:600;">Staff Management</h5>
        @include('component.search_input',['data'=>[
            ['type'=>'text','name'=>'query','title'=> 'Search Name'],
        ]])                      
    </div>
    <div class="table-responsive">
        <table class="table">
            <div class="alert alert-info" role="alert">
                Hold "Shift" and scroll for horizontal scroll
            </div>
            <thead class='thead-blue'>
                <tr>                    
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Created Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($staffs as $staff)
                    <tr>
                        <td>{{$staff->name}}</td>
                        <td>{{$staff->email}}</td>
                        <td>{{$staff->created_at}}</td>
                        <td class="row">
                            {!! Form::open(['method'=>'get', 'url' => route('admin.account.staff.edit_staff'),'enctype'=>'multipart/form-data']) !!}
                                <input hidden name="id" value={{customEncryption($staff->id)}} />
                                <button style="margin-right:20px;" class="btn btn-primary">Edit Details</button>
                            {!! Form::close() !!}
                            <button data-id={{$staff->id}}  data-toggle="modal" data-target="#remove_staff_modal"   class="btn btn-danger">Remove Staff</button>
                        </td>
                    </tr>
                @endforeach
                <div class="modal fade" id="remove_staff_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel" style="font-size:16px;text-align:center;font-weight:bold;"> Are you sure want to delete this staff ?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div style="font-size:16px;text-align:center;font-weight:bold;" class="modal-body">
                                Once confirm, this action cannot be revert.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                {!! Form::open(['method'=>'delete', 'url' => route('admin.account.staff.delete_staff'),'enctype'=>'multipart/form-data']) !!}
                                    <input hidden name="user_id"/>                                
                                    <button type="submit" class="btn btn-danger">Confirm</button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </tbody>
        </table>
    </div>
</div>

<script>

    $(document).ready(function() {
        $('#remove_staff_modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var staff_id = button.data('id') 
            var modal = $(this)
            modal.find('input[name="user_id"]').val(staff_id)
        })
    });
    
</script>

@stop