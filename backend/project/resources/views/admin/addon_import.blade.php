@extends('layouts.admin')
@section('title')
    @lang('Manage Addon')
@endsection

@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Manage Addon')</h1>

        </div>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="product-description">
                        <div class="body-area">

                            <form action="{{ route('admin-import-addon-submit') }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Import Addon Zip File') }} *</h4>

                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <input class="form-control" name="addon_charity" id="addon" required=""
                                            value="" type="file">
                                    </div>
                                </div>


                                <div class="row mt-4">
                                    <div class="col-lg-4">
                                        <div class="left-area">

                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <button class=" btn btn-primary" type="submit">{{ __('Import') }}</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
