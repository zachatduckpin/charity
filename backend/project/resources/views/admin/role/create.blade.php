@extends('layouts.admin')
@section('title')
    @lang('Add Role')
@endsection

@section('breadcrumb')
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>@lang('Add Role')</h1>
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

                    <form action="{{ route('admin.role.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>@lang('Name')</label>
                            <input class="form-control" type="text" name="name">
                        </div>
                        <div class="form-group ch-permission-multi-select">
                            <label class="w-100 d-block">@lang('Permission')</label>
                            <select name="section[]" class="select2" multiple>
                                <option value="Manage Donations">@lang('Manage Donations')</option>
                                <option value="Manage Events">@lang('Manage Events')</option>
                                <option value="Manage User">@lang('Manage User')</option>
                                <option value="Manage Campaign">@lang('Manage Campaign')</option>
                                <option value="Manage Contact">@lang('Manage Contact')</option>
                                <option value="Manage Gateway">@lang('Manage Gateway')</option>
                                <option value="Manage Withdraw">@lang('Manage Withdraw')</option>
                                <option value="Blogs">@lang('Blogs')</option>
                                <option value="Manage Pages">@lang('Manage Pages')</option>
                                <option value="Manage Staff">@lang('Manage Staff')</option>
                                <option value="Manage Volunteer">@lang('Manage Volunteer')</option>
                                <option value="General Settings">@lang('General Settings')</option>
                                <option value="Frontend Setting">@lang('Frontend Setting')</option>
                                <option value="Support Tickets">@lang('Support Tickets')</option>
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
