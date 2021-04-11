@extends('admin.layouts.app')

@section('content')

@include('admin.layouts.breadcrumb', [
    'items' => [
        'assign' => ''
    ]
])

<div class="row">
    <div class="col-md-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="text fw-bold">
                        @lang('assigns')
                    </h4>
                    <div>
                        <a href="{{ route('assigns.create') }}" class="btn btn-sm btn-primary align-self-center">
                            @lang('create')
                        </a>
                        {{-- <a href="{{ route('assigns.trashed') }}" class="btn btn-sm btn-secondary align-self-center">
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
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="h5 fw-bold">
                                    @lang('name')
                                </th>
                                <th class="h5 fw-bold w-75">
                                    @lang('permissions')
                                </th>
                                <th class="h5 fw-bold">
                                    @lang('action')
                                </th>
                            </tr>
                        </thead>
                        <tbody class="{{ session('locale') == 'mm' ? 'fw-bold' : null }}">
                            @foreach ($assigns as $assign)
                            <tr>
                                <td>
                                    {{ $assign->name }}
                                </td>
                                <td>
                                    @foreach ($assign->permissions as $permission)
                                        <span class="badge btn-info">{{ $permission->name }}</span>
                                    @endforeach
                                </td>
                                
                                <td class="">
                                    <a href="{{ route('assigns.edit', $assign) }}" class="" title="@lang('assign_edit')">
                                        <div class="my-2">
                                            <i class="align-middle text-warning" data-feather="edit"></i>
                                        </div>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                {{-- {{ $assigns->links() }} --}}
            </div>  
        </div>
    </div>
</div>
@endsection

@section('script')
<script>

</script>
@endsection
