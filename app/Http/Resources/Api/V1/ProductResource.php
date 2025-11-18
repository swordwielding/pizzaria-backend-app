<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'image' => $this->image,
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'categoryId' => $this->category_id,
            'tags' => TagResource::collection($this->whenLoaded('tags')),
            'tagIds' => $this->tag_ids,
            'isAvailable' => $this->is_available,
        ];
    }
}
