@extends('layouts.admin')
@section('title')
@lang('Edit Service')
@endsection

@section('breadcrumb')
<section class="section">
    <div class="section-header  d-flex justify-content-between">
        <h1>@lang('Edit Service')</h1>
        <a href="{{ route('admin.service.index') }}" class="btn btn-primary"><i class="fas fa-backward"></i>
            @lang('Back')</a>
    </div>
</section>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <!-- Form Basic -->
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">{{ __('Update Service Form') }}</h6>
            </div>
            <div class="card-body">

                <form action="{{ route('admin.service.update',$service->id) }}" enctype="multipart/form-data"
                    method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row">

                        <div class="col-lg-4 col-md-4 col-sm-12 text-center">
                            <label for="">@lang('Icon')</label>
                            <div class="form-group d-flex justify-content-center">
                                <div id="image-preview_one" class="image-preview image-preview_alt"
                                    style="background-image:url({{ getPhoto($service->icon) }});">
                                    <label for="image-upload_one" id="image-label">@lang('Choose File')</label>
                                    <input type="file" name="icon" id="image-upload_one" />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12 text-center">
                            <label for="">@lang('Feature Photo')</label>
                            <div class="form-group d-flex justify-content-center">
                                <div id="image-preview_two" class="image-preview image-preview_alt"
                                    style="background-image:url({{ getPhoto($service->photo) }});">
                                    <label for="image-upload_two" id="image-label">@lang('Choose File')</label>
                                    <input type="file" name="photo" id="image-upload_two" />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12 text-center">
                            <label for="">@lang('Service Photo')</label>
                            <div class="form-group d-flex justify-content-center">
                                <div id="image-preview_three" class="image-preview image-preview_alt"
                                    style="background-image:url({{ getPhoto($service->service_photo) }});">
                                    <label for="image-upload_three" id="image-label">@lang('Choose File')</label>
                                    <input type="file" name="service_photo" id="image-upload_three" />
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="title">{{ __('Service Title') }}</label>
                        <input type="text" class="form-control" name="title" id="title" required
                            placeholder="{{ __('Service Title') }}" value="{{ old('title',$service->title) }}">
                    </div>

                    <div class="form-group">
                        <label for="sort_text">{{ __('Sort Text') }}</label>
                        <textarea id="area1" class="form-control" name="sort_text" placeholder="{{ __('Sort Text') }}"
                            required>{{ old('sort_text',$service->sort_text) }}</textarea>
                    </div>


                    <div class="form-group">
                        <label for="description">{{ __('Description') }}</label>
                        <textarea id="area1" class="form-control summernote" name="description"
                            placeholder="{{ __('Description') }}"
                            required>{{ old('description',$service->description) }}</textarea>
                    </div>

                    <div class="text-center py-3">
                        <strong>@lang('Benifits Section')</strong>
                    </div>

                    <div class="selectgroup selectgroup-none-flex pb-3">

                        <label class="selectgroup-item">
                            <input type="radio" {{$service->is_benifit == 1 ? 'checked' : ''}} name="is_benifit"
                            value="1"
                            class="selectgroup-input is_benifit">
                            <span class="selectgroup-button">@lang('Yes')</span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" {{$service->is_benifit == 0 ? 'checked' : ''}} name="is_benifit"
                            value="0" class="selectgroup-input is_benifit">
                            <span class="selectgroup-button">@lang('No')</span>
                        </label>
                    </div>

                    <div id="total_benifits" class="{{$service->is_benifit == 1 ? '' : 'd-none'}}">
                        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                            <label for="">@lang('Benifits Photo')</label>
                            <div class="form-group d-flex justify-content-center">
                                <div id="image-preview_four" class="image-preview image-preview_alt"
                                    style="background-image:url({{ getPhoto($service->benifits_photo) }});">
                                    <label for="image-upload_four" id="image-label">@lang('Choose File')</label>
                                    <input type="file" name="benifits_photo" id="image-upload_four" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sort_text">{{ __('Benifits Details') }}</label>
                            <textarea id="area1" class="form-control" name="benifits_details"
                                placeholder="{{ __('Benifits Details') }}"
                                >{{ old('benifits_details',$service->benifits_details) }}</textarea>
                        </div>

                        @php
                        $benifits = $service->benifits ? @explode(',',$service->benifits) : [];
                        @endphp

                        <div class="form-group">
                            <label>{{ __('Benifits Label') }}</label>
                            <div id="binifits">
                                @foreach ($benifits as $item)
                                <div class="binifit-item col-md-12 col-lg-6 col-sm-12 offset-1 offset-md-0 offset-sm-0">
                                    <div class="input-group mb-3">
                                        <input type="text" name="benifits[]" class="form-control"
                                            placeholder="Enter Label" value="{{$item}}">
                                        <button class="btn btn-outline-danger remove_button" type="button"
                                            id="button-addon2"><i class="fas fa-times"></i></button>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="text-center">
                                <button type="button" class="btn btn-primary add_button"><i
                                        class="fas fa-plus-circle"></i> {{ __('Add
                                    More') }}</button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>{{ __('Feature') }}</label>
                        <select class="form-control  mb-3" name="is_feature">
                            <option value="1" {{$service->is_feature == 1 ? 'selected' : ''}}>{{ __('Yes') }}</option>
                            <option value="0" {{$service->is_feature == 0 ? 'selected' : ''}}>{{ __('No') }}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>{{ __('Status') }}</label>
                        <select class="form-control  mb-3" name="status" required>
                            <option value="1" {{$service->status == 1 ? 'selected' : ''}}>{{ __('Active') }}</option>
                            <option value="0" {{$service->status == 0 ? 'selected' : ''}}>{{ __('Inactive') }}</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    'use strict';
        $.uploadPreview({
            input_field: "#image-upload_one", // Default: .image-upload
            preview_box: "#image-preview_one", // Default: .image-preview
            label_field: "#image-label", // Default: .image-label
            label_default: "{{ __('Choose File') }}", // Default: Choose File
            label_selected: "{{ __('Update Image') }}", // Default: Change File
            no_label: false, // Default: false
            success_callback: null // Default: null
        });
        $.uploadPreview({
            input_field: "#image-upload_two", // Default: .image-upload
            preview_box: "#image-preview_two", // Default: .image-preview
            label_field: "#image-label_two", // Default: .image-label
            label_default: "{{ __('Choose File') }}", // Default: Choose File
            label_selected: "{{ __('Update Image') }}", // Default: Change File
            no_label: false, // Default: false
            success_callback: null // Default: null
        });
        $.uploadPreview({
            input_field: "#image-upload_three", // Default: .image-upload
            preview_box: "#image-preview_three", // Default: .image-preview
            label_field: "#image-label_three", // Default: .image-label
            label_default: "{{ __('Choose File') }}", // Default: Choose File
            label_selected: "{{ __('Update Image') }}", // Default: Change File
            no_label: false, // Default: false
            success_callback: null // Default: null
        });
        $.uploadPreview({
            input_field: "#image-upload_four", // Default: .image-upload
            preview_box: "#image-preview_four", // Default: .image-preview
            label_field: "#image-label_four", // Default: .image-label
            label_default: "{{ __('Choose File') }}", // Default: Choose File
            label_selected: "{{ __('Update Image') }}", // Default: Change File
            no_label: false, // Default: false
            success_callback: null // Default: null
        });




// benifits 

$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('#binifits'); //Input field wrapper
    var fieldHTML = '<div class="binifit-item col-md-12 col-lg-6 col-sm-12 offset-1 offset-md-0 offset-sm-0"><div class="input-group mb-3"><input type="text" class="form-control" name="benifits[]" placeholder="Enter Label" ><button class="btn btn-outline-danger remove_button" type="button" id="button-addon2"><i class="fas fa-times"></i></button></div></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        console.log('click');
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
            console.log('click');
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        console.log('click');
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});



// is benifit
$(document).on('click','.is_benifit',function(){
        var is_benifit = $(this).val();
        if(is_benifit == 1){
            $('#total_benifits').show().fadeIn();
            $('#total_benifits').removeClass('d-none');
        }else{
            $('#total_benifits').hide().fadeOut();
            $('#total_benifits').addClass('d-none');
        }
    });

</script>
@endpush