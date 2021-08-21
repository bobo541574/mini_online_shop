@extends('admin.layouts.app')

@section('content')

@include('admin.layouts.breadcrumb', [
    'items' => [
        'category_table' => route('categories.index'),
        'trashed' => null
    ]
])

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="text fw-bold">
                        @lang('categories')
                    </h4>
                    <a href="{{ route('categories.index') }}" class="btn btn-sm btn-dark align-self-center">
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
                    <thead class="table-light">
                        <tr>
                            <th class="h5 fw-bold">
                                @lang('name')
                            </th>
                            <th class="h5 fw-bold">
                                @lang('status')
                            </th>
                            <th class="h5 fw-bold">
                                @lang('action')
                            </th>
                        </tr>
                    </thead>
                    <tbody class="{{ table_font_with_locale() }}">
                        @forelse ($categories as $category)
                        <tr>
                            <td>
                                {{ $category->name }}
                            </td>
                            <td>
                                @if ($category->active)
                                    <i class="fas fa-circle text-success align-middle text-sm mr-2"></i>
                                    <span class="">@lang('active')</span>
                                @else
                                    <i class="fas fa-circle text-danger mr-2"></i>
                                    @lang('inactive')
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-around my-2">
                                    <form action="{{ route('categories.restore', $category) }}" method="post" class="inline">
                                        @csrf
                                        <button class="border-0 text-danger bg-light" title="@lang('category_restore')">
                                            <i class="align-middle text-warning" data-feather="refresh-cw"></i>
                                        </button>
                                    </form>

                                    <form action="{{ route('categories.destroy', $category) }}" method="post" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="border-0 text-danger bg-light" title="@lang('category_delete')">
                                            <i class="align-middle" data-feather="trash-2"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <td class="text-center" colspan="3">nothing to show</td>
                        @endforelse
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
