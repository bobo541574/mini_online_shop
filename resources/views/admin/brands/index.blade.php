@extends('admin.layouts.app')

@section('content')

@include('admin.layouts.breadcrumb', [
    'items' => [
        'brand' => ''
    ]
])

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="text fw-bold">
                        @lang('brands')
                    </h4>
                    <div>
                        <a href="{{ route('brands.create') }}" class="btn btn-sm btn-primary align-self-center">
                            @lang('create')
                        </a>
                        <a href="{{ route('brands.trashed') }}" class="btn btn-sm btn-secondary align-self-center">
                            @lang('trashed')
                        </a>
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
                    <table class="table table-responsive table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="h5 fw-bold">
                                    @lang('name')
                                </th>
                                <th class="h5 fw-bold">
                                    @lang('brand_photo')
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
                            @foreach ($brands as $brand)
                            <tr>
                                <td>
                                    {{ $brand->name }}
                                </td>
                                <td>
                                    <img src="{{ asset($brand->image) }}" class="avatar img-fluid" alt="brand-logo">
                                </td>
                                <td>
                                    @if ($brand->active)
                                        <i class="fas fa-circle text-success align-middle text-sm mr-2"></i>
                                        <span class="">@lang('active')</span>
                                    @else
                                        <i class="fas fa-circle text-danger mr-2"></i>
                                        @lang('inactive')
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">

                                        <a href="{{ route('brands.edit', $brand) }}" class="" title="@lang('brand_edit')">
                                            <div class="my-2">
                                                <i class="align-middle text-warning" data-feather="edit"></i>
                                            </div>
                                        </a>
        
                                        <form action="{{ route('brands.to-trash', $brand) }}" method="post" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <button class="border-0 text-danger bg-light" title="@lang('brand_remove')">
                                                <div class="my-2">
                                                    <i class="align-middle" data-feather="trash"></i>
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
                <div class="d-flex justify-content-center">
                    {{ $brands->links() }}
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
