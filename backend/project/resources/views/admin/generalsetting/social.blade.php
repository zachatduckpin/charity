@extends('layouts.admin')

@section('title')
    @lang('Social Links')
@endsection

@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Social Links')</h1>
        </div>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-end">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
                        <i class="fas fa-plus"></i> @lang('Add New')
                    </button>

                </div>
                <div class="table-responsive p-3">
                    <table class="table table-striped" id="table">
                        <thead>
                            <tr>

                                <th>@lang('Icon')</th>
                                <th>@lang('Name')</th>
                                <th>@lang('Link')</th>
                                <th class="text-right">@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($socails as $item)
                                <tr>
                                    <td class="py-3" data-label="@lang('Icon')">
                                        <i class="{{ $item->icon }}" style="font-size:50px"></i>
                                    </td>
                                    <td data-label="@lang('Name')">
                                        {{ $item->name }}
                                    </td>
                                    <td data-label="@lang('Link')">
                                        {{ $item->link }}
                                    </td>
                                    <td data-label="@lang('Action')" class="text-right">
                                        <div class="d-flex gap-10 justify-content-end">

                                            <a href="javascript:void()" class="btn btn-primary approve btn-sm edit mb-1"
                                                data-route="{{ route('admin.social.update', $item->id) }}"
                                                data-item="{{ $item }}" data-path="{{ adminpath() }}"
                                                data-toggle="tooltip" title="@lang('Edit')"><i
                                                    class="fas fa-edit"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm remove mb-1"
                                                data-id="{{ $item->id }}" data-toggle="tooltip"
                                                title="@lang('Remove')"><i class="fas fa-trash"></i></a>
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

    <!-- Modal -->
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.social.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('Add new Social Link')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group d-flex">
                            <div class="">
                                <button class="btn btn-primary icon-picker" data-icon="far fa-address-card"></button>
                            </div>
                            <div class="flex-grow-1">
                                <div class="form-group mb-1">
                                    <input type="text" class="form-control" id="icon" name="icon" value=""
                                        placeholder="" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>@lang('Name')</label>
                            <input class="form-control " type="text" name="name">
                        </div>
                        <div class="form-group">
                            <label>@lang('Link')</label>
                            <input class="form-control " type="text" name="link">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('Edit Social Link')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group d-flex">
                            <div class="">
                                <button class="btn btn-primary icon-picker" data-icon="far fa-address-card"></button>
                            </div>
                            <div class="flex-grow-1">
                                <div class="form-group mb-1">
                                    <input type="text" class="form-control" id="icon_edit" name="icon"
                                        value="" placeholder="" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>@lang('Name')</label>
                            <input class="form-control " type="text" name="name">
                        </div>
                        <div class="form-group">
                            <label>@lang('Link')</label>
                            <input class="form-control " type="text" name="link">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="removeMod" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.social.destroy') }}" method="POST">
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
        $('#add').on('shown.bs.modal', function(e) {
            $(document).off('focusin.modal');
        });
        $('#edit').on('shown.bs.modal', function(e) {
            $(document).off('focusin.modal');
        });


        $(document).on('click', '.btn-icon', function() {
            $('#icon').val($(this).val());
        });
        $(document).on('click', '.btn-icon', function() {
            $('#icon_edit').val($(this).val());
        });

        $('.edit').on('click', function() {

            var data = $(this).data('item');
            $('.edit_icon').attr('data-icon', data.icon);
            $('.edit_icon').find('i').attr('class', data.icon);
            $('#edit').find('input[name=name]').val(data.name)
            $('#edit').find('input[name=link]').val(data.link)
            $('#edit').find('input[name=icon]').val(data.icon)
            $('#edit').find('form').attr('action', $(this).data('route'))
            $('#edit').modal('show')
        })

        $('.remove').on('click', function() {
            $('#removeMod').find('input[name=id]').val($(this).data('id'))
            $('#removeMod').modal('show')
        })
    </script>
@endpush
