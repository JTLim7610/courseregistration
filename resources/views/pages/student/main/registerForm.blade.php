@extends('pages.student.layout.index')


@section('content')

<div style="box-shadow: 5px 5px lightgrey; background-color:white; margin-left:100px; margin-right:100px;margin-top:50px;padding:20px 20px 100px 20px; border-radius:10px;">
    <h5 style="text-align: center; font-weight:600;">Register Form ({{$course->name}})</h5>

    <h6 style="margin-top:40px; font-weight:600; color:gray">Extra Personal Information</h6>
    <hr>
    {!! Form::open(['method'=>'post', 'url' => route('student.account.course.register')]) !!}
    <div class="row">
        <div class="form-group col-sm-6">
            <label for="formGroupExampleInput">Name</label>
            <input readonly type="text" value="{{Auth::user()->name}}" name="name" class="form-control" id="formGroupExampleInput">
        </div>
        <div class="form-group col-sm-6">
            <label for="formGroupExampleInput">Contact Number</label>
            <input type="text" name="contact_number" class="form-control" id="formGroupExampleInput">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-6">
            <label for="formGroupExampleInput">Select Your Age Range</label>
            <select name="ageRange" class="form-control">
                <option value="">Select Here</option>
                <option value="7 - 12 years old">7 - 12 years old</option>
                <option value="13 - 18 years old">13 - 18 years old</option>
                <option value="25 - 30 years old">25 - 30 years old</option>
                <option value="31 - 36 years old">31 - 36 years old</option>
                <option value="36 years old and above">36 years old and above</option>
            </select>
        </div>
        <div class="form-group col-sm-6">
            <label for="formGroupExampleInput">Select Your Category</label>
            <select name="participants_group" class="form-control">
                <option value="">Select Here</option>
                <option value="Non UTAR Student">Non UTAR Student</option>
                <option value="UTAR Student">UTAR Student</option>
                <option value="UTAR Staff">UTAR Staff</option>
                <option value="Public">Public</option>
            </select>
        </div>
    </div>

    <h6 style="margin-top:40px; font-weight:600; color:gray">Other Questions</h6>
    <hr>
    <div class="row">
        <div class="form-group col-sm-6">
            <label for="formGroupExampleInput">How Did Your Hear About This Course</label>
            <select name="howYouKnowUs" class="form-control">
                <option value="">Select Here</option>
                <option value="Facebook">Facebook</option>
                <option value="Twitter">Twitter</option>
                <option value="Webite">Webite</option>
                <option value="LinkedIn">LinkedIn</option>
                <option value="Email">Email</option>
                <option value="Friends / Colleagues">Friends / Colleagues</option>
            </select>
        </div>
        <div class="form-group col-sm-6">
            <label for="formGroupExampleInput">Remarks (if any)</label>
            <input type="text" name="remarks" class="form-control" id="formGroupExampleInput">
        </div>
    </div>


    <div class="row" style="margin-top:30px;float: right;">
        <input hidden name="action" value="register" />
        <input hidden name="course_id" value={{request()->query("course_id")}} />
        <button style="margin-left: 15px;" type="submit" class="btn btn-primary">Register</button>
    {!! Form::close() !!}
        {!! Form::open(['method'=>'post', 'url' => route('student.account.course.register')]) !!}
            <input hidden name="action" value="cancel" />
            <button style="margin-left: 10px; margin-right:15px;" class="btn btn-danger">Cancel</button>
        {!! Form::close() !!}
    </div>
</div>
@stop 