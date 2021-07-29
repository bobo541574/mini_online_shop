@extends('admin.layouts.app')

@section('content')

@include('admin.layouts.breadcrumb', [
    'items' => [
        'color' => ''
    ]
])

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="text fw-bold">
                        @lang('color_table')
                    </h4>
                    <div>
                        <a href="{{ route('colors.create') }}" class="btn btn-sm btn-primary align-self-center">
                            @lang('create')
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
                                    #
                                </th>
                                <th class="h5 fw-bold">
                                    @lang('name')
                                </th>
                                <th class="h5 fw-bold">
                                    @lang('color_code')
                                </th>
                                <th class="h5 fw-bold">
                                    @lang('action')
                                </th>
                            </tr>
                        </thead>
                        <tbody class="{{ session('locale') == 'mm' ? 'fw-bold' : null }}">
                            @foreach ($colors as $key => $color)
                            <tr>
                                <td>
                                    {{ numberTranslate($colors->firstItem() + $key) }}
                                </td>
                                <td>
                                    {{ $color->name }}
                                </td>
                                <td>
                                    <input type="color" name="color_code" value="{{ $color->color_code }}" class="form-control form-control-color"
                                        placeholder="@lang('enter_color_color_code')">
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <a href="{{ route('colors.edit', $color) }}" class="" title="@lang('color_edit')">
                                            <div class="my-2">
                                                <i class="align-middle text-warning" data-feather="edit"></i>
                                            </div>
                                        </a>
        
                                        <form action="{{ route('colors.destroy', $color) }}" method="post" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="border-0 text-danger bg-light" title="@lang('color_delete')">
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
                </div>
                <div class="d-flex justify-content-center">
                    {{ $colors->links() }}
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
