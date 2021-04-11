@extends('admin.layouts.app')

@section('content')

@include('admin.layouts.breadcrumb', [
    'items' => [
        'assign' => route('assigns.index'),
        'create' => null
    ]
])


<div class="row">
    <div class="col-md-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="text fw-bold">
                        @lang('assign_create')
                    </h4>
                    <a href="{{ route('assigns.index') }}" class="btn btn-sm btn-dark align-self-center">
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
                <form action="{{ route('assigns.update', $role) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="role" class="form-label fw-bold">@lang('role')</label>
                        <select class="form-select" id="role" name="role_id" aria-label="Default select example">
                            @foreach ($roles as $r)
                                <option value="{{ $r->id }}" {{ $r->id == $role->id ? 'selected=selected' : '' }}>{{$role->name}}</option>
                            @endforeach
                          </select>
                    </div>

                    <div class="mb-3">
                        <label for="permission" class="form-label fw-bold">@lang('permission')</label>
                        <div class="row mt-1">
                            @foreach ($permissions as $key => $permission)
                                <div class="col-md-4">
                                    <span class="fw-bold">@lang($key)</span>
                                    <hr class="my-2 w-75 border border-dark">
                                    @foreach ($permission as $p)
                                        <div class="form-check">
                                            <input type="checkbox" name="permission[]" value="{{ $p->id }}" 
                                                id="permission-{{ $p->id }}" class="form-check-input" @if (in_array($p->id, pluck_relation($role))) {{ 'checked=checked' }} @endif>
                                            <label for="permission-{{ $p->id }}" class="form-check-label">{{ $p->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
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
