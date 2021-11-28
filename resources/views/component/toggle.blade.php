<fieldset>
    <div class="toggle">
        <input type="radio" name="{{$name}}" value="{{$key1}}" id="{{$name.  $key1}}" checked="checked" />
        <label for="{{$name . $key1}}">{{$title1}}</label>
        <input type="radio" name="{{$name}}" value="{{$key2}}" id="{{$name . $key2}}" />
        <label for="{{$name . $key2}}">{{$title2}} </label>
    </div>
</fieldset>