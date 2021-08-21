@extends('admin.layouts.app')

@section('content')

@include('admin.layouts.breadcrumb', [
    'items' => [
        'user_table' => route('users.index'),
        'detail' => null
    ]
])


<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="text fw-bold">
                        @lang('user_detail')
                    </h4>
                    <div>
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-info align-self-center">
                            @lang('edit')
                        </a>
                        <a href="{{ route('users.index') }}" class="btn btn-sm btn-dark align-self-center">
                            @lang('back')
                        </a>
                    </div>
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
                <div class="col-md-12">
                    <div class="row">
                        <table class="table table-borderless py-5">
                            <tbody>
                                <tr>
                                    <td class="fw-bold">@lang('name')</td>
                                    <td class="fw-bold">{{ $user->full_name }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">@lang('user_name')</td>
                                    <td class="fw-bold">{{ $user->user_name }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">@lang('email')</td>
                                    <td class="fw-bold">{{ $user->email }}</td>
                                </tr>
                            </tbody>
                        </table>
                        {{-- <div class="col-6 mx-auto text-right mb-2">
                            <span  </span>
                        </div>
                        <div class="col-6 mx-auto">
                            <span class="fw-bold">{{ $user->first_name }} </span>
                            <span class="fw-bold">{{ $user->last_name }}</span>
                        </div>
                        <div class="col-6 mx-auto text-right mb-2">
                            <span class="fw-bold">@lang('user_name'): </span>
                        </div>
                        <div class="col-6 mx-auto">
                            <span class="fw-bold">{{ $user->user_name }} </span>
                        </div>
                        <div class="col-6 mx-auto text-right mb-2">
                            <span class="fw-bold">@lang('email'): </span>
                        </div>
                        <div class="col-6 mx-auto">
                            <span class="fw-bold">{{ $user->email }} </span>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

@endsection
