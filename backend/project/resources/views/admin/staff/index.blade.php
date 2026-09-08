@extends('layouts.admin')

@section('title')
    @lang('Manage Staff')
@endsection

@section('breadcrumb')
    <section class="section">
        <div class="section-header justify-content-between">
            <h1> @lang('Manage Staff')</h1>

            <a href="javascript:void(0)" data-toggle="modal" data-target="#addModal" class="btn btn-primary btn-sm add"><i
                    class="fas fa-plus"></i> @lang('Add New Staff')</a>

        </div>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body text-center">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>@lang('Sl')</th>
                                <th>@lang('Name')</th>
                                <th>@lang('Email')</th>
                                <th>@lang('Role')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>
                            </tr>

                            @forelse ($staffs as $key => $user)
                                <tr>
                                    <td data-label="@lang('Sl')">{{ $key + $staffs->firstItem() }}</td>

                                    <td data-label="@lang('Name')">
                                        {{ $user->name }}
                                    </td>
                                    <td data-label="@lang('Email')">{{ $user->email }}</td>
                                    <td data-label="@lang('Role')">
                                        <span class="badge badge-dark">{{ strtoupper($user->role) }}</span>
                                    </td>
                                    <td data-label="@lang('Status')">
                                        @if ($user->status == 1)
                                            <span class="badge badge-success">@lang('active')</span>
                                        @elseif($user->status == 2)
                                            <span class="badge badge-danger">@lang('banned')</span>
                                        @endif
                                    </td>
                                    <td data-label="@lang('Action')">

                                        <div class="d-flex gap-10 justify-content-end">

                                            <a class="btn btn-primary btn-sm details mr-2" data-staff="{{ $user }}"
                                                href="javascript:void(0)"
                                                data-route="{{ route('admin.staff.update', $user->id) }}">@lang('Details')</a>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm remove "
                                                data-id="{{ $user->id }}" data-toggle="tooltip"
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
                @if ($staffs->hasPages())
                    {{ $staffs->links('admin.partials.paginate') }}
                @endif
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="removeMod" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.staff.destroy') }}" method="POST">
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

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.staff.add') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('Add New Staff')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Name')</label>
                            <input class="form-control" type="text" name="name" required value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label>@lang('Email')</label>
                            <input class="form-control" type="email" name="email" required value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <label>@lang('Password')</label>
                            <input class="form-control" type="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label>@lang('Confirm Password')</label>
                            <input class="form-control" type="password" name="password_confirmation" required>
                        </div>

                        <div class="form-group ">
                            <label>@lang('Status')</label>
                            <select name="status" class="form-control mb-3">
                                <option value="1">@lang('Active')</option>
                                <option value="2">@lang('Banned')</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>@lang('Select Role')</label>
                            <select name="role" class="form-control ">
                                <option value="">Select</option>
                                @foreach ($roles as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
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
@endsection

@push('script')
    <script>
        'use strict';
        $('.add').on('click', function() {
            $('#addModal').find('.append').children().remove()
            $('#addModal').find('form')[0].reset();
        })
        $('.details').on('click', function() {
            $('#addModal').find('.modal-title').text("@lang('Edit staff')")
            $('#addModal').find('input[name=name]').val($(this).data('staff').name)
            $('#addModal').find('input[name=email]').val($(this).data('staff').email)
            $('#addModal').find('input[name=password]').attr('required', false)
            $('#addModal').find('input[name=password_confirmation]').attr('required', false)
            $('#addModal').find('select[name=role]').val($(this).data('staff').role)
            $('#addModal').find('select[name=status]').val($(this).data('staff').status)
            $("select").niceSelect("update");


            $(document).find('select[name=status]').val($(this).data('staff').status)
            $('#addModal').find('form').attr('action', $(this).data('route'))
            
            $('#addModal').modal('show');

        })

        $('.remove').on('click', function() {
            $('#removeMod').find('input[name=id]').val($(this).data('id'))
            $('#removeMod').modal('show')
        })
    </script>
@endpush
