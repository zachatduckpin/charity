@extends('layouts.admin')
@section('title')
    @lang('Faq Section Photo')
@endsection

@section('breadcrumb')
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>@lang('Faq Section Photo')</h1>
        </div>
    </section>
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">

                    <form action="{{ route('admin.gs.update') }}" method="POST" enctype="multipart/form-data">
                        @method('POST')
                        @csrf

                        <div class="row">
                            {{-- <div class="col-sm-6 text-center">
                                <label for="">@lang('Theme 1 Photo')</label>
                                <div class="form-group d-flex justify-content-center">
                                    <div id="image-preview_about" class="image-preview image-preview_alt"
                                        style="background-image:url({{ getPhoto($gs->faq_theme1) }});">
                                        <label for="image-upload_about" id="image-label_about">@lang('Choose File')</label>
                                        <input type="file" name="faq_theme1" id="image-upload_about" />
                                    </div>
                                </div>
                            </div> --}}



                            <div class="col-sm-6 text-center">
                                <label for="">@lang('Theme 2 Photo')</label>
                                <div class="form-group d-flex justify-content-center">
                                    <div id="image-preview_about1" class="image-preview image-preview_alt"
                                        style="background-image:url({{ getPhoto($gs->faq_theme2) }});">
                                        <label for="image-upload_about1" id="image-label_about1">@lang('Choose File')</label>
                                        <input type="file" name="faq_theme2" id="image-upload_about1" />
                                    </div>
                                </div>
                            </div>

                            @if (checkAddon())
                                
                            

                            <div class="col-sm-6 text-center">
                                <label for="">@lang('Theme Photo 3')</label>
                                <div class="form-group d-flex justify-content-center">
                                    <div id="image-preview_about3" class="image-preview image-preview_alt"
                                        style="background-image:url({{ getPhoto($gs->faq_theme3) }});">
                                        <label for="image-upload_about3" id="image-label_about3">@lang('Choose File')</label>
                                        <input type="file" name="faq_theme3" id="image-upload_about3" />
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-6 text-center">
                                <label for="">@lang('Theme 4 Photo')</label>
                                <div class="form-group d-flex justify-content-center">
                                    <div id="image-preview_about4" class="image-preview image-preview_alt"
                                        style="background-image:url({{ getPhoto($gs->faq_theme4) }});">
                                        <label for="image-upload_about4" id="image-label_about4">@lang('Choose File')</label>
                                        <input type="file" name="faq_theme4" id="image-upload_about4" />
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>



                        <div class="text-centerh">
                            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                        </div>
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

            $.uploadPreview({
                input_field: "#image-upload_about3",
                preview_box: "#image-preview_about3",
                label_field: "#image-label_about3",
                label_default: "{{ __('Choose File') }}",
                label_selected: "{{ __('Update Image') }}",
                no_label: false,
                success_callback: null
            });
            $.uploadPreview({
                input_field: "#image-upload_about4",
                preview_box: "#image-preview_about4",
                label_field: "#image-label_about4",
                label_default: "{{ __('Choose File') }}",
                label_selected: "{{ __('Update Image') }}",
                no_label: false,
                success_callback: null
            });
        </script>
    @endpush
@endpush
