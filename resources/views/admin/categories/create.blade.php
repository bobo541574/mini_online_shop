@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="text fw-bold">
                        @lang('category_create')
                    </h4>
                    <a href="{{ route('categories.index') }}" class="btn btn-sm btn-dark align-self-center">
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
                <form action="{{ route('categories.store') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for="name_en" class="form-label fw-bold">@lang('category_name_en')</label>
                        <input type="text" name="name_en" value="{{ old('name_en') }}" id="name_en" class="form-control"
                            placeholder="@lang('enter_category_name_en')">

                        @error('name_en')
                        <div class="text-red-500 text-xs pt-2 pl-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="name_mm" class="form-label fw-bold">@lang('category_name_mm')</label>
                        <input type="text" name="name_mm" value="{{ old('name_mm') }}" id="name_mm" class="form-control"
                            placeholder="@lang('enter_category_name_mm')">
                
                        @error('name_mm')
                        <div class="text-red-500 text-xs pt-2 pl-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                
                    <div class="mb-3">
                        <label for="description_en" class="form-label fw-bold">@lang('description_name_en')</label>
                        <textarea name="description_en" id="description_en" rows="3" class="form-control"
                            placeholder="@lang('enter_description_name_en')">{{ old('description_en') }}</textarea>
                
                        @error('description_en')
                        <div class="text-red-500 text-xs pt-2 pl-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                
                    <div class="mb-3">
                        <label for="description_mm" class="form-label fw-bold">@lang('description_name_mm')</label>
                        <textarea name="description_mm" id="description_mm" rows="3" class="form-control"
                            placeholder="@lang('enter_description_name_mm')">{{ old('description_mm') }}</textarea>
                
                        @error('description_mm')
                        <div class="text-red-500 text-xs pt-2 pl-1">
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
