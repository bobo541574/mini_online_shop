@extends('layouts.app')

@section('content')

<div class="row my-3 justify-content-center">
    <div class="col-md-8">
        <div class="card border">
            <div class="card-body">
                @include('front.shared._breadcurmb', [
                    'items' => [
                        'product' => route('front.product.attributes', $cart->attribute->product),
                        'cart' => ''
                    ]
                ])
                <div class="row">
                    <div id="preview-{{ $cart->attribute->id }}" class="preview col-md-4">
                        <div class="row text-center">
                            <div class="preview-pic tab-content">
                                @foreach ($cart->attribute->photos as $key => $photo)
                                <div class="tab-pane {{ $loop->first ? 'active' : '' }}"
                                    id="pic-{{ $key }}-{{ $cart->attribute->id }}"><img src="{{ asset($photo) }}" class="w-75" />
                                </div>
                                @endforeach
                            </div>
                            <ul class="preview-thumbnail nav nav-tabs">
                                @foreach ($cart->attribute->photos as $key => $photo)
                                <li><a data-bs-target="#pic-{{ $key }}-{{ $cart->attribute->id }}" data-bs-toggle="tab"><img
                                            src="{{ asset($photo) }}" /></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-8 mx-auto">
                        <div id="property-{{ $cart->attribute->id }}" class="property">
                            <div class="fs-4 fw-bolder mb-1">{{ $cart->attribute->product->name }}</div>
                            <hr class="border border-b-2 border-dark" />
        
                            <div class="row mb-3 col-md-12">
                                <div class="col-3">
                                    <span class="fw-bold">@lang('cat'): </span>
                                </div>
                                <div class="col-9">
                                    <span class="fw-bold">{{ $cart->attribute->product->category->name }} / </span>
                                    <span class="fw-bold">{{ $cart->attribute->product->subcategory->name }}</span>
                                </div>
                            </div>
                            <div class="row mb-3 col-md-12">
                                <div class="col-3">
                                    <span class="fw-bold">@lang('brd'): </span>
                                </div>
                                <div class="col-9">
                                    <span class="fw-bold">{{ $cart->attribute->product->brand->name }} </span>
                                </div>
                            </div>
                            <div class="row mb-3 col-md-12">
                                <div class="col-3">
                                    <span class="fw-bold">@lang('attribute_sale_price'): </span>
                                </div>
                                <div class="col-9">
                                    <span class="fw-bold">{{ $cart->attribute->sale }} </span>
                                </div>
                            </div>
                            <div class="row mb-3 col-md-12">
                                <div class="col-3">
                                    <span class="fw-bold">@lang('attribute_delivery_cost'): </span>
                                </div>
                                <div class="col-9">
                                    <span class="fw-bold">{{ $cart->attribute->delivery }} </span>
                                </div>
                            </div>
                            <div class="row mb-3 col-md-12">
                                <div class="col-3">
                                    <span class="fw-bold">@lang('attribute_sku'): </span>
                                </div>
                                <div class="col-3">
                                    <input type="number" id="sku" value="{{ $cart->quantity }}"
                                        class="form-control form-control-sm" min="1" max="{{ $cart->attribute->sku }}">
                                </div>
                            </div>
                            <div class="row mb-3 col-md-12">
                                <div class="col-3">
                                    <span class="fw-bold">@lang('color') - @lang('size'): </span>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="color-size" value="{{ $cart->attribute->color->name }} - {{ $cart->attribute->size->name }}"
                                        class="form-control form-control-sm" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex col-12 mt-3">
                            <div class="col-6">
                                @auth
                                <form action="{{ route('front.orders.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="sku" id="buy-sku" value="{{ $cart->quantity }}">
                                    <input type="hidden" name="contact_id" id="buy-contact" value="{{ old('contact_id') }}">
                                    <input type="hidden" name="attribute_id" id="buy-attribute_id"
                                        value="{{ $cart->product_attribute_id }}">
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
    </div>
    @auth
        @include('front.products._info')
    @endauth
</div>

@endsection

@section('script')
    <script>
        let sku = document.querySelector(`#sku`);

        sku.addEventListener('change', () => {
            let buySku = document.querySelector('#buy-sku');
            buySku.value = sku.value;
        });

        // contact id add to buy & cart form
        function contactCheck(id) {
            let address = document.querySelector(`#address-${id}`);
            let buyAddress = document.querySelector(`#buy-contact`);

            if(address.checked) {
                buyAddress.value = address.value;
            } else {
                buyAddress.value = "";
            }
        }

        // get city list by state
        let state = document.querySelector('#state');
        
        state.addEventListener('change', () => {
            fetch(`/state/${state.value}/cities`)
            .then(res => res.json())
            .then(data => {
                let city = document.querySelector('#city');
                let html = "";
                
                html += `<option value="">@lang('select_citites')</option>`;
                data.forEach(city => {
                    html += `
                        <option value="${city['key']}" title="${city['name']}">${city['name']}</option>
                    `;
                })
                city.innerHTML = html;
            })
        })

        // get township list by city
        let city = document.querySelector('#city');

        city.addEventListener('change', () => {
            fetch(`/city/${city.value}/townships`)
            .then(res => res.json())
            .then(data => {
                let township = document.querySelector('#township');
                let html = "";
                
                html += `<option value="">@lang('select_townships')</option>`;
                data.forEach(township => {
                    html += `
                        <option value="${township['key']}" title="${township['name']}">${township['name']}</option>
                    `;
                })
                township.innerHTML = html;
            })
        })

    </script>
@endsection
