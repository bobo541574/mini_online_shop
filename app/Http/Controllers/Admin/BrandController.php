<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Back\BrandRepository;
use App\Http\Requests\Back\Brand\CreateRequest;
use App\Http\Requests\Back\Brand\UpdateRequest;

class BrandController extends Controller
{
    protected $repo;

    public function __construct(BrandRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $brands = $this->repo->getAll();

        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(CreateRequest $request)
    {
        $this->repo->store($request);

        return redirect()->route('brands.index')->with('status', 'brand_created');
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(UpdateRequest $request, Brand $brand)
    {
        $this->repo->update($request, $brand);

        return redirect()->route('brands.index')->with('status', 'brand_updated');
    }

    public function destroy($slug)
    {
        $this->repo->destroy($slug);

        return redirect()->route('brands.index')->with('status', 'brand_deleted');
    }

    public function toTrash(Brand $brand)
    {
        $this->repo->toTrash($brand);

        return redirect()->route('brands.index')->with('status', 'brand_deleted');
    }

    public function restore($slug)
    {
        $this->repo->restore($slug);

        return redirect()->route('brands.index')->with('status', 'brand_restored');
    }

    public function trashed()
    {
        $brands = $this->repo->trashed();

        return view('admin.brands.trashed', compact('brands'));
    }

    public function restoreAll()
    {
        dd("restoreAll");
    }
}
