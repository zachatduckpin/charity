@extends('layouts.admin')

@section('title')
    @lang('Manage Event')
@endsection

@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Manage Event')</h1>
        </div>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-end">
                    <a href="{{ route('admin.event.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> @lang('Add New')
                    </a>

                </div>
                <div class="table-responsive p-3">
                    <table class="table table-striped">
                        <tr>
                            <th>@lang('Photo')</th>
                            <th class="min-w-200">@lang('Title')</th>
                            <th>@lang('Type')</th>
                            <th class="min-w-200">@lang('Date & Time')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Action')</th>
                        </tr>
                        @forelse ($events as $item)
                            <tr>
                                <td class="py-1" data-label="@lang('Photo')">
                                    <img src="{{ getPhoto($item->photo) }}" alt="icon" class="img-fluid w-100"
                                       >
                                </td>
                                <td class="py-1 min-w-200" data-label="@lang('Title')">
                                    {{ $item->title }}
                                </td>
                                <td class="py-1" data-label="@lang('Event Type')">
                                    {{ $item->event_type }}
                                </td>

                                <td class="py-1 min-w-200" data-label="@lang('Date & Time')">
                                    {{ $item->date }} / {{ $item->start_time }} - {{ $item->end_time }}
                                </td>

                                <td class="py-1" data-label="@lang('Status')">
                                    @if ($item->status == 1)
                                        <span class="badge badge-success"> @lang('Active') </span>
                                    @else
                                        <span class="badge badge-warning"> @lang('Inactive') </span>
                                    @endif
                                </td>

                                <td class="py-1" data-label="@lang('Action')">
                                    <div class="d-flex">

                                        <a href="{{ route('admin.event.edit', $item->id) }}"
                                            class="btn btn-primary approve btn-sm  mr-2" data-toggle="tooltip"
                                            title="@lang('Edit')"><i class="fas fa-edit"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm remove"
                                            data-id="{{ $item->id }}" data-toggle="tooltip" title="@lang('Remove')"><i
                                                class="fas fa-trash"></i></a>
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
                @if ($events->hasPages())
                    {{ $events->links('admin.partials.paginate') }}
                @endif
            </div>
        </div>
    </div>


    <div class="modal fade" id="removeMod" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.event.destroy') }}" method="POST">
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
