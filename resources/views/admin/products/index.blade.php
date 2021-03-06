@extends('admin.layouts.app')

{{-- @section('search')
    @include('admin.products._search')
@endsection --}}

@section('content')

@include('admin.layouts.breadcrumb', [
    'items' => [
        'product_table' => ''
    ]
])

<div class="row">
    <div class="col-md-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="text fw-bold">
                        @lang('product_table')
                    </h4>
                    <div>
                        <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary align-self-center">
                            @lang('create')
                        </a>
                        <a href="{{ route('products.trashed') }}" class="btn btn-sm btn-secondary align-self-center">
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

            <span class="mt-0 mb-3 border-bottom"></span>

            @include('admin.products._search')

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-light">
                            <tr>
                                <th class="h5 fw-bold">
                                    #
                                </th>
                                <th class="h5 fw-bold">
                                    @lang('name')
                                </th>
                                <th class="h5 fw-bold">
                                    @lang('category')
                                </th>
                                <th class="h5 fw-bold">
                                    @lang('subcategory')
                                </th>
                                <th class="h5 fw-bold">
                                    @lang('brand')
                                </th>
                                <th class="h5 fw-bold">
                                    @lang('action')
                                </th>
                            </tr>
                        </thead>
                        <tbody class="{{ table_font_with_locale() }}">
                            @foreach ($products as $key => $product)
                            <tr>
                                <td>
                                    {{ numberTranslate($products->firstItem() + $key) }}
                                </td>
                                <td>
                                    {{ $product->name }}
                                </td>
                                <td>
                                    {{ $product->category->name }}
                                </td>
                                <td>
                                    {{ $product->subcategory->name }}
                                </td>
                                <td>
                                    {{ $product->brand->name }}
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around my-2">
                                        <a href="{{ route('attributes.create', $product) }}" class="" title="@lang('attribute_create')">
                                            <i class="align-middle text-info" data-feather="plus-circle"></i>
                                        </a>

                                        {{-- @if ($product->productAttributes)
                                            <a href="{{ route('attributes.index') }}" class="" title="@lang('attributes')">
                                                <div class=">
                                                    <i class="align-middle text-info" data-feather="list"></i>
                                                </div>
                                            </a>
                                        @endif --}}
                                        @if ($product->productAttributes)
                                            <a href="{{ route('attributes.product', $product->slug) }}" class="" title="@lang('attributes')">
                                                <i class="align-middle text-info" data-feather="list"></i>
                                            </a>
                                        @endif


                                        <a href="{{ route('products.edit', $product) }}" class="" title="@lang('product_edit')">
                                            <i class="align-middle text-warning" data-feather="edit"></i>
                                        </a>

                                        <form action="{{ route('products.to-trash', $product) }}" method="post" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <button class="border-0 text-danger bg-light" title="@lang('product_remove')">
                                                <i class="align-middle" data-feather="trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $("#brand").select2({
                placeholder: "@lang('brand')"
            });
        });
    </script>
@endsection

