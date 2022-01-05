@extends('layouts.app')

@section('content')

<div class="row my-3 justify-content-center">
    <div class="col-md-8">
        <div class="card border">
            <div class="card-body">
                @include('front.shared._breadcurmb', [
                    'items' => [
                        'product' => route('front.product.attributes', $order->attribute->product),
                        'order' => ''
                    ]
                ])

                <div class="row">
                    <div id="preview-{{ $order->attribute->id }}" class="preview col-md-4">
                        <div class="row text-center">
                            <div class="preview-pic tab-content">
                                @foreach ($order->attribute->images as $key => $image)
                                <div class="tab-pane {{ $loop->first ? 'active' : '' }}"
                                    id="pic-{{ $key }}-{{ $order->attribute->id }}"><img src="{{ asset($image->name) }}" class="w-75" />
                                </div>
                                @endforeach
                            </div>
                            <ul class="preview-thumbnail nav nav-tabs">
                                @foreach ($order->attribute->images as $key => $image)
                                <li><a data-bs-target="#pic-{{ $key }}-{{ $order->attribute->id }}" data-bs-toggle="tab"><img
                                            src="{{ asset($image->name) }}" /></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-8 mx-auto">
                        <div id="property-{{ $order->attribute->id }}" class="property">
                            <div class="fs-4 fw-bolder mb-1">{{ $order->attribute->product->name }}</div>
                            <hr class="border border-b-2 border-dark" />
        
                            <div class="row mb-3 col-md-12">
                                <div class="col-3">
                                    <span class="fw-bold">@lang('cat'): </span>
                                </div>
                                <div class="col-9">
                                    <span class="fw-bold">{{ $order->attribute->product->category->name }} / </span>
                                    <span class="fw-bold">{{ $order->attribute->product->subcategory->name }}</span>
                                </div>
                            </div>
                            <div class="row mb-3 col-md-12">
                                <div class="col-3">
                                    <span class="fw-bold">@lang('brd'): </span>
                                </div>
                                <div class="col-9">
                                    <span class="fw-bold">{{ $order->attribute->product->brand->name }} </span>
                                </div>
                            </div>
                            <div class="row mb-3 col-md-12">
                                <div class="col-3">
                                    <span class="fw-bold">@lang('attribute_sale_price'): </span>
                                </div>
                                <div class="col-9">
                                    <span class="fw-bold">{{ $order->sale }} </span>
                                </div>
                            </div>
                            <div class="row mb-3 col-md-12">
                                <div class="col-3">
                                    <span class="fw-bold">@lang('attribute_delivery_cost'): </span>
                                </div>
                                <div class="col-9">
                                    <span class="fw-bold">{{ $order->delivery }} </span>
                                </div>
                            </div>
                            <div class="row mb-3 col-md-12">
                                <div class="col-3">
                                    <span class="fw-bold">@lang('attribute_sku'): </span>
                                </div>
                                <div class="col-3">
                                    <span class="fw-bold">{{ $order->quantity }}</span>
                                </div>
                            </div>
                            <div class="row mb-3 col-md-12">
                                <div class="col-3">
                                    <span class="fw-bold">@lang('total_cost'): </span>
                                </div>
                                <div class="col-3">
                                    <span class="fw-bold">{{ $order->total_cost }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border">
            <div class="card-body">
                <div class="fw-bold">
                    <p><span>@lang('name'): </span>&nbsp;{{ auth()->user()->name }}</p>
                    <p><span>@lang('email'): </span>&nbsp;{{ auth()->user()->email }}</p>
                    
                    @if ($order->transition)
                        <p><span>@lang('phone'): </span>&nbsp;{{ $order->contact->phone }}</p>
                        <p><span>@lang('address'): </span>&nbsp;{{ $order->contact->address }}</p>
                        <p><span>@lang('transition_name'): </span>&nbsp;{{ $order->transition->phone }}</p>
                        <p><span>@lang('transition_phone'): </span>&nbsp;{{ $order->transition->phone }}</p>
                    @if ($order->transition->code)
                        <p><span>@lang('transition_code'): </span>&nbsp;{{ $order->transition->code }}</p>
                    @else
                        <p><span>@lang('transition_photo'): </span></p>
                        <img src="{{ asset($order->transition->image) }}" class="w-100" alt="transition">
                    @endif
                </div>
                @else
                    {{-- Start - Contacts --}}
                    <form action="{{ route('front.orders.update', $order) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="my-1">
                            <small class="fw-bold text-danger">@lang('attribute_address_select_note')</small>
                        </div>
                        <div class="row border rounded mb-2 py-1">
                            @foreach (auth()->user()->contacts as $key => $contact)
                            <div class="d-flex pt-1 mb-1 justify-content-between">
                                <div class="row col-11">
                                    <label for="address-{{ $contact->id }}">@lang('phone'): &nbsp;{{ $contact->phone }}</label>
                                    <label for="address-{{ $contact->id }}">@lang('address')-@lang($key+1): &nbsp;{{ $contact->address }}</label>
                                </div>
                                <div class="col-1">
                                    <input type="checkbox" name="address" value="{{ $contact->id }}" id="address-{{ $contact->id }}" 
                                        {{ ($contact->id == $order->contact_id) ? 'checked=checked' : '' }} class="form-check-input">
                                </div>
                            </div>
                            @endforeach
                            <div class="my-2 text-center">
                                <button class="btn btn-sm rounded bg-theme text-light">@lang('update')</button>
                            </div>
                        </div>
                    </form>
                    {{-- End - Contacts --}}

                    {{-- Start - Create Contacts --}}
                    <form action="{{ route('front.users.store-contact') }}" method="post">
                        <div class="my-1">
                            <small class="fw-bold text-danger">@lang('attribute_address_create_note')</small>
                        </div>
                        <div class="row border rounded py-2 mb-3">
                            @csrf
                            <div class="mb-1">
                                <label for="phone" class="form-label">@lang('phone')</label>
                                <input type="text" name="phone" id="phone" value="" class="form-control form-control-sm"
                                    placeholder="@lang('enter_phone')">
                            </div>
                            <div class="mb-1">
                                <label for="home_street" class="form-label">@lang('home_street')</label>
                                <input type="text" name="home_street" id="home_street" value=""
                                    class="form-control form-control-sm" placeholder="@lang('enter_home_street')">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="state" class="form-label">@lang('state')</label>
                                <select id="state" name="state" class="form-select form-select-sm" aria-label="form-select-sm">
                                    <option value="">@lang('select_states')</option>
                                    @foreach ($states as $state)
                                    <option value="{{ $state['key'] }}"
                                        {{ (old('state') == $state['key']) ? 'selected=selected' : '' }}
                                        title="{{ $state['name'] }}">{{ $state['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="city" class="form-label">@lang('city')</label>
                                <select id="city" name="city" class="form-select form-select-sm" aria-label="form-select-sm">
                                    <option value="">@lang('select_citites')</option>
                                    {{-- @foreach ($states as $state)
                                        <option value="{{ $state['key'] }}"
                                    {{ (old('state') == $state['key']) ? 'selected=selected' : '' }}
                                    title="{{ $state['name'] }}">{{ $state['name'] }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="township" class="form-label">@lang('township')</label>
                                <select id="township" name="township" class="form-select form-select-sm"
                                    aria-label="form-select-sm">
                                    <option value="">@lang('select_townships')</option>
                                    {{-- @foreach ($states as $state)
                                        <option value="{{ $state['key'] }}"
                                    {{ (old('state') == $state['key']) ? 'selected=selected' : '' }}
                                    title="{{ $state['name'] }}">{{ $state['name'] }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
        
                            <div class="text-center">
                                <button class="btn btn-sm bg-theme text-light rounded">@lang('create')</button>
                            </div>
                        </div>
                    </form>
                    {{-- End - Create Contacts --}}

                    {{-- Start - Create Transition --}}
                    <form action="{{ route('front.transitions.store', $order) }}" method="post">
                        @csrf
                        <div class="row border rounded py-2">
                            <div class="mb-1">
                                <label for="transition_name" class="form-label">@lang('transition_name')</label>
                                <input type="text" name="name" id="transition_name" value="" class="form-control form-control-sm"
                                    placeholder="@lang('enter_transition_name')">
                            </div>
                            <div class="mb-1">
                                <label for="transition_phone" class="form-label">@lang('transition_phone')</label>
                                <input type="text" name="phone" id="transition_phone" value="" class="form-control form-control-sm"
                                    placeholder="@lang('enter_transition_phone')">
                            </div>
                            <div class="mb-1">
                                <label for="payment" class="form-label">@lang('payment')</label>
                                <select id="payment" name="payment" class="form-select form-select-sm" aria-label="form-select-sm">
                                    <option value="">@lang('select_payments')</option>
                                    @foreach ($payments as $payment)
                                    <option value="{{ $payment->id }}"
                                        {{ (old('payment') == $payment->id) ? 'selected=selected' : '' }}
                                        title="{{ $payment->name }} - {{ $payment->payment_type }}">{{ $payment->name }} - {{ $payment->payment_type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-1">
                                <label for="transition_code" class="form-label">@lang('transition_code')</label>
                                <input type="text" name="code" id="transition_code" value="" class="form-control form-control-sm"
                                    placeholder="@lang('enter_transition_code')">
                            </div>
                            <div class="my-1 text-center">
                                <small class="fw-bold text-theme">(@lang('or'))</small>
                            </div>
                            <div class="mb-2">
                                <label for="transition_photo" class="form-label">@lang('transition_photo')</label>
                                <input type="file" name="photo" id="transition_photo" value="" class="form-control form-control-sm"
                                    placeholder="@lang('enter_transition_photo')">
                            </div>
                            <div class="text-center">
                                <button class="btn btn-sm bg-theme text-light rounded">@lang('checkout')</button>
                            </div>
                        </div>
                    </form>
                    {{-- End - Create Transition --}}
                @endif
            </div>
        </div>
    </div>    
</div>

@endsection

@section('script')
    <script>
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
