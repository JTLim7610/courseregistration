
@if(isset($route))
{{ Form::open(['route'=>$route, 'method' =>'GET', 'class'=>'search-form']) }}
@else 
{{ Form::open(['method' =>'GET', 'class'=>'search-form']) }}
@endif

@php($queryInput = (isset($queryInput))?$queryInput:"query")

<div class="input-group search-bar">
    <input type="text" name='{{$queryInput}}' class="form-control {{($class)??''}}" placeholder="{{($placeholder)??translate('search_placeholder','Touch me and search me anything !')}}" value="{{requestInput($queryInput)}}"  id="{{($id)??''}}"  maxlength="100">
    <div class="input-group-append">
        <button class="btn btn-outline-secondary {{($buttonClass)??''}}" type="{{(isset($type))?$type:'submit'}}" ><i class="fas fa-search"></i></button>
    </div>
</div>     

{!! Form::close() !!}