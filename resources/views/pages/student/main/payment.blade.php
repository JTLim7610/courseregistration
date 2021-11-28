@extends('pages.student.layout.index')

@section('head')
    <link href="/css/page/component/table.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet" />
@endsection


@section('content')

<div class='table-section'>

    <h3 class='title'>Payments</h3>

    @if(count($pending_payments) == 0)
    <h5 style="text-align: center; font-weight:bold;color:#00026b;padding-top:30px;">No Registered Courses Yet</h5>
    <p style="text-align: center; font-weight:bold;color:#00026b;padding-top:30px; font-size: 13px;"> Please wait for admin to approve your registration and send you a receipt via email</p>
    <p style="text-align: center; font-weight:bold;color:#00026b; font-size: 13px;"> Once your registration is approved, you will be able to view it here and submit a payment</p>
    @else
    <div class="table-responsive">
    <p style="text-align: center; font-weight:bold;color:#00026b; font-size: 13px;"> Select a file then click upload it to complete a payment. /n You will be registered for a course after admin approves your payment.</p>
        <table class="table">
            <div class="alert alert-info" role="alert">
                Hold "Shift" and scroll for horizontal scroll
            </div>
            <thead class='thead-blue'>
                <tr>
                    <th scope="col-2">#</th>
                    <th scope="col">Course Code</th>
                    <th scope="col">Course Name</th>
                    <th scope="col">Fee</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pending_payments as $index=> $course)
                    <tr class='product-row' data-row="{{$index}}">
                        <td>{{$index+1}}.</td>
                        <td>{{$course->course->code}}</td>
                        <td>{{$course->course->name}}</td>
                        <td>RM {{$course->payment->amount}}</td>
                        <td>{{$course->getStatus()}}</td>

                        <td>
                            @if($course->payment->payslip === null)
                            {!! Form::open(['method'=>'post', 'url' =>  route('student.account.payment.upload'),'enctype'=>'multipart/form-data']) !!}
                                <div class="row">
                                    <input hidden name="payment_id" value={{$course->payment->id}} />
                                    <input type="file" name="payslip" class="form-control col-sm-5"/>
                                    <input hidden name="user_id" value={{$course->user_id}} />
                                    <input hidden name="course_id" value={{$course->course->id}} />
                                    <button class="btn btn-primary" style="padding: 5px 10px 5px 10px;" type="submit">Upload</button>
                                </div>
                            {!! Form::close() !!}
                            @else
                            <div>
                                <button class="btn btn-primary"style="padding: 5px 10px 5px 10px; margin-right:10px;" data-toggle="modal" data-payslip={{$course->payment->payslip}} data-target="#receipt-modal">View Receipt</button>
                            </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
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
            </tbody>
        </table>
    </div>
    @endif
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

});
</script>
@stop