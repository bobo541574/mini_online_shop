@extends('layouts.app')

@section('content')

<div class="row my-3 justify-content-center">
    <div class="col-md-7">
        <div class="card border">     
            <div class="card-body">
                <div class="row">
                    <div class="preview col-md-4 mx-auto">
                        <div class="row justify-content-around">
                            <div class="preview-pic tab-content">
                            @foreach ($attributes->first()->photos as $key => $photo)
                                <div class="tab-pane {{ $loop->first ? 'active' : '' }}" id="pic-{{ $key }}"><img src="{{ asset($photo) }}" class="w-75" /></div>
                            @endforeach
                            </div>
                            <ul class="preview-thumbnail nav nav-tabs">
                            @foreach ($attributes->first()->photos as $key => $photo)
                                <li><a data-bs-target="#pic-{{ $key }}" data-bs-toggle="tab"><img src="{{ asset($photo) }}" /></a></li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-7 mx-auto">
                        <div class="fs-4 fw-bolder mb-1">{{ $attributes->first()->product->name }}</div>
                        <hr class="border border-b-2 border-dark" />
                        <div class="badge bg-info fw-bold mb-2">
                            <span>@lang('cat'): </span>
                            <span class="">{{ $attributes->first()->product->category->name }} > </span>
                            <span class="">{{ $attributes->first()->product->subcategory->name }}</span>
                        </div>
                        <br />
                        <div class="badge bg-info fw-bold mb-2">
                            <span>@lang('brd'): </span>
                            <span class="">{{ $attributes->first()->product->brand->name }} </span>
                        </div>
                        <br />
                        <div class="badge bg-info fw-bold mb-3">
                            <span>@lang('attribute_sale_price'): </span>
                            <span class="">{{ $attributes->first()->sale_price }} </span>
                        </div>
                        <div class="row mb-3 col-md-12">
                            <label for="sku" class="form-label col-4 col-md-4">@lang('attribute_sku')</label>
                            <div class="col-3 col-md-3">
                                <input type="number" name="sku" class="form-control form-control-sm">
                            </div>
                        </div>

                        <div class="col-md-7">
                            <select id="color-size" class="form-select form-select-sm" aria-label="form-select-sm example">
                                <option selected>Open this select menu</option>
                                @foreach ($attributes as $attribute)
                                    {{-- <div class="row justify-content-around"> --}}
                                        {{-- @foreach ($attribute->photos as $photo)
                                            <img src="{{ asset($photo) }}" class="img-fluid" style="width: 15%" alt="attribute-{{ $attribute->id }}">
                                        @endforeach --}}
                                        <option value="1">{{ $attribute->color->name }} - {{ $attribute->size->name }}</option>
                                    {{-- </div> --}}
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border">
            <div class="card-body">
                <h4 class="card-title">Title</h4>
                <p class="card-text">Text</p>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script>
        $('#color-size').select2();
        let attributes = '{{ $attributes }}';
        console.log(attributes);
    </script>
@endsection
