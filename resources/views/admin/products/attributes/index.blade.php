@extends('admin.layouts.app')

@section('content')

@include('admin.layouts.breadcrumb', [
'items' => [
        'attribute' => route('attributes.index'),
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
                        <a href="{{ route('attributes.trashed') }}" class="btn btn-sm btn-secondary align-self-center">
                            @lang('trashed')
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
                        <tbody class="{{ session('locale') == 'mm' ? 'fw-bold' : null }}">
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
                                    <div class="d-flex justify-content-around">
                                        <a href="{{ route('attributes.show', $attribute) }}" class=""
                                            title="@lang('attribute_detail')">
                                            <div class="my-2">
                                                <i class="align-middle text-info" data-feather="eye"></i>
                                            </div>
                                        </a>

                                        <a href="{{ route('attributes.edit', $attribute) }}" class=""
                                            title="@lang('attribute_edit')">
                                            <div class="my-2">
                                                <i class="align-middle text-warning" data-feather="edit"></i>
                                            </div>
                                        </a>

                                        <form action="{{ route('attributes.remove', $attribute) }}" method="post"
                                            class="inline">
                                            @csrf
                                            @method('PUT')
                                            <button class="border-0 text-danger bg-light"
                                                title="@lang('attribute_remove')">
                                                <div class="my-2">
                                                    <i class="align-middle" data-feather="trash"></i>
                                                </div>
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
            </div>
        </div>
    </div>
</div>

@endsection
