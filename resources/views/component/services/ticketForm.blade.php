<div class="ticket-form">
    {!! Form::open(['route' => $route,'type'=>'post']) !!}
        <input hidden name="merchant_id" value={{customEncryption(getMerchantID())}} />
        <input hidden name="service" value={{$service}} />
        <input hidden name="parent_id" value={{customEncryption($parent_id)}} />
        <div  class="form-group row">
            <div class="form-group col-md-6">
                <label class="col-12 col-sm-2 col-form-label">{{translate("name", "Name")}}</label>
                <div class="col-12 col-sm-12">
                    <input readonly class="form-control" type="text" name="user_name" placeholder="" value="{{$user->name}}">
                </div>
            </div>      
            <div class="form-group col-md-6">
                <label class="col-12 col-sm-2 col-form-label">{{translate("email", "Email")}}</label>
                <div class="col-12 col-sm-12">
                    <input readonly class="form-control" type="text" name="user_email" placeholder="" value="{{$user->email}}">
                </div>
            </div>      
        </div>
        <div  class="form-group row">
            <div class="form-group col-md-12">
                <label class="col-12 col-sm-12 col-form-label required">{{translate("subject", "Subject")}}</label>
                <div class="col-12 col-sm-12">
                    <input class="form-control" type="text" name="subject" placeholder="" value="">
                </div>
            </div>       
        </div>
        <div class="row">
            @if($service === "domain_hosting")
            <div class="form-group col-md-6">
                <label class="col-12 col-sm-12 col-form-label">{{translate("suggested_domain_name", "Domain name that you would like to subscribe")}}</label>
                <div class="col-12 col-sm-12">
                    <input hidden class="form-control price" type="text" name="price" placeholder="" value="80" />
                    <input class="form-control domain_name" type="text" name="domain_name" placeholder="" value="">
                </div>
            </div>  
            @endif 
            <div class="form-group col-md-6">
                <label class="col-12 col-sm-2 col-form-label">{{translate("priority", "Priority")}}</label>
                <div class="col-12 col-sm-12">
                    {{Form::select('priority', ['Low', 'Medium', 'High'], 'High',['class'=>'form-control'])}}
                </div>
            </div>      
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label class="col-12 col-sm-12 col-form-label">{{translate("message", "Message")}}</label>
                <div class="col-12 col-sm-12 message-area">
                    {{-- <textarea class="form-control" name="message" rows="15" value=""></textarea> --}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <div class="col-12 col-sm-12">
                    <input hidden name="action" value="create_ticket" />
                    <button class='btn btn-primary submit-ticket-btn' type="submit"> {{translate('submit_ticket','Submit Ticket')}} </button>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
</div>