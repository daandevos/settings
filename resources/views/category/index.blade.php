@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('All categories') }}</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('Name') }}</th>
                                <th scope="col">{{ __('Subcategories') }}</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <th>{{ $category->name }}</th>
                                <td>{{ $category->children->pluck('name')->implode(', ') }}</td>
                                <td><a class="btn btn-sm btn-secondary" href="{{ action('CategoryController@edit', $category->id) }}">Edit</a></td>
                                <td>
                                    <form action="{{ action('CategoryController@destroy', $category->id) }}" method="POST" id="delete-form-{{ $category->id }}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">{{ __('Delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-muted">
                    <a href="{{ action('CategoryController@create') }}" role="button" class="btn btn-primary">{{ __('Create category') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
