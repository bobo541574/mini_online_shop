<?php

namespace App\Http\Controllers\Admin;

use App\Models\Size;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Size\SizeRequest;
use App\Http\Repositories\SizeRepository;

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

    public function store(SizeRequest $request)
    {
        $this->sizeRepository->store($request);

        return redirect()->route('sizes.index')->with('status', 'color_created');
    }

    public function edit(Size $color)
    {
        return view('admin.sizes.edit', compact('color'));
    }

    public function update(SizeRequest $request, Size $color)
    {
        $this->sizeRepository->update($request, $color);

        return redirect()->route('sizes.index')->with('status', 'color_updated');
    }

    public function destroy(Size $color)
    {
        $this->sizeRepository->destroy($color);

        return redirect()->route('sizes.index')->with('status', 'color_deleted');
    }
}
