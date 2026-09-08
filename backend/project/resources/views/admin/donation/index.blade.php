@extends('layouts.admin')

@section('title')
    @lang('Manage Donations')
@endsection

@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Manage Donations')</h1>
        </div>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-end">
                    <form action="" class="d-flex flex-wrap justify-content-start">
                        <div class="form-group m-1 flex-grow-1">
                            <div class="input-group align-items-center">
                                <input type="text" class="form-control py-3 mr-2 form-control-search-input"
                                    name="txn_id" value="{{ request()->input('txn_id') }}" placeholder="@lang('Txn ID')">
                                <div class="input-group-append">
                                    <button
                                        class="input-group-text btn btn-primary text-white form-control-search-input-btn"
                                        id="my-addon"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive p-3">
                    <table class="table table-striped">
                        <tr>
                            <th>@lang('Campaign Name')</th>
                            <th>@lang('Campaign Owner')</th>
                            <th>@lang('Tips')</th>
                            <th>@lang('Total')</th>
                            <th class="text-right">@lang('Status')</th>
                            <th class="text-right">@lang('Action')</th>
                        </tr>
                        @forelse ($donations as $item)
                            <tr>
                                <td class="py-3" data-label="@lang('Campaign Name')">
                                    <a
                                        href="{{ $item->campaign->id ? route('admin.campaign.edit', $item->campaign->id) : 'javascriipt:;' }}">{{ $item->campaign->title }}</a>
                                </td>
                                <td data-label="@lang('Raised')">
                                    {{ $item->owner_id ? $item->owner->username : __('Admin') }}

                                </td>

                                <td data-label="@lang('Total')">
                                    {{ showAdminAmount($item->total) }}
                                </td>
                                <td data-label="@lang('Tips')">
                                    {{ showAdminAmount($item->tips) ?? 'N/A' }}
                                </td>



                                <td class="text-right" data-label="@lang('Feature')">
                                    <div class="btn-group mb-2">
                                        <button
                                            class="btn btn-{{ $item->status == 1 ? 'success' : 'danger' }} btn-sm dropdown-toggle"
                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            @if ($item->status == 1)
                                                @lang('Yes')
                                            @else
                                                @lang('No')
                                            @endif
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start"
                                            style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item"
                                                href="{{ route('admin.donation.status', [$item->id, 1]) }}">Yes</a>
                                            <a class="dropdown-item"
                                                href="{{ route('admin.donation.status', [$item->id, 0]) }}">No</a>
                                        </div>
                                    </div>
                                </td>

                                <td data-label="@lang('Action')" class="text-right">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="javascript:void(0)" class="btn btn-primary btn-sm view_donation mx-2 mb-1"
                                            data-id="{{ $item->id }}" data-txn="{{ $item->txn_id ?? 'N/A' }}"
                                            data-donar=" {{ $item->name ?? 'Anonymous' }}" data-toggle="tooltip"
                                            data-method="{{ $item->payment_method ?? 'N/A' }}" data-toggle="tooltip"><i
                                                class="fas fa-eye"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm remove mb-1"
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

                @if ($donations->hasPages())
                    {{ $donations->links('admin.partials.paginate') }}
                @endif
            </div>
        </div>
    </div>


    <div class="modal fade" id="removeMod" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.donation.destroy') }}" method="POST">
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


    <div class="modal fade" id="view_donation" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title show_subject">@lang('Donation Details')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>@lang('Donar Name'):</strong> <span class="show_donar"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>@lang('Transaction ID'):</strong> <span class="show_txn"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>@lang('Payment Method'):</strong> <span class="show_method"></span>

                        </li>

                    </ul>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
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


        $('.view_donation').on('click', function() {
            $('.show_method').text($(this).data('method'))
            $('.show_donar').text($(this).data('donar'))
            $('.show_txn').text($(this).data('txn'))
            $('#view_donation').modal('show');
        })
    </script>
@endpush
