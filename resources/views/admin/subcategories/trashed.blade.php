@extends('admin.layouts.app')

@section('content')

@include('admin.layouts.breadcrumb', [
    'items' => [
        'subcategory' => route('subcategories.index'),
        'trashed' => null
    ]
])

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="text fw-bold">
                        @lang('subcategories')
                    </h4>
                    <a href="{{ route('subcategories.index') }}" class="btn btn-sm btn-primary align-self-center">
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
                            <td class="d-flex justify-content-around">
                                <form action="{{ route('subcategories.restore', $subcategory) }}" method="post" class="inline">
                                    @csrf
                                    <button class="border-0 text-danger bg-light" title="@lang('subcategory_restore')">
                                        <div class="my-2">
                                            <i class="align-middle text-warning" data-feather="refresh-ccw"></i>
                                        </div>
                                    </button>
                                </form>

                                <form action="{{ route('subcategories.destroy', $subcategory) }}" method="post" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="border-0 text-danger bg-light" title="@lang('subcategory_delete')">
                                        <div class="my-2">
                                            <i class="align-middle" data-feather="trash-2"></i>
                                        </div>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>

</script>
@endsection
