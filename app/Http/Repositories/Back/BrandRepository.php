<?php

namespace App\Http\Repositories\Back;

use App\Models\Brand;

class BrandRepository
{
    public function model()
    {
        return (new Brand());
    }

    public function getAll()
    {
        return $this->model()->orderBy('name_' . session('locale'))->paginate(10);
    }

    public function store($request)
    {

        $photo = $this->photoUpload($request->file('photo'));

        return $this->model()->create([
            'name_en' => $request->name_en,
            'name_mm' => $request->name_mm,
            'photo' => $photo,
            'slug' => strtoslug($request->name_en),
            'description_en' => $request->description_en,
            'description_mm' => $request->description_mm,
        ]);
    }

    public function update($request, $brand)
    {
        $photo = $request->old_photo;

        if ($request->hasFile('photo')) {
            $photo = $this->photoUpload($request->file('photo'));
        }

        return $brand->update([
            'name_en' => $request->name_en,
            'name_mm' => $request->name_mm,
            'photo' => $photo,
            'slug' => strtoslug($request->name_en),
            'description_en' => $request->description_en,
            'description_mm' => $request->description_mm,
        ]);
    }

    protected function photoUpload($photo)
    {
        $path = public_path() . '/img/brands/';
        $photo->move($path, $photo->getClientOriginalName());
        return json_encode('/img/brands/' . $photo->getClientOriginalName());
    }

    public function destroy($slug)
    {
        $brand = $this->model()->onlyTrashed()->where('slug', $slug)->first();

        return $brand->forceDelete();
    }

    public function toTrash(Brand $brand)
    {
        $brand->active = 0;
        $brand->save();

        return $brand->delete();
    }

    public function restore($slug)
    {
        $brand = $this->model()->onlyTrashed()->where('slug', $slug)->first();
        $brand->active = 1;
        $brand->save();

        return $brand->restore();
    }

    public function trashed()
    {
        return $this->model()->onlyTrashed()->paginate(10);
    }
}
