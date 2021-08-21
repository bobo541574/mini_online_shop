@extends('admin.layouts.app')

@section('content')

@include('admin.layouts.breadcrumb', [
'items' => [
        'attribute_table' => route('attributes.index'),
        'create' => null
    ]
])

<div class="row">
    <div class="col-md-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="text fw-bold">
                        @lang('attributes')
                    </h4>
                    <div>
                        <a href="{{ route('products.index') }}" class="btn btn-sm btn-dark align-self-center">
                            @lang('back')
                        </a>
                    </div>
                </div>
                @if (session('status'))
                <div class="alert alert-warning alert-dismissible mt-3 mb-0" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-message">
                        <strong>@lang(session('status'))</strong>
                    </div>
                </div>
                @endif
            </div>
            <div class="card-body">
                @if ($attributes->count() > 0)
                    <div class="d-flex align-middle">
                        <span class="text fw-bold badge bg-success">{{ $attributes->first()->product->name }} </span>
                        <span class="fw-bold"> - </span>
                        <span class="text fw-bold badge bg-success">{{ $attributes->first()->product->category->name }} </span>
                        <span class="fw-bold"> - </span>
                        <span class="text fw-bold badge bg-success">{{ $attributes->first()->product->subcategory->name }} </span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th class="h5 fw-bold">
                                        @lang('attribute_photo')
                                    </th>
                                    <th class="h5 fw-bold">
                                        @lang('attribute_color')
                                    </th>
                                    <th class="h5 fw-bold">
                                        @lang('attribute_size')
                                    </th>
                                    <th class="h5 fw-bold">
                                        @lang('attribute_sku')
                                    </th>
                                    <th class="h5 fw-bold">
                                        @lang('attribute_buy_price')
                                    </th>
                                    <th class="h5 fw-bold">
                                        @lang('attribute_extra_cost')
                                    </th>
                                    <th class="h5 fw-bold">
                                        @lang('attribute_sale_price')
                                    </th>
                                    <th class="h5 fw-bold">
                                        @lang('action')
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="{{ table_font_with_locale() }}">
                                @foreach ($attributes as $attribute)
                                <tr>
                                    <td>
                                        <img src="{{ asset($attribute->image) }}" class="mx-1" width="45" height="45" alt="attribute_photo">
                                    </td>
                                    <td>
                                        <div class="border border-1 rounded" title="{{ $attribute->color->name }}" style="width: 50px; height: 25px; background: {{ $attribute->color->color_code }}; cursor: pointer;">

                                        </div>
                                        {{-- <input type="color" class="form-control-sm form-control-color border-0 bg-light" title="{{ $attribute->color->name }}" value="{{ $attribute->color->color_code }}"> --}}
                                    </td>
                                    <td>
                                        {{ $attribute->size->name }}
                                    </td>
                                    <td>
                                        {{ $attribute->sku }}
                                    </td>
                                    <td>
                                        {{ $attribute->buy_price }}
                                    </td>
                                    <td>
                                        {{ $attribute->extra_cost }}
                                    </td>
                                    <td>
                                        {{ $attribute->sale_price }}
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-around my-2">
                                            <form action="{{ route('attributes.restore', $attribute) }}" method="post" class="inline">
                                                @csrf
                                                <button class="border-0 text-danger bg-light" title="@lang('attribute_restore')">
                                                    <i class="align-middle" data-feather="refresh-cw"></i>
                                                </button>
                                            </form>

                                            <form action="{{ route('attributes.destroy', $attribute) }}" method="post"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="border-0 text-danger bg-light"
                                                    title="@lang('attribute_delete')">
                                                    <i class="align-middle" data-feather="trash-2"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $attributes->links() }}
                        </div>
                    </div>
                @else
                    <div class="text-center fw-bold">
                        Noting To Show
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
