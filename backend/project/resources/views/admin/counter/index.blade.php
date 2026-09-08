@extends('layouts.admin')

@section('title')
    @lang('Counter Section')
@endsection

@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Counter Section')</h1>
        </div>
    </section>
@endsection

@section('content')
    <div class="row">
        @if ($gs->theme == 'theme4')
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body text-center">
                        <p class="mb-2">@lang('Counter Background') <small>
                                (@lang('recommended size (1920x672)'))
                            </small></p>
                        <form action="{{ route('admin.gs.update') }}" enctype="multipart/form-data" method="POST">
                            @csrf

                            <div class="col-md-12 ShowImage mb-3  text-center">
                                <label for="image">
                                    <img src="{{ getPhoto($gs->counter_background) }}" class="img-fluid" alt="image"
                                        width="400">
                                </label>
                                <input type="file" class="d-none" id="image" name="counter_background">
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        @endif

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
                                <th>@lang('Title')</th>
                                <th>@lang('Counter Number')</th>
                                <th class="text-right">@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($counters as $item)
                                <tr>
                                    <td data-label="@lang('Icon')">
                                        <i class="{{ $item->icon }}" style="font-size:50px"></i>
                                    </td>
                                    <td data-label="@lang('Title')">
                                        {{ $item->title }}
                                    </td>
                                    <td data-label="@lang('Title')">
                                        {{ $item->counter_number }}
                                    </td>
                                    <td data-label="@lang('Action')" class="text-right">
                                        <a href="javascript:void()" class="btn btn-primary approve btn-sm edit mx-2 mb-1"
                                            data-route="{{ route('admin.counter.update', $item->id) }}"
                                            data-item="{{ $item }}" data-toggle="tooltip"
                                            title="@lang('Edit')"><i class="fas fa-edit"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm remove mb-1"
                                            data-id="{{ $item->id }}" data-toggle="tooltip"
                                            title="@lang('Remove')"><i class="fas fa-trash"></i></a>
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
            <form action="{{ route('admin.counter.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('Add new Counter')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Name')</label>
                            <input class="form-control slug-title" type="text" name="title">
                        </div>
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
                            <label>@lang('Counter Number')</label>
                            <input class="form-control slug-title" type="number" name="counter_number">
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
                        <h5 class="modal-title">@lang('Edit Counter')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Name')</label>
                            <input class="form-control slug-title" type="text" name="title">
                        </div>
                        <div class="form-group d-flex align-items-center">
                            <div class="">
                                <button class="py-2 btn btn-primary icon-picker edit_icon" data-icon="">
                                    <i class=""></i>
                                </button>
                            </div>
                            <div class="flex-grow-1">
                                <div class="form-group mb-0">
                                    <input type="text" class="form-control" id="icon_edit" name="icon"
                                        value="" placeholder="" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>@lang('Counter Number')</label>
                            <input class="form-control slug-title" type="number" name="counter_number">
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
            <form action="{{ route('admin.counter.destroy') }}" method="POST">
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
        $.uploadPreview({
            input_field: "#image-upload", // Default: .image-upload
            preview_box: "#image-preview", // Default: .image-preview
            label_field: "#image-label", // Default: .image-label
            label_default: "{{ __('Choose File') }}", // Default: Choose File
            label_selected: "{{ __('Update Image') }}", // Default: Change File
            no_label: false, // Default: false
            success_callback: null // Default: null
        });

        $('.icon-picker').iconpicker();
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
            $('#edit').find('input[name=title]').val(data.title)
            $('#edit').find('input[name=counter_number]').val(data.counter_number)
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
