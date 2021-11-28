@extends("pages.student.layout.index")

@section('head')
<link href="/css/page/student/index.css" type="text/css" rel="stylesheet"/>
@endsection

@section('content')
    <div class="row background" >
        <div class="top" style="width: 100%">
            <br>
            @if(Auth::user())
                {!! Form::open(['method'=>'get', 'url' => route('student.account.index')]) !!}
                    <div class="row"  style="margin-left: 30px; margin-bottom: 30px;">
                            <input type="text" class="col-sm-10" placeholder="Search By Course Name" name="name" style="height: 40px; border-radius:10px;"> 
                            <div class="col-sm-2">
                                <button style="font-size: 13px; padding: 5px 20px 5px 20px; background-color:#080bc2; color:white; border:none; height: 38px; border-radius:10px;" type="submit">Search</button>
                            </div>
                    </div>
                {!! Form::close() !!}
            @elseif(!Auth::user())
                {!! Form::open(['method'=>'get', 'url' => route('guest')]) !!}
                    <div class="row"  style="margin-left: 30px; margin-bottom: 30px;">
                            <input type="text" class="col-sm-10" placeholder="Search By Course Name" name="name" style="height: 40px; border-radius:10px;"> 
                            <div class="col-sm-2">
                                <button style="font-size: 13px; padding: 5px 20px 5px 20px; background-color:#00026b; color:white; border:none; height: 38px; border-radius:10px;" type="submit">Search</button>
                            </div>
                    </div>
                {!! Form::close() !!}
            @endif
            <h3 style="font-weight: bold; color:#00026b; margin-top:60px; margin-bottom:50px; font-family:'Times New Roman', Times, serif; text-align:center;">Course List</h3>
        </div>
        <div class="bottom" style="padding:20px; align-items: center; justify-content: center;">
            <div class="row" style=" align-items: center; justify-content: center;">
                @foreach($courses as $index=>$course)
                    <div class="card" style="height:25rem; width: 18rem; padding:10px; margin: 30px;" >
                        <div class="top">
                            <div>
                                <img 
                                    style="height:220px; width: 270px;  border-radius: 5px;"
                                    src="{{$course->course_pic ? $course->course_pic : "https://upload.wikimedia.org/wikipedia/commons/6/65/No-Image-Placeholder.svg" }}"
                                />
                            </div>
                            <br>
                            <p style="text-align: center; font-size:14px; font-weight:bold; color:#181543">{{$course->name}}</p>
                        </div>
                        <div class="bottom card-body">
                            <div>
                                <div class="container">
                                    <div class="row" style=" align-items: center; justify-content: center;">
                                        @if(Auth::user())
                                            <div style="align-items: center; justify-content: center; position: relative; ">
                                                {{-- <div style="display: inline-block;">
                                                    {!! Form::open(['method'=>'get', 'url' => route('student.account.course.details')]) !!}
                                                        <input hidden name="course_id" value={{$course->id}} />
                                                        <button style=" width:100px; height:50px; font-size: 13px; font-weight: bold; padding: 5px 5px 5px 5px; background-color:#00026b; color:white; border:none; border-radius: 5px;" type="submit">View Details</button>
                                                    {!! Form::close() !!}
                                                </div> --}}
                                                @if (!($registered_courses->contains('course_id',$course->id)))
                                                    @if (strtotime($course->courseDetails['date']) < time())
                                                        <div style="position: absolute; font-size: 15px; font-weight: bold; color:red; text-align: center;">Expired</div>
                                                        
                                                    @elseif ($course->courseDetails['current_capacity'] == $course->courseDetails['capacity'])
                                                        <div style="position: absolute; font-size: 15px; font-weight: bold; color:red; text-align: center;">Capacity has full.</div>
    
                                                    @else
                                                        <div style="display: inline-block;">
                                                            {!! Form::open(['method'=>'get', 'url' => route('student.account.course.form')]) !!}
                                                                <input hidden name="course_id" value={{$course->id}} />
                                                                <button style=" width:100px; height:50px; font-size: 13px; font-weight: bold; margin-left: 25px; padding: 5px 5px 5px 5px; background-color:#9e1b4d; color:white; border:none; border-radius: 5px;" type="submit">Register</button>
                                                            {!! Form::close() !!}
                                                        </div>
                                                    @endif
                                                @else
                                                    <div style=" align-items: center; position: absolute; font-size: 15px; font-weight: bold; color:red; text-align: center;">Registered!</div>
                                                @endif 
                                            </div>
                                        @else
                                            <div class="col-sm">
                                                {!! Form::open(['method'=>'get', 'url' => '/guest/course']) !!}
                                                    <input hidden name="course_id" value={{$course->id}} />
                                                    <button style="margin-left:30px; font-size: 13px; padding: 5px 10px 5px 10px; background-color:#00026b; color:white; border:none;" type="submit">View Details</button>
                                                {!! Form::close() !!}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <a href="www.twitter.com" class="stretched-link"></a>

                        </div>
                    </div>
                @endforeach
            </div>
            
        </div>
    </div>
@stop