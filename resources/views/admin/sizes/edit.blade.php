@extends('admin.layouts.app')

@section('content')

@include('admin.layouts.breadcrumb', [
'items' => [
    'size' => route('sizes.index'),
    'create' => null
]
])


<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="text fw-bold">
                        @lang('size_edit')
                    </h4>
                    <a href="{{ route('sizes.index') }}" class="btn btn-sm btn-dark align-self-center">
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
                <form action="{{ route('sizes.update', $size) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="name_en" class="form-label fw-bold">@lang('size_name_en')</label>
                        <input type="text" name="name_en" value="{{ $size->name_en }}" id="name_en" class="form-control"
                            placeholder="@lang('enter_size_name_en')">

                        @error('name_en')
                        <div class="text-danger pt-1 mx-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="name_mm" class="form-label fw-bold">@lang('size_name_mm')</label>
                        <input type="text" name="name_mm" value="{{ $size->name_mm }}" id="name_mm" class="form-control"
                            placeholder="@lang('enter_size_name_mm')">

                        @error('name_mm')
                        <div class="text-danger pt-1 mx-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="size_code" class="form-label fw-bold">@lang('size_code')</label>
                        <input type="size" name="size_code" value="{{ $size->size_code }}" id="size_code" class="form-control form-control-size"
                            placeholder="@lang('enter_size_size_code')">

                        @error('size_code')
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
