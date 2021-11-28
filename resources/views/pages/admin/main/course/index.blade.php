@extends('pages.admin.layout.index')

@section('section')
<link href="/css/prod/component/table.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
<script defer type="text/javascript" src="/js/prod/component/table.js{{ config('app.link_version') }}"></script>
<script type="text/javascript" src="/js/prod/component/tinymce.min.js{{ config('app.link_version') }}"></script>
@endsection 

@section('content')
<a href='/admin/account'><button class='btn circle-btn back-btn'><p style="font-size: 10px; padding-top:11px;">Back</p><span>Back</span></button></a>
<a href='/admin/account/add_course' class='btn circle-btn global-form-btn ml-3'>
    <p style="font-size: 30px; padding-top:11px;">+</p>
    <span>Create</span>
</a>

<div class='table-section'>
    <div class='inline-table-form-section'>
        <h5 class='title' style="margin-bottom: 20px; font-weight:600;">Course Management</h5>
        @include('component.search_input',['data'=>[
            ['type'=>'text','name'=>'query','title'=> 'Search'],
            ['type'=>'date','name'=>'startDate','title'=> 'Start Date'],
            ['type'=>'date','name'=>'endDate','title'=> 'End Date'],
        ]])                      
    </div>
</div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" role="tab" href="#short_courses">Short Courses</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " data-toggle="tab" role="tab" href="#events">Events</a>
        </li>

    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
            <!-- short_courses -->
            <div class="tab-pane active" role="tabpanel" id="short_courses">
                <div class="table-responsive">
                    <table class="table">
                        <div class="alert alert-info" role="alert">
                            Hold "Shift" and scroll for horizontal scroll
                        </div>
                        <thead class='thead-blue'>
                            <tr>                    
                                <th scope="col">Course Name</th>
                                <th scope="col">Completed</th>
                                <th scope="col">Capacity</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courses as $index=>$course)
                                @if ($course->activity_type == 1)
                                    <tr>
                                        <td>{{$course->name}}</td>
                                        <td>{{$course->is_completed ? "Yes" : "No"}}
                                        <td>{{$course->courseDetails->current_capacity}}/{{$course->courseDetails->capacity}}</td>
                                        <td>
                                            <div class="row">
                                                {!! Form::open(['method'=>'get', 'url' => route('admin.account.course.details',['id' => customEncryption($course->id)])]) !!}
                                                    <button class="btn btn-primary">View Details</button>
                                                {!! Form::close() !!}
                                                @if(!$course->is_completed)
                                                    {!! Form::open(['method'=>'post', 'url' => route('admin.account.course.course_completion')]) !!}
                                                        <input hidden name="course_id" value={{customEncryption($course->id)}} />
                                                        <button style="margin-left:8px;" class="btn btn-danger col-sm-12">Mark As Completed</button>
                                                    {!! Form::close() !!}
                                                @endif
                                            </div>    
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- events -->
            <div class="tab-pane " role="tabpanel" id="events">
                <div class="table-responsive">
                    <table class="table">
                        <div class="alert alert-info" role="alert">
                            Hold "Shift" and scroll for horizontal scroll
                        </div>
                        <thead class='thead-blue'>
                            <tr>                    
                                <th scope="col">Course Name</th>
                                <th scope="col">Completed</th>
                                <th scope="col">Capacity</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courses as $index=>$course)
                                @if ($course->activity_type == 2)
                                    <tr>
                                        <td>{{$course->name}}</td>
                                        <td>{{$course->is_completed ? "Yes" : "No"}}
                                        <td>{{$course->courseDetails->current_capacity}}/{{$course->courseDetails->capacity}}</td>
                                        <td>
                                            <div class="row">
                                                {!! Form::open(['method'=>'get', 'url' => route('admin.account.course.details',['id' => customEncryption($course->id)])]) !!}
                                                    <button class="btn btn-primary">View Details</button>
                                                {!! Form::close() !!}
                                                @if(!$course->is_completed)
                                                    {!! Form::open(['method'=>'post', 'url' => route('admin.account.course.course_completion')]) !!}
                                                        <input hidden name="course_id" value={{customEncryption($course->id)}} />
                                                        <button style="margin-left:8px;" class="btn btn-danger col-sm-12">Mark As Completed</button>
                                                    {!! Form::close() !!}
                                                @endif
                                            </div>    
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    </div> 


@stop