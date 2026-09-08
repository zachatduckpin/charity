@extends('layouts.admin')
@section('breadcrumb')
<section class="section">
    <div class="section-header">
        <h1>@lang('Maintainance Settings')</h1>
    </div>
</section>
@endsection
@section('title')
@lang('Maintainance')
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h6 class="text-primary"> @lang('Maintainance Settings')</h6>
            </div>
            <div class="card-body">
                <form id="" action="{{ route('admin.gs.update') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <input type="hidden" name="maintenance" value="1" id="">
                    <div class="selectgroup w-100 mb-5">
                        <label class="selectgroup-item">
                            <input type="radio" {{ $gs->is_maintenance == 1 ? 'checked' : '' }} name="is_maintenance"
                            value="1"
                            class="selectgroup-input">
                            <span class="selectgroup-button">Active</span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" {{ $gs->is_maintenance == 0 ? 'checked' : '' }} name="is_maintenance"
                            value="0"
                            class="selectgroup-input">
                            <span class="selectgroup-button">@lang('Deactive')</span>
                        </label>
                    </div>
                    <div class="form-group d-flex justify-content-center">
                        <div id="image-preview" class="image-preview image-preview_alt"
                            style="background-image:url({{ getPhoto($gs->maintenance_photo) }});">
                            <label for="image-upload" id="image-label">@lang('Choose File')</label>
                            <input type="file" name="maintenance_photo" id="image-upload" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="text-md-right text-left">@lang('Maintenance Message')*</label>
                        <textarea name="maintenance_message" class="form-control summernote"
                            cols="10">{{ $gs->maintenance }}</textarea>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    </div>
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
            input_field: "#image-upload", // Default: .image-upload
            preview_box: "#image-preview", // Default: .image-preview
            label_field: "#image-label", // Default: .image-label
            label_default: "{{ __('Choose File') }}", // Default: Choose File
            label_selected: "{{ __('Update Image') }}", // Default: Change File
            no_label: false, // Default: false
            success_callback: null // Default: null
        });
</script>
@endpush