@extends("pages.student.layout.index")


@section('head')

@endsection


@section('content')

<div style=" width:800px; position: absolute; top:25%; left:30%;margin-top: -50px; margin-left: -50px; padding: 20px 20px 20px 20px; box-shadow:2px 2px 2px 2px #888888;">
    <div 
        class="row" 
        style="align-items:center;">
        <img style="width:100px; height: 50px; margin-left:20px;" src="https://upload.wikimedia.org/wikipedia/en/f/f1/Universiti_Tunku_Abdul_Rahman_Logo.jpg" />
        <p style="margin-top:15px; padding-left: 20%; font-weight:700; font-size: 23px; text-align:center; color:#00026b;">Contact Us</p>
    </div>
    <div style="width: 100%;">
        <hr style="color: 10px;">
        <p style="font-size: 14px; text-align:center; font-weight:500; letter-spacing:1px; margin-top:30px;">We would like your feedback to improve our website.</p>
        <p style="font-size: 14px; text-align:center; font-weight:500; letter-spacing:1px; margin-top:10px; margin-bottom:30px;">What is your opinion for this website ?</p>
        <hr style="color: 10px;">
    </div>
    {!! Form::open(['method'=>'post', 'url' => route('student.account.feedback.create')]) !!}
    <div>
        <input hidden id="feedback_value" name="feedback_type" value="" />
        <p style="font-size: 14px; font-weight:bold; margin-top:10px;">Please select your feedback category below.</p>
        <div style="display: flex; justify-content:space-evenly; margin-top:30px;margin-bottom:30px;">
            
            @foreach(getConfig('feedback') as $key=>$feedback)
                <div class="feedback_type" data-id={{$feedback}} style="cursor: pointer; background-color: #e4e9f2; border: 1px solid grey; text-align:center; font-size:12px; font-weight:bold; border-radius : 15px; padding-left:15px; padding-right:15px; padding-top: 20px; padding-bottom:20px;">
                    {{$key}}
                </div>
            @endforeach
        </div>
        <hr style="color: 10px;">
    </div>
    <div>
        <p style="font-size: 14px; font-weight:bold; margin-top:10px;">Please leave your feedback below.</p>
        <textarea type="text" name="feedback" maxlength="250" rows="5" style="width: 100%;border-radius:10px;">
        </textarea>
    </div>
    <button style="border-radius:10px; border:none;font-size:14px;padding:10px 30px 10px 30px; float:right; font-weight:bold; margin-top :20px;" class="btn-primary" type="submit">Submit</button>
    {!! Form::close() !!}
</div>

<script>

$(document).ready(
    $('.feedback_type').on('click', function(){
        var feedback_id = $(this).data('id')
        console.log(feedback_id);
        $('input[name=feedback_type]').val(feedback_id)
        $('.feedback_type').css('background-color', '#e4e9f2')
        $(this).css('background-color', "lightblue");
    })
)
</script>
@stop