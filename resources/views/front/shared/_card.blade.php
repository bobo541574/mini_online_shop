<a href="#" class="card-link text-dark">
    <div class="card product-card">
        <img class="card-img-top w-75 mx-auto" src="{{ asset($product->attribute->image) }}"
            alt="product_{{ $product->attribute->id }}">
        <hr />
        <div class="card-body px-2 my-0 pt-0 pb-3 mt-0">
            <p class="text-lg fw-bolder mb-1">{{ $product->name }}</p>
            <div class="badge bg-info fw-bold">
                <small>@lang('cat'): </small>
                <small class="">{{ $product->category->name }} > </small>
                <small class="">{{ $product->subcategory->name }}</small>
            </div>
            <div class="badge bg-info fw-bold">
                <small>@lang('brd'): </small>
                <small class="">{{ $product->brand->name }} </small>
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
