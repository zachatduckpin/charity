@extends('layouts.admin')
@section('title')
    @lang('Admin Dashboard')
@endsection
@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Dashboard')</h1>
        </div>
    </section>
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-bullhorn"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>@lang('Total Campaign')</h4>
                    </div>
                    <div class="card-body d-flex justify-content-between">
                        {{ $total_campaign }}
                        <a href="{{ route('admin.campaign.index') }}">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-envelope-open-text"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>@lang('Total Donations')</h4>
                    </div>
                    <div class="card-body d-flex justify-content-between">
                        {{ $total_donations }}
                        <a href="{{ route('admin.donation.index') }}"><i class="fas fa-eye"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>@lang('Total Users')</h4>
                    </div>
                    <div class="card-body d-flex justify-content-between">
                        {{ $total_users }}
                        <a href="{{ route('admin.user.index') }}"><i class="fas fa-eye"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>@lang('Total Events')</h4>
                    </div>
                    <div class="card-body d-flex justify-content-between">
                        {{ $total_events }}
                        <a href="{{ route('admin.event.index') }}"><i class="fas fa-eye"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4>
                        @lang('Donation Statistics')
                    </h4>
                </div>
                <div class="card-body">
                    <canvas id="myChart2"></canvas>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4>
                        @lang('Withdraw Statistics')
                    </h4>
                </div>
                <div class="card-body">
                    <canvas id="myChart3"></canvas>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-12">
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
                                <th class="text-right">@lang('Status')</th>

                            </tr>
                            @forelse ($recent_campaigns as $item)
                                <tr>
                                    <td class="py-1" data-label="@lang('Photo')">
                                        <img src="{{ getPhoto($item->photo) }}" height="85" width="80" alt="icon"
                                            class="chv1-dash-rc-img thmub-80 ">
                                    </td>
                                    <td class="py-1" data-label="@lang('Title')">
                                        <a href="{{ route('admin.campaign.edit', $item->id) }}"> {{ $item->title }}</a>
                                    </td>
                                    <td class="py-1" data-label="@lang('Goal')">
                                        {{ showAdminAmount($item->goal) }}
                                    </td>

                                    <td class="py-1" data-label="@lang('Status')">
                                        <div class="d-flex justify-content-end">

                                            @if ($item->status == 1)
                                                <span class="badge badge-success"> @lang('Running') </span>
                                            @elseif($item->status == 2)
                                                <span class="badge badge-danger"> @lang('Closed') </span>
                                            @else
                                                <span class="badge badge-warning"> @lang('Pending') </span>
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
            </div>
        </div>

        <div class="col-12 col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4>@lang('Recent Donations')</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>@lang('Campaign Name')</th>
                                <th>@lang('Campaign Owner')</th>
                                <th>@lang('Donar Name')</th>
                                <th>@lang('Total')</th>
                                <th class="text-right">@lang('Action')</th>
                            </tr>
                            @forelse ($recent_donations as $item)
                                <tr>
                                    <td class="py-3" data-label="@lang('Campaign Name')">
                                        <a
                                            href="{{ $item->campaign->id ? route('admin.campaign.edit', $item->campaign->id) : 'javascriipt:;' }}">{{ $item->campaign->title }}</a>
                                    </td>
                                  

                                    <td data-label="@lang('Raised')">
                                        <a href="">

                                            {{ $item->owner_id ? $item->owner->username : __('Admin') }}

                                        </a>
                                    </td>

                                    <td data-label="@lang('Donor Name')">
                                        {{ $item->name ?? 'N/A' }}
                                    </td>
                                    <td data-label="@lang('Total')">
                                        {{ showAdminAmount($item->total) }}
                                    </td>
                                    <td data-label="@lang('Action')" class="text-right">
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm remove mb-1"
                                            data-id="{{ $item->id }}" data-toggle="tooltip"
                                            title="@lang('Remove')"><i class="fas fa-trash"></i></a>
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

        <div class="col-12 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4>@lang('Recent Customers')</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>@lang('Sl')</th>
                                <th>@lang('Name')</th>
                                <th>@lang('Email')</th>
                                <th class="text-right">@lang('Action')</th>
                            </tr>
                            @forelse ($recent_users as $key => $user)
                                <tr>
                                    <td data-label="@lang('Sl')">{{ $key + 1 }}</td>

                                    <td class="py-3" data-label="@lang('Name')">
                                        {{ $user->name }}
                                    </td>
                                    <td data-label="@lang('Email')">{{ $user->email }}</td>

                                    <td data-label="@lang('Action')">
                                        <div class="d-flex justify-content-end">
                                            <a class="btn btn-primary details"
                                                href="{{ route('admin.user.details', $user->id) }}">@lang('Details')</a>
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
            </div>
        </div>

        <div class="col-12 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4>@lang('Recent Contact Messages')</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table">
                            <thead>
                                <tr>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Email')</th>
                                    <th class="text-right">@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recent_messages as $item)
                                    <tr>
                                        <td class="py-3" data-label="@lang('Name')">
                                            {{ $item->name }}
                                        </td>
                                        <td data-label="@lang('Email')">
                                            {{ $item->email ?? 'N/A' }}
                                        </td>

                                        <td data-label="@lang('Action')" class="text-right">
                                            <div class="d-flex justify-content-end gap-2">
                                                <a href="javascript:void(0)" class="btn btn-danger btn-sm remove mr-2"
                                                    data-id="{{ $item->id }}" data-toggle="tooltip"
                                                    title="@lang('Remove')"><i class="fas fa-trash"></i></a>
                                                <a href="javascript:void()" class="btn btn-primary btn-sm view"
                                                    data-message="{{ $item->message }}"
                                                    data-subject=" {{ $item->subject }}" data-toggle="tooltip"
                                                    title="@lang('View Message')"><i class="fas fa-eye"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="removeMod" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.contact.message.delete') }}" method="POST">
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




    <div class="modal fade" id="view" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title show_subject"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <p id="view_message">

                    </p>

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

        $('.view').on('click', function() {
            $('#view_message').text($(this).data('message'));
            $('.show_subject').text("Subject : " + $(this).data('subject'));
            $('#view').modal('show');
        })


        var canvas = document.getElementById("myChart2");
        var ctx = canvas.getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($donation_date) !!},
                datasets: [{
                    label: 'Donation Statistics',
                    data: {!! json_encode($donation_amount) !!},
                    borderWidth: 2,
                    backgroundColor: '#35BA7D',
                    borderColor: '#35BA7D',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#ffffff',
                    pointRadius: 4
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            drawBorder: false,
                            color: '#f2f2f2',
                        },
                        ticks: {
                            beginAtZero: true,
                            stepSize: 150
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            display: false
                        },
                        gridLines: {
                            display: false
                        }
                    }]
                },
            }
        });







        var canvas1 = document.getElementById("myChart3");
        var ctx1 = canvas1.getContext('2d');
        var myChart = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: {!! json_encode($withdraw_date) !!},
                datasets: [{
                    label: 'Withdraw Statistics',
                    data: {!! json_encode($withdraw_amount) !!},
                    borderWidth: 2,
                    backgroundColor: '#35BA7D',
                    borderColor: '#35BA7D',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#ffffff',
                    pointRadius: 4
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            drawBorder: false,
                            color: '#f2f2f2',
                        },
                        ticks: {
                            beginAtZero: true,
                            stepSize: 150
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            display: false
                        },
                        gridLines: {
                            display: false
                        }
                    }]
                },
            }
        });







        var canvas1 = document.getElementById("myChart3");
        var ctx1 = canvas1.getContext('2d');
        var myChart = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: {!! json_encode($withdraw_date) !!},
                datasets: [{
                    label: 'Withdraw Statistics',
                    data: {!! json_encode($withdraw_amount) !!},
                    borderWidth: 2,
                    backgroundColor: '#6777ef',
                    borderColor: '#6777ef',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#ffffff',
                    pointRadius: 4
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            drawBorder: false,
                            color: '#f2f2f2',
                        },
                        ticks: {
                            beginAtZero: true,
                            stepSize: 150
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            display: false
                        },
                        gridLines: {
                            display: false
                        }
                    }]
                },
            }
        });
    </script>
@endpush
