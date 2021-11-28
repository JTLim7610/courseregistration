@extends('pages.admin.layout.index')

@section('head')
<link href="/css/page/admin/details.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
@endsection 

@section('content')
<a href='/admin/account/course'><button class='btn circle-btn back-btn'><p style="font-size: 10px; padding-top:11px;">Back</p><span>Back</span></button></a>

<div class="course_details_container">
   
    <div class="course_details_wrapper">
        <div class="row">
            <h6 class="col-sm-8" style="padding-left: 30px; padding-bottom:30px; color:darkblue; font-weight:600; font-size:18px;">Course Details</h6>
            <div class="col-sm-2">
                <button  data-toggle="modal" data-target="#delete-modal" style="float: right;" class="btn btn-danger">Delete</button>
                <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel" style="font-size:16px;text-align:center;font-weight:bold;">Are you sure ?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div style="font-size:16px;text-align:center;font-weight:bold;" class="modal-body">
                            Once confirm, this action cannot be revert.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                {!! Form::open(['method'=>'DELETE', 'url' => route('admin.account.add_course.delete')]) !!}
                                    <input hidden name="course_id" value={{$course->id}} />
                                    <button type="submit" class="btn btn-danger">Confirm</button>
                                {!! Form::close() !!}
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <input hidden name="course_id" value={{$course->id}} />
                <button type="submit" style="float: right; margin-bottom:30px;" class="btn btn-primary">Update Course Details</button>
            </div>
        </div>

        {!! Form::open(['method'=>'POST', 'url' => route('admin.account.course.update'),'enctype'=>'multipart/form-data']) !!}
        <div class="row">
            <div class="col-sm-3">
                <img 
                    style="height:50%; width: 75%; margin-left:25px;"
                    src="{{$course->course_pic ? $course->course_pic : "https://upload.wikimedia.org/wikipedia/commons/6/65/No-Image-Placeholder.svg" }}"
                />
            </div>
            <div class="col-sm-9">
                <div class="form-group">
                    <label>Course Name</label>
                    <input required type="text" name="course_name" class="form-control" value="{{$course->name}}" placeholder="Enter course name" />
                </div> 
    
                <div class="form-group">
                    <label>Course Code</label>
                    <input required type="text" name="course_code" class="form-control" aria-describedby="emailHelp" value={{$course->code}} placeholder="Enter course code" />
                </div> 

                <div class="form-group">
                    <label>Course Fees</label>
                    <input required type="number" min=1 name="price" class="form-control" aria-describedby="emailHelp" value={{$course->courseDetails->price}} placeholder="Enter price" />
                </div> 
    
    
                <div class="form-group">
                    <label>Capacity</label>
                    <input required type="number" min=1 name="course_capacity" class="form-control" aria-describedby="emailHelp" value={{$course->courseDetails->capacity}} placeholder="Enter capacity" />
                </div> 
    
                <div class="form-group">
                    <label>Date</label>
                    <input required type="date" name="course_date" class="form-control" aria-describedby="emailHelp" value={{$course->courseDetails->date}} placeholder="Enter course date" />
                </div> 
    
                <div class="form-group">
                    <label>Time</label>
                    <input required type="time" name="course_time" class="form-control" aria-describedby="emailHelp" value={{$course->courseDetails->time}} placeholder="Enter course time" />
                </div> 

                <div class="form-group">
                    <label>Course Cover</label>
                    <input type="file" name="course_pic" class="form-control" aria-describedby="emailHelp" />
                </div> 

                <div class="form-group">
                    <label>Feedback Link</label>
                    <input required type="text" name="feedback_link" class="form-control" aria-describedby="emailHelp" value="{{$course->courseDetails->feedback_link}}" placeholder="Enter feedback Link" />
                </div> 
                @if($course->courseDetails->feedback_link !==null)
                    <a target="_blank" style="font-size: 14px; margin-top:-20px; margin-bottom:3px; color:blue; text-decoration:underline" href={{$course->courseDetails->feedback_link}}> Click Here to View Feedback Response </a>
                @endif
    
                <div class="form-group">
                    <label style="margin-top:20px;" for="exampleFormControlTextarea1">Description</label>
                    <textarea required class="form-control" name="description" id="exampleFormControlTextarea1" rows="10">{{$course->courseDetails->description}}</textarea>
                </div>

            </div>
        </div>
        {!! Form::close() !!}

        <div  style="margin-top:20px;">
            <h6 class="col-sm-10" style="padding-bottom:30px; color:darkblue; font-weight:600; font-size:18px;">Registered Students List (Total Student : {{count($course_students)}})</h6>
            {!! Form::open(['method'=>'POST', 'url' => route('admin.account.course.mark_all_complete')]) !!}
                <input hidden value="{{json_encode($course_students)}}" name="students" />
                <button style="float: right; margin-bottom:15px;" class="btn btn-primary">Mark All Students As Completed</button>
            {!! Form::close() !!}

            <div class="table-responsive">
                <table class="table">
                    <div class="alert alert-info" role="alert">
                        Hold "Shift" and scroll for horizontal scroll
                    </div>
                    <thead class='thead-blue'>
                        <tr>                   
                            <th scope="col">#</th> 
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($course_students as $index=>$student)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$student->user->name}}</td>
                                <td>{{$student->user->email}}</td>
                                <td>
                                    <div class="row">
                                        <div>
                                            <button  data-toggle="modal" data-target="#delete-modal-{{$index}}" class="btn btn-danger">Remove Student</button>
                                            <div class="modal fade" id="delete-modal-{{$index}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel" style="font-size:16px;text-align:center;font-weight:bold;">Are you sure ?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div style="font-size:16px;text-align:center;font-weight:bold;" class="modal-body">
                                                    Once confirm, this action cannot be revert.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        {!! Form::open(['method'=>'DELETE', 'url' => route('admin.account.course.remove_student')]) !!}
                                                            <input hidden name="id" value={{$student->id}} />
                                                            <button type="submit" class="btn btn-danger">Confirm</button>
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if($student->is_completed !== 1)
                                        <div>
                                            {!! Form::open(['method'=>'POST', 'url' => route('admin.account.course.mark_as_complete')]) !!}
                                                <input name="id" hidden value={{customEncryption($student->id)}} />
                                                <button style="margin-left:10px;" class="btn btn-primary">Mark As Completed</button>
                                            {!! Form::close() !!}
                                        </div>
                                        @else
                                        <div>
                                            {!! Form::open(['method'=>'POST', 'url' => route('admin.account.course.generate_cert')]) !!}
                                                <input name="id" hidden value={{customEncryption($student->id)}} />
                                                <button style="margin-left:10px;" class="btn btn-primary">Generate Certificate</button>
                                            {!! Form::close() !!}
                                        </div>
                                        @endif
                                    </div>
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop