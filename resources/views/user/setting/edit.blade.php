@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Change your settings</div>

                <div class="card-body">
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    @error('settings')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <form method="POST" action="{{ action('UserSettingController@update') }}">
                        @method('PATCH')
                        @csrf

                        @forelse ($categories as $category)
                            <h2>{{ $category->name }}</h2>
                            @foreach ($category->settings as $setting)
                                @error('settings.' . $setting->id)
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="setting">{{ $setting->name }}</label>
                                    <span class="float-right text-secondary">{{ $setting->description }}</span>
                                    <input name="settings[{{ $setting->id }}]" type="number" min="0" max="100000" class="form-control @error('settings.' . $setting->id) is-invalid @enderror" id="setting" placeholder="0-100000" value="{{ $setting->getValueForUser(Auth::user()) }}">
                                </div>
                            @endforeach

                            @if ($category['children']->isNotEmpty())
                                @foreach ($category['children'] as $subCategory)
                                    <h4>{{ $subCategory->name }}</h4>

                                    @foreach ($subCategory->settings as $setting)
                                        @error('settings.' . $setting->id)
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="form-group">
                                            <label for="setting">{{ $setting->name }}</label>
                                            <span class="float-right text-secondary">{{ $setting->description }}</span>
                                            <input name="settings[{{ $setting->id }}]" type="number" min="0" max="100000" class="form-control @error('settings.' . $setting->id) is-invalid @enderror" id="setting" placeholder="0-100000" value="{{ $setting->getValueForUser(Auth::user()) }}">
                                        </div>
                                    @endforeach

                                @endforeach
                            @endif

                        @empty
                            No categories, meaning no settings.
                        @endforelse
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
