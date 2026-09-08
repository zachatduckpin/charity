@extends('layouts.admin')
@section('title')
    @lang('Withdraws')
@endsection
@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Withdraws')</h1>
        </div>
    </section>
@endsection
@section('content')
    <div class="row">

        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">

                <div class="card-body text-center">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>@lang('User')</th>
                                <th>@lang('Withdraw Amount')</th>
                                <th>@lang('Charge')</th>
                                <th>@lang('Total')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>
                            </tr>
                            @forelse ($withdraws as $key => $item)
                                <tr>

                                    <td data-label="@lang('User')">
                                        <a
                                            href="{{ route('admin.user.details', $item->user->id) }}">{{ $item->user->username }}</a>
                                    </td>

                                    <td data-label="@lang('User')">
                                        {{ showAdminAmount($item->amount) }}
                                    </td>
                                    <td data-label="@lang('User')">
                                        {{ showAdminAmount($item->charge) }}
                                    </td>
                                    <td data-label="@lang('Total')">
                                        {{ showAdminAmount($item->total) }}
                                    </td>


                                    <td data-label="@lang('status')">

                              

                                            @if ($item->status == 1)
                                                <span class="badge badge-success">@lang('Accepted')</span>
                                            @elseif($item->status == 2)
                                                <span class="badge badge-danger">@lang('Rejected')</span>
                                            @else
                                                <span class="badge badge-warning">@lang('Pending')</span>
                                            @endif
                                    

                                    </td>

                                    <td data-label="@lang('Action')">

                                        <div
                                            class="d-flex gap-10 align-items-center justify-content-end justify-content-lg-center">

                                            @if ($item->status == 0)
                                                <button class="btn btn-primary accept m-1 btn-sm"
                                                    data-url="{{ route('admin.withdraw.approve', $item->id) }}">@lang('Accept')</button>
                                                <button class="btn btn-danger reject m-1 btn-sm"
                                                    data-url="{{ route('admin.withdraw.reject', $item->id) }}">@lang('Reject')</button>
                                            @else
                                                @if ($item->status == 1)
                                                    <span class="badge badge-success">
                                                        Accepted
                                                    </span>
                                                @else
                                                    <span class="badge badge-danger">
                                                        Rejected
                                                    </span>
                                                @endif
                                            @endif
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
                </div>
                @if ($withdraws->hasPages())
                    <div class="card-footer">
                        {{ $withdraws->links('admin.partials.paginate') }}
                    </div>
                @endif
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="accept" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">

            <form action="" method="get">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('Withdraw Accept')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <p>@lang('Are you sure to Accept this withdraw request')?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark btn-sm" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-primary btn-sm">@lang('Accept')</button>

                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">

            <form action="" method="get">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('Withdraw Reject')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <p>@lang('Are you sure to Reject this withdraw request')?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark btn-sm" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-danger btn-sm">@lang('Reject')</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@push('script')
    <script>
        $(function() {
            'use strict';

            $('.details').on('click', function() {
                const modal = $('#details');

                let html = `
                
                    <ul class="list-group">
                           
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @lang('Transaction Id')
                                <span>${$(this).data('transaction')}</span>
                            </li>  
                            
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @lang('User Name')
                                <span>${$(this).data('provider')}</span>
                            </li> 
                            
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @lang('Withdraw Method')
                                <span>${$(this).data('method_name')}</span>
                            </li> 
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @lang('Withdraw Date')
                                <span>${$(this).data('date')}</span>
                            </li> 
                        </ul>
                        <hr>
                        <h6>@lang('User Data For Withdraw : ')</h6>
                        <textarea class="form-control" rows="5" disabled>${$(this).data('user_data')}</textarea>
                
                
                `;

                modal.find('.withdraw-details').html(html);
                modal.modal('show');
            })

            $('.accept').on('click', function() {
                const modal = $('#accept');

                modal.find('form').attr('action', $(this).data('url'));
                modal.modal('show');
            })

            $('.reject').on('click', function() {
                const modal = $('#reject');

                modal.find('form').attr('action', $(this).data('url'));
                modal.modal('show');
            })

        })
    </script>
@endpush
