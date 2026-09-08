@extends('layouts.admin')
@section('title')
    @lang('Add New Event')
@endsection

@section('breadcrumb')
    <section class="section">
        <div class="section-header  d-flex justify-content-between">
            <h1>@lang('Edit Event')</h1>
            <a href="{{ route('admin.event.index') }}" class="btn btn-primary"><i class="fas fa-backward"></i>
                @lang('Back')</a>
        </div>
    </section>
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('Edit Event Form') }}</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.event.update', $event->id) }}" enctype="multipart/form-data"
                        method="POST">
                        @method('PUT')
                        @csrf
                        <div class="col-md-12 ShowImage mb-3  text-center">
                            <label for="image">
                                <img src="{{ getPhoto($event->photo) }}" class="img-fluid" alt="image" width="400">
                            </label>
                        </div>

                        <div class="row">
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label for="title">{{ __('Event Title') }}</label>
                                    <input type="text" class="form-control" name="title" id="title" required
                                        placeholder="{{ __('Event Title') }}" value="{{ old('title', $event->title) }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image">{{ __('Feature Photo') }}

                                        <span class="ml-1">{{ __('(Extension:jpeg,jpg,png)') }}</span>
                                    </label>

                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="photo" id="image"
                                            accept="image/*">
                                        <label class="custom-file-label" for="photo">{{ __('Choose file') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="event_type">{{ __('Event Type') }}</label>
                                    <select class="form-control mb-3 mb-md-0" name="event_type" id="event_type">
                                        <option value="online" {{ $event->event_type == 'online' ? 'selected' : '' }}>
                                            @lang('Online')</option>
                                        <option value="offline" {{ $event->event_type == 'offline' ? 'selected' : '' }}>
                                            @lang('Offline')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group d-none event_location">
                                    <label for="event_location">{{ __('Event Location') }}</label>
                                    <input type="text" class="form-control" name="event_location" id="event_location" \
                                        placeholder="{{ __('Event Location') }}"
                                        value="{{ old('event_location', $event->event_location) }}">
                                </div>
                                <div class="form-group event_link">
                                    <label for="event_link">{{ __('Event Link') }}</label>
                                    <input type="numnber" class="form-control" name="event_link" id="event_link"
                                        placeholder="{{ __('Event Link') }}"
                                        value="{{ old('event_link', $event->event_link) }}">
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date">{{ __('Date') }}</label>
                                    <input type="date" class="form-control" name="date" id="date" required
                                        placeholder="{{ __('Date') }}" value="{{ old('date', $event->date) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="start_time">{{ __('Start Time') }}</label>
                                            <input type="time" class="form-control" name="start_time" id="start_time"
                                                required placeholder="{{ __('Time') }}"
                                                value="{{ old('start_time', $event->start_time) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="end_time">{{ __('End Time') }}</label>
                                            <input type="time" class="form-control" name="end_time" id="end_time"
                                                required placeholder="{{ __('Time') }}"
                                                value="{{ old('end_time', $event->end_time) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="organizar_name">{{ __('Organizar Name') }}</label>
                            <input type="text" step="any" class="form-control" name="organizar_name"
                                id="organizar_name" placeholder="{{ __('Organizar Name') }}"
                                value="{{ old('organizar_name', $event->organizar_name) }}">
                        </div>

                        <div class="form-group">
                            <label for="organizar_email">{{ __('Organizar Email') }}</label>
                            <input type="text" step="any" class="form-control" name="organizar_email"
                                id="organizar_email" placeholder="{{ __('Organizar Email') }}"
                                value="{{ old('organizar_email', $event->organizar_email) }}">
                        </div>

                        <div class="form-group">
                            <label for="organizar_phone">{{ __('Organizar Phone') }}</label>
                            <input type="text" step="any" class="form-control" name="organizar_phone"
                                id="organizar_phone" placeholder="{{ __('Organizar Phone') }}"
                                value="{{ old('organizar_phone', $event->organizar_phone) }}">
                        </div>


                        <div class="form-group">
                            <label for="map_link">{{ __('Google Map Link') }}</label>
                            <input type="text" step="any" class="form-control" name="map_link" id="map_link"
                                placeholder="{{ __('Google Map Link') }}"
                                value="{{ old('map_link', $event->map_link) }}">
                        </div>

                        <div class="form-group">
                            <label for="description">{{ __('Description') }}</label>
                            <textarea id="area1" class="form-control summernote" name="description" placeholder="{{ __('Description') }}"
                                required>{{ old('description', $event->description) }}</textarea>
                        </div>


                        <div class="form-group">
                            <label>{{ __('Status') }}</label>
                            <select class="form-control  mb-3" name="status" required>
                                <option value="1" {{ $event->status == '1' ? 'selected' : '' }}>{{ __('Active') }}
                                </option>
                                <option value="0" {{ $event->status == '0' ? 'selected' : '' }}>{{ __('Inactive') }}
                                </option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
