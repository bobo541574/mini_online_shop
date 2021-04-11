<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\BrandRequest;
use App\Http\Repositories\BrandRepository;
use App\Http\Requests\Brand\UpdateRequest;

class BrandController extends Controller
{
    protected $brandRepository;

    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function index()
    {
        $brands = $this->brandRepository->getAllBrands();

        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(BrandRequest $request)
    {
        $this->brandRepository->store($request);

        return redirect()->route('brands.index')->with('status', 'brand_created');
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(UpdateRequest $request, Brand $brand)
    {
        $this->brandRepository->update($request, $brand);

        return redirect()->route('brands.index')->with('status', 'brand_updated');
    }

    public function destroy($slug)
    {
        $this->brandRepository->destroy($slug);

        return redirect()->route('brands.index')->with('status', 'brand_deleted');
    }

    public function toTrash(Brand $brand)
    {
        $this->brandRepository->toTrash($brand);

        return redirect()->route('brands.index')->with('status', 'brand_deleted');
    }

    public function restore($slug)
    {
        $this->brandRepository->restore($slug);

        return redirect()->route('brands.index')->with('status', 'brand_restored');
    }

    public function trashed()
    {
        $brands = $this->brandRepository->trashed();

        return view('admin.brands.trashed', compact('brands'));
    }

    public function restoreAll()
    {
    }
}
