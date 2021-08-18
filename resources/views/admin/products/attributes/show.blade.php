@extends('admin.layouts.app')

@section('content')
    @include('admin.layouts.breadcrumb', [
        'items' => [
            'attribute_table' => route('attributes.index'),
            'detail' => null
        ]
    ])

    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="text fw-bold">
                            @lang('attribute_detail')
                        </h4>
                        <a href="{{ route('attributes.product', $attribute->product->slug) }}" class="btn btn-sm btn-dark align-self-center">
                            @lang('back')
                        </a>
                    </div>
                </div>
                <div class="card-body bg-light">
                    <h5 class="mb-4 fw-bolder">{{ $attribute->product->name }}</h5>
                    <div class="row justify-content-around">
                        @foreach ($attribute->images as $image)
                            <img src="{{ asset($image->image_name) }}" alt="attribute_photo" style="width: 20%!important;">
                        @endforeach

                    </div>
                    <hr class="border border-dark">
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center shadow-lg">
                                <div class="card-body">
                                    <h5 class="fw-bold">@lang('attribute_color')</h5>
                                    {{ $attribute->color->name }}
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center shadow-lg">
                                <div class="card-body">
                                    <h5 class="fw-bold">@lang('attribute_size')</h5>
                                    {{ $attribute->size->name }}
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center shadow-lg">
                                <div class="card-body">
                                    <h5 class="fw-bold">@lang('attribute_sku')</h5>
                                    {{ $attribute->sku }}
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center shadow-lg">
                                <div class="card-body">
                                    <h5 class="fw-bold">@lang('attribute_buy_price')</h5>
                                    {{ $attribute->buy_price }}
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center shadow-lg">
                                <div class="card-body">
                                    <h5 class="fw-bold">@lang('attribute_extra_cost')</h5>
                                    {{ $attribute->extra_cost }}
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center shadow-lg">
                                <div class="card-body">
                                    <h5 class="fw-bold">@lang('attribute_sale_price')</h5>
                                    {{ $attribute->sale_price }}
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center shadow-lg">
                                <div class="card-body">
                                    <h5 class="fw-bold">@lang('attribute_arrived')</h5>
                                    {{ $attribute->arrived }}
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center shadow-lg">
                                <div class="card-body">
                                    <h5 class="fw-bold">@lang('attribute_promotion')</h5>
                                    {{ $attribute->promotion }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
