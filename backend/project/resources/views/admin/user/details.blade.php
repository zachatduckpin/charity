@extends('layouts.admin')

@section('title')
    @lang('User Details')
@endsection

@section('breadcrumb')
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>@lang('User Details')</h1>
            <a href="{{ route('admin.user.index') }}" class="btn btn-primary"><i class="fas fa-backward"></i>
                @lang('Back')</a>
        </div>
    </section>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-xxl-8 col-lg-6">
            <div class="card">
                <div class="card-body">


                    <h6 class="mt-3 ">@lang('User details')</h6>
                    <hr class="mb-5">
                    <form action="{{ route('admin.user.profile.update', $user->id) }}" method="POST" class="row">
                        @csrf
                        <div class="form-group col-md-6 mt-1">
                            <label>@lang('Name')</label>
                            <input class="form-control" type="text" name="name" value="{{ $user->name }}" required>
                        </div>
                        <div class="form-group col-md-6 mt-1">
                            <label>@lang('Email')</label>
                            <input class="form-control" type="email" name="email" value="{{ $user->email }}" required>
                        </div>
                        <div class="form-group col-md-6 mt-1">
                            <label>@lang('Phone')</label>
                            <input class="form-control" type="text" name="phone" value="{{ $user->phone }}" >
                        </div>
                        <div class="form-group col-md-6 mt-1">
                            <label>@lang('Country')</label>
                            <input class="form-control" type="text" name="country" value="{{ $user->country }}" >
                        </div>
                        <div class="form-group col-md-6 mt-1">
                            <label>@lang('City')</label>
                            <input class="form-control" type="text" name="city" value="{{ $user->city }}">
                        </div>
                        <div class="form-group col-md-6 mt-1">
                            <label>@lang('Zip')</label>
                            <input class="form-control" type="text" name="zip" value="{{ $user->zip }}">
                        </div>
                        <div class="form-group col-md-12">
                            <label>@lang('Address')</label>
                            <input class="form-control" type="text" name="address" value="{{ $user->address }}">
                        </div>
                        <div class="form-group my-3 col-md-6 mt-1">
                            <label class="cswitch d-flex justify-content-between align-items-center border p-2 rounded-lg">
                                <input class="cswitch--input" name="status" type="checkbox"
                                    {{ $user->status == 1 ? 'checked' : '' }} /><span
                                    class="cswitch--trigger wrapper"></span>
                                <span class="cswitch--label font-weight-bold">@lang('User status')</span>
                            </label>
                        </div>
                        <div class="form-group my-3 col-md-6 mt-1 ">
                            <label class="cswitch d-flex justify-content-between align-items-center border p-2 rounded-lg">
                                <input class="cswitch--input update" name="email_verified" type="checkbox"
                                    {{ $user->email_verified == 1 ? 'checked' : '' }} /><span
                                    class="cswitch--trigger wrapper"></span>
                                <span class="cswitch--label font-weight-bold">@lang('Email Verified')</span>
                            </label>
                        </div>


                        <div class="form-group col-md-12 text-right mt-5">
                            <button type="submit" class="btn btn-primary btn-lg">@lang('Submit')</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-lg-6 col-12">
            <div class="card">
                <div class="card-body">
                    <label class="font-weight-bold">@lang('Profile Picture')</label>
                    <div id="image-preview" class="image-preview u_details w-100 min-w-100"
                        style="background-image:url({{ getPhoto($user->photo) }});">
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item active">
                            <h5>@lang('Information')</h5>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">@lang('Total Campaign')
                            <span>{{ $user->campaigns()->count() }} {{ $gs->curr_code }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">@lang('Total Withdraw')
                            <span>{{ showAdminAmount($user->total_withdraw) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">@lang('Current Balance')
                            <span>{{ showAdminAmount($user->balance) }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>@lang('Recent Donations')</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>@lang('Campaign Name')</th>
                                <th>@lang('Total')</th>
                                <th>@lang('Campaign Owner')</th>
                                <th>@lang('Donar Name')</th>
                                <th class="text-right">@lang('Action')</th>
                            </tr>
                            @forelse ($user->donations->take(5) as $item)
                                <tr>
                                    <td data-label="@lang('Campaign Name')">
                                        <a
                                            href="{{ route('admin.campaign.edit', $item->campaign->id) }}">{{ $item->campaign->title }}</a>
                                    </td>
                                    <td data-label="@lang('Total')">
                                        {{ showAdminAmount($item->total) }}
                                    </td>

                                    <td data-label="@lang('Raised')">
                                        <a href="">
                                            <strong>
                                                {{ $item->owner_id ? $item->owner->username : __('Admin') }}
                                            </strong>
                                        </a>
                                    </td>

                                    <td data-label="@lang('Donor Name')">
                                        {{ $item->name ?? 'N/A' }}
                                    </td>

                                    <td data-label="@lang('Action')" class="text-right">
                                        <a href="{{ route('admin.campaign.edit', $item->id) }}"
                                            class="btn btn-primary btn-sm  mb-1" data-toggle="tooltip"
                                            title="@lang('Edit')">@lang('Detail')</a>
                                    </td>
                                </tr>
                            @empty

                                <tr>
                                    <td class="text-center" colspan="100%">@lang('No Data Found')</td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>@lang('Recent Campaigns')</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>@lang('Photo')</th>
                                <th>@lang('Title')</th>
                                <th>@lang('Goal')</th>
                                <th>@lang('Status')</th>

                            </tr>
                            @forelse ($user->campaigns->take(5) as $item)
                                <tr>
                                    <td data-label="@lang('Photo')">
                                        <img src="{{ getPhoto($item->photo) }}" height="85" width="80"
                                            alt="icon">
                                    </td>
                                    <td data-label="@lang('Title')">
                                        <a href="{{ route('admin.campaign.edit', $item->id) }}"> {{ $item->title }}</a>
                                    </td>
                                    <td data-label="@lang('Goal')">
                                        {{ showAdminAmount($item->goal) }}
                                    </td>

                                    <td data-label="@lang('Status')">
                                        @if ($item->status == 1)
                                            <span class="badge badge-success"> @lang('Running') </span>
                                        @elseif($item->status == 2)
                                            <span class="badge badge-danger"> @lang('Closed') </span>
                                        @else
                                            <span class="badge badge-warning"> @lang('Pending') </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty

                                <tr>
                                    <td class="text-center" colspan="100%">@lang('No Data Found')</td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
@endsection
@push('script')
    <script>
        'use strict';
        $.uploadPreview({
            input_field: "#image-upload", // Default: .image-upload
            preview_box: "#image-preview", // Default: .image-preview
            label_field: "#image-label", // Default: .image-label
            label_default: "@lang('Choose File')", // Default: Choose File
            label_selected: "@lang('Update Image')", // Default: Change File
            no_label: false, // Default: false
            success_callback: null // Default: null
        });
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endpush

@push('style')
    <style>
        .bg-sec {
            background-color: #cdd3d83c
        }

        .u_details {
            height: 370px !important;
        }
    </style>
@endpush
