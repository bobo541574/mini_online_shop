@extends('admin.layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/dropzone/basic.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dropzone/dropzone.css') }}">
    <style>
        /* #color option:hover {
            background: goldenrod;
        } */
        .dz-preview .dz-image img{
            width: 100% !important;
            height: 100% !important;
            object-fit: cover;
        }
    </style>
@endsection
@section('content')

@include('admin.layouts.breadcrumb', [
    'items' => [
        'attribute_table' => route('attributes.index'),
        'edit' => null
    ]
])

<div class="row">
    <div class="col-md-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="text fw-bold">
                        @lang('attribute_edit')
                    </h4>
                    <a href="{{ route('attributes.product', $attribute->product->slug) }}" class="btn btn-sm btn-dark align-self-center">
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
                <form action="{{ route('attributes.update', $attribute) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <input type="hidden" name="product_id" value="{{ $attribute->product_id }}">
                        <input type="hidden" name="product_name" value="{{ $attribute->product->name_en }}">

                        <div class="mb-3 col-md-4">
                            <label for="color" class="form-label fw-bold">@lang('attribute_color')</label>

                            <select class="form-select" id="color" name="color" aria-label="Default select example" style="">
                                <option value="">@lang('select_attribute_color')</option>
                                @foreach ($colors as $color)
                                    <option value="{{ $color->id }}" {{ ($attribute->color_id == $color->id) ? 'selected=selected' : ''}}>
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
                                    <option value="{{ $size->id }}" {{ ($attribute->size_id == $size->id) ? 'selected=selected' : ''}}>{{$size->name}}</option>
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
                            <input type="number" name="sku" value="{{ $attribute->sku }}" id="sku" class="form-control"
                                placeholder="@lang('enter_attribute_sku')">

                            @error('sku')
                            <div class="text-danger pt-1 mx-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="buy_price" class="form-label fw-bold">@lang('attribute_buy_price')</label>
                            <input type="number" name="buy_price" value="{{ $attribute->buy_price }}" id="buy_price" class="form-control"
                                   placeholder="@lang('enter_attribute_buy_price')">

                            @error('buy_price')
                            <div class="text-danger pt-1 mx-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="extra_cost" class="form-label fw-bold">@lang('attribute_extra_cost')</label>
                            <input type="number" name="extra_cost" value="{{ $attribute->extra_cost }}" id="extra_cost" class="form-control"
                                   placeholder="@lang('enter_attribute_extra_cost')">

                            @error('extra_cost')
                            <div class="text-danger pt-1 mx-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="sale_price" class="form-label fw-bold">@lang('attribute_sale_price')</label>
                            <input type="number" name="sale_price" value="{{ $attribute->sale_price }}" id="sale_price" class="form-control"
                                   placeholder="@lang('enter_attribute_sale_price')">

                            @error('sale_price')
                            <div class="text-danger pt-1 mx-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="description_en" class="form-label fw-bold">@lang('attribute_description_en')</label>
                            <textarea name="description_en" id="description_en" rows="5" class="form-control"
                                      placeholder="@lang('enter_attribute_description_en')">{{ $attribute->description_en }}</textarea>

                            @error('description_en')
                            <div class="text-danger pt-1 mx-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="description_mm" class="form-label fw-bold">@lang('attribute_description_mm')</label>
                            <textarea name="description_mm" id="description_mm" rows="5" class="form-control"
                                      placeholder="@lang('enter_attribute_description_mm')">{{ $attribute->description_mm }}</textarea>

                            @error('description_mm')
                            <div class="text-danger pt-1 mx-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-12">
                            <label for="photo" class="form-label fw-bold">@lang('attribute_photo')</label>
                            <div class="row dropzone rounded border-1 justify-content-between" id="attributeImages">

                            </div>
                            @error('photo')
                            <div class="text-danger pt-1 mx-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>


                    <div class="row justify-content-between">
                        <div class="mb-3 col-md-4">
                            <label for="arrived" class="form-label fw-bold">@lang('attribute_arrived')</label>
                            <input type="date" name="arrived" value="{{ $attribute->arrived }}" id="arrived" class="form-control"
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
                            @lang('update')
                        </button>
                    </div>

                    @foreach($attribute->images as $image)
                        <input type="hidden" name="photo[]" value="{{ $image->name }}">
                     @endforeach
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
            init: function() {
                showPhoto = this;
                $.ajax({
                    url: "{{ route('attributes.show-photos', $attribute->id) }}",
                    type: 'post',
                    data: {request: 'fetch'},
                    dataType: 'json',
                    headers: {
                        "X-CSRF-TOKEN": token,
                    },
                    success: function(response){
                        $.each(response, function(key,value) {
                            let mockFile = { name: value.name, size: 50000};
                            showPhoto.emit("addedfile", mockFile);
                            showPhoto.emit("thumbnail", mockFile, `${storage_url}${value.name}`);
                            {
                                $('[data-dz-thumbnail]').css('height', '100%');
                                $('[data-dz-thumbnail]').css('width', '100%');
                                $('[data-dz-thumbnail]').css('object-fit', 'cover');
                            };
                            showPhoto.emit("complete", mockFile);
                            // showPhoto.getElementsByTagName('a')[index].setAttribute('data-id', img.id)
                            //
                            //
                            // var mockFile = { name: img.image, size: 50000};
                            // fireProposalImageDropzone.emit("addedfile", mockFile);
                            // fireProposalImageDropzone.emit("thumbnail", mockFile, `${storage_url}${img.image}`);
                            // {
                            //     $('[data-dz-thumbnail]').css('height', '100%');
                            //     $('[data-dz-thumbnail]').css('width', '100%');
                            //     $('[data-dz-thumbnail]').css('object-fit', 'cover');
                            // };
                            // fireProposalImageDropzone.emit("complete", mockFile);
                            // fireProposalImage.getElementsByTagName('a')[index].setAttribute('data-id', img.id)
                        });
                    }
                });
            },
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
