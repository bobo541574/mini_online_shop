@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center fw-bold">@lang('register_form')</h4>
                </div>
                <hr class="my-0 mx-2" />
                <div class="card-body">
                    <form action="{{ route('register') }}" method="post">
                        @csrf

                        <div class="mb-3 px-4">
                            <label for="first_name" class="form-label fw-bold">@lang('first_name')</label>
                            <input type="text" name="first_name" id="first_name" class="form-control"
                                placeholder="@lang('enter_first_name')">

                            @error('first_name')
                            <div class="text-red-500 text-xs pt-2 pl-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3 px-4">
                            <label for="last_name" class="form-label fw-bold">@lang('last_name')</label>
                            <input type="text" name="last_name" id="last_name" class="form-control"
                                placeholder="@lang('enter_last_name')">

                            @error('last_name')
                            <div class="text-red-500 text-xs pt-2 pl-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3 px-4">
                            <label for="user_name" class="form-label fw-bold">@lang('user_name')</label>
                            <input type="text" name="user_name" id="user_name" class="form-control"
                                placeholder="@lang('enter_user_name')">

                            @error('user_name')
                            <div class="text-red-500 text-xs pt-2 pl-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3 px-4">
                            <label for="email" class="form-label fw-bold">@lang('email')</label>
                            <input type="text" name="email" id="email" class="form-control"
                                placeholder="@lang('enter_email')">

                            @error('email')
                            <div class="text-red-500 text-xs pt-2 pl-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3 px-4">
                            <label for="phone" class="form-label fw-bold">@lang('phone')</label>
                            <input type="text" name="phone" id="phone" class="form-control"
                                placeholder="@lang('enter_phone')">

                            @error('phone')
                            <div class="text-red-500 text-xs pt-2 pl-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3 px-4">
                            <label for="password" class="form-label fw-bold">@lang('password')</label>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="@lang('enter_password')">

                            @error('password')
                            <div class="text-red-500 text-xs pt-2 pl-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3 px-4">
                            <label for="password_confirmation" class="form-label fw-bold">@lang('password_confirm')</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control" placeholder="@lang('enter_password_confirm')">

                            @error('password_confirmation')
                            <div class="text-red-500 text-xs pt-2 pl-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        {{-- <div class="mb-3 px-4 pt-1">
                                <label class="form-label fw-bold-check" for="remember">
                                    <input id="remember" name="remember" type="checkbox" class="form-checkbox"/>
                                    <span class="ml-2 text-sm font-semibold text-gray-700">Remember me</span
                                ></label>
                            </div> --}}

                        <div class="mb-3 text-center px-4">
                            <button class="btn btn btn-success" type="submit">
                                @lang('register')
                            </button>
                        </div>

                        <div class="mb-3 text-center">
                            <a href="{{ route('login') }}"
                                class="fw-bold text-info">@lang('already_registered')</a>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
