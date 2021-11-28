@extends('pages.admin.layout.index')

@section('section')
<link href="/css/prod/component/table.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
<script defer type="text/javascript" src="/js/prod/component/table.js{{ config('app.link_version') }}"></script>
<script type="text/javascript" src="/js/prod/component/tinymce.min.js{{ config('app.link_version') }}"></script>
@endsection 

@section('content')
<div class='table-section'>
    {{-- {{dd($staff)}} --}}
    {!! Form::open(['method'=>'post', 'url' => route('admin.account.staff.update_staff'),'enctype'=>'multipart/form-data']) !!}
        <input hidden name="id" value="{{customEncryption($staff->id)}}" />
        <div style="background-color: white; padding:20px; border-radius:10px;" class='inline-table-form-section'>
        <h5 class='title' style="margin-bottom: 20px; font-weight:600;">Edit Staff</h5>   
        <div class="row" style="margin-bottom: 40px;">
            <div style="margin-top:15px;" class="form-group col-sm-6">
                <label>Name</label>
                <input required type="text" name="name" class="form-control"  placeholder="Enter name" value={{$staff->name}} />
            </div> 

            <div style="margin-top:15px;" class="form-group col-sm-6">
                <label>Email</label>
                <input required type="email"value={{$staff->email}} name="email" class="form-control" aria-describedby="emailHelp"  placeholder="Enter email" />
            </div> 

            <div style="margin-top:25px;" class="form-group col-sm-12">
                <h6>Reset Staff's Password</h6>
                <hr>
            </div>

            <div class="form-group col-sm-6">
                <label>Password</label>
                <input  type="password"  placeholder="Enter password" name="password" class="form-control"  />
            </div>

            <div class="form-group col-sm-6">
                <label>Confirm Password</label>
                <input   type="password" name="confirm_password" class="form-control" placeholder="Confirm Your Password" />
            </div> 

            <div class="col-sm-12" style="margin-top:15px;">
                <button type="submit" class="btn btn-primary" style="float: right;" type="submit">Update Staff Details</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>

@stop