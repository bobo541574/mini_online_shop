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

        {{-- <div class="col-2">
            <input type="text" name="brand" value="{{ request('brand') }}" class="form-control" placeholder="@lang('brand')…" aria-label="Brand">
        </div> --}}
        <div class="col-2">
            <select class="form-select" id="brand" name="brand" aria-label="Default select example">
                <option value=""></option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}" {{ (request()->query('brand') == $brand->id) ? "selected=selected" : ""}}>{{$brand->name}}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success" type="submit">
            <i class="fa fa-search" aria-hidden="true"></i>
        </button>
    </div>
</form>
