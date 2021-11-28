    
@foreach($data as $box)
    <div class='col-xl-3 col-lg-4 col-sm-6'>
        <a href='{{$box["href"]}}'>
            <div class='custom-panel {{isset($box["isActive"])?"panel-blue":""}}'>
                <div class='row'>
                    <div class='col-4'>
                        <div class='icon-section'>
                            <i class='{{$box["icon"]}}'></i>
                        </div>
                    </div>
                    <div class='col-8'>
                        <div class='content-section'>
                            <h1>{{$box["title"]}}</h1>
                            <p> {{$box["desc"]}} </p>
                        </div>
                    </div>
                </div>
                <div class='panel-action'>
                    <button class='btn panel-action-btn'> {{$box["btn_desc"]}}</button>
                </div>
            </div>
        </a>
    </div>
@endforeach