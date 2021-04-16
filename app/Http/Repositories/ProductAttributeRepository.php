<?php

namespace App\Http\Repositories;

use App\Models\ProductAttribute;

class ProductAttributeRepository
{
    public function model()
    {
        return (new ProductAttribute());
    }

    public function paginate($data)
    {
        return $attributes = $this->model()->with(['color', 'size'])->orderBy('arrived', 'desc')->paginate($data);
    }

    public function store($request)
    {
        $photos = $this->photoUpload($request->file('photo'));

        return $this->model()->create([
            'product_id' => $request->product_id,
            'photo' => $photos,
            'color_id' => $request->color,
            'size_id' => $request->size,
            "slug" => strtoslug([$request->product_name, $request->color . $request->size]),
            'sku' => $request->sku,
            'buy_price' => $request->buy_price,
            'extra_cost' => $request->extra_cost,
            'sale_price' => $request->sale_price,
            'arrived' => $request->arrived,
            'description_en' => $request->description_en,
            'description_mm' => $request->description_mm,
        ]);
    }

    protected function photoUpload($photos)
    {
        $photoArray = "";

        $location = "/img/products/";
        $path = public_path() . $location;

        if (request()->hasFile('photo')) {
            foreach ($photos as $photo) {
                $photo->move($path, $photo->getClientOriginalName());
                $photoArray .= ',' . $location . $photo->getClientOriginalName();
            }
        }

        return json_encode($photoArray);
    }

    public function update($request, $attribute)
    {
        $photos = $request->old_photo;

        if ($request->hasFile('photo')) {
            $photos = $this->photoUpload($request->file('photo'));
        }

        return $attribute->update([
            'product_id' => $request->product_id,
            'photo' => $photos,
            'color_id' => $request->color,
            'size_id' => $request->size,
            "slug" => strtoslug([$request->product_name, $request->color . $request->size]),
            'sku' => $request->sku,
            'buy_price' => $request->buy_price,
            'extra_cost' => $request->extra_cost,
            'sale_price' => $request->sale_price,
            'arrived' => $request->arrived,
            'description_en' => $request->description_en,
            'description_mm' => $request->description_mm,
        ]);
    }

    public function destory($slug)
    {
        $attribute = $this->model()->onlyTrashed()->where('slug', $slug)->frist();

        return $attribute->forceDelete();
    }

    public function remove($attribute)
    {
        $attribute->active = 0;
        $attribute->save();

        return $attribute->delete();
    }

    public function trashed()
    {
        return $this->model()->onlyTrashed()->paginate(10);
    }

    public function restore($slug)
    {
        $attribute = $this->model()->onlyTrashed()->where('slug', $slug)->first();
        $attribute->active = 1;
        $attribute->save();

        return $attribute->restore();
    }
}
