@extends('admin.layouts.app')

@section('content')

@include('admin.layouts.breadcrumb', [
    'items' => [
        'user_table' => route('users.index'),
        'edit' => null
    ]
])


<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="text fw-bold">
                        @lang('user_edit')
                    </h4>
                    <a href="{{ route('users.index') }}" class="btn btn-sm btn-dark align-self-center">
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
                <form action="{{ route('users.update', $user) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="first_name" class="form-label fw-bold">@lang('first_name')</label>
                        <input type="text" name="first_name" value="{{ $user->first_name }}" id="first_name" class="form-control"
                            placeholder="@lang('enter_first_name')">

                        @error('first_name')
                        <div class="text-danger pt-1 mx-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="last_name" class="form-label fw-bold">@lang('last_name')</label>
                        <input type="text" name="last_name" value="{{ $user->last_name }}" id="last_name" class="form-control"
                            placeholder="@lang('enter_last_name')">
                
                        @error('last_name')
                        <div class="text-danger pt-1 mx-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="user_name" class="form-label fw-bold">@lang('user_name')</label>
                        <input type="text" name="user_name" value="{{ $user->user_name }}" id="user_name" class="form-control"
                            placeholder="@lang('enter_user_name')">
                
                        @error('user_name')
                        <div class="text-danger pt-1 mx-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">@lang('email')</label>
                        <input type="text" name="email" value="{{ $user->email }}" id="email" class="form-control"
                            placeholder="@lang('enter_email')">
                
                        @error('email')
                        <div class="text-danger pt-1 mx-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label fw-bold">@lang('role')</label>
                        <select class="form-select" id="role" name="role_id" aria-label="Default select example">
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ ($role->id == $user->role_id) ? 'selected=selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                
                    <div class="mb-3">
                        <label for="phone" class="form-label fw-bold">@lang('phone')</label>
                        <input type="text" name="phone" value="{{ $user->phone }}" id="phone" class="form-control"
                            placeholder="@lang('enter_phone')">
                
                        @error('phone')
                        <div class="text-danger pt-1 mx-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                
                    {{-- <div class="mb-3">
                        <label for="password" class="form-label fw-bold">@lang('password')</label>
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="@lang('enter_password')">
                
                        @error('password')
                        <div class="text-danger pt-1 mx-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirm" class="form-label fw-bold">@lang('password_confirm')</label>
                        <input type="password" name="password_confirmation" id="password_confirm" class="form-control"
                            placeholder="@lang('enter_password_confirm')">
                
                        @error('password_confirmation')
                        <div class="text-danger pt-1 mx-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div> --}}

                    <div class="text-center">
                        <button class="btn btn btn-primary" type="submit">
                            @lang('update')
                        </button>
                    </div>  
                </form>
            </div>
        </div>
        
    </div>
</div>

@endsection
