@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        @include('front.shared._carousel')
    </div>
</div>

<div class="col-md-10 offset-md-1">
    <div class="row mx-auto justify-content-center">
        <div class="col-md-3">
            
            @include('front.shared._categories')

            <div class="bg-theme mb-2 p-2 fs-4 fw-bold text-white rounded shadow">
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

            <div class="bg-theme mb-2 p-2 fs-4 fw-bold text-white rounded shadow">
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
            <div class="bg-theme mb-2 p-2 fs-4 fw-bold text-white rounded shadow">
                @lang('products')
            </div>
            <div class="col-md-9 mx-auto">
                <div class="row" id="products">
                    
                </div>
            </div>

            <div class="bg-theme mb-2 p-2 fs-4 fw-bold text-white rounded shadow">
                @lang('latest_products')
            </div>
            <div class="row mx-1 justify-content-center">
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

        // fetch all product
        function fetchProducts(url) {
            let currentUrl = url ?? '/products';
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
                let links = data.meta.links;
                let currentPage = data.meta.current_page;
                let lastPage = data.meta.last_page;
                let prevPageUrl = data.links.prev;
                let nextPageUrl = data.links.next;
                let products = data.data;
                let html = "";
                products.forEach(product => {
                    // let photo = JSON.parse(product.attribute.photo);
                    let photo = product.attribute.photo;
                    let slug = product.slug;
                    if(product.attribute) {
                        html += `
                            <div class="col-4">
                                <a href="/product/${slug}/attributes" class="card-link text-dark">
                                    <div class="card product-card">
                                        <img class="card-img-top w-75 mx-auto" src="${photo}"
                                            alt="product_${product.attribute.id}">
                                        <hr />
                                        <div class="card-body px-2 my-0 pt-0 pb-3 mt-0">
                                            <p class="text-lg fw-bolder mb-1"> ${product.name} </p>
                                            <div class="fw-bold my-1 small">
                                                <div>@lang('cat'): 
                                                    <span class="badge bg-info">${product.category.name}</span>  
                                                </div>
                                            </div><div class="fw-bold my-1 small">
                                                <div>@lang('subcat'): 
                                                    <span class="badge bg-info">${product.subcategory.name}</span>  
                                                </div>
                                            </div><div class="fw-bold my-1 small">
                                                <div>@lang('brd'): 
                                                    <span class="badge bg-info">${product.brand.name}</span>  
                                                </div>
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
                                        <a class="page-link text-theme text-decoration-none" href="javascript:void(0)" aria-label="Previous" onclick="fetchProducts('${prevPageUrl}')">
                                            <span aria-hidden="true">&lsaquo;</span>
                                        </a>
                                    </li>
                                `;
                                for (let i = 1; i < (links.length - 1); i++) {
                                    html += `
                                        <li class="page-item ${links[i].active ? "active" : "" }">
                                            <a class="page-link text-decoration-none ${links[i].active ? "" : "text-theme" }" href="javascript:void(0)" aria-label="Previous" onclick="fetchProducts('${links[i].url}')">
                                                <span aria-hidden="true">${trans(links[i].label)}</span>
                                            </a>
                                        </li>
                                    `;
                                }

                                html += `
                                    <li class="page-item ${currentPage == lastPage ? "disabled text-muted" : "" }">
                                        <a class="page-link text-theme text-decoration-none" href="javascript:void(0)" aria-label="Previous" onclick="fetchProducts('${nextPageUrl}')">
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

        // fetch all product by category
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
                let links = data.meta.links;
                let currentPage = data.meta.current_page;
                let lastPage = data.meta.last_page;
                let prevPageUrl = data.links.prev;
                let nextPageUrl = data.links.next;
                let products = data.data;
                let html = "";
                products.forEach(product => {
                    // let photo = JSON.parse(product.attribute.photo);
                    let photo = product.attribute.photo;
                    let slug = product.slug;
                    if(product.attribute) {
                        html += `
                            <div class="col-4">
                                <a href="/product/${slug}/attributes" class="card-link text-dark">
                                    <div class="card product-card">
                                        <img class="card-img-top w-75 mx-auto" src="${photo}"
                                            alt="product_${product.attribute.id}">
                                        <hr />
                                        <div class="card-body px-2 my-0 pt-0 pb-3 mt-0">
                                            <p class="text-lg fw-bolder mb-1"> ${product.name} </p>
                                            <div class="fw-bold my-1 small">
                                                <div>@lang('cat'): 
                                                    <span class="badge bg-info">${product.category.name}</span>  
                                                </div>
                                            </div><div class="fw-bold my-1 small">
                                                <div>@lang('subcat'): 
                                                    <span class="badge bg-info">${product.subcategory.name}</span>  
                                                </div>
                                            </div><div class="fw-bold my-1 small">
                                                <div>@lang('brd'): 
                                                    <span class="badge bg-info">${product.brand.name}</span>  
                                                </div>
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
                                        <a class="page-link text-theme text-decoration-none" href="javascript:void(0)" aria-label="Previous" onclick="fetchProductsByCategory('${prevPageUrl}')">
                                            <span aria-hidden="true">&lsaquo;</span>
                                        </a>
                                    </li>
                                `;
                                for (let i = 1; i < (links.length - 1); i++) {
                                    html += `
                                        <li class="page-item ${links[i].active ? "active" : "" }">
                                            <a class="page-link text-decoration-none ${links[i].active ? "" : "text-theme" }" href="javascript:void(0)" aria-label="Previous" onclick="fetchProductsByCategory('${links[i].url}')">
                                                <span aria-hidden="true">${trans(links[i].label)}</span>
                                            </a>
                                        </li>
                                    `;
                                }

                                html += `
                                    <li class="page-item ${currentPage == lastPage ? "disabled text-muted" : "" }">
                                        <a class="page-link text-theme text-decoration-none" href="javascript:void(0)" aria-label="Previous" onclick="fetchProductsByCategory('${nextPageUrl}')">
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
