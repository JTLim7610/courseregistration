@extends('pages.student.layout.empty')


@section('head')
    <link href="/css/page/student/cert.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet" />
@endsection

@section('content')
<div style="margin-left:25%;">
    <h1 id="cert-title">
        Certificate of Proficiency
      </h1>
      <br><br><br><br>
      
      <p class="smaller" id="cert-declaration">
        THIS IS TO CERTIFY THAT
      </p>
      
      <h1 id="cert-holder">
        {{$registeredCourses->user->name}}
      </h1>
      
      <p class="smaller" id='cert-completed-line'>
        has successfully completed the
      </p>
      
      <h2 id="cert-course">
        {{$registeredCourses->course->name}}
      </h2>
      
      <br>
      <p id="cert-from" class="smaller">
        &nbsp; from UTAR Short Course
      </p>
      
      <br>
      <p class="smaller" id='cert-issued'>
       <b>Issued on:</b> {{$registeredCourses->updated_at}}
      </p>
      
      <div id="cert-footer">
        <div id="cert-issued-by">
          <img id="cert-stamp" src="https://i7.pngguru.com/preview/585/794/452/paper-rubber-stamp-postage-stamps-company-seal-seal-thumbnail.jpg">
          <hr>
          <p>Issued by<br>UTAR</p>
        </div>
        <div id="cert-ceo-design">
          <img id="cert-ceo-sign" src="https://i7.pngguru.com/preview/585/794/452/paper-rubber-stamp-postage-stamps-company-seal-seal-thumbnail.jpg">
          <hr>
          <p>President of UTAR</p>
        </div>
      </div>
      
      <div id="cert-verify">
          <br> UTAR has confirmed the participation of this individual in the course.
    </div>
</div>


@endsection

  
  
  