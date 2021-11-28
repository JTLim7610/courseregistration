@extends('pages.student.layout.index')

@section('head')
<link href="/css/page/student/courseDetails.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
@endsection

@section('content')

<div class="course_details_container">
    
    <div class="row course_details_wrapper">
        <div class="col-sm-3">
            <img 
                style="height:100%; width: 80%; margin-left:25px;"
                src="{{$course->course_pic ? $course->course_pic : "https://upload.wikimedia.org/wikipedia/commons/6/65/No-Image-Placeholder.svg" }}"
            />
        </div>
        
        <div class="col-sm-9">
            @if(Auth::user() && (count($is_registred) == 0))
                {!! Form::open(['method'=>'get', 'url' => route('student.account.course.form')]) !!}
                    <input hidden name="course_id" value={{$course->id}} />
                    <button style="float: right;margin-bottom:30px;" class="btn btn-danger">Register</button>
                {!! Form::close() !!}
            @endif
            <h5 class="title">{{$course->name}}</h5>
            <div class="info">Course Code: {{$course->code}}</div>
            <div class="info">Capacity: {{$course->courseDetails->capacity}}</div>
            <div class="info">Date: {{$course->courseDetails->date}}</div>
            <div class="info">Time: {{$course->courseDetails->time}}</div>
            <div class="description">Description</div>
            <div class="info">{{$course->courseDetails->description}}</div>
            @if($course->courseDetails->feedback_link)
                <div class="feedback_link"><a href={{$course->courseDetails->feedback_link}}  style="color:royalblue" href="">Click Here to Give Feedback On This Course</a></div>
            @endif
        </div>
    </div>
</div>

@stop
