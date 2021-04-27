@extends('admin.layouts.app')

@section('content')

@include('admin.layouts.breadcrumb', [
    'items' => [
        'payment_table' => route('payments.index'),
        'create' => null
    ]
])


<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="text fw-bold">
                        @lang('payment_edit')
                    </h4>
                    <a href="{{ route('payments.index') }}" class="btn btn-sm btn-dark align-self-center">
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
                <form action="{{ route('payments.update', $payment) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name_en" class="form-label fw-bold">@lang('payment_name_en')</label>
                        <input type="text" name="name_en" value="{{ $payment->name_en }}" id="name_en" class="form-control"
                            placeholder="@lang('enter_payment_name_en')">

                        @error('name_en')
                        <div class="text-danger pt-1 mx-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="name_mm" class="form-label fw-bold">@lang('payment_name_mm')</label>
                        <input type="text" name="name_mm" value="{{ $payment->name_mm }}" id="name_mm" class="form-control"
                            placeholder="@lang('enter_payment_name_mm')">

                        @error('name_mm')
                        <div class="text-danger pt-1 mx-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="payment_type" class="form-label fw-bold">@lang('payment_type')</label>
                        <select class="form-select" id="payment_type" name="payment_type" aria-label="Default select example">
                            <option value="">@lang('select_payment')</option>
                            @foreach ($payment_types as $payment_type)
                                <option value={{ $payment_type }} {{ ($payment->payment_type == $payment_type) ? 'selected=selected' : ''}}>@lang($payment_type)</option>
                            @endforeach
                        </select>
                       
                        @error('payment_type')
                        <div class="text-danger pt-1 mx-1">
                            {{ $message }}
                        </div>
                        @enderror
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
