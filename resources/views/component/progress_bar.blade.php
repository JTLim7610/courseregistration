<div id="{{$id}}" class='custom-progressbar' data-current ="{{$currentValue}}"  data-target="{{$targetValue}}"></div>


@if(isset($percent))
    <small class='custom-progressbar-text'>{{ filterNumber($currentValue / (($targetValue)?$targetValue:1) * 100) }}%</small>
@else 
    <small class='custom-progressbar-text'>{{isset($displayCurrent)?$displayCurrent:$currentValue}}/{{isset($displayTarget)?$displayTarget:$targetValue}}</small>
@endif