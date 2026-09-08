@extends('layouts.admin')
@section('title')
    @lang('Edit Footer Section')
@endsection

@section('breadcrumb')
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>@lang('Edit Footer Section')</h1>
        </div>
    </section>
@endsection
@section('content')
    <div class="row justify-content-center overflow-hidden">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">

                    <form action="{{ route('admin.gs.update') }}" method="POST" enctype="multipart/form-data">
                        @method('post')
                        @csrf

                        <div class="row d-flex">
                            <div class="col-sm-6 text-center">
                                <label for="">@lang('Theme 1-2 Footer Image')</label>
                                <div class="form-group d-flex justify-content-center">
                                    <div id="image-preview" class="image-preview image-preview_alt"
                                        style="background-image:url({{ getPhoto($gs->footer_photo1) }});">
                                        <label for="image-upload" id="image-label">@lang('Choose File')</label>
                                        <input type="file" name="footer_photo1" id="image-upload" />
                                    </div>
                                </div>
                            </div>

                            @if (checkAddon())
                                <div class="col-sm-6 text-center">
                                    <label for="">@lang('Theme 3-4 Footer Image')</label>
                                    <div class="form-group d-flex justify-content-center">
                                        <div id="image-preview1" class="image-preview image-preview_alt"
                                            style="background-image:url({{ getPhoto($gs->footer_photo2) }});">
                                            <label for="image-upload1" id="image-label1">@lang('Choose File')</label>
                                            <input type="file" name="footer_photo2" id="image-upload1" />
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <input type="hidden" name="footer" value="1" id="">
                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Row-->
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
        $.uploadPreview({
            input_field: "#image-upload1", // Default: .image-upload
            preview_box: "#image-preview1", // Default: .image-preview
            label_field: "#image-label1", // Default: .image-label
            label_default: "{{ __('Choose File') }}", // Default: Choose File
            label_selected: "{{ __('Update Image') }}", // Default: Change File
            no_label: false, // Default: false
            success_callback: null // Default: null
        });
    </script>
@endpush
