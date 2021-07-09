<?php

namespace App\Http\Controllers\Admin;

use App\Models\Size;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Back\SizeRepository;
use App\Http\Requests\Back\Size\CreateRequest;

class SizeController extends Controller
{
    protected $repo;

    public function __construct(SizeRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $sizes = $this->repo->getAll();

        return view('admin.sizes.index', compact('sizes'));
    }

    public function create()
    {
        return view('admin.sizes.create');
    }

    public function store(CreateRequest $request)
    {
        $this->repo->store($request);

        return redirect()->route('sizes.index')->with('status', 'size_created');
    }

    public function edit(Size $size)
    {
        return view('admin.sizes.edit', compact('size'));
    }

    public function update(CreateRequest $request, Size $size)
    {
        $this->repo->update($request, $size);

        return redirect()->route('sizes.index')->with('status', 'size_updated');
    }

    public function destroy(Size $size)
    {
        $this->repo->destroy($size);

        return redirect()->route('sizes.index')->with('status', 'size_deleted');
    }
}
