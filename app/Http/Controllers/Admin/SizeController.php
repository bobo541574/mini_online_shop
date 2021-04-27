<?php

namespace App\Http\Controllers\Admin;

use App\Models\Size;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Back\SizeRepository;
use App\Http\Requests\Back\Size\CreateRequest;

class SizeController extends Controller
{
    protected $sizeRepository;

    public function __construct(SizeRepository $sizeRepository)
    {
        $this->sizeRepository = $sizeRepository;
    }

    public function index()
    {
        $sizes = $this->sizeRepository->getAll();

        return view('admin.sizes.index', compact('sizes'));
    }

    public function create()
    {
        return view('admin.sizes.create');
    }

    public function store(CreateRequest $request)
    {
        $this->sizeRepository->store($request);

        return redirect()->route('sizes.index')->with('status', 'size_created');
    }

    public function edit(Size $size)
    {
        return view('admin.sizes.edit', compact('size'));
    }

    public function update(CreateRequest $request, Size $size)
    {
        $this->sizeRepository->update($request, $size);

        return redirect()->route('sizes.index')->with('status', 'size_updated');
    }

    public function destroy(Size $size)
    {
        $this->sizeRepository->destroy($size);

        return redirect()->route('sizes.index')->with('status', 'size_deleted');
    }
}
