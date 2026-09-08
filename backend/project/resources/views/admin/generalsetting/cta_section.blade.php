@extends('layouts.admin')
@section('title')
    @lang('Edit Cta Section')
@endsection

@section('breadcrumb')
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>@lang('Edit Cta Section')</h1>
        </div>
    </section>
@endsection




@push('style')
    <style>
        .nice-select .list {
            z-index: 11;
        }
    </style>
@endpush

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.gs.update') }}" method="POST" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="row ">
                            <div class="form-group col-md-6 offset-md-3">
                                <label for="">@lang('Select Theme')</label>
                                <select id="selct_theme" class="form-control" required>
                                    <option value="1" {{ request()->input('theme') == 1 ? 'selected' : '' }}>
                                        @lang('Theme 1')</option>
                                    <option value="2" {{ request()->input('theme') == 2 ? 'selected' : '' }}>
                                        @lang('Theme 2')</option>
                                    @if (checkAddon())
                                        
                                    
                                    <option value="3" {{ request()->input('theme') == 3 ? 'selected' : '' }}>
                                        @lang('Theme 3')</option>
                                    <option value="4" {{ request()->input('theme') == 4 ? 'selected' : '' }}>
                                        @lang('Theme 4')</option>
                                        @endif
                                </select>
                            </div>
                        </div>

                        <div class="row">

                            @if (request()->input('theme') == 1 || !request()->input('theme'))
                                <div class="col-sm-6 text-center">
                                    <label for="">@lang('Background Photo')</label>
                                    <div class="form-group d-flex justify-content-center">
                                        <div id="image-preview_about" class="image-preview image-preview_alt"
                                            style="background-image:url({{ getPhoto($gs->cta_background_theme1) }});">
                                            <label for="image-upload_about"
                                                id="image-label_about">@lang('Choose File')</label>
                                            <input type="file" name="cta_background_theme1" id="image-upload_about" />
                                        </div>
                                    </div>
                                </div>
                            @endif


                            @if (request()->input('theme') == 2 || !request()->input('theme'))
                                <div class="col-sm-6 text-center">
                                    <label for="">@lang('Background Photo')</label>
                                    <div class="form-group d-flex justify-content-center">
                                        <div id="image-preview_about" class="image-preview image-preview_alt"
                                            style="background-image:url({{ getPhoto($gs->cta_background_theme2) }});">
                                            <label for="image-upload_about"
                                                id="image-label_about">@lang('Choose File')</label>
                                            <input type="file" name="cta_background_theme2" id="image-upload_about" />
                                        </div>
                                    </div>
                                </div>
                            @endif


                            @if (request()->input('theme') == 3)
                                <div class="col-sm-6 text-center">
                                    <label for="">@lang('Background Photo 1')</label>
                                    <div class="form-group d-flex justify-content-center">
                                        <div id="image-preview_about" class="image-preview image-preview_alt"
                                            style="background-image:url({{ getPhoto($gs->cta_background_theme3_1) }});">
                                            <label for="image-upload_about"
                                                id="image-label_about">@lang('Choose File')</label>
                                            <input type="file" name="cta_background_theme3_1" id="image-upload_about" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 text-center">
                                    <label for="">@lang('Background Photo 2')</label>
                                    <div class="form-group d-flex justify-content-center">
                                        <div id="image-preview_about1" class="image-preview image-preview_alt"
                                            style="background-image:url({{ getPhoto($gs->cta_background_theme3_2) }});">
                                            <label for="image-upload_about1"
                                                id="image-label_about1">@lang('Choose File')</label>
                                            <input type="file" name="cta_background_theme3_2" id="image-upload_about1" />
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (request()->input('theme') == 4)
                                <div class="col-sm-6 text-center">
                                    <label for="">@lang('Background Photo 1')</label>
                                    <div class="form-group d-flex justify-content-center">
                                        <div id="image-preview_about" class="image-preview image-preview_alt"
                                            style="background-image:url({{ getPhoto($gs->cta_background_theme4_1) }});">
                                            <label for="image-upload_about"
                                                id="image-label_about">@lang('Choose File')</label>
                                            <input type="file" name="cta_background_theme4_1" id="image-upload_about" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 text-center">
                                    <label for="">@lang('Background Photo 2')</label>
                                    <div class="form-group d-flex justify-content-center">
                                        <div id="image-preview_about1" class="image-preview image-preview_alt"
                                            style="background-image:url({{ getPhoto($gs->cta_background_theme4_2) }});">
                                            <label for="image-upload_about1"
                                                id="image-label_about1">@lang('Choose File')</label>
                                            <input type="file" name="cta_background_theme4_2" id="image-upload_about1" />
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                        <input type="hidden" name="type" value="cta" id="">
                        <div class="form-group">
                            <label>@lang('Title')</label>
                            <textarea class="form-control" type="text" name="cta_title">{{ $gs->cta_title }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Row-->
@endsection

@push('script')
    @push('script')
        <script>
            'use strict';

            $.uploadPreview({
                input_field: "#image-upload_about",
                preview_box: "#image-preview_about",
                label_field: "#image-label_about",
                label_default: "{{ __('Choose File') }}",
                label_selected: "{{ __('Update Image') }}",
                no_label: false,
                success_callback: null
            });

            $.uploadPreview({
                input_field: "#image-upload_about1",
                preview_box: "#image-preview_about1",
                label_field: "#image-label_about1",
                label_default: "{{ __('Choose File') }}",
                label_selected: "{{ __('Update Image') }}",
                no_label: false,
                success_callback: null
            });

            $(document).on('change', "#selct_theme", function() {
                // current url with query string and location reload
                var url = new URL(window.location.href);
                url.searchParams.set('theme', $(this).val());
                window.location.href = url.href;
            })
        </script>
    @endpush
@endpush
