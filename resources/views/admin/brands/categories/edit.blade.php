@extends('admin.layouts.app')

@section('content')

@include('admin.layouts.breadcrumb', [
    'items' => [
        'brand_category' => route('brands.index'),
        'edit' => null
    ]
])


<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="text fw-bold">
                        @lang('brand_category_create')
                    </h4>
                    <a href="{{ route('assigns.categories-index') }}" class="btn btn-sm btn-dark align-self-center">
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
                <form action="{{ route('assigns.categories-update', $brand) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="brand" class="form-label fw-bold">@lang('brand')</label>
                        <input type="text" value="{{ $brand->name }}" class="form-control" readonly>
                        <input type="hidden" name="brand" value="{{ $brand->id }}">
                    </div>

                    <div class="mb-3">
                        <label for="categories" class="form-label fw-bold">@lang('categories')</label>
                        <select class="form-select" id="categories" name="categories[]" aria-label="Default select example" multiple>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ multiple_selected($brand->categories_id, $category->id)}}>{{$category->name}} ({{$category->category_name}})</option>
                            @endforeach
                        </select>

                        @error('categories')
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

@section('script')
    <script>
        $(document).ready(function() {
            $('#categories').select2();
        })
    </script>
@endsection
