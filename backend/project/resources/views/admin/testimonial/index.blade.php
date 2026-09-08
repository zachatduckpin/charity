@extends('layouts.admin')

@section('title')
    @lang('Testimonial')
@endsection

@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Testimonial')</h1>
        </div>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body text-center">
                    <p class="mb-2">@lang('Testimonial Background') <small>
                            (@lang('recommended size (1920x672)'))
                        </small></p>
                    <form action="{{ route('admin.gs.update') }}" enctype="multipart/form-data" method="POST">
                        @csrf

                        <div class="col-md-12 ShowImage mb-3  text-center">
                            <label for="image">
                                <img src="{{ getPhoto($gs->testimonial_background) }}" class="img-fluid" alt="image"
                                    width="400">
                            </label>
                            <input type="file" class="d-none" id="image" name="testimonial_background">
                        </div>
                        @if ($gs->theme == 'theme4')
                            <input type="hidden" name="testimonial" value="1">
                            <div class="form-group col-md-6 offset-md-3 mb-3">
                                <label for="title">{{ __('Section Title') }}</label>
                                <input type="text" class="form-control" name="testimonial_title" id="testimonial_title"
                                    required placeholder="{{ __('Section Title') }}" value="{{ $gs->testimonial_title }}">
                            </div>
                            <div class="form-group col-md-6 offset-md-3 mb-3">
                                <label for="title">{{ __('Section Description') }}</label>
                                <input type="text" class="form-control" name="testimonial_description"
                                    id="testimonial_description" required placeholder="{{ __('Section Description') }}"
                                    value="{{ $gs->testimonial_description }}">
                            </div>
                        @endif


                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    </form>
                </div>
            </div>


            <div class="card mb-4">
                <div class="card-header d-flex justify-content-end">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
                        <i class="fas fa-plus"></i> @lang('Add New')
                    </button>

                </div>
                <div class="table-responsive p-3">
                    <table class="table table-striped">
                        <tr>
                            <th>@lang('Name')</th>
                            <th>@lang('Photo')</th>
                            <th>@lang('Message')</th>
                            <th width="15%" class="text-right">@lang('Action')</th>
                        </tr>
                        @forelse ($testimonials as $item)
                            <tr>

                                <td data-label="@lang('name')">
                                    {{ $item->name }}
                                </td>

                                <td data-label="@lang('Icon')">
                                    <img src="{{ getPhoto($item->photo) }}" alt="icon" class="img-fluid"
                                        style="width: 50px">
                                </td>
                                <td data-label="@lang('message')">
                                    {{ Str::limit($item->message, 100) }}
                                </td>

                                <td data-label="@lang('Action')" class="text-right">
                                    <div class="d-flex gap-10 justify-content-end">
                                        <a href="javascript:void()" class="btn btn-primary approve btn-sm edit mb-1"
                                            data-route="{{ route('admin.testimonial.update', $item->id) }}"
                                            data-item="{{ $item }}" data-toggle="tooltip"
                                            data-path="{{ adminpath() }}" title="@lang('Edit')"><i
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

    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.testimonial.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('Add new testimonial')</h5>
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
                            <label>@lang('Name')</label>
                            <input class="form-control" type="text" name="name">
                        </div>

                        <div class="form-group">
                            <label>@lang('Message')</label>
                            <textarea class="form-control" name="message" rows="5"></textarea>
                        </div>
                        5
                        @if ($gs->theme == 'theme4')
                            <div class="form-group">
                                <label>@lang('Rating')</label>
                                <input class="form-control" type="number" step="0.1" name="rating">
                            </div>
                        @endif

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
                        <h5 class="modal-title">@lang('Edit Testimonail')</h5>
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
                            <label>@lang('Name')</label>
                            <input class="form-control" type="text" name="name">
                        </div>

                        <div class="form-group">
                            <label>@lang('Message')</label>
                            <textarea class="form-control" name="message" rows="5"></textarea>
                        </div>
                        @if ($gs->theme == 'theme4')
                            <div class="form-group">
                                <label>@lang('Rating')</label>
                                <input class="form-control" type="number" step="0.1" name="rating">
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <div class="modal fade" id="removeMod" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.testimonial.destroy') }}" method="POST">
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
            $('#edit').find('input[name=name]').val(data.name)
            $('#edit').find('input[name=designation]').val(data.designation)
            $('#edit').find('input[name=rating]').val(data.rating)
            $('#edit').find('textarea[name=message]').val(data.message)
            $('#edit').find('input[name=rating]').val(data.rating)
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
