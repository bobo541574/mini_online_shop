<form action="{{ route('products.index') }}" method="GET" class="d-none d-sm-inline-block">
    <div class="d-flex justify-content-around">
        <div class="col-2">
            <input type="text" name="product" value="{{ request('product') }}" class="form-control" placeholder="@lang('product')…" aria-label="Product">
        </div>
        
        <div class="col-2">
            <input type="text" name="category" value="{{ request('category') }}" class="form-control" placeholder="@lang('category')…" aria-label="Category">
        </div>
        
        <div class="col-2">
            <input type="text" name="subcategory" value="{{ request('subcategory') }}" class="form-control" placeholder="@lang('subcategory')…" aria-label="Subcategory">
        </div>

        <div class="col-2">
            <input type="text" name="brand" value="{{ request('brand') }}" class="form-control" placeholder="@lang('brand')…" aria-label="Brand">
        </div>

        <button class="btn btn-success text-theme col-2" type="submit"> 
            <i class="align-middle text-white" data-feather="search"></i>
            @lang('search')
        </button>
    </div>
</form>