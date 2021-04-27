<?php

namespace App\Http\Controllers\Admin;

use App\Models\Color;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Back\ColorRepository;
use App\Http\Requests\Back\Color\CreateRequest;

class ColorController extends Controller
{
    protected $colorRepository;

    public function __construct(ColorRepository $colorRepository)
    {
        $this->colorRepository = $colorRepository;
    }

    public function index()
    {
        $colors = $this->colorRepository->getAll();

        return view('admin.colors.index', compact('colors'));
    }

    public function create()
    {
        return view('admin.colors.create');
    }

    public function store(CreateRequest $request)
    {
        $this->colorRepository->store($request);

        return redirect()->route('colors.index')->with('status', 'color_created');
    }

    public function edit(Color $color)
    {
        return view('admin.colors.edit', compact('color'));
    }

    public function update(CreateRequest $request, Color $color)
    {
        $this->colorRepository->update($request, $color);

        return redirect()->route('colors.index')->with('status', 'color_updated');
    }

    public function destroy(Color $color)
    {
        $this->colorRepository->destroy($color);

        return redirect()->route('colors.index')->with('status', 'color_deleted');
    }
}
