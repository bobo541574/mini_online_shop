@extends('layouts.app')

@section('content')

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
                                            <a class="dropdown-item" href="#">{{ $subcategory->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div id="subcategories" style="position: absolute; width: 100%; z-index: 100;">
    
        </div>
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

        <div class="row mb-5">
            @foreach ($products as $product)
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
        </div>
    </div>
</div>

@endsection

@section('script')
    <script>
        
    </script>
@endsection
