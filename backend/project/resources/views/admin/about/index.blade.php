@extends('layouts.admin')
@section('title')
    @lang('Edit About Section')
@endsection

@section('breadcrumb')
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>@lang('Edit About Section')</h1>
        </div>
    </section>
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">

                    <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="row">
                            <div class="col-sm-6 text-center">
                                <label for="">@lang('Theme 1 About Photo')</label>
                                <div class="form-group d-flex justify-content-center">
                                    <div id="image-preview_about" class="image-preview image-preview_alt"
                                        style="background-image:url({{ getPhoto($about->photo) }});">
                                        <label for="image-upload_about" id="image-label_about">@lang('Choose File')</label>
                                        <input type="file" name="photo" id="image-upload_about" />
                                    </div>
                                </div>
                            </div>



                            <div class="col-sm-6 text-center">
                                <label for="">@lang('Theme 2 About Photo')</label>
                                <div class="form-group d-flex justify-content-center">
                                    <div id="image-preview_about1" class="image-preview image-preview_alt"
                                        style="background-image:url({{ getPhoto($about->photo2) }});">
                                        <label for="image-upload_about1" id="image-label_about1">@lang('Choose File')</label>
                                        <input type="file" name="photo2" id="image-upload_about1" />
                                    </div>
                                </div>
                            </div>


                            @if (checkAddon())
                                <div class="col-sm-6 text-center">
                                    <label for="">@lang('Theme 3 About Photo')</label>
                                    <div class="form-group d-flex justify-content-center">
                                        <div id="image-preview_about3" class="image-preview image-preview_alt"
                                            style="background-image:url({{ getPhoto($about->photo3) }});">
                                            <label for="image-upload_about3"
                                                id="image-label_about3">@lang('Choose File')</label>
                                            <input type="file" name="photo3" id="image-upload_about3" />
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-6 text-center">
                                    <label for="">@lang('Theme 4 About Photo')</label>
                                    <div class="form-group d-flex justify-content-center">
                                        <div id="image-preview_about4" class="image-preview image-preview_alt"
                                            style="background-image:url({{ getPhoto($about->photo4) }});">
                                            <label for="image-upload_about4"
                                                id="image-label_about4">@lang('Choose File')</label>
                                            <input type="file" name="photo4" id="image-upload_about4" />
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>

                        <div class="form-group">
                            <label>@lang('Subtitle')</label>
                            <input class="form-control" type="text" name="header_title"
                                value="{{ $about->header_title }}">
                        </div>
                        <div class="form-group">
                            <label>@lang('Title')</label>
                            <input class="form-control" type="text" name="title" value="{{ $about->title }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('Description')</label>
                            <textarea name="description" class="form-control summernote" rows="4">{{ $about->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>@lang('Youtube Video Id')</label>
                            <input class="form-control" type="text" name="video_id" value="{{ $about->video_id }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('Video Background')</label>
                            <div class="form-group d-flex">
                                <div id="image-preview3" class="image-preview image-preview_alt"
                                    style="background-image:url({{ getPhoto($about->backgroud_photo) }});">
                                    <label for="image-upload3" id="image-label3">@lang('Choose File')</label>
                                    <input type="file" name="backgroud_photo" id="image-upload3" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>@lang('Button Text')</label>
                            <input class="form-control" type="text" name="btn_text" value="{{ $about->btn_text }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('Button Url')</label>
                            <input class="form-control" type="text" name="btn_url" value="{{ $about->btn_url }}">
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between gap-10">
                    <h5>@lang('About Featured')</h5>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
                        <i class="fas fa-plus"></i> @lang('Add New')
                    </button>

                </div>
                <div class="table-responsive p-3">
                    <table class="table table-striped">
                        <tr>
                            <th>@lang('Photo')</th>
                            <th>@lang('Title')</th>
                            <th>@lang('Text')</th>
                            <th class="text-right">@lang('Action')</th>
                        </tr>
                        @forelse ($features as $item)
                            <tr>

                                <td data-label="@lang('Photo')">
                                    <img src="{{ getPhoto($item->photo) }}" class="img-fluid" style="width: 50px"
                                        alt="">
                                </td>
                                <td data-label="@lang('Title')">
                                    {{ $item->title }}
                                </td>
                                <td data-label="@lang('Text')">
                                    {{ $item->text }}
                                </td>

                                <td data-label="@lang('Action')" class="text-right">
                                    <div class="d-flex gap-10 justify-content-end">
                                        <a href="javascript:void()" class="btn btn-primary approve btn-sm edit mx-2 mb-1"
                                            data-route="{{ route('admin.feature.update', $item->id) }}"
                                            data-path="{{ adminpath() }}" data-item="{{ $item }}"
                                            data-toggle="tooltip" title="@lang('Edit')"><i
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

    <!-- Modal -->
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.feature.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('Add Feature')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Feature Icon')</label>
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
                            <input class="form-control" type="text" name="text">
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
                        <h5 class="modal-title">@lang('Edit Feature')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Feature Icon')</label>
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
                            <input class="form-control" type="text" name="text">
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
            <form action="{{ route('admin.feature.destroy') }}" method="POST">
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


    <!--Row-->
@endsection

@push('script')
    @push('script')
        <script>
            'use strict';

            $.uploadPreview({
                input_field: "#image-upload_about",
                preview_box: "#image-preview_about",
                label_field: "#image-label_about",
                label_default: "{{ __('Choose File') }}",
                label_selected: "{{ __('Update Image') }}",
                no_label: false,
                success_callback: null
            });

            $.uploadPreview({
                input_field: "#image-upload_about1",
                preview_box: "#image-preview_about1",
                label_field: "#image-label_about1",
                label_default: "{{ __('Choose File') }}",
                label_selected: "{{ __('Update Image') }}",
                no_label: false,
                success_callback: null
            });

            $.uploadPreview({
                input_field: "#image-upload_about3",
                preview_box: "#image-preview_about3",
                label_field: "#image-label_about3",
                label_default: "{{ __('Choose File') }}",
                label_selected: "{{ __('Update Image') }}",
                no_label: false,
                success_callback: null
            });
            $.uploadPreview({
                input_field: "#image-upload_about4",
                preview_box: "#image-preview_about4",
                label_field: "#image-label_about4",
                label_default: "{{ __('Choose File') }}",
                label_selected: "{{ __('Update Image') }}",
                no_label: false,
                success_callback: null
            });



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

            $.uploadPreview({
                input_field: "#image-upload3",
                preview_box: "#image-preview3",
                label_field: "#image-label3",
                label_default: "{{ __('Choose File') }}",
                label_selected: "{{ __('Update Image') }}",
                no_label: false,
                success_callback: null
            });

            $('.edit').on('click', function() {
                var data = $(this).data('item');
                $('#edit').find('input[name=title]').val(data.title);
                $('#edit').find('input[name=text]').val(data.text);
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
@endpush
