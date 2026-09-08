@extends('layouts.admin')

@section('title')
    @lang('Manage Faq')
@endsection

@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Manage Faq')</h1>
        </div>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body text-center">
                    <p class="mb-2">@lang('Faq Background') <small>
                        (@lang('recommended size (620x580)'))
                    </small></p>
                    <form action="{{ route('admin.gs.update') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        
                        <div class="col-md-12 ShowImage mb-3  text-center">
                            <label for="image">
                                <img src="{{ getPhoto($gs->faq_background) }}" class="img-fluid" alt="image"
                                    width="200">
                            </label>
                            <input type="file" class="d-none" id="image" name="faq_background">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    </form>
                </div>
            </div>


            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>@lang('Faq')</h4>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i>
                        @lang('Add New')</button>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>@lang('Question')</th>
                                <th>@lang('Answer')</th>
                                <th class="text-right">@lang('Action')</th>
                            </tr>
                            @forelse ($datas as $key => $item)
                                <tr>
                                    <td data-label="@lang('Question')">
                                        {{ $item->title }}
                                    </td>

                             
                                    <td data-label="@lang('Answer')">{{ Str::limit($item->details, 50) }}</td>
                                    <td data-label="@lang('Action')" class="text-right">
                                     <div class="d-flex gap-10 justify-content-end">
                                        <a href="javascript:void()" class="btn btn-primary approve btn-sm edit mb-1"
                                        data-route="{{ route('admin.faq.update', $item->id) }}"
                                        data-item="{{ $item }}" data-toggle="tooltip"
                                        title="@lang('Edit')"><i class="fas fa-edit"></i></a>
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
    </div>

    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.faq.store') }}" method="POST" enctype="multipart/form-data">
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
                            <label>@lang('Question')</label>
                            <input class="form-control" type="text" name="title" required>
                        </div>
                        <div class="form-group">
                            <label>@lang('Answer')</label>
                            <textarea class="form-control" type="text" name="details" required></textarea>
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
                            <label>@lang('Question')</label>
                            <input class="form-control" type="text" name="title" required>
                        </div>
                        <div class="form-group">
                            <label>@lang('Answer')</label>
                            <textarea class="form-control" type="text" name="details" required></textarea>
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









    <div class="modal fade" id="removeMod" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.faq.destroy') }}" method="POST">
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
        $('.remove').on('click', function() {
            $('#removeMod').find('input[name=id]').val($(this).data('id'))
            $('#removeMod').modal('show')
        })


        $('.edit').on('click', function() {

            var data = $(this).data('item');
            $('#edit').find('input[name=title]').val(data.title)
            $('#edit').find('textarea[name=details]').val(data.details)
            $('#edit').find('form').attr('action', $(this).data('route'))
            $('#edit').modal('show')
        })
    </script>
@endpush
