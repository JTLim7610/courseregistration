@extends('pages.student.layout.index')

@section('head')
    <link href="/css/page/component/table.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet" />
@endsection

@section('content')

<div class='table-section'>
    <h3 class='title'>Registered Courses</h3>
    
    @if(count($registeredCourses) == 0)
        <h5 style="text-align: center; font-weight:bold;color:#00026b;padding-top:30px;">No Registered Courses Yet</h5>
    @else
    <div class="table-responsive">
        <table class="table">
            <div class="alert alert-info" role="alert">
                Hold "Shift" and scroll for horizontal scroll
                
            </div>
            <thead class='thead-blue'>
                <tr>
                    <th scope="col-2">#</th>
                    <th scope="col">Course Code</th>
                    <th scope="col">Course Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach($registeredCourses as $index=> $course)
                    <tr class='product-row' data-row="{{$index}}">
                        <td>{{$index+1}}.</td>
                        <td>{{$course->course->code}}</td>
                        <td>{{$course->course->name}}</td>
                        <td>{{$course->getStatus()}}</td>
                        <td class="row">
                            @if($course->status !== getConfig('registered_course_status.course_completed') && $course->status !== getConfig('registered_course_status.cancelled'))
                                <input hidden name="course_id" value={{$course->course->id}} />
                                <button data-toggle="modal" data-target="#unregister_course_modal" data-id={{$course->course->id}} class="btn-danger" style="padding: 5px 10px 5px 10px;margin-right:15px;" type="submit">Unregister</button>
                            @endif
                            @if($course->certificate_generated == 1)
                            {!! Form::open(['method'=>'get', 'url' =>  route('student.account.registered_course.certificate')]) !!}
                                <input hidden name="course_id" value={{$course->id}} />
                                <button class="btn btn-primary" style="padding: 5px 10px 5px 10px; " type="submit">View Course Certificate</button>
                            {!! Form::close() !!}
                            @endif
                        </td>
                    </tr>
                @endforeach
                <div class="modal fade" id="unregister_course_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel" style="font-size:16px;text-align:center;font-weight:bold;"> Are you sure want to unregister?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div style="font-size:16px;text-align:center;font-weight:bold;" class="modal-body">
                            Once confirm, this action cannot be revert.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            {!! Form::open(['method'=>'post', 'url' =>  route('student.account.course.unregister')]) !!}
                                <input hidden name="course_id"/> 
                                <input hidden name="action" value="registered_approved" />
                                <button type="submit" class="btn btn-danger">Confirm</button>
                            {!! Form::close() !!}
                        </div>
                        </div>
                    </div>
                </div>
            </tbody>
        </table>
    </div>
    @endif
    <p> </p>
    <p style="text-align: left; font-weight:bold;color:#00026b; font-size: 17px;">Registration Process</p>
    <p style="text-align: left; font-weight:bold;color:#00026b; font-size: 13px;">1- Fill a course registration form to register for it. </p>
    <p style="text-align: left; font-weight:bold;color:#00026b; font-size: 13px;">2- (pending-approve) Wait for admin to approve your registration </p>
    <p style="text-align: left; font-weight:bold;color:#00026b; font-size: 13px;">3- The admin will send the pay slip bt email and approve your registration.</p>
    <p style="text-align: left; font-weight:bold;color:#00026b; font-size: 13px;">4- (pending-payment) once registration is approved, it will be pending for payment.</p>
    <p style="text-align: left; font-weight:bold;color:#00026b; font-size: 13px;">5- Submit the payment via payments option in the navigation </p>
    <p style="text-align: left; font-weight:bold;color:#00026b; font-size: 13px;">6- Wait for admin to approve payment.</p>
    <p style="text-align: left; font-weight:bold;color:#00026b; font-size: 13px;">7- (registered) Registration will be complete when admin approves the payment.</p>

</div>

<script>

    $(document).ready(function() {
        $('#unregister_course_modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var course_id = button.data('id') 
            var modal = $(this)
            modal.find('input[name="course_id"]').val(course_id)
        })
    });
    
</script>
@stop