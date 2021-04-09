@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center fw-bold">@lang('login_form')</h4>
                    </div>

                    <hr class="my-0 mx-2" />

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-warning alert-dismissible mt-0 mb-3 mx-3" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <div class="alert-message">
                                    <strong>Testing</strong>
                                </div>
                            </div>
                        @endif
        
                        <form action="{{ route('login') }}" method="post">
                            @csrf
        
                            <div class="mb-3 px-4">
                                <label for="email" class="form-label fw-bold">@lang('email')</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="@lang('enter_email')">
                            
                                @error('email')
                                    <div class="text-red-500 text-xs pt-2 pl-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
        
                            <div class="mb-3 px-4">
                                <label for="password" class="form-label fw-bold">@lang('password')</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="@lang('enter_password')">
                            
                                @error('password')
                                    <div class="text-red-500 text-xs pt-2 pl-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="mb-3 px-4">
                                <div class="form-check">
                                  <input class="form-check-input" name="remember" type="checkbox" id="remember">
                                  <label class="form-check-label fw-bold" for="remember">
                                    @lang('remember_me')
                                  </label>
                                </div>
                              </div>
        
                            <div class="mb-3 px-4 text-center">
                                <button class="btn btn btn-success" type="submit">
                                    @lang('login')
                                </button>
                            </div>
        
                            <div class="mb-3 px-4 text-center fw-bold">
                                <a href="{{ route('register') }}" class="text-sm text-gray-600 font-bold hover:text-gray-900">@lang('not_registered')</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection