@extends('admin.layouts.app')

@section('content')

@include('admin.layouts.breadcrumb', [
'items' => [
    'brand_table' => route('brands.index'),
    'edit' => null
]
])


<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="text fw-bold">
                        @lang('brand_edit')
                    </h4>
                    <a href="{{ route('brands.index') }}" class="btn btn-sm btn-dark align-self-center">
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
                <form action="{{ route('brands.update', $brand) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="name_en" class="form-label fw-bold">@lang('brand_name_en')</label>
                        <input type="text" name="name_en" value="{{ $brand->name_en }}" id="name_en" class="form-control"
                            placeholder="@lang('enter_brand_name_en')">

                        @error('name_en')
                        <div class="text-danger pt-1 mx-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="name_mm" class="form-label fw-bold">@lang('brand_name_mm')</label>
                        <input type="text" name="name_mm" value="{{ $brand->name_mm }}" id="name_mm" class="form-control"
                            placeholder="@lang('enter_brand_name_mm')">

                        @error('name_mm')
                        <div class="text-danger pt-1 mx-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="photo" class="form-label fw-bold">@lang('brand_photo')</label>
                        <input class="form-control" name="photo" id="photo" type="file">
                        <input class="form-control" name="old_photo" value="{{ $brand->photo }}" type="hidden">

                        @error('photo')
                        <div class="text-danger pt-1 mx-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description_en" class="form-label fw-bold">@lang('brand_description_en')</label>
                        <textarea name="description_en" id="description_en" rows="3" class="form-control"
                            placeholder="@lang('enter_brand_description_en')">{{ $brand->description_en }}</textarea>

                        @error('description_en')
                        <div class="text-danger pt-1 mx-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description_mm" class="form-label fw-bold">@lang('brand_description_mm')</label>
                        <textarea name="description_mm" id="description_mm" rows="3" class="form-control"
                            placeholder="@lang('enter_brand_description_mm')">{{ $brand->description_mm }}</textarea>

                        @error('description_mm')
                        <div class="text-danger pt-1 mx-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button class="btn btn btn-primary" type="submit">
                            @lang('update')
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection
