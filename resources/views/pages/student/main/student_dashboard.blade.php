@extends("pages.student.layout.index")

@section('head')
<link href="/css/page/student/index.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
@endsection

@section('content')
        {{-- @if(Auth::user())
            <div class="col-sm-3 left-nav">
                <div>
                    <h3 style="font-weight: bold; margin-top:30px; font-family:'Times New Roman', Times, serif; text-align:center; letter-spacing: 2px;">Welcome {{ $user->name }}</h3>
                    <h5 style="text-decoration:underline; font-weight: bold; color:#00026b; margin-top:30px; margin-bottom:50px; font-family:'Times New Roman', Times, serif; text-align:center;">Registered Courses</h5>
                    <div>
                        @if(count($registered_success) == 0)
                            <h6 style="text-align: center; margin-top:80px; font-weight:600; font-size:20px;"> No registered courses yet </h5>

                            <p style="text-align: left; font-weight:bold;color:#00026b; font-size: 13px;margin-top:25px;">Your registration will be completed once approved by the admin. </p>
                            <p style="text-align: left; font-weight:bold;color:#00026b; font-size: 13px;">Visit (My Registrations) to view your pending registrations </p>

                            @else
                            @foreach($registered_courses as $course)
                                <div class="row" style="margin-top: 25px;">
                                    <p class="col-sm-8" style="font-weight: 600;"> - {{$course->course->name}} </p>
                                    <div class="form-check col-sm-4">
                                        <button data-toggle="modal" data-target="#unregister_course_modal" class="btn-danger" style="padding: 5px 10px 5px 10px; font-size:12px; float:right;" type="submit">X</button>
                                        <div class="modal fade" id="unregister_course_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel" style="font-size:16px;text-align:center;font-weight:bold;"> Are you sure want to unregister {{$course->course->name}} ?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div style="font-size:16px;text-align:center;font-weight:bold;" class="modal-body">
                                                    Once confirmed, this action cannot be reverted.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    {!! Form::open(['method'=>'post', 'url' => route('student.account.course.unregister')]) !!}
                                                        <input hidden name="course_id" value={{$course->course->id}} /> 
                                                        <input hidden name="action" value="registered_approved" />
                                                        <button type="submit" class="btn btn-danger">Confirm</button>
                                                    {!! Form::close() !!}
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div style="float: right;">
                                <button class="btn-danger" style="padding: 5px 10px 5px 10px; margin-top:50px;" data-toggle="modal" data-target="#registered-modal">Unregister All Course</button>
                                
                                <div class="modal fade" id="registered-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel" style="font-size:16px;text-align:center;font-weight:bold;">Are you sure ?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div style="font-size:16px;text-align:center;font-weight:bold;" class="modal-body">
                                            Once confirmed, this action cannot be reverted.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            {!! Form::open(['method'=>'post', 'url' => route('student.account.course.unregister.all')]) !!}
                                                <input hidden name="action" value="registered_approved" />
                                                <button type="submit" class="btn btn-danger">Confirm</button>
                                            {!! Form::close() !!}
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <p style="text-align: left; font-weight:bold;color:#00026b; font-size: 13px;margin-top:25px;">Your registration will be completed once approved by the admin. </p>
                            <p style="text-align: left; font-weight:bold;color:#00026b; font-size: 13px;">Visit (My Registrations) to view your pending registrations </p>
                            
                            </div>
                            
                        @endif
                    </div>
                </div> --}}

                {{-- pending approve = havent verify --}}
                {{-- <div>
                    <h5 style="text-decoration:underline; font-weight: bold; color:#00026b; margin-top:130px; margin-bottom:50px; font-family:'Times New Roman', Times, serif; text-align:center;">Pending Accept Courses</h5>
                    <div>
                        @if(count($pending_courses) == 0)
                            <h6 style="text-align: center; margin-top:100px; font-weight:600; font-size:20px;"> No </h5>
                        @else
                            @foreach($pending_courses as $course)
                                <div class="row" style="margin-top: 25px;">
                                    <p class="col-sm-8" style="font-weight: 600;"> - {{$course->course->name}} </p>
                                    <div class="form-check col-sm-4">
                                        <button class="btn-danger" data-toggle="modal" data-target="#unregister_pending_modal" style="padding: 5px 10px 5px 10px; font-size:12px; float:right;" type="submit">X</button>
                                        <div class="modal fade" id="unregister_pending_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel" style="font-size:16px;text-align:center;font-weight:bold;"> Are you sure want to unregister {{$course->course->name}} ?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div style="font-size:16px;text-align:center;font-weight:bold;" class="modal-body">
                                                    Once Confirmed, This action cannot be reverted.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    {!! Form::open(['method'=>'post', 'url' => route('student.account.course.unregister')]) !!}
                                                        <input hidden name="action" value="unregistered_pending" />
                                                        <input hidden name="course_id" value={{$course->course->id}} />
                                                        <button type="submit" class="btn btn-danger">Confirm</button>
                                                    {!! Form::close() !!}
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div style="float: right;">
                                <button class="btn-danger" style="padding: 5px 10px 5px 10px; margin-top:50px;" data-toggle="modal" data-target="#unregistered-modal">Unregistered All Pending Courses</button>
                                <div class="modal fade" id="unregistered-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            {!! Form::open(['method'=>'post', 'url' => route('student.account.course.unregister.all')]) !!}
                                                <input hidden name="action" value="unregistered_pending" />
                                                <button type="submit" class="btn btn-danger">Confirm</button>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div> --}}

                {{-- pending payment --}}
                {{-- <div>
                     <h5 style="text-decoration:underline; font-weight: bold; color:#00026b; margin-top:130px; margin-bottom:50px; font-family:'Times New Roman', Times, serif; text-align:center;">Pending Payment Courses</h5>
                    <div>
                         @if(count($pending_payment) == 0)
                            <h6 style="text-align: center; margin-top:100px; font-weight:600; font-size:20px;"> No </h5>
                        @else
                            @foreach($pending_payment as $index=>$course)
                                <div class="row" style="margin-top: 25px;">
                                    <p class="col-sm-12" style="font-weight: 600;"> {{$index+1}}. {{$course->course->name}} </p>
                                </div>
                            @endforeach
                        @endif
                        @if(count($pending_payment) !== 0)
                        <div style="float: right;">
                            <a href="/account/payment" class="btn btn-primary" style="padding: 5px 10px 5px 10px; margin-top:30px;">View and Upload Payslip</a>
                        </div>
                        @endif
                    </div>
                </div> --}}

            {{-- </div>
        @endif --}}
        
@stop