@extends('pages.student.layout.index')

@section('head')
<link href="/css/page/student/aboutUs.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
@endsection

@section('content')
<div id="content">
    <h3 style="font-weight:bold; text-align:center; padding-top:30px; padding-bottom:30px; color:#00026b;">ABOUT US</h3>
    <div class="row" style="padding-left:100px;">
        <div class="col-sm-3" style="margin-top: 30px;">
            <img style="width: 100%; height:100%;" src="https://www.studymalaysiainfo.com/wp-content/uploads/2016/11/UTAR-University.jpg" />
        </div>
        <div class="col-sm-9" style="margin-top: 30px;">
            <h5 style="padding-left:100px; padding-right:50px; padding-top:30px; padding-bottom:50px; font-weight:bold">UTAR Background</h5>
            <p style="padding-left:100px; padding-right:50px; line-spacing:3px; font-weight:600; color:#00026b;">Universiti Tunku Abdul Rahman (abbreviated as UTAR) is a non-profit private research university in Malaysia. 
                It is ranked top 100 in the Times Higher Education Asia University Rankings 2018 and top 600 in the Times Higher 
                Education World University Rankings 2021, placing it overall 2nd in Malaysia only after University of Malaya. 
                <br>Beside basic courses, utar focuses on providing its students with a suitable environment and a room for social and general growth. 
                This includes providing events, Short courses, Workshops, etc.. 
            </p>
        </div>
    </div>

    <div class="row" style="padding-left:100px; margin-top:50px; margin-right:100px;">
        <div class="col-sm-9" style="margin-top: 40px;">
            <h5 style="padding-right:50px; padding-top:30px; padding-bottom:50px; font-weight:bold">UTAR WORLD App</h5>
            <p style="line-spacing:3px; font-weight:600; color:#00026b; padding-right:100px;">UTAR WORLD is an app that helps with the registration of short courses, workshops, and events posted by UTAR. 
                It also gives the opportunity for students to be updated on the latest events and on their registration status.
            </p>
        </div>
        <div class="col-sm-3" style="margin-top: 30px; padding-right:50px; ">
            <img style="height: 280px;" src="https://freedesignfile.com/upload/2019/12/Health-app-cartoon-illustration-vector.jpg" />
        </div>
    </div>

    <div class="row" style="padding-left:100px;">
        <div class="col-sm-3" style="margin-top: 30px;">
            <img style="width:400px;" src="https://elearningindustry.com/wp-content/uploads/2020/10/what-are-the-benefits-of-animation-based-learning.jpg" />
        </div>
        <div class="col-sm-9" style="margin-top: 30px;">
            <h5 style="padding-left:100px; padding-right:50px; padding-top:30px; padding-bottom:50px; font-weight:bold">Short Courses</h5>
            <p style="padding-left:100px; padding-right:50px; line-spacing:3px; font-weight:600; color:#00026b;">Short courses are courses that are completed within one or few sessions and are posted any time throughout the semester. 
                <br> short courses are available for registration by UTAR students as well as the public community
                /nShort courses topics usually involve general skills, related or unrelated to studey fields.
            </p>
        </div>
    </div>
</div>
@stop