@extends('layouts.admin')

@section('title')
    @lang('Role')
@endsection

@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Role')</h1>
        </div>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-end">
                    <a href="{{ route('admin.role.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> @lang('Add New')
                    </a>

                </div>
                <div class="table-responsive p-3">
                    <table class="table table-striped">
                        <tr>
                            <th>@lang('Name')</th>
                            <th>@lang('Permission')</th>
                            <th class="text-right">@lang('Action')</th>
                        </tr>
                        @forelse ($roles as $item)
                            <tr>
                                <td data-label="@lang('Name')">
                                    {{ $item->name }}
                                </td>
                                <td data-label="@lang('Permission')">
                                    @if ($item->section)
                                        @foreach (json_decode($item->section) as $permission)
                                            <span class="badge badge-success py-2 my-1"> {{ $permission }} </span>
                                        @endforeach
                                    @endif
                                </td>
                                <td data-label="@lang('Action')" class="text-right">

                                    <div class="d-flex gap-10 justify-content-end">
                                        <a href="{{ route('admin.role.edit', $item->id) }}"
                                            class="btn btn-primary btn-sm mb-1" title="@lang('Edit')"><i
                                                class="fas fa-edit"></i></a>
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
            </div>
        </div>
    </div>



    <div class="modal fade" id="removeMod" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.role.destroy') }}" method="POST">
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
