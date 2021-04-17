@extends('admin.layouts.app')

@section('content')

@include('admin.layouts.breadcrumb', [
    'items' => [
        'product' => ''
    ]
])

<div class="row">
    <div class="col-md-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="text fw-bold">
                        @lang('products')
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
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
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
                        <tbody class="{{ session('locale') == 'mm' ? 'fw-bold' : null }}">
                            @foreach ($products as $product)
                            <tr>
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
                                    <div class="d-flex justify-content-around">
                                        <a href="{{ route('attributes.create', $product) }}" class="" title="@lang('attribute_create')">
                                            <div class="my-2">
                                                <i class="align-middle text-info" data-feather="plus-circle"></i>
                                            </div>
                                        </a>

                                        @if ($product->productAttributes->count())  
                                            <a href="{{ route('attributes.index') }}" class="" title="@lang('attributes')">
                                                <div class="my-2">
                                                    <i class="align-middle text-info" data-feather="list"></i>
                                                </div>
                                            </a>
                                        @endif

    
                                        <a href="{{ route('products.edit', $product) }}" class="" title="@lang('product_edit')">
                                            <div class="my-2">
                                                <i class="align-middle text-warning" data-feather="edit"></i>
                                            </div>
                                        </a>
        
                                        <form action="{{ route('products.to-trash', $product) }}" method="post" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <button class="border-0 text-danger bg-light" title="@lang('product_remove')">
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

</script>
@endsection
