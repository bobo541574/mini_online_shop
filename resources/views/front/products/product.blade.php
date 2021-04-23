@extends('layouts.app')

@section('content')

<div class="row my-3 justify-content-center">
    <div class="col-md-8">
        @include('front.products._attribute')
    </div>
    @auth
        @include('front.products._info')
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
