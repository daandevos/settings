@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Welcome :user!', ['user' => Auth::user()->name]) }}</div>

                <div class="card-body">
                    <p>{{ __('Here\'s some information that might be intresting for you:') }}</p>
                    <div class="row">
                        <div class="col-4">
                        <div class="list-group" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="list-info-list" data-toggle="list" href="#list-info" role="tab" aria-controls="info">
                                {{ __('Personal information') }}
                            </a>
                            <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">
                                {{ __('Your settings') }}
                            </a>
                        </div>
                        </div>
                        <div class="col-8">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="list-info" role="tabpanel" aria-labelledby="list-info-list">
                                    <p><strong>{{ __('Name') }}</strong>: {{ Auth::user()->name }}</p>
                                    <p><strong>{{ __('Email Address') }}</strong>: {{ Auth::user()->email }}</p>
                                    <p><strong>{{ __('Registered since') }}</strong>: {{ Carbon\Carbon::parse(Auth::user()->created_at)->format('d-m-Y H:i') }}</p>
                                </div>
                                <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">{{ __('Name') }}</th>
                                                <th scope="col">{{ __('Category') }}</th>
                                                <th scope="col">{{ __('Description') }}</th>
                                                <th scope="col">{{ __('Value') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (\App\Setting::all() as $setting)
                                            <tr>
                                                <th>{{ $setting->name }}</th>
                                                <td>{{ $setting->category->name }}</td>
                                                <td>{{ $setting->description }}</td>
                                                <td>{{ $setting->getValueForUser(Auth::user()) }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
