@extends('layout.master')

@section('content')

@include('admin.partials.sidebar')

<div class="col-xs-12 col-sm-9 main">
    @include('dashboard.partials.errors')
    <div class="panel panel-default">
    <div class="panel-heading">{{ trans('admin.title') }}</div>
    <div class="panel-body">
        <form id="settings-form" name="SettingsForm" class="form-horizontal" role="form" action="/admin/settings" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <fieldset>            
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ trans('forms.settings.localization.site-locale') }}</label>
                            <div class="col-sm-6">
                            <select name="app_locale" class="form-control" required>
                                <option value="">{{ trans('forms.settings.localization.select-language') }}</option>
                                @foreach($langs as $lang => $name)
                                    <option value="{{ $lang }}" @if($app_locale === $lang) selected @endif>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>

            <div class="row">
                <div class="col-md-7">
                    <div class="form-actions text-center">
                        <button type="submit" class="btn btn-success">{{ trans('forms.save') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    </div>
</div>
@endsection