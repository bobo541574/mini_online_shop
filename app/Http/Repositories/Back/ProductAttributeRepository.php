<?php

namespace App\Http\Repositories\Back;

use App\Http\Requests\Back\ProductAttribute\CreateRequest;
use App\Http\Requests\Back\ProductAttribute\UpdateRequest;
use App\Models\ProductAttribute;
use App\Services\UploadFileService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

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

    public function attributesByProduct($slug, $data)
    {
        return $this->model()->with(['color', 'size'])->whereHas('product', function (Builder $query) use ($slug) {
            return $query->where('slug', $slug);
        })->paginate($data);
    }

    public function store(CreateRequest $request)
    {
        return $this->model()->create([
            'product_id' => $request->product_id,
//            'photo' => $request->photo,
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

    public function uploadPhoto(Request $request)
    {
        return UploadFileService::upload($request->file('file'), '/photos/products/attributes/');
    }

    public function removePhoto(Request $request)
    {
        return UploadFileService::delete($request->filename);
    }

    public function showPhoto($attributes)
    {
        return $this->model()
            ->findOrFail($attributes->id)
            ->images;
    }

    protected function photoUpload($attribute, $photos)
    {
        $attribute->images()->delete();

        $photos = request('photo');
        foreach ($photos as $photo) {
            $attribute->images()->create([
                'name' => $photo,
            ]);
        }
//        $photoArray = [];
//
//        $location = "/img/products/";
//        $path = public_path() . $location;
//
//        if (request()->hasFile('photo')) {
//            foreach ($photos as $photo) {
//                $photo->move($path, $photo->getClientOriginalName());
//                $photoArray[] = $location . $photo->getClientOriginalName();
//
//            }
//        }
//
//        return json_encode($photoArray);
    }

    public function update(UpdateRequest $request, $attribute)
    {
//        $this->photoUpload($attribute, $request->photo);

        return $attribute->update([
            'product_id' => $request->product_id,
            'color_id' => $request->color,
            'size_id' => $request->size,
            "slug" => strtoslug([$request->product_name, $request->color . $request->size], $attribute->created_at),
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
        $product = $attribute->product;

        $attribute->forceDelete();
        return $product;
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

        return $attribute->product;
    }
}
