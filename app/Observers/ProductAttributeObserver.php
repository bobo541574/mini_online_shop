<?php

namespace App\Observers;

use App\Models\ProductAttribute;

class ProductAttributeObserver
{
    /**
     * Handle the ProductAttribute "created" event.
     *
     * @param \App\Models\ProductAttribute $productAttribute
     * @return void
     */
    public function created(ProductAttribute $productAttribute)
    {
        $photos = request('photo');
        foreach ($photos as $photo) {
            $productAttribute->images()->create([
                'name' => $photo,
            ]);
        }
    }

    /**
     * Handle the ProductAttribute "updated" event.
     *
     * @param \App\Models\ProductAttribute $productAttribute
     * @return void
     */
    public function updated(ProductAttribute $productAttribute)
    {
//        $productAttribute->images()->delete();
//
//        $photos = request('photo');
//        foreach ($photos as $photo) {
//            $productAttribute->images()->create([
//                'name' => $photo,
//            ]);
//        }
    }

    /**
     * Handle the ProductAttribute "saving" event.
     *
     * @param \App\Models\ProductAttribute $productAttribute
     * @return void
     */
    public function saving(ProductAttribute $productAttribute)
    {
        $productAttribute->images()->delete();

        $photos = request('photo');
        foreach ($photos as $photo) {
            $productAttribute->images()->create([
                'name' => $photo,
            ]);
        }
    }

    /**
     * Handle the ProductAttribute "deleted" event.
     *
     * @param \App\Models\ProductAttribute $productAttribute
     * @return void
     */
    public function deleted(ProductAttribute $productAttribute)
    {
        //
    }

    /**
     * Handle the ProductAttribute "restored" event.
     *
     * @param \App\Models\ProductAttribute $productAttribute
     * @return void
     */
    public function restored(ProductAttribute $productAttribute)
    {
        //
    }

    /**
     * Handle the ProductAttribute "force deleted" event.
     *
     * @param \App\Models\ProductAttribute $productAttribute
     * @return void
     */
    public function forceDeleted(ProductAttribute $productAttribute)
    {
        //
    }
}
