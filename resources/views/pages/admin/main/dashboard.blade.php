@extends("pages.admin.layout.index")


@section('head')
<link href="/css/page/admin/details.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
@endsection

@section('content')
<h3 style="font-weight:bold; letter-spacing: 2px;">Welcome {{ $data['user'] }}</h3>
<div class="course_details_container" style="background-color: white; height:100vh; margin:20px;">
    <h5 style="margin-bottom:20px; font-size:40px; font-weight:bold; text-align: center;">Statistics and Analytics</h5>
    <div class="row" style="display: flex; justify-content: center; align-items: center;">
        <div class="card col-sm-5 " style="border: none; margin: 20px;">
            <div class="card-body" style=" text-align: center;">
              <img src="/img/dashboard/student.png"  width="80" height="80"  />
              <div>              
                <h6 class="card-title" style="font-weight:600; color:darkblue;">Number of Students</h6>
                <p class="card-text" style="font-size:40px; font-weight:800; ">{{$data['students_count']}}</p>
              </div>
            </div>
        </div>
    
        <div class="card col-sm-5" style="border: none; margin: 20px;">
            <div class="card-body" style=" text-align: center;">
              <img src="/img/dashboard/staff.png"  width="80" height="80"  style="display:inline; "/>
              <div>              
                <h6 class="card-title" style="font-weight:600; color:darkblue; display:inline; vertical-align: middle;">Number of Staff</h6>
                <p class="card-text" style="font-size:40px; font-weight:800; vertical-align: middle; ">{{$data['staff_count']}}</p>
              </div>
            </div>
        </div>

        <div class="card col-sm-5" style="border: none; margin: 20px;">
            <div class="card-body" style=" text-align: center;">
              <img src="/img/dashboard/course.png"  width="80" height="80"  style="display:inline;"/>
              <div>              
                <h6 class="card-title" style="font-weight:600; color:darkblue; display:inline;">Number of Courses</h6>
                <p class="card-text" style="font-size:40px; font-weight:800;">{{$data['courses_count']}}</p>
              </div>
            </div>
        </div>

        <div class="card col-sm-5" style="border: none; margin: 20px;">
          <div class="card-body" style="text-align: center;">
            <img src="/img/dashboard/pending.png"  width="80" height="80"  style="display:inline;"/>
            <div>              
              <h6 class="card-title" style="font-weight:600; color:darkblue; display:inline;">Courses Pending Review</h6>
              <p class="card-text" style="font-size:40px; font-weight:800;">{{$data['pending_course_count']}}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>


@stop