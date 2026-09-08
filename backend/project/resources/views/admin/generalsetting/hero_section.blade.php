@extends('layouts.admin')
@section('title')
    @lang('Edit Hero Section')
@endsection

@section('breadcrumb')
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>@lang('Edit Hero Section')</h1>
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
                                <label for="">@lang('Theme 1 Hero Image')</label>
                                <div class="form-group d-flex justify-content-center">
                                    <div id="image-preview" class="image-preview image-preview_alt"
                                        style="background-image:url({{ getPhoto($gs->hero_photo) }});">
                                        <label for="image-upload" id="image-label">@lang('Choose File')</label>
                                        <input type="file" name="hero_photo" id="image-upload" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 text-center">
                                <label for="">@lang('Theme 2 Hero Image')</label>
                                <div class="form-group d-flex justify-content-center">
                                    <div id="image-preview1" class="image-preview image-preview_alt"
                                        style="background-image:url({{ getPhoto($gs->hero_photo2) }});">
                                        <label for="image-upload1" id="image-label1">@lang('Choose File')</label>
                                        <input type="file" name="hero_photo2" id="image-upload1" />
                                    </div>
                                </div>
                            </div>

                            @if (checkAddon())
                                
                           
                            <div class="col-sm-6 text-center">
                                    <label for="">@lang('Theme 3 Hero Image')</label>
                                    <div class="form-group d-flex justify-content-center">
                                        <div id="image-preview3" class="image-preview image-preview_alt"
                                            style="background-image:url({{ getPhoto($gs->hero_photo3) }});">
                                            <label for="image-upload3" id="image-label3">@lang('Choose File')</label>
                                            <input type="file" name="hero_photo3" id="image-upload3" />
                                        </div>
                                    </div>
                                </div>
                            <div class="col-sm-6 text-center">
                                    <label for="">@lang('Theme 4 Hero Image')</label>
                                    <div class="form-group d-flex justify-content-center">
                                        <div id="image-preview4" class="image-preview image-preview_alt"
                                            style="background-image:url({{ getPhoto($gs->hero_photo4) }});">
                                            <label for="image-upload4" id="image-label4">@lang('Choose File')</label>
                                            <input type="file" name="hero_photo4" id="image-upload4" />
                                        </div>
                                    </div>
                                </div>
                                 @endif
                        </div>



                        <input type="hidden" name="hero" value="1" id="">
                        <div class="form-group">
                            <label>@lang('Sub Title')</label>
                            <input class="form-control" type="text" name="hero_subtitle"
                                value="{{ $gs->hero_subtitle }}">
                        </div>
                        <div class="form-group">
                            <label>@lang('Title')</label>
                            <input class="form-control" type="text" name="hero_title" value="{{ $gs->hero_title }}">
                        </div>
                        <div class="form-group">
                            <label>@lang('Youtube Video Id')</label>
                            <input class="form-control" type="text" name="hero_video_link"
                                value="{{ $gs->hero_video_link }}">
                        </div>


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
        $.uploadPreview({
            input_field: "#image-upload3", // Default: .image-upload
            preview_box: "#image-preview3", // Default: .image-preview
            label_field: "#image-label3", // Default: .image-label
            label_default: "{{ __('Choose File') }}", // Default: Choose File
            label_selected: "{{ __('Update Image') }}", // Default: Change File
            no_label: false, // Default: false
            success_callback: null // Default: null
        });
        $.uploadPreview({
            input_field: "#image-upload4", // Default: .image-upload
            preview_box: "#image-preview4", // Default: .image-preview
            label_field: "#image-label4", // Default: .image-label
            label_default: "{{ __('Choose File') }}", // Default: Choose File
            label_selected: "{{ __('Update Image') }}", // Default: Change File
            no_label: false, // Default: false
            success_callback: null // Default: null
        });
    </script>
@endpush
