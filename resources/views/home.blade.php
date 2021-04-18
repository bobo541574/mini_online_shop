@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div id="slider" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#slider" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#slider" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#slider" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="5000">
                        <img src="{{ asset('/img/slider/slide-1.jpg') }}" class="d-block w-100 rounded" alt="slid_1">
                        </div>
                        <div class="carousel-item" data-bs-interval="5000">
                        <img src="{{ asset('/img/slider/slide-1.jpg') }}" class="d-block w-100 rounded" alt="slid_1">
                        </div>
                        <div class="carousel-item" data-bs-interval="5000">
                        <img src="{{ asset('/img/slider/slide-1.jpg') }}" class="d-block w-100 rounded" alt="slid_1">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#slider" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#slider" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h4>@lang('categories')</h4>
                    <ul class="list-group pt-2">
                        @foreach ($categories as $category)
                            <li class="list-group-item list-group-item-action">
                                <a href="#" class="dropdown text-decoration-none" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="d-flex justify-content-between align-items-start text-dark">
                                        {{ $category->name }}
                                        <span class="badge bg-success rounded">@lang($category->subcategories->count())</span>
                                    </div>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        @foreach ($category->subcategories as $subcategory)
                                            <li>
                                                <a class="dropdown-item" href="{{ route('subcategories.products', $subcategory) }}">{{ $subcategory->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="bg-secondary mb-2 p-3 h4 fw-bold rounded shadow">
                @lang('admin_products')
            </div>
            <div class="row mx-1">
                <div id="admin_slider" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($adminProducts as $product)
                            @if ($product->attribute)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}" data-bs-interval="3000">
                                    <div class="col-md-10 mx-auto">
                                        <div class="card product-card">
                                            <img class="card-img-top w-75 mx-auto rounded" src="{{ asset($product->attribute->image) }}" alt="product_{{ $product->attribute->id }}">
                                            <hr />
                                            <div class="card-body px-2 pt-0 pb-3">
                                                <p class="text-lg fw-bolder">{{ $product->name }}</p>
                                                <small class="badge bg-info">{{ $product->category->name }}</small>
                                                <small class="badge bg-info">{{ $product->subcategory->name }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="bg-secondary mb-2 p-3 h4 fw-bold rounded shadow">
                @lang('popular_products')
            </div>
            <div class="row mx-1">
                <div id="popular_slider" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($adminProducts as $product)
                            @if ($product->attribute)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}" data-bs-interval="3000">
                                    <div class="col-md-10 mx-auto">
                                        <div class="card product-card">
                                            <img class="card-img-top w-75 mx-auto" src="{{ asset($product->attribute->image) }}" alt="product_{{ $product->attribute->id }}">
                                            <hr />
                                            <div class="card-body px-2 pt-0 pb-3">
                                                <p class="text-lg fw-bolder">{{ $product->name }}</p>
                                                <small class="badge bg-info">{{ $product->category->name }}</small>
                                                <small class="badge bg-info">{{ $product->subcategory->name }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="bg-secondary mb-2 p-3 h4 fw-bold rounded shadow">
                @lang('products')
            </div>
            <div class="row mx-1">
                @foreach ($products as $product)
                    @if ($product->attribute)
                        <div class="col-md-3">
                            <div class="card product-card">
                                <img class="card-img-top w-75 mx-auto" src="{{ asset($product->attribute->image) }}" alt="product_{{ $product->attribute->id }}">
                                <hr />
                                <div class="card-body px-2 pt-0 mb-0 pb-2">
                                    <p class="text-lg fw-bolder mb-0">{{ $product->name }}</p>
                                    <small class="badge bg-info">{{ $product->category->name }}</small>
                                    <small class="badge bg-info">{{ $product->subcategory->name }}</small>
                                </div>
                                <div class="d-flex justify-content-around mb-2">
                                    <a href="{{ route('products.add-to-cart', $product) }}" class="text-theme">
                                        <i class="fa fa-shopping-cart fs-3" aria-hidden="true"></i>
                                    </a>
                                    <a href="#" class="text-theme">
                                        <i class="fa fa-shopping-basket fs-3" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                <div class="d-flex justify-content-center">
                    {{ $products->links() }}
                </div>
            </div>

            <div class="bg-secondary mb-2 p-3 h4 fw-bold rounded shadow">
                @lang('latest_products')
            </div>
            <div class="row mx-1">
                @foreach ($latestProducts as $product)
                    @if ($product->attribute)
                        <div class="col-md-3">
                            <div class="card product-card">
                                <img class="card-img-top w-75 mx-auto" src="{{ asset($product->attribute->image) }}" alt="product_{{ $product->attribute->id }}">
                                <hr />
                                <div class="card-body px-2 pt-0 pb-3">
                                    <p class="text-lg fw-bolder">{{ $product->name }}</p>
                                    <small class="badge bg-info">{{ $product->category->name }}</small>
                                    <small class="badge bg-info">{{ $product->subcategory->name }}</small>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        
            {{-- <div class="bg-secondary mb-2 p-3 h4 fw-bold rounded shadow">
                @lang('popular_products')
            </div>
            <div class="row mx-1">
                @foreach ($popularProducts as $product)
                    @if ($product->attribute)
                        <div class="col-md-3">
                            <div class="card">
                                <img class="card-img-top w-75 mx-auto" src="{{ asset($product->attribute->image) }}" alt="product_{{ $product->attribute->id }}">
                                <hr />
                                <div class="card-body px-2 pt-0 pb-3">
                                    <p class="text-lg fw-bolder">{{ $product->name }}</p>
                                    <small class="badge bg-info">{{ $product->category->name }}</small>
                                    <small class="badge bg-info">{{ $product->subcategory->name }}</small>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div> --}}
        
            
        </div>
    </div>
</div>

<div class="row">

</div>

@endsection

@section('script')
    <script>
        
    </script>
@endsection
