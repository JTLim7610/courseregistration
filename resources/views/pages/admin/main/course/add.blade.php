@extends('pages.admin.layout.index')

@section('section')
<link href="/css/prod/component/table.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
<script defer type="text/javascript" src="/js/prod/component/table.js{{ config('app.link_version') }}"></script>
<script type="text/javascript" src="/js/prod/component/tinymce.min.js{{ config('app.link_version') }}"></script>
@endsection 

@section('content')
<div class='table-section'>
    {!! Form::open(['method'=>'post', 'url' => route('admin.account.add_course.create'),'enctype'=>'multipart/form-data']) !!}
    <div style="background-color: white; padding:20px; border-radius:10px;" class='inline-table-form-section'>
        <h5 class='title' style="margin-bottom: 20px; font-weight:600;">Add Course</h5>   
        <div class="row" style="margin-bottom: 40px;">
            <div style="margin-top:15px;" class="form-group col-sm-8">
                <label>Course Name</label>
                <input required type="text" name="course_name" class="form-control"  placeholder="Enter course name" />
            </div> 

            <div style="margin-top:15px;" class="form-group col-sm-4">
                <label>Course Code</label>
                <input required type="text" name="course_code" class="form-control" aria-describedby="emailHelp"  placeholder="Enter course code" />
            </div> 

            <div style="margin-top:15px;" class="form-group col-sm-3">
                <label>Activity Type</label>
                <select required class="form-control" name="activity_type" id="activity_type" aria-describedby="emailHelp">
                    <option selected disabled>Select activity type</option>
                    <option value="short_course">Short Course</option>
                    <option value="event">Event</option>
                </select>            
            </div>
            
            <div style="margin-top:15px;" class="form-group col-sm-3">
                <label>Course Cover Image</label>
                <input required type="file" name="course_pic" class="form-control"/>
            </div> 

            <div style="margin-top:20px;" class="form-group col-sm-3">
                <label>Course Fees</label>
                <input required  type="number" name="price" min="1" class="form-control" aria-describedby="emailHelp"  placeholder="Enter course fees" />
            </div> 

            <div style="margin-top:20px;" class="form-group col-sm-3">
                <label>Capacity</label>
                <input required  type="number" name="course_capacity" class="form-control" aria-describedby="emailHelp"  placeholder="Enter capacity" />
            </div> 

            <div style="margin-top:20px;" class="form-group col-sm-6">
                <label>Date</label>
                <input required  type="date" name="course_date" class="form-control" aria-describedby="emailHelp"  placeholder="Enter course date" />
            </div> 

            <div style="margin-top:20px;" class="form-group col-sm-6">
                <label>Time</label>
                <input required  type="time" name="course_time" class="form-control" aria-describedby="emailHelp"  placeholder="Enter course time" />
            </div> 

            <div style="margin-top:20px;" class="form-group col-sm-6">
                <label>Feedback Link</label>
                <input required  type="text" name="feedback_link" class="form-control" aria-describedby="emailHelp"  placeholder="Enter feedback link" />
            </div> 

            <div style="margin-top:20px;" class="form-group col-sm-12">
                <label for="exampleFormControlTextarea1">Description</label>
                <textarea required  class="form-control" name="description" id="exampleFormControlTextarea1" rows="10"></textarea>
            </div>

            <div class="col-sm-12" style="margin-top:15px;">
                <button type="submit" class="btn btn-primary" style="float: right;" type="submit">Add Course</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>

@stop