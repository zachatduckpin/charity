@extends('layouts.admin')

@section('title')
    @lang('Withdraw Settings')
@endsection

@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Withdraw Settings')</h1>
        </div>
    </section>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.gs.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="withdraw" value="1">
                        <div class="form-group">
                            <label>@lang('Withdraw Minimun Amount')</label>
                            <input class="form-control" name="withdraw_min" type="number" step="any"
                                value="{{ round($gs->withdraw_min, 2) }}" required>
                        </div>
                        <div class="form-group">
                            <label>@lang('Withdraw Maximum Amount')</label>
                            <input class="form-control" name="withdraw_max" type="number" step="any"
                                value="{{ round($gs->withdraw_max, 2) }}" required>
                        </div>
                        <div class="form-group">
                            <label>@lang('Withdraw Charge') <small>(fixed)</small></label>
                            <input class="form-control" name="withdraw_charge" type="number" step="any"
                                value="{{ round($gs->withdraw_charge, 2) }}" required>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary btn-lg">@lang('Update')</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
