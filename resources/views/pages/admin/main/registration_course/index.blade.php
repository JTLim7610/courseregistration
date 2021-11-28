@extends('pages.admin.layout.index')

@section('section')
<link href="/css/prod/component/table.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
<script defer type="text/javascript" src="/js/prod/component/table.js{{ config('app.link_version') }}"></script>
<script type="text/javascript" src="/js/prod/component/tinymce.min.js{{ config('app.link_version') }}"></script>
@endsection 

@section('content')
<a href='/admin/account'><button class='btn circle-btn back-btn'><p style="font-size: 10px; padding-top:11px;">Back</p><span>Back</span></button></a>

{{-- Pending for review registration --}}
{{-- <div class='table-section' style="background-color: white; padding:30px;">
    <h5 style="font-weight:bold;color:#00026b; margin-bottom:30px;" class='title'>Pending for review registration</h6>
    @if(count($pending_courses) == 0)
        <h5 style="text-align: center; font-weight:bold;color:#00026b;padding-top:30px;">No Registration From User</h5>
    @else
    <div class="table-responsive">
        @foreach($pending_courses as $index=>$courses)
            <h5 style="font-size: 14px; font-weight:bold;margin-top:20px; margin-bottom:15px; color:darkblue;">Course: {{$index}}</h5>  
            <table class="table">
                <thead class='thead-blue'>
                    <tr>
                        <th scope="col-2">#</th>
                        <th scope="col">User Name</th>
                        <th scope="col">User Email</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $key=>$course)
                        <tr class='product-row' data-row="{{$key}}" >
                            <td>{{$key+1}}.</td>
                            <td>{{$course->user->name}}</td>
                            <td>{{$course->user->email}}</td>
                            <td>Pending Approve</td>
                            <td>
                                <div class="row">
                                    <div style="margin-left: 10px;">
                                        <button data-user={{$course->user_id}} data-action="pending_payment" data-course={{$course->course->id}}  data-toggle="modal" data-target="#accept_modal" class="btn btn-primary" style="padding: 5px 10px 5px 10px;" type="submit">Approve User Registration</button>
                                    </div>

                                    <div style="margin-left: 10px;">
                                        <button data-toggle="modal" data-meta="{{$course->meta}}" data-target="#details_modal" class="btn btn-primary">View Details</button>
                                    </div>

                                    <div style="margin-left: 10px;">
                                        <button data-user={{$course->user_id}} data-action="reject" data-course={{$course->course->id}}  data-toggle="modal" data-target="#reject_modal" class="btn btn-danger" style="padding: 5px 10px 5px 10px;" type="submit">Reject</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    <div class="modal fade" id="accept_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel" style="font-size:16px;text-align:center;font-weight:bold;"> Are you sure want to reject this payment ? ?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div style="font-size:16px;text-align:center;font-weight:bold;" class="modal-body">
                                    Once confirm, this action cannot be revert.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    {!! Form::open(['method'=>'post', 'url' => route('admin.account.registered.action')]) !!}
                                        <input hidden name="action" value="pending_payment" />
                                        <input hidden name="registered_course_id" value={{$course->id}} />
                                        <input hidden name="user_id" value={{$course->user_id}} />
                                        <input hidden name="course_id" value={{$course->course->id}} />
                                        <button class="btn btn-danger" type="submit">Approve</button>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="reject_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel" style="font-size:16px;text-align:center;font-weight:bold;"> Are you sure want to reject this registration ? ?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div style="font-size:16px;text-align:center;font-weight:bold;" class="modal-body">
                                    Once confirm, this action cannot be revert.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    {!! Form::open(['method'=>'post', 'url' => route('admin.account.registered.action')]) !!}
                                        <input hidden name="action" value="reject" />
                                        <input hidden name="user_id" />
                                        <input hidden name="course_id"  />
                                        <button type="submit" class="btn btn-danger">Confirm</button>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </tbody>
            </table>
        @endforeach
        </table>
    </div>
    @endif
</div> --}}
{{-- Pending Payment --}}
<div class='table-section' style="background-color: white; padding:30px; margin-top:30px;">
    <h5 style="font-weight:bold;color:#00026b;" class='title'>Pending Payment</h6>

    @if(count($pending_payments) == 0)
        <h5 style="text-align: center; font-weight:bold;color:#00026b;padding-top:30px;">No Registration From User</h5>

    @else
        <div class="table-responsive">

            @foreach($pending_payments as $index=>$courses)

                <h5 style="font-size: 14px; font-weight:bold;margin-top:20px; margin-bottom:15px; color:darkblue;">Course: {{$index}}</h5>

                <table class="table">
                    <thead class='thead-blue'>
                        <tr>
                            <th scope="col-2">#</th>
                            <th scope="col">User Name</th>
                            <th scope="col">User Email</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>


                        @foreach($courses as $key=>$course)

                            @if($course->payment->payslip)
                                <tr class='product-row' data-row="{{$key}}">
                                    <td>{{$key+1}}.</td>
                                    <td>{{$course->user->name}}</td>
                                    <td>{{$course->user->email}}</td>
                                    <td>Pending Payment</td>
                                    <td class="row">
                                        <div style="margin-left: 10px;">
                                            <button data-user={{$course->user_id}} data-action="approved" data-course={{$course->course->id}}  data-toggle="modal" data-target="#approve_payment_modal" class="btn btn-primary" style="padding: 5px 10px 5px 10px; margin-right:10px;" type="submit">Approve Payment</button>
                                        </div>

                                        <div>
                                            <button class="btn btn-primary"style="padding: 5px 10px 5px 10px;" data-toggle="modal" data-payslip={{$course->payment->payslip}} data-target="#receipt-modal">View Receipt</button>
                                        </div>

                                        <div style="margin-left: 10px;">
                                            <button data-user={{$course->user_id}} data-action="reject" data-course={{$course->course->id}}  data-toggle="modal" data-target="#reject_modal" class="btn btn-danger" style="padding: 5px 10px 5px 10px;" type="submit">Reject</button>
                                        </div>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td>{{$key+1}}.</td>
                                    <td>{{$course->user->name}}</td>
                                    <td>{{$course->user->email}}</td>
                                    <td>Pending Receipt From Student</td>
                               </tr>
                            @endif
                        @endforeach
                        <div class="modal fade" id="approve_payment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel" style="font-size:16px;text-align:center;font-weight:bold;"> Are you sure want to approve this payment ? ?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div style="font-size:16px;text-align:center;font-weight:bold;" class="modal-body">
                                        Once confirm, this action cannot be revert.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        {!! Form::open(['method'=>'post', 'url' => route('admin.account.registered.action')]) !!}
                                            <input hidden name="action" value="approved" />
                                            <input hidden name="registered_course_id" value={{$course->id}} />
                                            <input hidden name="user_id" value={{$course->user_id}} />
                                            <input hidden name="payment_id" value={{$course->payment->id}} />
                                            <input hidden name="course_id" value={{$course->course->id}} />
                                            <button class="btn-danger" type="submit">Approve</button>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="receipt-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel" style="font-size:16px;text-align:center;font-weight:bold;">Payslip</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div style="font-size:16px;text-align:center;font-weight:bold;" class="modal-body">
                                    <img class="playslip" style="height:100%; width:100%;" src="" />
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            </div>
                        </div>

                        <div class="modal fade" id="reject_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel" style="font-size:16px;text-align:center;font-weight:bold;"> Are you sure want to reject this payment ? ?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div style="font-size:16px;text-align:center;font-weight:bold;" class="modal-body">
                                        Once confirm, this action cannot be revert.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        {!! Form::open(['method'=>'post', 'url' => route('admin.account.registered.action')]) !!}
                                            <input hidden name="action" value="reject" />
                                            <input hidden name="user_id" />
                                            <input hidden name="course_id"  />
                                            <button type="submit" class="btn btn-danger">Confirm</button>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tbody>
                </table>
            @endforeach
            </table>
        </div>

    @endif
</div>
{{-- Registered Courses --}}
<div class='table-section' style="background-color: white; padding:30px; margin-top:30px;">
    <h5 style="font-weight:bold;color:#00026b;" class='title'>Registered Courses</h6>
    @if(count($registered_courses) == 0)
        <h5 style="text-align: center; font-weight:bold;color:#00026b;padding-top:30px;">No Registration From User</h5>
    @else
    <div class="table-responsive">
        @foreach($registered_courses as $index=>$courses)
            <h5 style="font-size: 14px; font-weight:bold;margin-top:20px; margin-bottom:15px; color:darkblue;">Course: {{$index}}</h5>  
            <table class="table">
                <thead class='thead-blue'>
                    <tr>
                        <th scope="col-2">#</th>
                        <th scope="col">User Name</th>
                        <th scope="col">User Email</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $key=>$course)
                        
                        <tr class='product-row' data-row="{{$key}}">
                            <td>{{$key+1}}.</td>
                            <td>{{$course->user->name}}</td>
                            <td>{{$course->user->email}}</td>
                            <td>Register Successful</td>
                            <td>
                                <div style="margin-left: 10px;">
                                    <button data-user={{$course->user_id}} data-action="remove_student" data-course={{$course->course->id}}  data-toggle="modal" data-target="#remove_student_modal" class="btn btn-danger" style="padding: 5px 10px 5px 10px;" type="submit">Remove Student</button>
                                </div>
                            </td>

                            <div class="modal fade" id="remove_student_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel" style="font-size:16px;text-align:center;font-weight:bold;"> Are you sure want to remove this student ? ?</h5>
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
                                                <input hidden name="course_id" value={{$course->course_id}} />
                                                <input hidden name="user_id" value={{$course->user_id}} />
                                                <button class="btn-danger" type="submit">Confirm</button>
                                                {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
        </table>
    </div>
    @endif
    
    <div class="modal fade" id="details_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg"" role="document">
            <div class="modal-content"">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="font-size:16px;text-align:center;font-weight:bold;">Registration Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div style="font-size:16px;text-align:center;font-weight:bold;" class="modal-body">
                    <div class="row" style="margin-bottom: 20px;">
                        <p style="text-align:left;" class="col-sm-4">Name</p>
                        <input style="text-align:left; background-color:transparent; border:none;" readonly name="name" class="col-sm-8" />
                    </div>
                    <div class="row" style="margin-bottom: 20px;">
                        <p style="text-align:left;" class="col-sm-4">Contact Number</p>
                        <input readonly name="contact" class="col-sm-8 contact"></input>
                    </div>
                    <div class="row" style="margin-bottom: 20px;">
                        <p style="text-align:left;" class="col-sm-4">Age Range</p>
                        <input readonly name="age" class="col-sm-8 age"></input>
                    </div>
                    <div class="row" style="margin-bottom: 20px;">
                        <p style="text-align:left;" class="col-sm-4">Participants Type</p>
                        <input readonly name="participant" class="col-sm-8 participant"></input>
                    </div>
                    <div class="row" style="margin-bottom: 20px;">
                        <p style="text-align:left;" class="col-sm-4">How They Know Us</p>
                        <input readonly name="how_know" class="col-sm-8 how_know"></input>
                    </div>
                    <div class="row" style="margin-bottom: 20px;">
                        <p style="text-align:left;" class="col-sm-4">Remarks</p>
                        <input readonly name="remarks" class="col-sm-8 remarks"></input>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    $(document).ready(function() {
        $('#receipt-modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('payslip') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('img').attr("src", recipient);
            // modal.find('.modal-body input').val(recipient)
        })

        $('#reject_modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var user_id = button.data('user') 
            var course_id = button.data('course') 
            var modal = $(this)
            modal.find('input[name="user_id"]').val(user_id)
            modal.find('input[name="course_id"]').val(course_id)
        })

        $('#remove_student_modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var user_id = button.data('user') 
            var course_id = button.data('course') 
            var modal = $(this)
            modal.find('input[name="user_id"]').val(user_id)
            modal.find('input[name="course_id"]').val(course_id)
        })

        $('#details_modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var course_meta = button.data('meta')
            console.log(course_meta);
            var info = course_meta.register_info
            console.log(info);
            var modal = $(this)
            modal.find('input[name="name"]').val(info.name)
            modal.find('input[name="contact"]').val(info.contact_number ?? "-")
            modal.find('input[name="age"]').val(info.ageRange)
            modal.find('input[name="participant"]').val(info.participants_group)
            modal.find('input[name="how_know"]').val(info.howYouKnowUs)
            modal.find('input[name="remarks"]').val(info.remarks)
        })
    });
    </script>
@stop