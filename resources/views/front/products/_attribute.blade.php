<div class="card border">
    <div class="card-body">
        <div class="row">
            @foreach ($attributes as $attribute)
            <div id="preview-{{ $attribute->id }}" class="preview col-md-4 {{ $loop->first ? '' : 'd-none' }}">
                <div class="row text-center">
                    <div class="preview-pic tab-content">
                        @foreach ($attribute->photos as $key => $photo)
                        <div class="tab-pane {{ $loop->first ? 'active' : '' }}"
                            id="pic-{{ $key }}-{{ $attribute->id }}"><img src="{{ asset($photo) }}" class="w-75" />
                        </div>
                        @endforeach
                    </div>
                    <ul class="preview-thumbnail nav nav-tabs">
                        @foreach ($attribute->photos as $key => $photo)
                        <li><a data-bs-target="#pic-{{ $key }}-{{ $attribute->id }}" data-bs-toggle="tab"><img
                                    src="{{ asset($photo) }}" /></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
            <div class="col-md-8 mx-auto">
                @foreach ($attributes as $attribute)
                <div id="property-{{ $attribute->id }}" class="property {{ $loop->first ? '' : 'd-none' }}">
                    <div class="fs-4 fw-bolder mb-1">{{ $attribute->product->name }}</div>
                    <hr class="border border-b-2 border-dark" />

                    <div class="row mb-3 col-md-12">
                        <div class="col-3">
                            <span class="fw-bold">@lang('cat'): </span>
                        </div>
                        <div class="col-9">
                            <span class="fw-bold">{{ $attribute->product->category->name }} / </span>
                            <span class="fw-bold">{{ $attribute->product->subcategory->name }}</span>
                        </div>
                    </div>
                    <div class="row mb-3 col-md-12">
                        <div class="col-3">
                            <span class="fw-bold">@lang('brd'): </span>
                        </div>
                        <div class="col-9">
                            <span class="fw-bold">{{ $attribute->product->brand->name }} </span>
                        </div>
                    </div>
                    <div class="row mb-3 col-md-12">
                        <div class="col-3">
                            <span class="fw-bold">@lang('attribute_sale_price'): </span>
                        </div>
                        <div class="col-9">
                            <span class="fw-bold">{{ $attribute->sale }} </span>
                        </div>
                    </div>
                    <div class="row mb-3 col-md-12">
                        <div class="col-3">
                            <span class="fw-bold">@lang('attribute_delivery_cost'): </span>
                        </div>
                        <div class="col-9">
                            <span class="fw-bold">{{ $attribute->delivery }} </span>
                        </div>
                    </div>
                    <div class="row mb-3 col-md-12">
                        <div class="col-3">
                            <span class="fw-bold">@lang('attribute_sku'): </span>
                        </div>
                        <div class="col-3">
                            <input type="number" id="sku-{{ $attribute->id }}" value="{{ old('sku') }}"
                                class="form-control form-control-sm" min="1" max="{{ $attribute->sku }}">
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-md-7">
                    <select id="color-size" class="form-select color-size" aria-label="form-select-sm">
                        <option value="">@lang('color') - @lang('size')</option>
                        @foreach ($attributes as $attribute)
                        <option value="{{ $attribute->id }}"
                            {{ (old('attribute_id') == $attribute->id) ? 'selected=selected' : '' }}>
                            {{ $attribute->color->name }} - {{ $attribute->size->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex col-12 mt-3">
                    <div class="col-6">
                        <form action="" method="post">
                            @csrf
                            <input type="hidden" name="sku" id="cart-sku" value="{{ old('sku') }}">
                            <input type="hidden" name="contact_id" id="cart-contact" value="{{ old('contact_id') }}">
                            <input type="hidden" name="attribute_id" id="cart-attribute_id"
                                value="{{ old('attribute') }}">
                            <button class="btn btn-sm bg-theme rounded text-light"><i class="fa fa-shopping-cart fs-5"
                                    aria-hidden="true">&nbsp; @lang('add-to-cart')</i></button>
                        </form>
                    </div>
                    <div class="col-6">
                        @auth
                        <form action="{{ route('front.orders.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="sku" id="buy-sku" value="{{ old('sku') }}">
                            <input type="hidden" name="contact_id" id="buy-contact" value="{{ old('contact_id') }}">
                            <input type="hidden" name="attribute_id" id="buy-attribute_id"
                                value="{{ old('attribute_id') }}">
                            <button class="btn btn-sm bg-success rounded text-light"><i
                                    class="fa fa-shopping-basket fs-5" aria-hidden="true">&nbsp;
                                    @lang('buy-now')</i></button>
                        </form>
                        @else
                        <a href="{{ route('login') }}" class="btn btn-sm bg-success rounded text-light"><i
                                class="fa fa-shopping-basket fs-5" aria-hidden="true">&nbsp; @lang('buy-now')</i></a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
