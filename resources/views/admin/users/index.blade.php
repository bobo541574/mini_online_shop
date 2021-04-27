@extends('admin.layouts.app')

@section('content')

@include('admin.layouts.breadcrumb', [
    'items' => [
        'user_table' => ''
    ]
])

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="text fw-bold">
                        @lang('user_table')
                    </h4>
                    <div>
                        <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary align-self-center">
                            @lang('create')
                        </a>
                        {{-- <a href="{{ route('users.trashed') }}" class="btn btn-sm btn-secondary align-self-center">
                            @lang('trashed')
                        </a> --}}
                    </div>
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
                <table class="table table-responsive table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="h5 fw-bold">
                                @lang('name')
                            </th>
                            <th class="h5 fw-bold">
                                @lang('roles')
                            </th>
                            <th class="h5 fw-bold">
                                @lang('action')
                            </th>
                        </tr>
                    </thead>
                    <tbody class="{{ session('locale') == 'mm' ? 'fw-bold' : null }}">
                        @foreach ($users as $user)
                        <tr>
                            <td>
                                {{ $user->name }}
                            </td>
                            
                            <td>
                                <span class="badge {{ ($user->role_id !== 0) ? "bg-success" : "bg-info" }}">{{ ($user->role_id !== 0) ? $user->role->name : 'Not Assigned' }}</span>
                            </td>
                            
                            <td>
                                <div class="d-flex justify-content-around">
                                    <a href="{{ route('users.edit', $user) }}" class="" title="@lang('user_edit')">
                                        <div class="my-2">
                                            <i class="align-middle text-warning" data-feather="edit"></i>
                                        </div>
                                    </a>
    
                                    <form action="{{ route('users.destroy', $user) }}" method="post" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="border-0 text-danger bg-light" title="@lang('user_delete')">
                                            <div class="my-2">
                                                <i class="align-middle" data-feather="trash-2"></i>
                                            </div>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $users->links() }}
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
