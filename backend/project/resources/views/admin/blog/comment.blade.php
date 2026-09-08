@extends('layouts.admin')

@section('title')
    @lang('Manage Blog Comment')
@endsection

@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Manage Blog Comment')</h1>
        </div>
    </section>
@endsection
@section('content')
    <!-- Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-striped">
                        <tr>
                            <th>{{ __('Blog') }}</th>
                            <th class="min-w-200">{{ __('Name') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th class="min-w-200">{{ __('Comment') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>

                        @forelse ($comments as $item)
                            <tr>
                                <td class="min-w-250" data-label="{{ __('Blog') }}">
                                    {{ $item->blog->title }}
                                </td>
                                <td class="min-w-200" data-label="{{ __('Name') }}">
                                    {{ $item->name }}
                                </td>
                                <td data-label="{{ __('Email') }}">
                                    {{ $item->email }}
                                </td>
                                <td class="min-w-200 py-3" data-label="{{ __('Comment') }}">
                                    {{ $item->comment }}
                                </td>
                                <td data-label="{{ __('Action') }}">
                                    <a href="javascript:void(0)" class="btn btn-danger  btn-sm remove mb-1"
                                        data-route="{{ route('admin.blog.comment.delete', $item->id) }}"
                                        data-toggle="tooltip" title="@lang('Delete')"><i class="fas fa-trash"></i></a>
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
        <!-- DataTable with Hover -->

    </div>
    <!--Row-->



    <!-- Modal -->
    <div class="modal fade" id="del" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-body">
                        <h5 class="mt-3">@lang('Are you sure to remove?')</h5>
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
            var route = $(this).data('route')
            $('#del').find('form').attr('action', route)
            $('#del').modal('show')
        })
    </script>
@endpush
