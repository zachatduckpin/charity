@extends('layouts.admin')

@section('title')
    @lang('Service Module')
@endsection

@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Service Module')</h1>
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

                                <th>@lang('Photo')</th>
                                <th>@lang('Service')</th>
                                <th>@lang('Title')</th>
                                <th class="text-right">@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($modules as $item)
                                <tr>

                                    <td data-label="@lang('Photo')">
                                        <img src="{{ getPhoto($item->photo) }}" alt="" width="100">
                                    </td>
                                    <td data-label="@lang('Service')">
                                        {{ $item->service->title }}
                                    </td>
                                    <td data-label="@lang('Title')">
                                        {{ $item->title }}
                                    </td>

                                    <td data-label="@lang('Action')" class="text-right">
                                        <a href="javascript:void()" class="btn btn-primary approve btn-sm edit mb-1"
                                            data-route="{{ route('admin.module.update', $item->id) }}"
                                            data-item="{{ $item }}" data-path="{{adminpath()}}" data-toggle="tooltip"
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
            <form action="{{ route('admin.module.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('Add new module')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Service')</label>
                            <select name="service_id" class="form-control" id="">
                                <option value="">@lang('Select')</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group d-flex justify-content-center">
                            <div id="image-preview" class="image-preview image-preview_alt"
                                style="">
                                <label for="image-upload" id="image-label">@lang('Choose File')</label>
                                <input type="file" name="photo" id="image-upload" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>@lang('Title')</label>
                            <input class="form-control" type="text" name="title">
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
                        <h5 class="modal-title">@lang('Edit Module')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Service')</label>
                            <select name="service_id" class="form-control" id="">
                                <option value="">@lang('Select')</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group d-flex justify-content-center">
                            <div id="image-preview_update" class="image-preview image-preview_alt"
                                style="background-image:url({{ getPhoto('') }});">
                                <label for="image-upload_update" id="image-label_update">@lang('Choose File')</label>
                                <input type="file" name="photo" id="image-upload_update" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>@lang('Title')</label>
                            <input class="form-control" type="text" name="title">
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
            <form action="{{ route('admin.module.destroy') }}" method="POST">
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

        $.uploadPreview({
            input_field: "#image-upload", // Default: .image-upload
            preview_box: "#image-preview", // Default: .image-preview
            label_field: "#image-label", // Default: .image-label
            label_default: "{{ __('Choose File') }}", // Default: Choose File
            label_selected: "{{ __('Update Image') }}", // Default: Change File
            no_label: false, // Default: false
            success_callback: null // Default: null
        });

        $.uploadPreview({
            input_field: "#image-upload_update", // Default: .image-upload
            preview_box: "#image-preview_update", // Default: .image-preview
            label_field: "#image-label_update", // Default: .image-label
            label_default: "{{ __('Choose File') }}", // Default: Choose File
            label_selected: "{{ __('Update Image') }}", // Default: Change File
            no_label: false, // Default: false
            success_callback: null // Default: null
        });

        $('.edit').on('click', function() {
            var data = $(this).data('item')
            let path = $(this).attr('data-path');
            $('#edit').find('#image-preview_update').css('background-image', `url('${path}/${data.photo}')`);
            $('#edit').find('input[name=title]').val(data.title)
            $('#edit').find('select[name=service_id]').val(data.service_id)
            $('#edit').find('form').attr('action', $(this).data('route'))
            $('#edit').modal('show')
        })

        $('.remove').on('click', function() {
            $('#removeMod').find('input[name=id]').val($(this).data('id'))
            $('#removeMod').modal('show')
        })
    </script>
@endpush
