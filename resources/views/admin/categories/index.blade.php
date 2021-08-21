@extends('admin.layouts.app')

@section('content')

@include('admin.layouts.breadcrumb', [
    'items' => [
        'category_table' => ''
    ]
])

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="text fw-bold">
                        @lang('category_table')
                    </h4>
                    <div>
                        <a href="{{ route('categories.create') }}" class="btn btn-sm btn-primary align-self-center">
                            @lang('create')
                        </a>
                        <a href="{{ route('categories.trashed') }}" class="btn btn-sm btn-secondary align-self-center">
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
                    <thead class="table-light">
                        <tr>
                            <th class="h5 fw-bold">
                                #
                            </th>
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
                        @forelse ($categories as $key => $category)
                        <tr>
                            <td>
                                {{ numberTranslate($categories->firstItem() + $key) }}
                            </td>
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
                                    <a href="{{ route('categories.edit', $category) }}" class="" title="@lang('category_edit')">
                                        <i class="align-middle text-warning" data-feather="edit"></i>
                                    </a>

                                    <form action="{{ route('categories.to-trash', $category) }}" method="post" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button class="border-0 text-danger bg-light" title="@lang('category_remove')">
                                            <i class="align-middle" data-feather="trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                            nothing to show
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $categories->links() }}
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
