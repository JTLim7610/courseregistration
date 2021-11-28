
{{ Form::open(array('method' =>'GET')) }}
    <div class="form-group row">
        @foreach($data as $input)
                
            <div class="form-group col-md-6">
                <div class="row">
                    <label class="col-12 col-sm-2 col-form-label">{{$input['title']}}</label>
                    <div class="col-12 col-sm-10">
                        @if($input['type']=='select')
                            {{Form::select($input['name'], $input['option'], requestInput($input['name']),['class'=>'form-control'])}}
                        @else 
                            <input class="form-control {{($input['type']=='date')?'datepicker':''}}" type="{{$input['type']}}" name="{{$input['name']}}" placeholder="" value="{{requestInput($input['name'])}}">
                        @endif
                    </div>
                </div>
            </div>        
        
        @endforeach
    </div>
    <button style="margin-bottom:25px;" class='btn btn-primary-light'>Search</button>
{{ Form::close() }}