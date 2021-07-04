<?php

namespace App\Http\Repositories\Back;

use App\Models\Color;

class ColorRepository
{
    public function model()
    {
        return (new Color());
    }

    public function getAll()
    {
        return $this->model()->orderBy('name_' . session('locale'))->paginate(10);
    }

    public function store($request)
    {
        return $this->model()->create([
            'name_en' => $request->name_en,
            'name_mm' => $request->name_mm,
            'color_code' => $request->color_code ?? '',
            'slug' => strtoslug($request->name_en),
        ]);
    }

    public function update($request, $color)
    {
        return $color->update([
            'name_en' => $request->name_en,
            'name_mm' => $request->name_mm,
            'color_code' => $request->color_code ?? '',
            'slug' => strtoslug($request->name_en),
        ]);
    }

    public function destroy($color)
    {
        return $color->delete();
    }
}
