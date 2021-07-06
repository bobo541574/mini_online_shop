@extends('layouts.app')

@section('content')

{{-- @include('admin.layouts.breadcrumb', [
    'items' => [
        'order' => ''
    ]
]) --}}

<div class="row mt-3">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                @include('front.shared._breadcurmb', [
                    'items' => [
                        'orders' => ''
                    ]
                ])
                <div class="d-flex justify-content-between">
                    <h4 class="text fw-bold">
                        @lang('orders')
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
                        <thead>
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
                                    @lang('status')
                                </th>
                                <th class="h5 fw-bold">
                                    @lang('status')
                                </th>
                                <th class="h5 fw-bold">
                                    @lang('action')
                                </th>
                            </tr>
                        </thead>
                        <tbody class="{{ session('locale') == 'mm' ? 'fw-bold' : null }}">
                            @foreach ($orders as $order)
                            <tr>
                                <td>
                                    {{ $order->attribute->product->name }}
                                </td>
                                <td>
                                    <img src="{{ asset($order->attribute->image) }}" class="avatar img-fluid" alt="order-logo">
                                </td>
                                <td>
                                    <span class="badge bg-theme">
                                        {{ $order->qty }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-theme">
                                        @lang($order->attribute->color->name) - @lang($order->attribute->size->name)
                                    </span>
                                </td>
                                <td>
                                    {{ $order->payment_status }}
                                </td>
                                <td>
                                    <span class="badge bg-danger">@lang($order->admin_approvement)</span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">

                                        <a href="{{ route('front.orders.show', $order) }}" class="" title="@lang('order_detail')">
                                            <div class="my-2">
                                                <i class="align-middle text-warning" data-feather="eye"></i>
                                            </div>
                                        </a>
                                        {{-- <a href="{{ route('orders.edit', $order) }}" class="" title="@lang('order_edit')">
                                            <div class="my-2">
                                                <i class="align-middle text-warning" data-feather="edit"></i>
                                            </div>
                                        </a> --}}
        
                                        <form action="{{ route('front.orders.to-trash', $order) }}" method="post" class="inline">
                                            @csrf
                                            <button class="border-0 text-danger bg-light" title="@lang('order_delete')">
                                                <div class="my-2">
                                                    <i class="align-middle" data-feather="x"></i>
                                                </div>
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
