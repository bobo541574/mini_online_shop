<?php

namespace App\Http\Controllers\Admin;

use App\Models\Color;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Back\ColorRepository;
use App\Http\Requests\Back\Color\CreateRequest;

class ColorController extends Controller
{
    protected $repo;

    public function __construct(ColorRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $colors = $this->repo->getAll();

        return view('admin.colors.index', compact('colors'));
    }

    public function create()
    {
        return view('admin.colors.create');
    }

    public function store(CreateRequest $request)
    {
        $this->repo->store($request);

        return redirect()->route('colors.index')->with('status', 'color_created');
    }

    public function edit(Color $color)
    {
        return view('admin.colors.edit', compact('color'));
    }

    public function update(CreateRequest $request, Color $color)
    {
        $this->repo->update($request, $color);

        return redirect()->route('colors.index')->with('status', 'color_updated');
    }

    public function destroy(Color $color)
    {
        $this->repo->destroy($color);

        return redirect()->route('colors.index')->with('status', 'color_deleted');
    }
}
