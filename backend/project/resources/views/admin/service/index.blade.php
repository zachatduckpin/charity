@extends('layouts.admin')

@section('title')
    @lang('Services')
@endsection

@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Services')</h1>
        </div>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-end">
                    <a href="{{ route('admin.service.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> @lang('Add New')
                    </a>

                </div>
                <div class="table-responsive p-3">
                    <table class="table table-striped">
                        <tr>
                            <th>@lang('Title')</th>
                            <th>@lang('Photo')</th>
                            <th>@lang('Feature')</th>
                            <th>@lang('Status')</th>
                            <th class="text-right">@lang('Action')</th>
                        </tr>
                        @forelse ($services as $item)
                            <tr>

                                <td data-label="@lang('Title')">
                                    {{ $item->title }}
                                </td>
                               
                                <td data-label="@lang('Icon')">
                                    <img src="{{ getPhoto($item->photo) }}" alt="icon" class="img-fluid"
                                        style="width: 50px">
                                </td>

                                <td data-label="@lang('Feature')">
                                    @if ($item->is_feature == 1)
                                        <span class="badge badge-success"> @lang('Yes') </span>
                                    @else
                                        <span class="badge badge-warning"> @lang('No') </span>
                                    @endif
                                </td>
                                <td data-label="@lang('Status')">
                                    @if ($item->status == 1)
                                        <span class="badge badge-success"> @lang('Active') </span>
                                    @else
                                        <span class="badge badge-warning"> @lang('Inactive') </span>
                                    @endif
                                </td>
                                <td data-label="@lang('Action')" class="text-right">
                                    <a href="{{ route('admin.service.edit', $item->id) }}"
                                        class="btn btn-primary approve btn-sm  mb-1" data-toggle="tooltip"
                                        title="@lang('Edit')"><i class="fas fa-edit"></i></a>
                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm remove mb-1"
                                        data-id="{{ $item->id }}" data-toggle="tooltip" title="@lang('Remove')"><i
                                            class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        @empty

                            <tr>
                                <td class="text-center" colspan="100%">@lang('No Data Found')</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
                <div class="d-flex mr-3 justify-content-end">
                    {{ $services->links() }}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.service.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('Add new service')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Feature Photo')</label>
                            <div class="form-group d-flex justify-content-center">
                                <div id="image-preview" class="image-preview image-preview_alt" style="">
                                    <label for="image-upload" id="image-label">@lang('Choose File')</label>
                                    <input type="file" name="photo" id="image-upload" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>@lang('Title')</label>
                            <input class="form-control" type="text" name="title">
                        </div>
                        <div class="form-group">
                            <label>@lang('Text')</label>
                            <textarea class="form-control" name="text" rows="5"></textarea>
                        </div>

                        <div class="form-group">
                            <label>@lang('Status')</label>
                            <select name="status" class="form-control">
                                <option value="1">@lang('Active')</option>
                                <option value="0">@lang('Inactive')</option>
                            </select>
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
                        <h5 class="modal-title">@lang('Edit service')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Feature Photo')</label>
                            <div class="form-group d-flex justify-content-center">
                                <div id="image-preview1" class="image-preview image-preview_alt" style="">
                                    <label for="image-upload1" id="image-label1">@lang('Choose File')</label>
                                    <input type="file" name="photo" id="image-upload1" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>@lang('Title')</label>
                            <input class="form-control" type="text" name="title">
                        </div>
                        <div class="form-group">
                            <label>@lang('Text')</label>
                            <textarea class="form-control" name="text" rows="5"></textarea>
                        </div>

                        <div class="form-group">
                            <label>@lang('Status')</label>
                            <select name="status" class="form-control">
                                <option value="1">@lang('Active')</option>
                                <option value="0">@lang('Inactive')</option>
                            </select>
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
            <form action="{{ route('admin.service.destroy') }}" method="POST">
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

        $('#add').on('shown.bs.modal', function(e) {
            $(document).off('focusin.modal');
        });
        $('#edit').on('shown.bs.modal', function(e) {
            $(document).off('focusin.modal');
        });

        $('.edit').on('click', function() {
            var data = $(this).data('item')
            $('#edit').find('input[name=icon]').val(data.icon)
            $('#edit').find('input[name=title]').val(data.title)
            $('#edit').find('textarea[name=text]').val(data.text)
            $('#edit').find('select[name=status]').val(data.status)
            $('#edit').find('form').attr('action', $(this).data('route'))
            let path = $(this).attr('data-path');
            $('#edit').find('#image-preview1').css('background-image', `url('${path}/${data.photo}')`);
            $('#edit').modal('show')
        })

        $('.remove').on('click', function() {
            $('#removeMod').find('input[name=id]').val($(this).data('id'))
            $('#removeMod').modal('show')
        })
    </script>
@endpush
