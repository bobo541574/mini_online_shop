@extends('admin.layouts.app')

@section('content')

@include('admin.layouts.breadcrumb', [
    'items' => [
        'subcategory_table' => ''
    ]
])

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="text fw-bold">
                        @lang('subcategory_table')
                    </h4>
                    <div>
                        <a href="{{ route('subcategories.create') }}" class="btn btn-sm btn-primary align-self-center">
                            @lang('create')
                        </a>
                        <a href="{{ route('subcategories.trashed') }}" class="btn btn-sm btn-secondary align-self-center">
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
                <table class="table table-responsive table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="h5 fw-bold">
                                @lang('name')
                            </th>
                            <th class="h5 fw-bold">
                                @lang('category')
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
                        @foreach ($subcategories as $subcategory)
                        <tr>
                            <td>
                                {{ $subcategory->name }}
                            </td>
                            <td>
                                {{ $subcategory->category_name }}
                            </td>
                            <td>
                                @if ($subcategory->active)
                                    <i class="fas fa-circle text-success align-middle text-sm mr-2"></i>
                                    <span class="">@lang('active')</span>
                                @else
                                    <i class="fas fa-circle text-danger mr-2"></i>
                                    @lang('inactive')
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <a href="{{ route('subcategories.edit', $subcategory) }}" class="" title="@lang('subcategory_edit')">
                                        <div class="my-2">
                                            <i class="align-middle text-warning" data-feather="edit"></i>
                                        </div>
                                    </a>
    
                                    <form action="{{ route('subcategories.to-trash', $subcategory) }}" method="post" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button class="border-0 text-danger bg-light" title="@lang('subcategory_remove')">
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
                <div class="d-flex justify-content-center">
                    {{ $subcategories->links() }}
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
