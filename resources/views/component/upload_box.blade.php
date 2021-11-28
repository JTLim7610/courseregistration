
@if(isset($type) && $type =='attachment')

<div class='uploader' id="{{$key}}-uploader">    
    <input  type="hidden" value="{{$key}}" class='uploader-key'  />
    <input id="{{$key}}-uid" type="hidden" name="{{$key}}_document_uid" class='clear-input'  />
    <input id="{{$key}}-image-path" type="hidden" name="{{$key}}_document_path" class='clear-input'   />
    <input id="{{$key}}-upload" type="file" name="{{$key}}_document" accept=".pdf, .csv, .xlsx, .doc, .docx" {{isset($required)?'required':''}} />    
    <label for="{{$key}}-upload" id="{{$key}}-drag">
        <div class='start'>
            <div class='uploaded-hide' id="{{$key}}-hide">
                <i class="fa fa-download merc-uploadicon" aria-hidden="true"></i>
                <div>
                    {{translate('click_to_upload_file','Click to upload file here')}}
                </div>
            </div>
            <img id="{{$key}}-image-response"/>
            <small class="attachment-file-name" id="{{$key}}-image-name"></small>
            <span id="{{$key}}-upload-btn" class="uploader-btn btn btn-primary edit-show create-show">{{translate('upload_file','Upload file')}}</span>
            <span  data-key="{{$key}}" data-type='attachment' class="filemanager-btn uploader-btn btn btn-secondary  edit-show create-show">{{translate('file_manager','File Manager')}}</span>
        </div>       
    </label>
</div>

<script>

    $(document).ready(function() {
        initialUploadBox('{{$key}}','attachment');
    });
    
</script>


@else 

<div class='uploader' id="{{$key}}-uploader">    
    <input  type="hidden" value="{{$key}}" class='uploader-key'  />
    <input id="{{$key}}-uid" type="hidden" name="{{$key}}_document_uid" class='clear-input'  />
    <input id="{{$key}}-image-path" type="hidden" name="{{$key}}_document_path" class='clear-input'   />
    <input id="{{$key}}-upload" type="file" name="{{$key}}_document" accept="*" {{isset($required)?'required':''}} />    
    <label for="{{$key}}-upload" id="{{$key}}-drag">
        <div class='start'>
            <div class='uploaded-hide' id="{{$key}}-hide">
                <i class="fa fa-download merc-uploadicon" aria-hidden="true"></i>
                <div>
                    {{translate('click_to_upload_file','Click to upload file here')}}
                </div>
            </div>
            <img id="{{$key}}-image-response"/>
            <small class="attachment-file-name" id="{{$key}}-image-name"></small>
            <span id="{{$key}}-upload-btn" class="uploader-btn btn btn-secondary edit-show create-show">{{translate('upload_file','Upload file')}}</span>
            <span data-key="{{$key}}" class="filemanager-btn uploader-btn btn btn-primary  edit-show create-show">{{translate('file_manager','File Manager')}}</span>
        </div>       
    </label>
</div>

<script>

    $(document).ready(function() {
        initialUploadBox('{{$key}}');
    });
    
</script>


@endif
