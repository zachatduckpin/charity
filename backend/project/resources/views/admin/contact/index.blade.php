@extends('layouts.admin')
@section('title')
    @lang('Update Contact Setting')
@endsection

@section('breadcrumb')
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>@lang('Update Contact Setting')</h1>
        </div>
    </section>
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">

                    <form action="{{ route('admin.contact.setting.update') }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="form-group">
                            <label>@lang('Contact Page Title')</label>
                            <input class="form-control" type="text" name="title" value="{{ $contact->title }}">
                        </div>
                        <div class="form-group">
                            <label>@lang('Contact Page Text')</label>
                            <input class="form-control" type="text" name="text" value="{{ $contact->text }}">
                        </div>

                  

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>@lang('Email 1')</label>
                                    <input class="form-control" type="text" name="email1" value="{{ $contact->email1 }}">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>@lang('Email 2')</label>
                                    <input class="form-control" type="text" name="email2" value="{{ $contact->email2 }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                           <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>@lang('Phone 1')</label>
                                <input class="form-control" type="text" name="phone1" value="{{ $contact->phone1 }}">
                            </div>
                           </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>@lang('Phone 2')</label>
                                    <input class="form-control" type="text" name="phone2" value="{{ $contact->phone2 }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>@lang('Address')</label>
                            <input class="form-control" type="text" name="address" value="{{ $contact->address }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('Map Iframe Link')</label>
                            <textarea name="map_link" class="form-control" rows="4">{{ $contact->map_link }}</textarea>
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
