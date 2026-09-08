@extends('layouts.admin')
@section('breadcrumb')
 <section class="section">
        <div class="section-header">
        <h1>@lang('Logo Settings')</h1>
        </div>
</section>
@endsection
@section('title')
   @lang('Site Logo')
@endsection
@section('content')

<div class="row">
    <div class="col-md-6 col-lg-6 col-sm-12">
        <div class="card">
            <div class="card-header">
               <h6 class="text-primary"> @lang('Header Logo')</h6>
            </div>
            <div class="card-body">
              <form id="" action="{{ route('admin.gs.update') }}" enctype="multipart/form-data" method="POST">
                @csrf
              
                 <div class="form-group d-flex justify-content-center">
                    <div id="image-preview" class="image-preview image-preview_alt"
                        style="background-image:url({{ getPhoto($gs->header_logo) }});">
                        <label for="image-upload" id="image-label">@lang('Choose File')</label>
                        <input type="file" name="header_logo" id="image-upload" />
                    </div>
                 </div>
                   <div class="form-group row">
                    <div class="col-sm-12 text-center">
                      <button type="submit" class="btn btn-primary btn-block">{{ __('Update') }}</button>
                    </div>
                  </div>
              </form>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-6 col-sm-12">
      <div class="card">
          <div class="card-header">
             <h6 class="text-primary"> @lang('Footer Logo')</h6>
          </div>
          <div class="card-body">
            <form id="" action="{{ route('admin.gs.update') }}" enctype="multipart/form-data" method="POST">
              @csrf
            
               <div class="form-group d-flex justify-content-center">
                  <div id="image-preview_f" class="image-preview image-preview_alt"
                      style="background-image:url({{ getPhoto($gs->footer_logo) }});">
                      <label for="image-upload_f" id="image-label">@lang('Choose File')</label>
                      <input type="file" name="footer_logo" id="image-upload_f" />
                  </div>
               </div>
                 <div class="form-group row">
                  <div class="col-sm-12 text-center">
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Update') }}</button>
                  </div>
                </div>
            </form>
          </div>
      </div>
  </div>
</div>



@endsection

@push('script')
    <script>
      'use strict';
      $.uploadPreview({
                input_field: "#image-upload", // Default: .image-upload
                preview_box: "#image-preview", // Default: .image-preview
                label_field: "#image-label", // Default: .image-label
                label_default: "{{__('Choose File')}}", // Default: Choose File
                label_selected: "{{__('Update Image')}}", // Default: Change File
                no_label: false, // Default: false
                success_callback: null // Default: null
            });
        $.uploadPreview({
                input_field: "#image-upload1", // Default: .image-upload
                preview_box: "#image-preview1", // Default: .image-preview
                label_field: "#image-label1", // Default: .image-label
                label_default: "{{__('Choose File')}}", // Default: Choose File
                label_selected: "{{__('Update Image')}}", // Default: Change File
                no_label: false, // Default: false
                success_callback: null // Default: null
            });
        $.uploadPreview({
                input_field: "#image-upload_f", // Default: .image-upload
                preview_box: "#image-preview_f", // Default: .image-preview
                label_field: "#image-label_f", // Default: .image-label
                label_default: "{{__('Choose File')}}", // Default: Choose File
                label_selected: "{{__('Update Image')}}", // Default: Change File
                no_label: false, // Default: false
                success_callback: null // Default: null
            });
    </script>
@endpush