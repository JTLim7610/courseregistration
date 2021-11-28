

<select data-name='{{$key}}[]' style='display:none' multiple='multiple' id='{{$key}}SelectTemplate'>
    @foreach($data as $index=>$value)
        <option value="{{$index}}">{{$value}}</option>
    @endforeach
</select>                  
<div id="{{$key}}MultiselectSection"></div>                                              
<button type='button' class='btn btn-default multiple-select-all'  data-target="{{$key}}MultiselectSection">{{translate('select_all','Select all')}}</button> 
<button type='button' class='btn btn-default multiple-deselect-all'  data-target="{{$key}}MultiselectSection">{{translate('deselect_all','Deselect all')}}</button> 