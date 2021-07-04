@extends('admin.layouts.app')

@section('content')

@include('admin.layouts.breadcrumb', [
'items' => [
'product_table' => route('products.index'),
'create' => null
]
])

<div class="row">
    <div class="col-md-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="text fw-bold">
                        @lang('product_detail')
                    </h4>
                    <a href="{{ route('products.index') }}" class="btn btn-sm btn-dark align-self-center">
                        @lang('back')
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex align-middle">
                    <span class="text fw-bold badge bg-success">{{ $attributes->first()->product->name }} </span>
                    <span class="fw-bold"> - </span>
                    <span class="text fw-bold badge bg-success">{{ $attributes->first()->product->category->name }} </span>
                    <span class="fw-bold"> - </span>
                    <span class="text fw-bold badge bg-success">{{ $attributes->first()->product->subcategory->name }} </span>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="h5 fw-bold">
                                    @lang('photo')
                                </th>
                                <th class="h5 fw-bold">
                                    @lang('color')
                                </th>
                                <th class="h5 fw-bold">
                                    @lang('size')
                                </th>
                                <th class="h5 fw-bold">
                                    @lang('sku')
                                </th>
                                <th class="h5 fw-bold">
                                    @lang('buy_price')
                                </th>
                                <th class="h5 fw-bold">
                                    @lang('extra_cost')
                                </th>
                                <th class="h5 fw-bold">
                                    @lang('sale_price')
                                </th>
                                <th class="h5 fw-bold">
                                    @lang('action')
                                </th>
                            </tr>
                        </thead>
                        <tbody class="{{ session('locale') == 'mm' ? 'fw-bold' : null }}">
                            @foreach ($attributes as $attribute)
                            <tr>
                                <td>
                                    <img src="{{ asset($attribute->image) }}" class="mx-1" width="45" height="45" alt="product_photo">
                                </td>
                                <td>
                                    <input type="color" class="form-control-sm form-control-color border-0 bg-light" title="{{ $attribute->color->name }}" value="{{ $attribute->color->color_code }}">
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
                                    {{-- <div class="d-flex justify-content-around">
                                        <a href="{{ route('products.show', $product) }}" class=""
                                            title="@lang('product_show')">
                                            <div class="my-2">
                                                <i class="align-middle text-info" data-feather="eye"></i>
                                            </div>
                                        </a>

                                        <a href="{{ route('products.edit', $product) }}" class=""
                                            title="@lang('product_edit')">
                                            <div class="my-2">
                                                <i class="align-middle text-warning" data-feather="edit"></i>
                                            </div>
                                        </a>

                                        <form action="{{ route('products.to-trash', $product) }}" method="post"
                                            class="inline">
                                            @csrf
                                            @method('PUT')
                                            <button class="border-0 text-danger bg-light"
                                                title="@lang('product_remove')">
                                                <div class="my-2">
                                                    <i class="align-middle" data-feather="trash"></i>
                                                </div>
                                            </button>
                                        </form>
                                    </div> --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $attributes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
