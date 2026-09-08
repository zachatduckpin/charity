@extends('layouts.admin')

@section('title')
    @lang('Brand')
@endsection

@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Brand')</h1>
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
                <div class="table-responsivee p-3">
                    <table class="table table-striped">
                        <tr>
                            <th class="w-200">@lang('Photo')</th>
                            <th class="text-right">@lang('Action')</th>
                        </tr>
                        @forelse ($brands as $item)
                            <tr>

                                <td class="py-1 w-200" data-label="@lang('Photo')">
                                    <img src="{{ getPhoto($item->photo) }}" class="img-fluid max-w-150" alt="">
                                </td>

                                <td class="py-1" data-label="@lang('Action')" class="text-right">
                                    <div class="d-flex justify-content-end">
                                        <a href="javascript:void()" class="btn btn-primary approve btn-sm edit  mr-2"
                                            data-route="{{ route('admin.brand.update', $item->id) }}"
                                            data-path="{{ adminpath() }}" data-item="{{ $item }}"
                                            data-toggle="tooltip" title="@lang('Edit')"><i class="fas fa-edit"></i></a>
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
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.brand.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('Add new Brand')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Brand Photo')</label>
                            <div class="form-group d-flex justify-content-center">
                                <div id="image-preview" class="image-preview image-preview_alt" style="">
                                    <label for="image-upload" id="image-label">@lang('Choose File')</label>
                                    <input type="file" name="photo" id="image-upload" />
                                </div>
                            </div>
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
                        <h5 class="modal-title">@lang('Edit Brand')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Brand Photo')</label>
                            <div class="form-group d-flex justify-content-center">
                                <div id="image-preview1" class="image-preview image-preview_alt" style="">
                                    <label for="image-upload1" id="image-label1">@lang('Choose File')</label>
                                    <input type="file" name="photo" id="image-upload1" />
                                </div>
                            </div>
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
            <form action="{{ route('admin.brand.destroy') }}" method="POST">
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
            input_field: "#image-upload",
            preview_box: "#image-preview",
            label_field: "#image-label",
            label_default: "{{ __('Choose File') }}",
            label_selected: "{{ __('Update Image') }}",
            no_label: false,
            success_callback: null
        });
        $.uploadPreview({
            input_field: "#image-upload1",
            preview_box: "#image-preview1",
            label_field: "#image-label1",
            label_default: "{{ __('Choose File') }}",
            label_selected: "{{ __('Update Image') }}",
            no_label: false,
            success_callback: null
        });

        $('.edit').on('click', function() {
            var data = $(this).data('item');
            $('#edit').find('form').attr('action', $(this).data('route'));
            let path = $(this).attr('data-path');
            $('#edit').find('#image-preview1').css('background-image', `url('${path}/${data.photo}')`);
            $('#edit').modal('show');
        })

        $('.remove').on('click', function() {
            $('#removeMod').find('input[name=id]').val($(this).data('id'))
            $('#removeMod').modal('show')
        })
    </script>
@endpush
