@extends('layouts.app')

@section('content')

<div class="row my-3 justify-content-center">
    <div class="col-md-8">
        <div class="card border">     
            <div class="card-body">
                <div class="row">
                    @foreach ($attributes as $attribute)
                        <div id="preview-{{ $attribute->id }}" class="preview col-md-4 mx-auto {{ $loop->first ? '' : 'd-none' }}">
                            <div class="row justify-content-around">
                                <div class="preview-pic tab-content">
                                @foreach ($attribute->photos as $key => $photo)
                                    <div class="tab-pane {{ $loop->first ? 'active' : '' }}" id="pic-{{ $key }}-{{ $attribute->id }}"><img src="{{ asset($photo) }}" class="w-75" /></div>
                                @endforeach
                                </div>
                                <ul class="preview-thumbnail nav nav-tabs">
                                @foreach ($attribute->photos as $key => $photo)
                                    <li><a data-bs-target="#pic-{{ $key }}-{{ $attribute->id }}" data-bs-toggle="tab"><img src="{{ asset($photo) }}" /></a></li>
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
                                <div class="badge bg-info fw-bold mb-2">
                                    <span>@lang('cat'): </span>
                                    <span class="">{{ $attribute->product->category->name }} > </span>
                                    <span class="">{{ $attribute->product->subcategory->name }}</span>
                                </div>
                                <br />
                                <div class="badge bg-info fw-bold mb-2">
                                    <span>@lang('brd'): </span>
                                    <span class="">{{ $attribute->product->brand->name }} </span>
                                </div>
                                <br />
                                <div class="badge bg-info fw-bold mb-3">
                                    <span>@lang('attribute_sale_price'): </span>
                                    <span class="">{{ $attribute->sale_price }} </span>
                                </div>
                                <div class="row mb-3 col-md-12">
                                    <label for="sku" class="form-label col-4 col-md-4">@lang('attribute_sku')</label>
                                    <div class="col-3 col-md-3">
                                        <input type="number" id="sku-{{ $attribute->id }}" value="{{ old('sku') }}" class="form-control form-control-sm" min="1" max="{{ $attribute->sku }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-md-7">
                            <select id="color-size" class="form-select color-size" aria-label="form-select-sm">
                                <option value="">@lang('color') - @lang('size')</option>
                                @foreach ($attributes as $attribute)
                                    <option value="{{ $attribute->id }}" {{ (old('attribute_id') == $attribute->id) ? 'selected=selected' : '' }}>{{ $attribute->color->name }} - {{ $attribute->size->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex col-md-12 mt-3">
                            <div class="col-6 col-sm-3 col-md-5">
                                <form action="" method="post">
                                    @csrf
                                    <input type="hidden" name="sku" id="cart-sku" value="{{ old('sku') }}">
                                    <input type="hidden" name="contact_id" id="cart-contact" value="{{ old('contact_id') }}">
                                    <input type="hidden" name="attribute_id" id="cart-attribute_id" value="{{ old('attribute') }}">
                                    <button class="btn btn-sm bg-theme rounded text-light"><i class="fa fa-shopping-cart fs-5" aria-hidden="true">&nbsp; Add To Cart</i></button>
                                </form>
                            </div>
                            <div class="col-6 col-sm-3 col-md-5">
                                @auth
                                <form action="{{ route('front.order.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="sku" id="buy-sku" value="{{ old('sku') }}">
                                    <input type="hidden" name="contact_id" id="buy-contact" value="{{ old('contact_id') }}">
                                    <input type="hidden" name="attribute_id" id="buy-attribute_id" value="{{ old('attribute_id') }}">
                                    <button class="btn btn-sm bg-success rounded text-light"><i class="fa fa-shopping-basket fs-5" aria-hidden="true">&nbsp; Buy Now</i></button>
                                </form>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-sm bg-success rounded text-light"><i class="fa fa-shopping-basket fs-5" aria-hidden="true">&nbsp; Buy NowA</i></a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @auth
        <div class="col-md-4">
            <div class="card border">
                <div class="card-body">
                    <p><span>@lang('name'): </span>&nbsp;{{ auth()->user()->name }}</p>
                    <p><span>@lang('email'): </span>&nbsp;{{ auth()->user()->email }}</p>
                    @if (auth()->user()->contacts)
                    <div class="my-1">
                        <small class="text-danger">@lang('attribute_address_select_note')</small>
                    </div>
                    <div class="row border rounded mb-2 py-1">
                        @foreach (auth()->user()->contacts as $key => $contact)
                        <div class="d-flex pt-1">
                            <div class="row">
                                <span>@lang('phone'): &nbsp;{{ $contact->phone }}</span>
                                <span>@lang('address')-@lang($key+1): &nbsp;{{ $contact->address }}</span>
                            </div>
                            <input type="checkbox" name="address" value="{{ $contact->id }}" onchange="contactCheck({{ $contact->id }})" id="address-{{ $contact->id }}" class="form-check-input">
                        </div>
                        @endforeach
                    </div>
                    @endif
                    <form action="{{ route('front.contacts.store-user') }}" method="post">
                        <div class="my-1">
                            <small class="text-danger">@lang('attribute_address_create_note')</small>
                        </div>
                        <div class="row border rounded py-2">
                            @csrf
                            <div class="mb-1">
                                <label for="phone" class="form-label">@lang('phone')</label>
                                <input type="text" name="phone" id="phone" value="" class="form-control form-control-sm" placeholder="@lang('enter_phone')">
                            </div>
                            <div class="mb-1">
                                <label for="home_street" class="form-label">@lang('home_street')</label>
                                <input type="text" name="home_street" id="home_street" value="" class="form-control form-control-sm" placeholder="@lang('enter_home_street')">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="state" class="form-label">@lang('state')</label>
                                <select id="state" name="state" class="form-select form-select-sm" aria-label="form-select-sm">
                                    <option value="">@lang('select_states')</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state['key'] }}" {{ (old('state') == $state['key']) ? 'selected=selected' : '' }} title="{{ $state['name'] }}">{{ $state['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="city" class="form-label">@lang('city')</label>
                                <select id="city" name="city" class="form-select form-select-sm" aria-label="form-select-sm">
                                    <option value="">@lang('select_citites')</option>
                                    {{-- @foreach ($states as $state)
                                        <option value="{{ $state['key'] }}" {{ (old('state') == $state['key']) ? 'selected=selected' : '' }} title="{{ $state['name'] }}">{{ $state['name'] }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="township" class="form-label">@lang('township')</label>
                                <select id="township" name="township" class="form-select form-select-sm" aria-label="form-select-sm">
                                    <option value="">@lang('select_townships')</option>
                                    {{-- @foreach ($states as $state)
                                        <option value="{{ $state['key'] }}" {{ (old('state') == $state['key']) ? 'selected=selected' : '' }} title="{{ $state['name'] }}">{{ $state['name'] }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
    
                            <div class="text-center">
                                <button class="btn btn-sm bg-theme text-light rounded">@lang('create')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endauth
</div>

@endsection

@section('script')
    <script>
        // $('.color-size').select2();
        let attribute = document.querySelector('#color-size');
        
        attribute.addEventListener('change', () => {
            let preview = document.querySelector(`#preview-${attribute.value}`);
            let previewNodes = document.querySelectorAll('.preview'); 
            let property = document.querySelector(`#property-${attribute.value}`);
            let propertyNodes = document.querySelectorAll('.property'); 

            previewNodes.forEach(node => {
                node.classList.add('d-none');
            })

            propertyNodes.forEach(node => {
                node.classList.add('d-none');
            })

            property.classList.remove('d-none');
            preview.classList.remove('d-none');

            let cartAttribute = document.querySelector('#cart-attribute_id');
            let buyAttribute = document.querySelector('#buy-attribute_id');

            cartAttribute.value = attribute.value;
            buyAttribute.value = attribute.value;

            let sku = document.querySelector(`#sku-${attribute.value}`);

            sku.addEventListener('change', () => {
                let cartSku = document.querySelector('#cart-sku');
                cartSku.value = sku.value;
                
                let buySku = document.querySelector('#buy-sku');
                buySku.value = sku.value;
            });
        });

        let buyAttribute = document.querySelector('#buy-attribute_id');
        let cartAttribute = document.querySelector('#cart-attribute_id');

        if(buyAttribute.value !== "" || cartAttribute.value !== "") {
            let sku = document.querySelector(`#sku-${buyAttribute.value}`);

            sku.addEventListener('click', () => {
                let cartSku = document.querySelector('#cart-sku');
                cartSku.value = sku.value;
                
                let buySku = document.querySelector('#buy-sku');
                buySku.value = sku.value;
            });
        }

        // contact id add to buy & cart form
        function contactCheck(id) {
            let address = document.querySelector(`#address-${id}`);
            let buyAddress = document.querySelector(`#buy-contact`);
            let cartAddress = document.querySelector(`#cart-contact`);

            if(address.checked) {
                buyAddress.value = address.value;
                cartAddress.value = address.value;
            } else {
                buyAddress.value = "";
                cartAddress.value = "";
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
