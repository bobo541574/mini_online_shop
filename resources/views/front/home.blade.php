@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        @include('front.shared._carousel')
    </div>
</div>

<div class="col-md-12">
    <div class="row">
        <div class="col-md-3">
            
            @include('front.shared._categories')

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
                                    @include('front.shared._card', [
                                        'product' => $product
                                    ])
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
                        @foreach ($popularProducts as $product)
                            @if ($product->attribute)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}" data-bs-interval="3000">
                                <div class="col-md-10 mx-auto">
                                    @include('front.shared._card', [
                                        'product' => $product
                                    ])
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
            <div class="row mx-1" id="products">
                {{-- @foreach ($products as $product)
                    @if ($product->attribute)
                    <div class="col-md-3">
                        @include('front.shared._card', [
                            'product' => $product
                        ])
                    </div>
                    @endif  
                @endforeach
                <div class="d-flex justify-content-center">
                    {{ $products->links() }}
                </div> --}}
            </div>

            <div class="bg-secondary mb-2 p-3 h4 fw-bold rounded shadow">
                @lang('latest_products')
            </div>
            <div class="row mx-1">
                @foreach ($latestProducts as $product)
                    @if ($product->attribute)
                    <div class="col-md-3">
                        @include('front.shared._card', [
                            'product' => $product
                        ])
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="row">

</div>

@endsection

@section('script')
    <script>

        fetchProducts();

        function fetchProducts(url) {
            let currentUrl = url ? `/products?page=${url}` : '/products';
            fetch(currentUrl, {
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json, text-plain, */*",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": token,
                    credentials: "same-origin",
                }
            })
            .then(res => res.json())
            .then(data => {
                let productsHtml = document.querySelector('#products');
                let links = data.links;
                let currentPage = data.current_page;
                let lastPage = data.last_page;
                let prevPageUrl = data.prev_page_url;
                let nextPageUrl = data.next_page_url;
                let products = data.data;
                let html = "";
                products.forEach(product => {
                    let photo = JSON.parse(product.attribute.photo);
                    if(product.attribute) {
                        html += `
                            <div class="col-md-3">
                                <a href="#" class="card-link text-dark">
                                    <div class="card product-card">
                                        <img class="card-img-top w-75 mx-auto" src="${photo[0]}"
                                            alt="product_${product.attribute.id}">
                                        <hr />
                                        <div class="card-body px-2 my-0 pt-0 pb-3 mt-0">
                                            <p class="text-lg fw-bolder mb-1"> ${product.name_mm} </p>
                                            <div class="badge bg-info fw-bold">
                                                <small>@lang('cat'): </small>
                                                <small class=""> ${product.category.name_mm}  > </small>
                                                <small class=""> ${product.subcategory.name_mm} </small>
                                            </div>
                                            <div class="badge bg-info fw-bold">
                                                <small>@lang('brd'): </small>
                                                <small class=""> ${product.brand.name_mm}  </small>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        `;
                    }
                })
                if (lastPage > 1) {
                    html += `
                        <div class="d-flex justify-content-center">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end mr-4">
                                `;

                                html += ` 
                                    <li class="page-item ${currentPage > 1 ? "" : " disabled text-muted" }">
                                        <a class="page-link text-theme" href="javascript:void(0)" aria-label="Previous" onclick="fetchProducts(${currentPage - 1})">
                                            <span aria-hidden="true">&lsaquo;</span>
                                        </a>
                                    </li>
                                `;
                                for (let i = 1; i < (links.length - 1); i++) {
                                    html += `
                                        <li class="page-item ${links[i].active ? "active" : "" }">
                                            <a class="page-link text-theme" href="javascript:void(0)" aria-label="Previous" onclick="fetchProducts(${i})">
                                                <span aria-hidden="true">${links[i].label }</span>
                                            </a>
                                        </li>
                                    `;
                                }

                                html += `
                                    <li class="page-item ${currentPage == lastPage ? "disabled text-muted" : "" }">
                                        <a class="page-link text-theme" href="javascript:void(0)" aria-label="Previous" onclick="fetchProducts(${currentPage + 1})">
                                            <span aria-hidden="true">&rsaquo;</span>
                                        </a>
                                    </li>
                                `;

                        html += `
                                </ul>
                            </nav>
                        </div>
                    `;
                    
                }
                productsHtml.innerHTML = html;
            })
        }

        function fetchProductsByCategory(url) {
            fetch(url, {
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json, text-plain, */*",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": token,
                    credentials: "same-origin",
                }
            })
            .then(res => res.json())
            .then(data => {
                let productsHtml = document.querySelector('#products');
                let links = data.links;
                let currentPage = data.current_page;
                let lastPage = data.last_page;
                let prevPageUrl = data.prev_page_url;
                // prevPageUrl = prevPageUrl.replace("http", "https")
                let nextPageUrl = data.next_page_url;
                // nextPageUrl = nextPageUrl.replace("http", "https");
                let products = data.data;
                let html = "";
                products.forEach(product => {
                    let photo = JSON.parse(product.attribute.photo);
                    if(product.attribute) {
                        html += `
                            <div class="col-md-3">
                                <a href="#" class="card-link text-dark">
                                    <div class="card product-card">
                                        <img class="card-img-top w-75 mx-auto" src="${photo[0]}"
                                            alt="product_${product.attribute.id}">
                                        <hr />
                                        <div class="card-body px-2 my-0 pt-0 pb-3 mt-0">
                                            <p class="text-lg fw-bolder mb-1"> ${product.name_mm} </p>
                                            <div class="badge bg-info fw-bold">
                                                <small>@lang('cat'): </small>
                                                <small class=""> ${product.category.name_mm}  > </small>
                                                <small class=""> ${product.subcategory.name_mm} </small>
                                            </div>
                                            <div class="badge bg-info fw-bold">
                                                <small>@lang('brd'): </small>
                                                <small class=""> ${product.brand.name_mm}  </small>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        `;
                    }
                })
                if (lastPage > 1) {
                    html += `
                        <div class="d-flex justify-content-center">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end mr-4">
                                `;

                                html += ` 
                                    <li class="page-item ${currentPage > 1 ? "" : " disabled text-muted" }">
                                        <a class="page-link text-theme" href="javascript:void(0)" aria-label="Previous" onclick="fetchProductsByCategory('${prevPageUrl}')">
                                            <span aria-hidden="true">&lsaquo;</span>
                                        </a>
                                    </li>
                                `;
                                for (let i = 1; i < (links.length - 1); i++) {
                                    html += `
                                        <li class="page-item ${links[i].active ? "active" : "" }">
                                            <a class="page-link text-theme" href="javascript:void(0)" aria-label="Previous" onclick="fetchProductsByCategory('${links[i].url}')">
                                                <span aria-hidden="true">${links[i].label }</span>
                                            </a>
                                        </li>
                                    `;
                                }

                                html += `
                                    <li class="page-item ${currentPage == lastPage ? "disabled text-muted" : "" }">
                                        <a class="page-link text-theme" href="javascript:void(0)" aria-label="Previous" onclick="fetchProductsByCategory('${nextPageUrl}')">
                                            <span aria-hidden="true">&rsaquo;</span>
                                        </a>
                                    </li>
                                `;

                        html += `
                                </ul>
                            </nav>
                        </div>
                    `;
                    
                }
                productsHtml.innerHTML = html;
            })
        }
    </script>
@endsection
