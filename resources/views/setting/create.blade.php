@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Create settings</div>

                <div class="card-body">
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @endif

                    @forelse ($categories as $category)
                        <h2>{{ $category->name }}</h2>

                        @if ($category->settings->isNotEmpty())
                        <div class="accordion" id="accordion">
                            <div id="{{ $category->id }}">
                                <a href="#" class="text-decoration-none float-right" data-toggle="collapse" data-target="#collapseOne{{ $category->id }}" aria-expanded="false" aria-controls="collapseOne{{ $category->id }}">
                                    {{ __('View settings') }}
                                </a>
                            </div>

                            <div id="collapseOne{{ $category->id }}" class="collapse" aria-labelledby="{{ $category->id }}" data-parent="#accordion">
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">{{ __('Name') }}</th>
                                                <th scope="col">{{ __('Description') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($category->settings as $setting)
                                            <tr>
                                                <th>{{ $setting->name }}</th>
                                                <td>{{ $setting->description }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endif

                        <form method="POST" action="{{ action('SettingController@store') }}" class="form-inline mt-2">
                            @csrf

                            <label class="sr-only" for="name">{{ __('Name') }}</label>
                            <input type="text" class="form-control mr-sm-2" id="name" name="name" placeholder="{{ __('Name') }}">

                            <label class="sr-only" for="description">{{ __('Description') }}</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="{{ __('Description') }}">
                            
                            <input hidden name="category_id" value="{{ $category->id }}">

                            <button type="submit" class="btn btn-primary ml-sm-2">{{ __('Save') }}</button>
                        </form>

                        @if (!$loop->last)
                            <hr>
                        @endif
                    @empty
                        No categories, meaning no settings.
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
