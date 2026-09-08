@extends('layouts.admin')
@section('title')
    @lang('Edit Role')
@endsection

@section('breadcrumb')
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>@lang('Edit Role')</h1>
            <a href="{{ route('admin.role.index') }}" class="btn btn-primary"><i class="fas fa-backward"></i> @lang('Back')
            </a>
        </div>
    </section>
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">

                    <form action="{{ route('admin.role.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>@lang('Name')</label>
                            <input class="form-control" type="text" name="name" value="{{ $role->name }}">
                        </div>

                        @php
                            $data = json_decode($role->section, true);
                            if (!$data) {
                                $data = [];
                            }
                        @endphp
                        <div class="form-group ch-permission-multi-select">
                            <label class="w-100 d-block">@lang('Permission')</label>
                            <select name="section[]" class="select2" multiple>
                                <option value="Manage Donations"
                                    {{ in_array('Manage Donations', $data) ? 'selected' : '' }}>@lang('Manage Donations')</option>
                                <option value="Manage Events" {{ in_array('Manage Events', $data) ? 'selected' : '' }}>
                                    @lang('Manage Events')</option>
                                <option value="Manage User" {{ in_array('Manage User', $data) ? 'selected' : '' }}>
                                    @lang('Manage User')</option>
                                <option value="Manage Campaign" {{ in_array('Manage Campaign', $data) ? 'selected' : '' }}>
                                    @lang('Manage Campaign')</option>
                                <option value="Manage Contact" {{ in_array('Manage Contact', $data) ? 'selected' : '' }}>
                                    @lang('Manage Contact')</option>
                                <option value="Manage Gateway" {{ in_array('Manage Gateway', $data) ? 'selected' : '' }}>
                                    @lang('Manage Gateway')</option>
                                    <option value="Manage Withdraw" {{ in_array('Manage Withdraw', $data) ? 'selected' : '' }}>@lang('Manage Withdraw')</option>
                                <option value="Blogs" {{ in_array('Blogs', $data) ? 'selected' : '' }}>@lang('Blogs')
                                </option>
                                <option value="Manage Pages" {{ in_array('Manage Pages', $data) ? 'selected' : '' }}>
                                    @lang('Manage Pages')</option>
                                <option value="Manage Staff" {{ in_array('Manage Staff', $data) ? 'selected' : '' }}>
                                    @lang('Manage Staff')</option>
                                <option value="Manage Volunteer"
                                    {{ in_array('Manage Volunteer', $data) ? 'selected' : '' }}>@lang('Manage Volunteer')</option>
                                <option value="General Settings"
                                    {{ in_array('General Settings', $data) ? 'selected' : '' }}>@lang('General Settings')</option>
                                <option value="Frontend Setting"
                                    {{ in_array('Frontend Setting', $data) ? 'selected' : '' }}>@lang('Frontend Setting')</option>
                                <option value="Support Tickets" {{ in_array('Support Tickets', $data) ? 'selected' : '' }}>
                                    @lang('Support Tickets')</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Row-->
@endsection
