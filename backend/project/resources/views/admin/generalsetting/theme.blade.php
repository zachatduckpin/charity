@extends('layouts.admin')
@section('breadcrumb')
 <section class="section">
        <div class="section-header">
        <h1>@lang('Home Page')</h1>
        </div>
</section>
@endsection
@section('title')
   @lang('Home Page')
@endsection
@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
               <h6 class="text-primary"> @lang('Home Page 1')</h6>
            </div>
            <div class="card-body">
              <form id="" action="{{ route('admin.gs.update') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <input type="hidden" name="type" value="theme">
                <input type="hidden" name="theme" value="theme1">
                 <div class="form-group d-flex justify-content-center homepage-wrapper" 
                 style="background-image:url({{ asset('assets/admin/theme1.png') }});"
                 >
                 </div>
                   <div class="form-group row">
                    <div class="col-sm-12 text-center">
                        @if ($gs->theme == 'theme1')
                            <button type="button" class="btn btn-success btn-block">{{ __('Active') }}</button>
                        @else
                            <button type="submit" class="btn btn-dark btn-block">{{ __('Make it Active') }}</button>
                        @endif
                    </div>
                  </div>
              </form>
            </div>
        </div>
    </div>

   
    <div class="col-md-6">
      <div class="card">
        <div class="card-header  d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">{{ __('Home Page 2') }}</h6>
        </div>
        <div class="card-body">
            <form id="" action="{{ route('admin.gs.update') }}" enctype="multipart/form-data" method="POST">
              @csrf
              <input type="hidden" name="type" value="theme">
              <input type="hidden" name="theme" value="theme2">
              <div class="form-group d-flex justify-content-center homepage-wrapper" 
              
              style="background-image:url({{ asset('assets/admin/theme2.png') }});"
              >
             </div>
             <div class="form-group row">
              <div class="col-sm-12 text-center">
                @if ($gs->theme == 'theme2')
                <button type="button" class="btn btn-success btn-block">{{ __('Active') }}</button>
            @else
                <button type="submit" class="btn btn-dark btn-block">{{ __('Make it Active') }}</button>
            @endif
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    @if (checkAddon())
        <div class="col-md-6">
            <div class="card">
        <div class="card-header  d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">{{ __('Home Page 3') }}</h6>
        </div>
        <div class="card-body">
            <form id="" action="{{ route('admin.gs.update') }}" enctype="multipart/form-data" method="POST">
              @csrf
              <input type="hidden" name="type" value="theme">
              <input type="hidden" name="theme" value="theme3">
              <div class="form-group d-flex justify-content-center homepage-wrapper" 
              
              style="background-image:url({{ asset('assets/admin/theme3.png') }});"
              >
             </div>
             <div class="form-group row">
              <div class="col-sm-12 text-center">
                @if ($gs->theme == 'theme3')
                <button type="button" class="btn btn-success btn-block">{{ __('Active') }}</button>
            @else
                <button type="submit" class="btn btn-dark btn-block">{{ __('Make it Active') }}</button>
            @endif
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>


    <div class="col-md-6">
      <div class="card">
        <div class="card-header  d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">{{ __('Home Page 4') }}</h6>
        </div>
        <div class="card-body">
            <form id="" action="{{ route('admin.gs.update') }}" enctype="multipart/form-data" method="POST">
              @csrf
              <input type="hidden" name="type" value="theme">
              <input type="hidden" name="theme" value="theme4">
              <div class="form-group d-flex justify-content-center homepage-wrapper" 

              style="background-image:url({{ asset('assets/admin/theme4.png') }});"
              >
             </div>
             <div class="form-group row">
              <div class="col-sm-12 text-center">
                @if ($gs->theme == 'theme4')
                <button type="button" class="btn btn-success btn-block">{{ __('Active') }}</button>
            @else
                <button type="submit" class="btn btn-dark btn-block">{{ __('Make it Active') }}</button>
            @endif
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    @endif
</div>



@endsection
