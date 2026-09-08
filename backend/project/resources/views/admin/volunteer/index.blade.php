@extends('layouts.admin')

@section('title')
    @lang('Manage Volunteers')
@endsection

@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Manage Volunteers')</h1>
        </div>
    </section>
@endsection
@section('content')
    <!-- Row -->
    <div class="row">
        <div class="col-lg-12">


            <div class="card">
                <div class="card-body text-center">
                    <p class="mb-2">@lang('Volunteer Background') <small>
                            (@lang('recommended size (620x580)'))
                        </small></p>
                    <form action="{{ route('admin.gs.update') }}" enctype="multipart/form-data" method="POST">
                        @csrf

                        <div class="col-md-12 ShowImage mb-3  text-center">
                            <label for="image">
                                <img src="{{ getPhoto($gs->volunteers_background) }}" class="img-fluid" alt="image"
                                    width="200">
                            </label>
                            <input type="file" class="d-none" id="image" name="volunteers_background">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    </form>
                </div>
            </div>


            <div class="card mb-4">
                <div class="card-header d-flex justify-content-end">
                    <a href="{{ route('admin.volunteer.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>
                        @lang('Add New')</a>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-striped">

                        <tr>
                            <th>{{ __('Photo') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Designation') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th class="text-right">{{ __('Action') }}</th>
                        </tr>

                        @forelse ($volunteers as $item)
                            <tr>

                                <td class="py-1" data-label="{{ __('Photo') }}">
                                    <img class="thmub-100-66" src="{{ getPhoto($item->photo) }}" alt="" width="100">
                                </td>
                                <td class="py-1" data-label="{{ __('Name') }}">
                                    {{ $item->name }}
                                </td>
                                <td class="py-1" data-label="{{ __('Designation') }}">
                                    {{ $item->designation }}
                                </td>

                                <td class="py-1" data-label="@lang('Feature')">
                                    <div class="btn-group mb-2">
                                        <button
                                            class="btn btn-{{ $item->status == 1 ? 'success' : 'danger' }} btn-sm dropdown-toggle"
                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            @if ($item->status == 1)
                                                @lang('Active')
                                            @else
                                                @lang('Inactive')
                                            @endif
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start"
                                            style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item"
                                                href="{{ route('admin.volunteer.status', [$item->id, 1]) }}">@lang('Active')</a>
                                            <a class="dropdown-item"
                                                href="{{ route('admin.volunteer.status', [$item->id, 0]) }}">@lang('Inactive')</a>
                                        </div>
                                    </div>
                                </td>

                                <td class="py-1" data-label="{{ __('Action') }}">
                                    <div class="d-flex gap-10 justify-content-end">
                                        <a href="{{ route('admin.volunteer.edit', $item->id) }}"
                                            class="btn btn-primary  btn-sm edit mb-1" data-toggle="tooltip"
                                            title="@lang('Edit')"><i class="fas fa-edit"></i></a>

                                        <a href="javascript:void(0)" class="btn btn-danger  btn-sm remove mb-1"
                                            data-id="{{ $item->id }}" data-toggle="tooltip"
                                            title="@lang('Delete')"><i class="fas fa-trash"></i></a>
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
                @if ($volunteers->hasPages())
                    {{ $volunteers->links('admin.partials.paginate') }}
                @endif
            </div>
        </div>
        <!-- DataTable with Hover -->

    </div>
    <!--Row-->



    <!-- Modal -->
    <div class="modal fade" id="del" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.volunteer.destroy') }}" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-body">
                        <h5 class="mt-3">@lang('Are you sure to remove?')</h5>
                    </div>
                    <input type="hidden" name="id">
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
            var route = $(this).data('route')
            $('#del').find('input[name=id]').val($(this).data('id'))
            $('#del').modal('show')
        })
    </script>
@endpush