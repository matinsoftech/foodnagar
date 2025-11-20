<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'category_id' => $this->category_id ?? null,
            'feature_status'       => $this->feature_status,
            'vendor_type' => $this->vendor_type ?? $this->category->vendor_type,
            'name' => $this->name,
            'photo' => $this->photo,
            'banner' => $this->getFirstMediaUrl('banner'),
            'color' => $this->color ?? "#eeeeee",
            'priority' => $this->priority ?? null,
            'has_subcategories' => (bool) ($this->has_subcategories ?? false),
        ];
    }
}
