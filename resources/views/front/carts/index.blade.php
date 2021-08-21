@extends('layouts.app')

@section('content')

<div class="row mt-3">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                @include('front.shared._breadcurmb', [
                    'items' => [
                        'carts' => ''
                    ]
                ])
                <div class="d-flex justify-content-between">
                    <h4 class="text fw-bold">
                        @lang('carts')
                    </h4>
                </div>
                @if (session('status'))
                <div class="alert alert-warning alert-dismissible mt-3 mb-0" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-message">
                        <strong>@lang(session('status'))</strong>
                    </div>
                </div>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-responsive table-striped table-hover">
                        <thead class="table-light">
                            <tr>
                                <th class="h5 fw-bold">
                                    @lang('name')
                                </th>
                                <th class="h5 fw-bold">
                                    @lang('attribute_photo')
                                </th>
                                <th class="h5 fw-bold">
                                    @lang('attribute_sku')
                                </th>
                                <th class="h5 fw-bold">
                                    @lang('color') - @lang('size')
                                </th>
                                <th class="h5 fw-bold">
                                    @lang('action')
                                </th>
                            </tr>
                        </thead>
                        <tbody class="{{ table_font_with_locale() }}">
                            @foreach ($carts as $cart)
                            <tr>
                                <td>
                                    {{ $cart->attribute->product->name }}
                                </td>
                                <td>
                                    <img src="{{ asset($cart->attribute->image) }}" class="avatar img-fluid" alt="order-logo">
                                </td>
                                <td>
                                    <span class="badge bg-theme">
                                        {{ $cart->qty }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-theme">
                                        @lang($cart->attribute->color->name) - @lang($cart->attribute->size->name)
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around my-2">

                                        <a href="{{ route('front.carts.show', $cart) }}" class="" title="@lang('cart_detail')">
                                            <i class="align-middle text-warning" data-feather="eye"></i>
                                        </a>

                                        <form action="{{ route('front.carts.destroy', $cart) }}" method="post" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="border-0 text-danger bg-light" title="@lang('cart_delete')">
                                                <i class="align-middle" data-feather="x"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>

</script>
@endsection
