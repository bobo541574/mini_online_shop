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
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="fetchProductsByCategory('{{ route('front.subcategories.ajax', $subcategory) }}')">{{ $subcategory->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>