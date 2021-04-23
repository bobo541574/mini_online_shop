@extends('admin.layouts.app')

@section('content')

@include('admin.layouts.breadcrumb', [
    'items' => [
        'subcategory' => route('subcategories.index'),
        'edit' => null
    ]
])

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="text fw-bold">
                        @lang('subcategory_edit')
                    </h4>
                    <a href="{{ route('subcategories.index') }}" class="btn btn-sm btn-dark align-self-center">
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
                <form action="{{ route('subcategories.store') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for="name_mm" class="form-label fw-bold">@lang('category')</label>
                        <select class="form-select" name="parent_id" aria-label="Default select example">
                            <option value="">@lang('select_category')</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ ($category->id == $subcategory->parent_id) ? 'selected=selected' : '' }}>
                                {{ $category->name }}</option>
                            @endforeach
                        </select>

                        @error('parent_id')
                        <div class="text-danger pt-1 mx-1" role="alert">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="name_en" class="form-label fw-bold">@lang('subcategory_name_en')</label>
                        <input type="text" name="name_en" value="{{ $subcategory->name_en }}" id="name_en" class="form-control"
                            placeholder="@lang('enter_subcategory_name_en')">

                        @error('name_en')
                        <div class="text-danger pt-1 mx-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="name_mm" class="form-label fw-bold">@lang('subcategory_name_mm')</label>
                        <input type="text" name="name_mm" value="{{ $subcategory->name_mm }}" id="name_mm" class="form-control"
                            placeholder="@lang('enter_subcategory_name_mm')">

                        @error('name_mm')
                        <div class="text-danger pt-1 mx-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description_en" class="form-label fw-bold">@lang('subcategory_description_en')</label>
                        <textarea name="description_en" id="description_en" rows="3" class="form-control"
                            placeholder="@lang('enter_subcategory_description_en')">{{ $subcategory->description_en }}</textarea>

                        @error('description_en')
                        <div class="text-danger pt-1 mx-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description_mm" class="form-label fw-bold">@lang('subcategory_description_mm')</label>
                        <textarea name="description_mm" id="description_mm" rows="3" class="form-control"
                            placeholder="@lang('enter_subcategory_description_mm')">{{ $subcategory->description_mm }}</textarea>

                        @error('description_mm')
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

@section('script')
<script>
    let select = document.querySelector('select');

</script>
@endsection
