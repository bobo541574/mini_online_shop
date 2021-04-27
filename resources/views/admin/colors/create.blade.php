@extends('admin.layouts.app')

@section('content')

@include('admin.layouts.breadcrumb', [
    'items' => [
        'color_table' => route('colors.index'),
        'create' => null
    ]
])


<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="text fw-bold">
                        @lang('color_create')
                    </h4>
                    <a href="{{ route('colors.index') }}" class="btn btn-sm btn-dark align-self-center">
                        @lang('back')
                    </a>
                </div>
                @if (session('status'))
                <div class="alert alert-warning alert-dismissible mt-3 mb-0" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-message">
                        <strong>{{ session('status') }}</strong>
                    </div>
                </div>
                @endif
            </div>
            <div class="card-body">
                <form action="{{ route('colors.store') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for="name_en" class="form-label fw-bold">@lang('color_name_en')</label>
                        <input type="text" name="name_en" value="{{ old('name_en') }}" id="name_en" class="form-control"
                            placeholder="@lang('enter_color_name_en')">

                        @error('name_en')
                        <div class="text-danger pt-1 mx-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="name_mm" class="form-label fw-bold">@lang('color_name_mm')</label>
                        <input type="text" name="name_mm" value="{{ old('name_mm') }}" id="name_mm" class="form-control"
                            placeholder="@lang('enter_color_name_mm')">

                        @error('name_mm')
                        <div class="text-danger pt-1 mx-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="color_code" class="form-label fw-bold">@lang('color_code')</label>
                        <input type="color" name="color_code" value="{{ old('color_code') }}" id="color_code" class="form-control form-control-color"
                            placeholder="@lang('enter_color_code')">

                        @error('color_code')
                        <div class="text-danger pt-1 mx-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button class="btn btn btn-primary" type="submit">
                            @lang('create')
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection
