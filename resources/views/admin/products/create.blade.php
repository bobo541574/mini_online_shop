@extends('admin.layouts.app')

@section('content')

@include('admin.layouts.breadcrumb', [
    'items' => [
        'product_table' => route('products.index'),
        'create' => null
    ]
])

<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="text fw-bold">
                        @lang('product_create')
                    </h4>
                    <a href="{{ route('products.index') }}" class="btn btn-sm btn-dark align-self-center">
                        @lang('back')
                    </a>
                </div>
                @if (session('status'))
                    <div class="alert alert-warning alert-dismissible mt-3 mb-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <div class="alert-message">
                            <strong>{{ session('status') }}</strong>
                        </div>
                    </div>
                @endif
            </div>
            <div class="card-body">
                <form action="{{ route('products.store') }}" method="post">
                    @csrf

                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label for="name_en" class="form-label fw-bold">@lang('product_name_en')</label>
                            <input type="text" name="name_en" value="{{ old('name_en') }}" id="name_en" class="form-control"
                                placeholder="@lang('enter_product_name_en')">
    
                            @error('name_en')
                            <div class="text-danger pt-1 mx-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
    
                        <div class="mb-3 col-md-4">
                            <label for="name_mm" class="form-label fw-bold">@lang('product_name_mm')</label>
                            <input type="text" name="name_mm" value="{{ old('name_mm') }}" id="name_mm" class="form-control"
                                placeholder="@lang('enter_product_name_mm')">
                    
                            @error('name_mm')
                            <div class="text-danger pt-1 mx-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="supplier" class="form-label fw-bold">@lang('supplier')</label>
                            <select class="form-select" id="supplier" name="supplier" aria-label="Default select example">
                                <option value="">@lang('select_supplier')</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ (old('supplier') == $supplier->id) ? 'selected=selected' : ''}}>{{$supplier->name}}</option>
                                @endforeach
                            </select>
    
                            @error('supplier')
                            <div class="text-danger pt-1 mx-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label for="category" class="form-label fw-bold">@lang('category')</label>
                            <select class="form-select" id="category" name="category" aria-label="Default select example">
                                <option value="">@lang('select_category')</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ (old('category') == $category->id) ? 'selected=selected' : ''}}>{{$category->name}}</option>
                                @endforeach
                            </select>
    
                            @error('category')
                            <div class="text-danger pt-1 mx-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="subcategories" class="form-label fw-bold">@lang('subcategories')</label>
                            <select class="form-select" id="subcategory" name="subcategories" aria-label="Default select example">
                                <option value="">@lang('select_subcategory')</option>
                                {{-- @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ (old('brand') == $brand->id) ? 'selected=selected' : ''}}>{{$brand->name}}</option>
                                @endforeach --}}
                            </select>
    
                            @error('brand')
                            <div class="text-danger pt-1 mx-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="brands" class="form-label fw-bold">@lang('brands')</label>
                            <select class="form-select" id="brand" name="brands" aria-label="Default select example">
                                <option value="">@lang('select_brand')</option>
                                {{-- @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ (old('brand') == $brand->id) ? 'selected=selected' : ''}}>{{$brand->name}}</option>
                                @endforeach --}}
                            </select>
    
                            @error('brand')
                            <div class="text-danger pt-1 mx-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                
                    <div class="text-center">
                        <button class="btn btn btn-primary" type="submit">
                            @lang('create')
                        </button>
                    </div>  
                </form>
            </div>
        </div>
        
    </div>
</div>

@endsection

@section('script')
    <script>
        (() => {
            let locale = '{{ session('locale') }}';
            let category = document.querySelector('#category');
            let subcategory = document.querySelector('#subcategory');
            let brand = document.querySelector('#brand');

            findSubcategoriesById(category.value);
            findBrandsById(subcategory.value);
            category.addEventListener('change', () => {
                findSubcategoriesById(category.value);
            });
            subcategory.addEventListener('change', () => {
                findBrandsById(subcategory.value);
            });
        })();
        
        function findSubcategoriesById(parentId) {
            let html = "";

            if(parentId != "") {
                fetch(`/admin/products/${parentId}/subcategories`)
                .then(res => res.json())
                .then(result => {
                    html += `<option value=''>@lang('select_subcategory')</option>`;
                    result.forEach(subcategory => {
                        if(locale = 'mm') {
                            html += `<option value='${subcategory.id}'>${subcategory.name_mm}</option>`;
                        } else if(locale = 'en') {
                            html += `<option value='${subcategory.id}'>${subcategory.name_en}</option>`;
                        }
                    });
                    subcategory.innerHTML = html;
                })
            }
        }

        function findBrandsById(subcategoryId) {
            let html = "";

            if(subcategoryId != "") {
                fetch(`/admin/subcategory/${subcategoryId}/brands`)
                .then(res => res.json())
                .then(result => {
                    html += `<option value=''>@lang('select_brand')</option>`;
                    result.forEach(brand => {
                        if(locale = 'mm') {
                            html += `<option value='${brand.id}'>${brand.name_mm}</option>`;
                        } else if(locale = 'en') {
                            html += `<option value='${brand.id}'>${brand.name_en}</option>`;
                        }
                    });
                    brand.innerHTML = html;
                })
            }
        }
    </script>
@endsection