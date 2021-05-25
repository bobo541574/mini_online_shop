<a href="{{ route('front.product.attributes', $product) }}" class="card-link text-dark">
    <div class="card product-card">
        <img class="card-img-top w-75 mx-auto" src="{{ asset($product->attribute->image) }}"
            alt="product_{{ $product->attribute->id }}">
        <hr />
        <div class="card-body px-2 my-0 pt-0 pb-3 mt-0">
            <p class="text-lg fw-bolder mb-1">{{ $product->name }}</p>
            <div class="fw-bold my-1 small">
                <div>@lang('cat'): 
                    <span class="badge bg-info">{{ $product->category->name }}</span>  
                </div>
            </div>
            <div class="fw-bold my-1 small">
                <div>@lang('subcat'): 
                    <span class="badge bg-info">{{ $product->subcategory->name }}</span>  
                </div>
            </div>
            <div class="fw-bold my-1 small">
                <div>@lang('brand'): 
                    <span class="badge bg-info">{{ $product->brand->name }}</span>  
                </div>
            </div>
        </div>
        {{-- <div class="d-flex justify-content-around mb-2">
            <a href="{{ route('products.add-to-cart', $product) }}" class="text-theme">
                <i class="fa fa-shopping-cart fs-3" aria-hidden="true"></i>
            </a>
            <a href="#" class="text-theme">
                <i class="fa fa-shopping-basket fs-3" aria-hidden="true"></i>
            </a>
        </div> --}}
    </div>
</a>
