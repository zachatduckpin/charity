@extends('layouts.admin')

@section('title')
    @lang('General Settings')
@endsection

@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Plugin Settings')</h1>
        </div>
    </section>
@endsection

@section('content')
    <div class="row justify-content-center">


        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <h4>@lang('Plugin Settings')</h4>
                    </div>

                    <form action="{{ route('admin.gs.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="plugin" value="1">

                        <div class="row">
                            {{-- <div class="col-sm-12 col-md-6 col-lg-4">
                                <div class="card shadow-lg">
                                    <div class="card-header">
                                        Google Recaptcha
                                    </div>
                                    <div class="card-body">
                                        <div class="selectgroup w-100">
                                            <label class="selectgroup-item">
                                                <input type="radio" {{ $gs->recaptcha == 1 ? 'checked' : '' }} name="recaptcha" value="1"
                                                    class="selectgroup-input">
                                                <span class="selectgroup-button">Active</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" {{ $gs->recaptcha == 0 ? 'checked' : '' }} name="recaptcha" value="0"
                                                    class="selectgroup-input">
                                                <span class="selectgroup-button">Deactive</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-md-right text-left">Google Recaptcha Site key</label>
                                            <input type="text" name="recaptcha_key" value="{{ $gs->recaptcha_key }}"
                                                class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="text-md-right text-left">Google Recaptcha Secret key</label>
                                            <input type="text" name="recaptcha_secret"
                                                value="{{ $gs->recaptcha_secret }}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="card shadow-lg">
                                    <div class="card-header">
                                        Tawk.to
                                    </div>
                                    <div class="card-body">
                                        <div class="selectgroup w-100">
                                            <label class="selectgroup-item">
                                                <input type="radio" {{ $gs->is_tawk == 1 ? 'checked' : '' }} name="is_tawk" value="1"
                                                    class="selectgroup-input">
                                                <span class="selectgroup-button">Active</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" {{ $gs->is_tawk == 0 ? 'checked' : '' }} name="is_tawk" value="0"
                                                    class="selectgroup-input">
                                                <span class="selectgroup-button">Deactive</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-md-right text-left">Tawk.to Script</label>
                                            <input name="tawk_id" class="form-control"  value="{{ $gs->tawk_id }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="card shadow-lg">
                                    <div class="card-header">
                                        Disqus
                                    </div>
                                    <div class="card-body">
                                        <div class="selectgroup w-100">
                                            <label class="selectgroup-item">
                                                <input type="radio" {{ $gs->is_disqus == 1 ? 'checked' : '' }} name="is_disqus" value="1"
                                                    class="selectgroup-input">
                                                <span class="selectgroup-button">Active</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" {{ $gs->is_disqus == 0 ? 'checked' : '' }} name="is_disqus" value="0"
                                                    class="selectgroup-input">
                                                <span class="selectgroup-button">Deactive</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-md-right text-left">Disqus Shortname</label>
                                            <input type="text" name="disqus" value="{{ $gs->disqus }}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group text-center">
                                        <button class="btn btn-primary">@lang('Update')</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>




        {{-- <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>@lang('Extension Settings')</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.gs.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="extension" value="1">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>@lang('Tawk.to status')</label>
                                <select name="is_tawk" class="form-control">
                                    <option value="1" {{ $gs->is_tawk == 1 ? 'selected' : '' }}>@lang('Active')
                                    </option>
                                    <option value="0" {{ $gs->is_tawk == 0 ? 'selected' : '' }}>@lang('Inactive')
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tawk_id">{{ __('Tawk.to ID') }}</label>
                                <input type="text" class="form-control" id="tawk_id" name="tawk_id"
                                    value="{{ $gs->tawk_id }}" placeholder="{{ __('Tawk.to ID') }}">
                            </div>
                        </div>

                        <hr>

                        <div class="row">

                            <div class="form-group col-md-4">
                                <label>@lang('Google Recaptcha Status')</label>
                                <select name="recaptcha" class="form-control">
                                    <option value="1" {{ $gs->recaptcha == 1 ? 'selected' : '' }}>@lang('Active')
                                    </option>
                                    <option value="0" {{ $gs->recaptcha == 0 ? 'selected' : '' }}>@lang('Inactive')
                                    </option>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="recaptcha_key">{{ __('Recaptcha Site Key') }}</label>
                                <input type="text" class="form-control" id="recaptcha_key" name="recaptcha_key"
                                    value="{{ $gs->recaptcha_key }}" placeholder="{{ __('Recaptcha Site Key') }}">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="recaptcha_key">{{ __('Recaptcha Secret Key') }}</label>
                                <input type="text" class="form-control" id="recaptcha_secret" name="recaptcha_secret"
                                    value="{{ $gs->recaptcha_secret }}" placeholder="{{ __('Recaptcha Secret Key') }}">
                            </div>

                        </div>

                        <div class="form-group text-right">
                            <button class="btn btn-primary">@lang('Update')</button>
                        </div>

                    </form>
                </div>
            </div>
        </div> --}}
    </div>
@endsection
