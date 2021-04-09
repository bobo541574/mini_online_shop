@extends('admin.layouts.app')

@section('content')
<div class="px-4 md:px-10 mx-auto w-full -m-24 -mb-6">
    <div class="flex flex-wrap mt-4">
        <div class="w-full mb-12 px-4">
            <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white">
                <div class="rounded-t mb-0 px-4 py-3 border-0">
                    <div class="flex flex-wrap">
                        <div class="relative w-full px-4 max-w-full">
                            <div class="block sm:flex justify-between">
                                <h3 class="font-semibold text-lg text-blueGray-700">
                                    @lang('trashed_categories')
                                </h3>
                                <a href="{{ route('categories.create') }}" class="btn-secondary-sm">
                                    @lang('create')
                                </a>
                                {{-- <a href="{{ route('categories.create') }}" class="rounded border-2 border-green-300
                                hover:border-green-700 hover:text-blueGray-500 px-2 py1 font-semibold text-lg
                                text-blueGray-700">
                                Create
                                </a> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block w-full overflow-x-auto">
                    @if (session('status'))
                    <div class="bg-green-200 text-red-500 text-sm text-center rounded py-3 mx-12 mt-1 mb-3">
                        @lang(session('status'))
                    </div>
                    @endif
                    <!-- Projects table -->
                    <table class="items-center w-full bg-transparent border-collapse">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-bold text-left bg-blueGray-50 text-blueGray-700 border-blueGray-100">
                                    @lang('name')
                                </th>
                                <th
                                    class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-bold text-left bg-blueGray-50 text-blueGray-700 border-blueGray-100">
                                    @lang('status')
                                </th>
                                <th
                                    class="px-6 align-middle border border-solid py-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-bold text-left bg-blueGray-50 text-blueGray-700 border-blueGray-100">
                                    @lang('action')
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-blueGray-600 {{ session('locale') == 'mm' ? 'font-bold' : null }}">
                            @foreach ($categories as $category)
                            <tr>
                                <td
                                    class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4">
                                    {{ $category->name }}
                                </td>
                                <td
                                    class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4">
                                    @if ($category->active)
                                    <i class="fas fa-circle text-green-500 mr-2"></i>
                                    @lang('active')
                                    @else
                                    <i class="fas fa-circle text-orange-500 mr-2"></i>
                                    @lang('inactive')
                                    @endif
                                </td>
                                <td
                                    class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4">
                                    <a href="{{ route('categories.edit', $category) }}"
                                        class="text-md uppercase py-3 font-bold text-yellow-600 hover:text-yellow-400 mr-6"
                                        title="@lang('category_edit')">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('categories.destroy', $category) }}" method="post"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="text-md uppercase py-3 font-bold text-red-600 hover:text-red-400 focus:outline-none"
                                            title="@lang('category_delete')"><i class="fa fa-trash"
                                                aria-hidden="true"></i></button>
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
</div>
@endsection

@section('script')
<script>
    (() => {
        // let categoryId = ('{{ $categories->pluck("id") }}');
        // for (let cId = 0; cId < JSON.parse(categoryId).length;) {
        //     const toggleBox = document.querySelector(`#toggle-box-${++cId}`);
        //     toggleBox.classList.remove('bg-gray-300');
        //     toggleBox.classList.add('bg-green-400');
        //     toggleButton = toggleBox.children[0];
        //     toggleButton.classList.add('translate-x-6');
        // }

    })();

</script>
@endsection
