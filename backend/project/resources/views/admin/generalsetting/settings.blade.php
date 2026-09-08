@extends('layouts.admin')

@section('title')
    @lang('General Settings')
@endsection

@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Site Settings')</h1>
        </div>
    </section>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>@lang('Basic Settings')</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.gs.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="basic" value="1">

                        <div class="form-group">
                            <label for="frontend_url" class="col-form-label">{{ __('Frontend Url') }}</label>
                            <input type="text" class="form-control" id="frontend_url" name="frontend_url"
                                placeholder="{{ __('Frontend Url') }}" value="{{ $gs->frontend_url }}">
                        </div>

                        <div class="form-group">
                            <label for="title" class="col-form-label">{{ __('Website Title') }}</label>
                            <input type="text" class="form-control" id="title" name="title"
                                placeholder="{{ __('Website Title') }}" value="{{ $gs->title }}">
                        </div>

                        <div class="form-group ">
                            <label for="phone" class="col-form-label">{{ __('Phone') }}</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                placeholder="{{ __('Phone') }}" value="{{ $gs->phone }}">
                        </div>

                        <div class="form-group ">
                            <label for="email" class="col-form-label">{{ __('Email') }}</label>
                            <input type="text" class="form-control" id="email" name="email"
                                placeholder="{{ __('Email') }}" value="{{ $gs->email }}">
                        </div>

                        <div class="form-group ">
                            <label for="address" class="col-form-label">{{ __('Address') }}</label>
                            <input type="text" class="form-control" id="address" name="address"
                                placeholder="{{ __('Address') }}" value="{{ $gs->address }}">
                        </div>

                        <div class="form-group ">
                            <label for="footer_text" class="col-form-label">{{ __('Footer Text') }}</label>
                            <input type="text" class="form-control" id="footer_text" name="footer_text"
                                placeholder="{{ __('Footer Text') }}" value="{{ $gs->footer_text }}">
                        </div>

                        <div class="form-group ">
                            <label for="copyright_text" class="col-form-label">{{ __('Copyright Text') }}</label>
                            <input type="text" class="form-control" id="copyright_text" name="copyright_text"
                                placeholder="{{ __('Copyright Text') }}" value="{{ $gs->copyright_text }}">
                        </div>

                        <div class="form-group text-right">
                            <button class="btn btn-primary">@lang('Update')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/admin/js/colorpicker.js') }}"></script>
    <script>
        'use strict';
        $(document).ready(function() {
            $(".cp").colorpicker({
                format: "auto",
            });

            $('input[name=allowed_email]').tagify();

            $('#select2-basic').select2();
        });
    </script>
@endpush
