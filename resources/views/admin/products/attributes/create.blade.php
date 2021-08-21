@extends('admin.layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/dropzone/basic.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dropzone/dropzone.css') }}">
    <style>
        /* #color option:hover {
            background: goldenrod;
        } */
    </style>
@endsection
@section('content')

@include('admin.layouts.breadcrumb', [
    'items' => [
        'product_table' => route('products.index'),
        'attribute_table' => route('attributes.product', $product->slug),
        'create' => null
    ]
])

<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="text fw-bold">
                        @lang('attribute_create')
                    </h4>
                    <a href="{{ route('attributes.product', $product->slug) }}" class="btn btn-sm btn-dark align-self-center">
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
                <form action="{{ route('attributes.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="product_name" value="{{ $product->name_en }}">

                        <div class="mb-3 col-md-4">
                            <label for="color" class="form-label fw-bold">@lang('attribute_color')</label>

                            <select class="form-select" id="color" name="color" aria-label="Default select example" style="">
                                <option value="">@lang('select_attribute_color')</option>
                                @foreach ($colors as $color)
                                    <option value="{{ $color->id }}" {{ (old('color') == $color->id) ? 'selected=selected' : ''}}>
                                        {{$color->name}}
                                    </option>
                                @endforeach
                            </select>

                            @error('color')
                            <div class="text-danger pt-1 mx-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="size" class="form-label fw-bold">@lang('attribute_size')</label>
                            <select class="form-select" id="size" name="size" aria-label="Default select example">
                                <option value="">@lang('select_attribute_size')</option>
                                @foreach ($sizes as $size)
                                    <option value="{{ $size->id }}" {{ (old('size') == $size->id) ? 'selected=selected' : ''}}>{{$size->name}}</option>
                                @endforeach
                            </select>

                            @error('size')
                            <div class="text-danger pt-1 mx-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="sku" class="form-label fw-bold">@lang('attribute_sku')</label>
                            <input type="number" name="sku" value="{{ old('sku') }}" id="sku" class="form-control"
                                placeholder="@lang('enter_attribute_sku')">

                            @error('sku')
                            <div class="text-danger pt-1 mx-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label for="buy_price" class="form-label fw-bold">@lang('attribute_buy_price')</label>
                            <input type="number" name="buy_price" value="{{ old('buy_price') }}" id="buy_price" class="form-control"
                                placeholder="@lang('enter_attribute_buy_price')">

                            @error('buy_price')
                            <div class="text-danger pt-1 mx-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="extra_cost" class="form-label fw-bold">@lang('attribute_extra_cost')</label>
                            <input type="number" name="extra_cost" value="{{ old('extra_cost') }}" id="extra_cost" class="form-control"
                                placeholder="@lang('enter_attribute_extra_cost')">

                            @error('extra_cost')
                            <div class="text-danger pt-1 mx-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="sale_price" class="form-label fw-bold">@lang('attribute_sale_price')</label>
                            <input type="number" name="sale_price" value="{{ old('sale_price') }}" id="sale_price" class="form-control"
                                placeholder="@lang('enter_attribute_sale_price')">

                            @error('sale_price')
                            <div class="text-danger pt-1 mx-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="description_en" class="form-label fw-bold">@lang('attribute_description_en')</label>
                            <textarea name="description_en" id="description_en" rows="3" class="form-control"
                                placeholder="@lang('enter_attribute_description_en')">{{ old('description_en') }}</textarea>

                            @error('description_en')
                            <div class="text-danger pt-1 mx-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="description_mm" class="form-label fw-bold">@lang('attribute_description_mm')</label>
                            <textarea name="description_mm" id="description_mm" rows="3" class="form-control"
                                placeholder="@lang('enter_attribute_description_mm')">{{ old('description_mm') }}</textarea>

                            @error('description_mm')
                            <div class="text-danger pt-1 mx-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-12">
                            <label for="photo" class="form-label fw-bold">@lang('attribute_photo')</label>
                            <div class="dropzone rounded border-1" id="attributeImages">

                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-between">
                        {{--<div class="mb-3 col-md-4">
                            <label for="photo" class="form-label fw-bold">@lang('attribute_photo')</label>
                            <input type="file" name="photo[]" value="{{ old('photo') }}" id="photo" class="form-control"
                                placeholder="@lang('enter_attribute_photo')" multiple>

                            @error('photo')
                            <div class="text-danger pt-1 mx-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>--}}

                        <div class="mb-3 col-md-4">
                            <label for="arrived" class="form-label fw-bold">@lang('attribute_arrived')</label>
                            <input type="date" name="arrived" value="{{ old('arrived') }}" id="arrived" class="form-control"
                                placeholder="@lang('enter_attribute_arrived')">

                            @error('arrived')
                            <div class="text-danger pt-1 mx-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
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
    <script type="text/javascript" src="{{ asset('assets/dropzone/dropzone.js') }}"></script>
    <script>
        /* Image Upload To DO_Spaces */
        let uploadedDocumentMap = {};
        Dropzone.options.attributeImages = {
            url: '{{ route("attributes.upload-photos") }}',
            maxFilesize: 3, // MB
            maxFiles: 5,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 50000,
            headers: {
                "X-CSRF-TOKEN": token,
            },
            success: (file, response) => {
                $('form').append('<input type="hidden" name="photo[]" value="' + response.name + '">')
                uploadedDocumentMap[file.name] = response.name
            },
            removedfile: function (file) {
                let name = uploadedDocumentMap[file.name]
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    type: 'POST',
                    url: '{{ route("attributes.remove-photos") }}',
                    data: {filename: name},
                    success: function (data) {
                        console.log("File has been successfully removed!!");
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
                let fileRef;
                return (fileRef = file.previewElement) != null ?
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
            }
        };
    </script>
@endsection
