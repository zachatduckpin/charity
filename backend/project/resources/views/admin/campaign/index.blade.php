@extends('layouts.admin')

@section('title')
    @lang('Manage Campaign')
@endsection

@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Manage Campaign')</h1>
        </div>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-end gap-10">


                    <form action="" class="d-flex flex-wrap flex-md-nowrap  justify-content-start mr-md-4">
                        <div class="form-group  m-1 flex-grow-1">
                            <select class="form-control" onChange="window.location.href=this.value">
                                <option value="{{ filter('type', '') }}">@lang('All Campaigns')</option>

                                <option value="{{ filter('type', 'pending') }}"
                                    {{ request('type') == 'pending' ? 'selected' : '' }}>@lang('Pending Campaigns')</option>

                                <option value="{{ filter('type', 'running') }}"
                                    {{ request('type') == 'running' ? 'selected' : '' }}>@lang('Completed Campaigns')</option>

                                <option value="{{ filter('type', 'closed') }}"
                                    {{ request('type') == 'closed' ? 'selected' : '' }}>
                                    @lang('Rejected Campaigns')</option>
                            </select>
                        </div>


                        <div class="form-group m-1 flex-grow-1">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-search-input mr-2 " name="search"
                                    value="{{ request()->input('search') }}" placeholder="@lang('Campaign Title')">
                                <div class="input-group-append">
                                    <button class="input-group-text btn btn-primary text-white form-control-search-input-btn" id="my-addon"><i
                                            class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>




                    <a href="{{ route('admin.campaign.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> @lang('Add New')
                    </a>

                </div>
                <div class="table-responsive p-3">
                    <table class="table table-striped">
                        <tr>
                            <th>@lang('Photo')</th>
                            <th class="min-w-200">@lang('Title')</th>
                            <th>@lang('Goal/Raised')</th>
                            <th>@lang('From')</th>
                            <th>@lang('Feature')</th>
                            <th>@lang('Status')</th>

                            <th class="text-right">@lang('Action')</th>
                        </tr>
                        @forelse ($campaigns as $item)
                            <tr>
                                <td class="py-1" data-label="@lang('Photo')">
                                    <img src="{{ getPhoto($item->photo) }}" alt="icon" class="img-fluid w-100">
                                </td>
                                <td class="min-w-200" class="py-1 " data-label="@lang('Title')">
                                    {{ $item->title }}

                                </td>
                                <td data-label="@lang('Goal')">
                                    {{ showAdminAmount($item->goal) }} / {{ showAdminAmount($item->raised) }}
                                </td>


                                <td>
                                    @if ($item->user_id == 0)
                                        @lang('Admin')
                                    @else
                                        {{ $item->user->username }}
                                    @endif
                                </td>

                                <td class="py-1" data-label="@lang('Feature')">
                                    <div class="btn-group mb-2">
                                        <button
                                            class="btn btn-{{ $item->is_feature == 1 ? 'success' : 'danger' }} btn-sm dropdown-toggle"
                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            @if ($item->is_feature == 1)
                                                @lang('Yes')
                                            @else
                                                @lang('No')
                                            @endif
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start"
                                            style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item"
                                                href="{{ route('admin.campaign.status', [$item->id, 1, 'feature']) }}">Yes</a>
                                            <a class="dropdown-item"
                                                href="{{ route('admin.campaign.status', [$item->id, 0, 'feature']) }}">No</a>
                                        </div>
                                    </div>
                                </td>




                                <td class="py-1" data-label="@lang('Feature')">
                                    @php
                                        if ($item->status == 1) {
                                            $status = 'success';
                                        } elseif ($item->status == 2) {
                                            $status = 'danger';
                                        } else {
                                            $status = 'warning';
                                        }
                                    @endphp
                                    <div class="btn-group mb-2">
                                        <button class="btn btn-{{ $status }} btn-sm dropdown-toggle" type="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            @if ($item->status == 1)
                                                @lang('Running')
                                            @elseif($item->status == 2)
                                                @lang('Closed')
                                            @else
                                                @lang('Pending')
                                            @endif

                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start"
                                            style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item"
                                                href="{{ route('admin.campaign.status', [$item->id, 1, 'status']) }}">@lang('Running')</a>
                                            <a class="dropdown-item"
                                                href="{{ route('admin.campaign.status', [$item->id, 2, 'status']) }}">@lang('Closed')</a>
                                            <a class="dropdown-item"
                                                href="{{ route('admin.campaign.status', [$item->id, 0, 'status']) }}">@lang('Pending')</a>
                                        </div>
                                    </div>
                                </td>





                                <td class="py-1" data-label="@lang('Action')" class="text-right">
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('admin.campaign.edit', $item->id) }}"
                                            class="btn btn-primary approve btn-sm  mr-2" data-toggle="tooltip"
                                            title="@lang('Edit')"><i class="fas fa-edit"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm remove"
                                            data-id="{{ $item->id }}" data-toggle="tooltip"
                                            title="@lang('Remove')"><i class="fas fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @empty

                            <tr>
                                <td class="text-center" colspan="100%">@lang('No Data Found')</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
                @if ($campaigns->hasPages())
                    {{ $campaigns->appends(['type' => request()->input('type')])->links('admin.partials.paginate') }}
                @endif
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="removeMod" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.campaign.destroy') }}" method="POST">
                @method('DELETE')
                @csrf
                <input type="hidden" name="id">
                <div class="modal-content">
                    <div class="modal-body">
                        <h5>@lang('Are you sure to remove?')</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-danger">@lang('Confirm')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script>
        'use strict';
        $('.remove').on('click', function() {
            $('#removeMod').find('input[name=id]').val($(this).data('id'))
            $('#removeMod').modal('show')
        })
    </script>
@endpush
