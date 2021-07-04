<?php

namespace App\Http\Resources\Front;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'name' => $this->name,
            'category' => new CategoryResource($this->category),
            'subcategory' => new CategoryResource($this->subcategory),
            'brand' => new BrandResource($this->brand),
            'attribute' => new ProductAttributeResource($this->attribute),
            'slug' => $this->slug,
        ];
    }
}
